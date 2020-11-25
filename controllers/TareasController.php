<?php

namespace app\controllers;

use Yii;
use app\models\Tareas;
use app\models\TareasSearch;
use DateInterval;
use DateTime;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TareasController implements the CRUD actions for Tareas model.
 */
class TareasController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tareas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TareasSearch();
        $searchModel->find()->where(['usuario_id' => Yii::$app->user->identity->id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (!Yii::$app->user->isGuest) {
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                ]);
        } else {
            return $this->redirect(['/site/login']);
        }
    }

    /**
     * Displays a single Tareas model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tareas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tareas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tareas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tareas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $tarea = $this->findModel($id);
        if (!$tarea->esrealizada) {
            $tarea->delete();
            Yii::$app->session->setFlash('success', 'Tarea borrada con éxito.');
            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('success', 'No puedes borrar una tarea realizada.');
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Tareas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tareas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tareas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
