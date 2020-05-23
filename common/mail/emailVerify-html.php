<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->verification_token]);
?>
<style>
    .link-button {
        border: 1px solid #ccc;
        padding: 6px 12px;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        cursor: pointer;
        background-image: none;
        border: 1px solid transparent;
        border-radius: 4px;
        text-decoration: none;

        color: #fff;
        background-color: #337ab7;
        border-color: #2e6da4;
    }

    .link-button:hover {
        color: #fff;
        background-color: #204d74;
        border-color: #122b40;
    }
</style>

<div class="verify-email">
    <p> Buenas <?= Html::encode($user->username) ?>. ¡Gracias por registrarte en la plataforma <?= Html::encode(Yii::$app->name) ?>!</p>
    <p> Para finalizar el proceso de registro, haz click sobre el siguiente botón para confirmar tu dirección de E-mail: </p>

    <!--<p> <a href=""><button> Verificar Cuenta </button><?= Html::a(Html::encode($verifyLink), $verifyLink) ?> </p>-->
    <p> <a href="<?= Html::encode($verifyLink) ?>" class="link-button"> Confirmar Email </a> </p>
</div>
