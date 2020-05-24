<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model {

//    public $username;
    public $email;
    public $password;
    public $showpw;
    public $rememberMe = true;
    private $_user;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            //email and password are both required
            [['email', 'password'], 'required', 'message'=>'Ingrese un valor para el campo "{attribute}".'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword', 'message'=>'La contraseña ingresada no es válida.'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login() {
        $pudoIngresar = false;
        if ($this->validate()) {
            $pudoIngresar = Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        return $pudoIngresar;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser() {
        if ($this->_user === null) {
//            $this->_user = User::findByUsername($this->username);
            $this->_user = User::findByEmail($this->email);     //modificado para acceder con el email
        }

        return $this->_user;
    }

}
