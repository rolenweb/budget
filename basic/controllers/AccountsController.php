<?php

namespace app\controllers;

use Yii;
use app\models\Accounts;
use app\models\Client;
use app\models\Currency;
use app\models\TypeAccounts;
use app\models\AccountsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

error_reporting(0);

/**
 * AccountsController implements the CRUD actions for Accounts model.
 */
class AccountsController extends Controller
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
     * Lists all Accounts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $models_account = Accounts::find()->with('client','currency', 'typeaccounts')->orderBy(['name' => SORT_ASC])->all();

        return $this->render('index', [
            'models_account' => $models_account,
            
        ]);
    }

    /**
     * Displays a single Accounts model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = Accounts::find()->with('client','currency', 'typeaccounts')->where(['id' => $id])->limit(1)->one();

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Accounts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Accounts();
        $models_clinent = Client::find()->where(['status' => self::ACTIVE])->orderBy(['firstname' => SORT_ASC])->all();
        $models_currency = Currency::find()->where(['status' => self::ACTIVE])->orderBy(['name' => SORT_ASC])->all();
        $models_type = TypeAccounts::find()->where(['status' => self::ACTIVE])->orderBy(['name' => SORT_ASC])->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'models_clinent' => $models_clinent,
                'models_currency' => $models_currency,
                'models_type' => $models_type,
            ]);
        }
    }

    /**
     * Updates an existing Accounts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = Accounts::find()->with('client','currency', 'typeaccounts')->where(['id' => $id])->limit(1)->one();
        $models_clinent = Client::find()->where(['status' => self::ACTIVE])->orderBy(['firstname' => SORT_ASC])->all();
        $models_currency = Currency::find()->where(['status' => self::ACTIVE])->orderBy(['name' => SORT_ASC])->all();
        $models_type = TypeAccounts::find()->where(['status' => self::ACTIVE])->orderBy(['name' => SORT_ASC])->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'models_clinent' => $models_clinent,
                'models_currency' => $models_currency,
                'models_type' => $models_type,
            ]);
        }
    }

    /**
     * Deletes an existing Accounts model.
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
     * Finds the Accounts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Accounts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Accounts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
