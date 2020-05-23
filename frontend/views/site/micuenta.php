<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = "Mi Perfil";
$this->params['breadcrumbs'][] = $this->title;
?>

<h1 class="text-center"> Perfil: <?= Html::encode(Yii::$app->user->identity->username); ?> </h1>

<div class='row'>
    <div class="col-sm-8 col-md-4 mt-4">
        <!-- Inicio Card JugadorClub -->
        <div class="card">
            <!-- Image JugadorClub -->
            <img class="card-img" src="" title="<?= Html::encode(Yii::$app->user->identity->username); ?>">
            <!-- Image JugadorClub -->

            <!-- Data JugadorClub -->
            <div class="card-body">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th> Nombre: </td>
                            <td> <?= Html::encode(Yii::$app->user->identity->username); ?> </td>
                        </tr>

                        <tr>
                            <th> Apellido: </td>
                            <td> <?= Html::encode(Yii::$app->user->identity->apellido); ?> </td>
                        </tr>
                        <tr>
                            <th> Email: </td>
                            <td> <?= Html::encode(Yii::$app->user->identity->email); ?> </td>
                        </tr>
                        </tr>
                        <tr>
                            <th> Telefono: </td>
                            <td> <?= Html::encode(Yii::$app->user->identity->telefono); ?> </td>
                        </tr>
                        <tr>
                            <th> Nacionalidad: </td>
                            <td> <?= Html::encode(Yii::$app->user->identity->nacionalidad); ?> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Data JugadorClub -->
        </div>
        <!-- Fin Card JugadorClub -->
    </div>
</div>

<!--<a href="<?= Url::toRoute(['club/listarposicionesclub']); ?>">Volver</a>-->