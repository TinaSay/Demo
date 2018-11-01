<?php

namespace app\modules\auth\models;

use Yii;
use yii\base\Model;

/**
 * Class Login
 *
 * @package app\modules\auth\models
 */
class Login extends Model
{
    /**
     * @var string
     */
    public $login;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $verifyCode;

    /**
     * @var null|Auth
     */
    protected $auth = null;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['login'], 'string', 'max' => 32, 'min' => 4],
            [['password'], 'string', 'max' => 512, 'min' => 8],
            [['login', 'password'], 'required'],
            ['password', 'authorization'],
            [
                'verifyCode',
                'captcha',
                'captchaAction' => '/auth/default/captcha',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'login' => 'Логин',
            'password' => 'Пароль',
            'verifyCode' => 'Проверочный код',
        ];
    }

    public function authorization()
    {
        if (!$this->hasErrors()) {
            if (!$this->getAuth() || !$this->getAuth()->validatePassword($this->password)) {
                $this->addError('password', 'Неправильное имя пользователя или пароль');
            }
        }
    }

    /**
     * @return bool
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->getUser()->login($this->getAuth());
        } else {
            return false;
        }
    }

    /**
     * @return Auth
     */
    public function getAuth()
    {
        if ($this->auth === null) {
            $this->auth = Auth::findOne(['login' => $this->login, 'blocked' => Auth::BLOCKED_NO]);
        }

        return $this->auth;
    }
}
