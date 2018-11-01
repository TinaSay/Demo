<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 09.02.17
 * Time: 16:31
 */

return [
    /**
     * Search
     */
    'search/<p:\d+>/<per:\d+>' => 'search',
    'search/<p:\d+>' => 'search',
    /**
     * Glide
     */
    'render/<path:[\w\/\.]+>' => 'glide/default/render',
    /**
     * Filesystem
     */
    'attachment/<path:[\w\/\.\-]+>' => 'filesystem/default/attachment',
    /**
     * Backup
     */
    '<language:\w+\-\w+>/backup/download/<action:[\w\-]+>/<path:[\w\/\.\-\:]+>' => 'backup/download/<action>',
    /**
     * System
     */
    '<language:\w+\-\w+>' => '/',
    '<language:\w+\-\w+>/<module:[\w\-]+>' => '<module>',
    '<language:\w+\-\w+>/<module:[\w\-]+>/<controller:[\w\-]+>' => '<module>/<controller>',
    '<language:\w+\-\w+>/<module:[\w\-]+>/<controller:[\w\-]+>/<action:[\w\-]+>/<p:\d+>/<per:\d+>' => '<module>/<controller>/<action>',
    '<language:\w+\-\w+>/<module:[\w\-]+>/<controller:[\w\-]+>/<action:[\w\-]+>/<id:\d+>' => '<module>/<controller>/<action>',
    '<language:\w+\-\w+>/<module:[\w\-]+>/<controller:[\w\-]+>/<action:[\w\-]+>' => '<module>/<controller>/<action>',
];
