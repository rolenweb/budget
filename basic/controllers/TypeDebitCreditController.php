<?php

namespace app\controllers;

use Yii;
use app\models\TypeDebitCredit;
use app\models\TypeDebitCreditSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

error_reporting(0);

/**
 * TypeDebitCreditController implements the CRUD actions for TypeDebitCredit model.
 */
class TypeDebitCreditController extends Controller
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
     * Lists all TypeDebitCredit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $models_type = TypeDebitCredit::find()->with('parent')->orderBy(['name' => SORT_ASC])->all();

        return $this->render('index', [
            'models_type' => $models_type,
        ]);
    }

    /**
     * Displays a single TypeDebitCredit model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = TypeDebitCredit::find()->with('parent')->where(['id' => $id])->limit(1)->one();
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new TypeDebitCredit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TypeDebitCredit();
        $models_type = TypeDebitCredit::find()->where(['status' => self::ACTIVE])->orderBy(['name' => SORT_ASC])->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'models_type' => $models_type,
            ]);
        }
    }

    /**
     * Updates an existing TypeDebitCredit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $models_type = TypeDebitCredit::find()->where(['status' => self::ACTIVE])->orderBy(['name' => SORT_ASC])->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'models_type' => $models_type,
            ]);
        }
    }

    /**
     * Deletes an existing TypeDebitCredit model.
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
     * Finds the TypeDebitCredit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TypeDebitCredit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TypeDebitCredit::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
