<?php
/**
 * Created by PhpStorm.
 * User: elfuvo
 * Date: 24.05.18
 * Time: 12:12
 */

namespace app\tests\fixtures;

use Yii;
use yii\test\ActiveFixture;

/**
 * Class DbInitFixture
 *
 * @package elfuvo\menu\tests\fixtures
 */
class DbInitFixture extends ActiveFixture
{
    /**
     * @var string
     */
    public $tableName = '{{%migration}}';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        if (!Yii::$app->db->getSchema()->getTableSchema($this->tableName)) {
            Yii::$app->runAction('migrate/up');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function unload()
    {
        // do nothing
    }
}