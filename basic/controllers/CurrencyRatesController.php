<?php

namespace app\controllers;

use Yii;
use app\models\CurrencyRates;
use app\models\Currency;
use app\models\CurrencyRatesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

error_reporting(0);

/**
 * CurrencyRatesController implements the CRUD actions for CurrencyRates model.
 */
class CurrencyRatesController extends Controller
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
     * Lists all CurrencyRates models.
     * @return mixed
     */
    public function actionIndex()
    {
        $models_currency_rate = CurrencyRates::find()->with('currency')->orderBy(['created_at' => SORT_DESC])->all();

        return $this->render('index', [
            'models_currency_rate' => $models_currency_rate,
        ]);
    }

    /**
     * Displays a single CurrencyRates model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = CurrencyRates::find()->with('currency')->where(['id' => $id])->limit(1)->one();
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new CurrencyRates model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CurrencyRates();
        $models_currency = Currency::find()->where(['status' => self::ACTIVE])->orderBy(['name' => SORT_ASC])->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'models_currency' => $models_currency,
            ]);
        }
    }

    /**
     * Updates an existing CurrencyRates model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $models_currency = Currency::find()->where(['status' => self::ACTIVE])->orderBy(['name' => SORT_ASC])->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'models_currency' => $models_currency,
            ]);
        }
    }

    /**
     * Deletes an existing CurrencyRates model.
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
     * Finds the CurrencyRates model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CurrencyRates the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CurrencyRates::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
