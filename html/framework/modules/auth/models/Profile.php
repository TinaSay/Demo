<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 19.07.17
 * Time: 23:54
 */

namespace app\modules\auth\models;

use Yii;
use yii\base\Model;

/**
 * Class Profile
 *
 * @property $password
 * @property $passwordNew
 *
 * @package app\modules\auth\models
 */
class Profile extends Model
{
    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $passwordNew;

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
            [['password', 'passwordNew'], 'string', 'max' => 512, 'min' => 8],
            [['password', 'passwordNew'], 'required'],
            [['password'], 'authorization'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'password' => 'Старый пароль',
            'passwordNew' => 'Новый пароль',
        ];
    }

    public function authorization()
    {
        if (!$this->hasErrors()) {
            if (!$this->getAuth() || !$this->getAuth()->validatePassword($this->password)) {
                $this->addError('password', 'Неправильный пароль');
            }
        }
    }

    /**
     * @return Auth
     */
    public function getAuth()
    {
        if ($this->auth === null) {
            $this->auth = Yii::$app->getUser()->getIdentity();
        }

        return $this->auth;
    }
}
