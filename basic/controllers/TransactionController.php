<?php

namespace app\controllers;

use Yii;
use app\models\Transaction;
use app\models\TypeDebitCredit;
use app\models\Client;
use app\models\Accounts;
use app\models\Comment;
use app\models\TransactionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;


/**
 * TransactionController implements the CRUD actions for Transaction model.
 */
class TransactionController extends Controller
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
     * Lists all Transaction models.
     * @return mixed
     */
    public function actionIndex()
    {
        

        $query = Transaction::find()->with('client', 'account.currency','type','comment');
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
        
        return $this->render('index', [
            'models_transaction' => $models,
            'pages' => $pages,
        ]);
    }

    /**
     * Displays a single Transaction model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $model = Transaction::find()->with(['client', 'account.currency','type','comment'])->where(['id' => $id])->limit(1)->one();
        
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Transaction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Transaction();
        $models_clinent = Client::find()->where(['status' => self::ACTIVE])->orderBy(['firstname' => SORT_ASC])->all();
        $models_account = Accounts::find()->where(['status' => self::ACTIVE])->orderBy(['name' => SORT_ASC])->all();
        $models_type = TypeDebitCredit::find()->where(['status' => self::ACTIVE])->orderBy(['name' => SORT_ASC])->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'models_clinent' => $models_clinent,
                'models_account' => $models_account,
                'models_type' => $models_type,
            ]);
        }
    }

    /**
     * Updates an existing Transaction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $models_clinent = Client::find()->where(['status' => self::ACTIVE])->orderBy(['firstname' => SORT_ASC])->all();
        $models_account = Accounts::find()->where(['status' => self::ACTIVE])->orderBy(['name' => SORT_ASC])->all();
        $models_type = TypeDebitCredit::find()->where(['status' => self::ACTIVE])->orderBy(['name' => SORT_ASC])->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'models_clinent' => $models_clinent,
                'models_account' => $models_account,
                'models_type' => $models_type,

            ]);
        }
    }

    /**
     * Deletes an existing Transaction model.
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
     * Finds the Transaction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transaction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transaction::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
