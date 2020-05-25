<?php

namespace backend\controllers;

use Yii;
use common\modules\auth\models\AuthItem;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RbacController implements the CRUD actions for AuthItem model.
 */
class RbacController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    //create permission
    public function actionCreate_permission() {
        $auth = Yii::$app->authManager;

        // add "index" permission
        $index = $auth->createPermission('evento/index');
        $index->description = 'list all posts';
        $auth->add($index);

        // add "createEvento" permission
        $create = $auth->createPermission('evento/create');
        $create->description = 'Create Evento';
        $auth->add($create);
        
        // add "viewEvento" permission
        $view = $auth->createPermission('evento/view');
        $view->description = 'View Evento';
        $auth->add($view);
        
        // add "updateEvento" permission
        $update = $auth->createPermission('evento/update');
        $update->description = 'Update Evento';
        $auth->add($update);
        
        // add "deleteEvento" permission
        $delete = $auth->createPermission('evento/delete');
        $delete->description = 'Delete Evento';
        $auth->add($delete);
    }
    
    //create role
    public function actionCreate_role() {
        $auth = Yii::$app->authManager;
        //Organizador -> index/create/view
        //Admin -> Organizador + update/delete = index/create/view/update/delete

        $index = $auth->createPermission('evento/index');
        $create = $auth->createPermission('evento/create');
        $view = $auth->createPermission('evento/view');
        $update = $auth->createPermission('evento/update');
        $delete = $auth->createPermission('evento/delete');
        
        // add "organizador" role and give this role the "createPost" permission
        $organizador = $auth->createRole('organizador');
        $organizador->description = "Usuario que puede organizar eventos";
        $auth->add($organizador);
        $auth->addChild($organizador, $index);
        $auth->addChild($organizador, $create);
        $auth->addChild($organizador, $view);
        
        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $admin->description = "Superusuario Administrador";
        $auth->add($admin);
        $auth->addChild($admin, $organizador);
        $auth->addChild($admin, $update);
        $auth->addChild($admin, $delete);
    }
    
    //Asignando roles a usuarios
    public function actionAssignuser() {
        $auth = Yii::$app->authManager;
        
        $organizador = $auth->createRole('organizador');
        $admin = $auth->createRole('admin');
        
        // Assign roles to users. 5 and 6 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($organizador, 6);
        $auth->assign($admin, 5);
    }

    /**
     * Lists all AuthItem models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => AuthItem::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new AuthItem();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AuthItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = AuthItem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
