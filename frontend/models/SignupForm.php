<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model {

    public $username;
    public $email;
    public $password;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            //Campos requeridos
            [['nombre', 'apellido', 'email', 'password', 'telefono', 'nacionalidad'], 'required'],
            
            //Reglas nombre
            ['nombre', 'string', 'min' => 2, 'max' => 50],
            
            //Reglas apellido
            ['nombre', 'string', 'min' => 4, 'max' => 50],
            
            //Reglas email
            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'El email ingresado ya está registrado en la plataforma.'],
            
            //Reglas telefono
            ['telefono', 'string', 'min' => 7, 'max' => 30],
            
            //Reglas nacionalidad
            ['nacionalidad', 'string', 'min' => 4],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup() {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->nombre = $this->nombre;
        $user->apellido = $this->apellido;
        $user->email = $this->email;
//        $user->password = $this->username;
        $user->setPassword($this->password);
        $user->telefono = $this->telefono;
        $user->nacionalidad = $this->nacionalidad;
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        return $user->save() && $this->sendEmail($user);
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user) {
        return Yii::$app
                        ->mailer
                        ->compose(
                                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                                ['user' => $user]
                        )
                        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                        ->setTo($this->email)
                        ->setSubject('Confirmación de registro para tu cuenta en ' . Yii::$app->name)
                        ->send();
    }

}
