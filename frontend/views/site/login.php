<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Iniciar sesion';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="signup-parent">
        <h1 class="text-center mb-2"><?= Html::encode($this->title) ?></h1>

        <!--<p class="text-center"> Ingrese sus datos para iniciar sesión en la plataforma: </p>-->

        <div class="row">
            <div class="col-lg-5 signup-child-center">
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'showpw')->checkBox(['label' => 'Mostrar Contraseña', 'data-size' => 'small', 'class' => 'showPwLogin']) ?>

                <?= $form->field($model, 'rememberMe')->checkbox()->label("Recordarme") ?>

                <div style="color:#999;margin:1em 0">
                    Si olvidaste tu contraseña puedes <?= Html::a('restablecerla', ['site/request-password-reset']) ?>.
                    <br>
                    ¿No pudiste realizar la verificación? <?= Html::a('Solicitar nuevo correo de verificacion', ['site/resend-verification-email']) ?>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Ingresar', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
