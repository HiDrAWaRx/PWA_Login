<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Plataforma - Juntar';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Juntar - Home</h1>

        <p class="lead">Inicio con el Login de la plataforma con lo roles: invitado, registrado,administrador</p>

        <p><a class="btn btn-lg btn-success" href="<?= Url::toRoute(['site/login']); ?>">Iniciar</a></p>
    </div>

    <div class="body-content">

        <div class="row">

        </div>

    </div>
</div>
