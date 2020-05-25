<?php

namespace backend\controllers;

use Yii;
use backend\models\Evento;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * EventoController implements the CRUD actions for Evento model.
 */
class EventoController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
//        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['POST'],
//                ],
//            ],
//        ];
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                    'matchCallback' => function ($rule, $action) {
//                        $module = Yii::$app->controller->module->id;
                        $module = "backend";
                        $action = Yii::$app->controller->action->id;
                        $controller = Yii::$app->controller->id;
//                        $route = "$module/$controller/$action";
                        $route = "$controller/$action";
//                        echo json_encode($route);

//                        $this->redirect(array('thing/view', 'id' => 1));

                        $post = Yii::$app->request->post();
                        if (\Yii::$app->user->can($route, ['post' => $post])) {
//                            echo "hola";
                            return true;
                        } else {
//                            return $this->goHome();
                        }
                    }
                ],
            ],
        ];

        return $behaviors;

        
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'actions' => ['index'],
//                        'roles' => ['organizador'],
//                    ],
//                    [
//                        'allow' => true,
//                        'actions' => ['view'],
//                        'roles' => ['organizador'],
//                    ],
//                    [
//                        'allow' => true,
//                        'actions' => ['create'],
//                        'roles' => ['organizador'],
//                    ],
//                    [
//                        'allow' => true,
//                        'actions' => ['update'],
//                        'roles' => ['admin'],
//                    ],
//                    [
//                        'allow' => true,
//                        'actions' => ['delete'],
//                        'roles' => ['admin'],
//                    ],
//                ],
//            ],
//        ];
        
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'actions' => ['index'],
//                        'roles' => ['organizador'],
//                    ],
//                    [
//                        'allow' => true,
//                        'actions' => ['index'],
//                        'roles' => ['organizador'],
////                        'roles' => ['@'],
////                        'matchCallback' => function ($rule, $action) {
////                            return (\Yii::$app->user->can('view', ['post' => $post]));
////                        }
//                    ],
//                    [
//                        'allow' => true,
//                        'actions' => ['view'],
//                        'roles' => ['organizador'],
//                    ],
//                    [
//                        'allow' => true,
//                        'actions' => ['create'],
//                        'roles' => ['organizador'],
//                    ],
//                    [
//                        'allow' => true,
//                        'actions' => ['update'],
//                        'roles' => ['admin'],
//                    ],
//                    [
//                        'allow' => true,
//                        'actions' => ['delete'],
//                        'roles' => ['admin'],
//                    ],
//                ],
//            ],
//        ];
    }

    /**
     * Lists all Evento models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Evento::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Evento model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Evento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Evento();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idEvento]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Evento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idEvento]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Evento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Evento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Evento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Evento::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
