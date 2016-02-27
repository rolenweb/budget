<?php

namespace app\controllers;

use Yii;
use app\models\BalanceStartYear;
use app\models\Client;
use app\models\Accounts;
use app\models\BalanceStartYearSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


error_reporting(0);
/**
 * BalanceStartYearController implements the CRUD actions for BalanceStartYear model.
 */
class BalanceStartYearController extends Controller
{
    const ACTIVE = 1;
    const NOACTIVE = 2;
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all BalanceStartYear models.
     * @return mixed
     */
    public function actionIndex()
    {
        $models_start_balance = BalanceStartYear::find()->with('client','account.currency')->all();

        return $this->render('index', [
            'models_start_balance' => $models_start_balance,
        ]);
    }

    /**
     * Displays a single BalanceStartYear model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = BalanceStartYear::find()->with('client','account.currency')->where(['id' => $id])->limit(1)->one();
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new BalanceStartYear model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BalanceStartYear();
        $models_clinent = Client::find()->where(['status' => self::ACTIVE])->orderBy(['firstname' => SORT_ASC])->all();
        $models_account = Accounts::find()->where(['status' => self::ACTIVE])->orderBy(['name' => SORT_ASC])->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'models_clinent' => $models_clinent,
                'models_account' => $models_account,
            ]);
        }
    }

    /**
     * Updates an existing BalanceStartYear model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $models_clinent = Client::find()->where(['status' => self::ACTIVE])->orderBy(['firstname' => SORT_ASC])->all();
        $models_account = Accounts::find()->where(['status' => self::ACTIVE])->orderBy(['name' => SORT_ASC])->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'models_clinent' => $models_clinent,
                'models_account' => $models_account,
            ]);
        }
    }

    /**
     * Deletes an existing BalanceStartYear model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BalanceStartYear model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BalanceStartYear the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BalanceStartYear::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
