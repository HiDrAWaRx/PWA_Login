<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = "Mi Perfil";
$this->params['breadcrumbs'][] = $this->title;
?>

<h1 class="text-center"> Perfil: <?= Html::encode(Yii::$app->user->identity->username); ?> </h1>

<div class='row'>
    <div class="col-sm-10 col-md-4 mt-4">
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
                            <th> Nombre Completo: </td>
                            <td> <?= Html::encode(Yii::$app->user->identity->full_name); ?> </td>
                        </tr>
                        <tr>
                            <th> Email: </td>
                            <td> <?= Html::encode(Yii::$app->user->identity->email); ?> </td>
                        </tr>
                        <tr>
                            <th> Roles: </td>
                            <?php foreach ($model as $rol): ?>
                              <td><?= Html::encode("{$rol['name']}")?></th>
                            <?php endforeach; ?>
                        </tr>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!--<a href="<?= Url::toRoute(['club/listarposicionesclub']); ?>">Volver</a>-->
