#!/usr/bin/env sh

. ./.env

do_exec() {
    docker exec -i --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_NAME" "$@"
}

do_cron() {
    docker exec -i "$CONTAINER_NAME" crontab -u "$APACHE_RUN_USER" "$@"
}

do_mysql_backup() {

    umask 177

    CONTAINER="$CONTAINER_NAME-mysql"

    DIRECTORY="docker/server/backup"
    if ! [ -d "$DIRECTORY" ]
    then
        mkdir --mode=0700 --parents "$DIRECTORY"
    fi

    if [ -z "$1" ]
    then
        DATE=$(date +"%Y-%m-%d %H:%M")
        COMMAND="$DIRECTORY/$MYSQL_DATABASE-$DATE.sql.gz"
    else
        COMMAND="$1"
    fi

    docker exec "$CONTAINER" mysqldump --single-transaction --no-create-db --verbose --user="$MYSQL_USER" --password="$MYSQL_PASSWORD" "$MYSQL_DATABASE" | gzip > "$COMMAND"

    find "$DIRECTORY" -type f -mtime +3 -exec rm {} \;

    echo "Done!"
}

do_mysql_restore() {

    CONTAINER="$CONTAINER_NAME-mysql"

    DIRECTORY="docker/server/backup"
    if ! [ -d "$DIRECTORY" ]
    then
        mkdir --mode=0700 --parents "$DIRECTORY"
    fi

    if [ -z "$1" ]
    then
        FILE=$(ls "$DIRECTORY" -t | head -1)
        COMMAND="$DIRECTORY/$FILE"
    else
        COMMAND="$1"
    fi

    gunzip < "$COMMAND" | docker exec -i "$CONTAINER" mysql --verbose --user="$MYSQL_USER" --password="$MYSQL_PASSWORD" "$MYSQL_DATABASE"

    echo "Done!"
}

do_mysql_drop_table() {

    CONTAINER="$CONTAINER_NAME-mysql"

    if [ -z "$1" ]
    then
        echo "Usage: docker.sh mysql-drop-table TABLE_NAME"
        exit 1;
    else
        TABLE="$1"
    fi

    docker exec -i "$CONTAINER" mysql --user="$MYSQL_USER" --password="$MYSQL_PASSWORD" "$MYSQL_DATABASE" -e "SET FOREIGN_KEY_CHECKS=0; DROP TABLE $TABLE;"
}

do_mysql_truncate_database() {

    CONTAINER="$CONTAINER_NAME-mysql"

    TABLES=$(docker exec -i "$CONTAINER" mysql --user="$MYSQL_USER" --password="$MYSQL_PASSWORD" "$MYSQL_DATABASE" -Nse "SHOW TABLES;")

    for TABLE in $TABLES
    do
        echo "DROP TABLE: $TABLE"
        do_mysql_drop_table "$TABLE"
    done
}

do_tests() {
    docker exec -i --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_NAME" framework/vendor/bin/codecept run --config=framework/codeception.yml
}

do_install() {
    docker exec -i --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_NAME" composer install --working-dir=framework
    docker exec -i --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_NAME" framework/yii migrate/up
    docker exec -i --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_NAME" framework/yii access/install
    docker exec -i --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_NAME" framework/yii cache/flush-all
}

do_update() {
    docker exec -i --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_NAME" composer update --working-dir=framework
    docker exec -i --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_NAME" framework/yii migrate/up
    docker exec -i --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_NAME" framework/yii access/install
    docker exec -i --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_NAME" framework/yii cache/flush-all
}

case "$1" in

    exec)
        shift
        do_exec $@
        ;;

    cron)
        shift
        do_cron $@
        ;;

    mysql-backup)
        shift
        do_mysql_backup $@
        ;;

    mysql-restore)
        shift
        do_mysql_restore $@
        ;;

    mysql-drop-table)
        shift
        do_mysql_drop_table $@
        ;;

    mysql-truncate-database)
        shift
        do_mysql_truncate_database
        ;;
    tests)
        shift
        do_tests
        ;;
    install)
        shift
        do_install
        ;;
    update)
        shift
        do_update
        ;;
    *)
    echo "Usage: docker.sh [exec|cron|mysql-backup|mysql-restore|mysql-drop-table|mysql-truncate-database|tests|install|update]"
    ;;

esac
