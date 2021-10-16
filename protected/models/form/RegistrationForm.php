<?php

namespace app\models\form;

use app\models\advanced\AdvancedUser;
use app\models\User;
use Yii;
use yii\helpers\Html;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read AdvancedUser|null $user This property is read-only.
 *
 */
class RegistrationForm extends User
{
    public $username = '';
    public $email = '';
    public $password = '';
    public $password_repeat = '';

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'required'],
            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],
            [['password', 'password_repeat'], 'required'],
            [['password', 'password_repeat'], 'string', 'min' => 3, 'max' => 25],
            ['password', 'compare', 'compareAttribute' => 'password_repeat'],
        ];
    }

    /**
     * Реєстрація нового користувача
     * @return AdvancedUser|null
     * @throws \yii\base\Exception
     */
    public function signUp()
    {
        if ($this->validate())
        {
            $user = new AdvancedUser();

            $user->username = Html::encode($this->username);
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->setAuthKey();
            $user->created_at = time();

            if($user->save(false))
            {
                // За замовчуванням назначаємо правило для користувача
                $auth = Yii::$app->authManager;
                $authorRole = $auth->getRole('user');
                $auth->assign($authorRole, $user->id);

                return $user;
            };
        }

        return null;
    }


    /**
     * Finds user by [[username]]
     *
     * @return AdvancedUser|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = AdvancedUser::findByUsername($this->username);
        }

        return $this->_user;
    }
}
