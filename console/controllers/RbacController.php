<?php
namespace app\commands;
namespace console\controllers;
use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
      // agrega el rol "author" y le asigna el permiso "createPost"
      $organizer= $auth->createRole('organizer');
      $auth->add($organizer);
      $auth->assign($organizer, 10);

      $admin = $auth->createRole('admin');
      $auth->add($admin);
      $auth->assign($admin, 8);

    }

}
