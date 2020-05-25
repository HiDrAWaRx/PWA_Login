<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $full_name;
    public $password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required', 'message' => 'Es necesario que ingrese un nombre de usuario.'],
            //['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'El usuario ingresado ya está registrado en la plataforma'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required', 'message' => 'Este campo es requerido.'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'El email ingresado ya está registrado en la plataforma.'],

            ['password', 'required', 'message' => 'Este campo es requerido.'],
            ['password', 'string', 'min' => 6],

            //Reglas Nombre Completo
            ['full_name', 'string', 'min' => 10, 'max' => 70],
            ['full_name', 'required', 'message' => 'Es necesario que ingrese su combre completo.'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->full_name = $this->full_name;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        return $user->save() && $this->sendEmail($user);

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' < correo automatico >'])
            ->setTo($this->email)
            ->setSubject('Confirmación de registro para tu cuenta en ' . Yii::$app->name)
            ->send();
    }

    public function attributeLabels()
    {
       return [
           'username' => 'Nombre de Usuario',
           'email' => 'Correo de Email',
           'full_name' => 'Nombre y Apellido Completo',
       ];
    }
}
