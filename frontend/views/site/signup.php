<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Registro';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">

    <div class="signup-parent">
        <h1 class="text-center mb-2"><?= Html::encode($this->title) ?></h1>

        <p class="text-center"> Complete el formulario para registrarse en la plataforma: </p>

        <div class="row">
            <div class="col-lg-5 border">
                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <div class="form-group signup-child-center">
                    <?= $form->field($model, 'nombre')->textInput(['autofocus' => true])->label('Nombre *') ?>
                    <?= $form->field($model, 'apellido')->label('Apellido *') ?>
                    <?= $form->field($model, 'telefono') ?>
                    <?= $form->field($model, 'nacionalidad') ?>
                    <?= $form->field($model, 'email')->label('Email *'); ?>
                    <?= $form->field($model, 'password')->passwordInput()->label('Password *'); ?>
                    <?= $form->field($model, 'showpw')->checkBox(['label' => 'Mostrar Contraseña', 'data-size' => 'small', 'class' => 'showPwSignup']) ?>
                </div>
                <div class="signup-child-center form-advice">
                    Los campos marcados con * son obligatorios.
                </div>

                <div class="form-group signup-child-center">
                    <?= Html::submitButton('Registrarse', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>


                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
