<?php

namespace app\models\form;

use app\models\advanced\AdvancedUser;
use Yii;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends AdvancedUser
{
    const USER_REMEMBER_ME_TIME = 3600 * 24;

    public $email;
    public $password;
    public $rememberMe = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            [['email', 'password'], 'trim'],
            [['email'], 'email'],
            ['rememberMe', 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('app/user', 'Email'),
            'password' => Yii::t('app/user', 'Password'),
            'rememberMe' => Yii::t('app/user', 'Remember Me'),
        ];
    }

    public function login()
    {
        if ($this->validate())
        {
            $user = AdvancedUser::findByEmail($this->email);

            if(empty($user))
            {
                $this->addError('email', 'There is no such user');
                return false;
            }

            if($user && $user->validatePassword($this->password))
            {
                return Yii::$app->user->login($user, $this->rememberMe ? self::USER_REMEMBER_ME_TIME : 0);
            }
            else
            {
                $this->addError('password', 'Incorrect password');
            }
        }
        return false;
    }
}
