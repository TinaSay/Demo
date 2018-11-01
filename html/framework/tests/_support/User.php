<?php
/**
 * Created by PhpStorm.
 * User: elfuvo
 * Date: 20.03.18
 * Time: 16:55
 */

namespace app\tests;

use Yii;
use yii\base\Model;
use yii\web\IdentityInterface;

/**
 * Class Client
 *
 * @property int $id
 * @property string $login
 * @property string $token
 * @property string $region
 * @property string $organization
 * @property string $department
 * @property array $roles
 *
 * @package app\modules\ns\models
 */
class User extends Model implements IdentityInterface
{
    public $id;
    public $login;
    public $token;
    public $region;
    public $organization;
    public $department;
    public $roles = [];

    public static $users = [
        100 => [
            'id' => 100,
            'login' => 'test_user',
            'token' => 'user-token-100',
            'region' => 'Moscow',
            'organization' => 'Nsign',
            'department' => 'Web development',
            'roles' => ['user', 'manager'],
        ],
    ];

    /**
     * init model
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'id',
            'login',
            'token',
            'region',
            'organization',
            'department',
            'roles',
        ];
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['id', 'integer'],
            [['login', 'token', 'region', 'organization', 'department'], 'string'],
            [
                ['roles'],
                'each',
                'rule' => ['string'],
            ],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'login' => 'Логин',
            'region' => 'Регион',
            'organization' => 'Организация',
            'department' => 'Департамент',
            'roles' => 'Роли',
        ];
    }

    /**
     * @param int|string $id
     *
     * @return IdentityInterface|static
     */
    public static function findIdentity($id)
    {
        if (array_key_exists($id, self::$users)) {
            Yii::$app->user->setIdentity(new self(self::$users[$id]));
        }

        return Yii::$app->user->getIdentity();
    }

    /**
     * @param mixed $token
     * @param null $type
     *
     * @return IdentityInterface|static
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['token'] == $token) {
                Yii::$app->user->setIdentity(new self($user));
                break;
            }
        }

        return Yii::$app->user->getIdentity();
    }

    /**
     * @return int|string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAuthKey()
    {
        return Yii::$app->user->getToken();
    }

    /**
     * @param string $auth_key
     *
     * @return bool
     */
    public function validateAuthKey($auth_key)
    {
        return Yii::$app->user->getToken() === $auth_key;
    }

    /**
     * @param $role
     *
     * @return bool
     */
    public function hasRole($role)
    {
        return in_array($role, $this->roles);
    }
}