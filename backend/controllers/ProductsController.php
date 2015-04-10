<?php

namespace backend\controllers;

use Yii;
use app\models\Products;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'update', 'delete', 'create', 'view'],
                        'allow' => true,
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Products();

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            $model = new Products(); //reset model
        }

        // for current user
        $DataProvider = new ActiveDataProvider([
            'query' => $model::find()->
                    where(['user_id'=>Yii::$app->user->identity->id])->
                    orderBy('name ASC'),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $DataProvider,
            'model' => $model,
        ]);
    }


    /**
     * Displays a single Products model.
     * @param integer $id
     * @return mixed
     */

    public function actionView()
    {
        $model = new Products();

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            $model = new Products(); //reset model
        }

        // for all users
        $DataProvider = new ActiveDataProvider([
            'query' => $model::find()->
                    where('quantity <> :quantity',[':quantity' => 0])->
                    orderBy('name ASC'),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('view', [
            'dataProvider' => $DataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Products();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->refresh();

            Yii::$app->response->format = 'json';
            return [
                'data' => $model,
                'action' => 'create'
            ];
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

           // return $this->redirect(['view', 'id' => $model->id]);
            Yii::$app->response->format = 'json';
            return [
                'data' => $this->findModel($id),
                'action' => 'update'
            ];
        }
        else{
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        Yii::$app->response->format = 'json';
        return [
            'data' => $model,
            'action' => 'delete'
        ];
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
