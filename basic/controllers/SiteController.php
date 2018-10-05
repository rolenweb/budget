<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\BalanceStartYear;
use app\models\Accounts;
use app\models\Transaction;
use app\models\Currency;
use app\models\CurrencyRates;

error_reporting(0);

class SiteController extends Controller
{
    const ACTIVE = 1;
    const NOACTIVE = 2;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex($year = null)
    {   
        if (empty($year)) {
            $start_year = date("Y").'-01-01 00:00:00';
            $finish_year = date("Y").'-12-31 23:59:59';
        }else{
            $start_year = date("Y",strtotime($year.'-01-01')).'-01-01 00:00:00';
            $finish_year = date("Y",strtotime($year.'-01-01')).'-12-31 23:59:59';
        }
        

        $default_currency = Currency::find()->where(['default' => 1])->limit(1)->one();
        $curency_rate_today = CurrencyRates::find()->where(['between', 'created_at', strtotime(date("Y-m-d").' 00:00:00'), strtotime(date("Y-m-d").' 23:59:59')])->indexBy('currency_id')->all();
        

        $models_account = Accounts::find()->with('currency')->where(['status' => self::ACTIVE])->orderBy(['name' => SORT_ASC])->indexBy('id')->all();
        $array_balance = [];
        if ($models_account != NULL) {
            foreach ($models_account as $account) {
                $models_transaction = Transaction::find()->with('type')->where(['and',['between', 'created_at', strtotime($start_year), strtotime($finish_year)],['account_id' => $account->id]])->all();
                if ($models_transaction != NULL) {
                    foreach ($models_transaction as $transaction) {
                        if ($transaction->type->type == 1) {
                            $array_balance[$account->id] += $transaction->amount;
                        }
                        else{
                            $array_balance[$account->id] -= $transaction->amount;
                        }
                    }
                }
                
            }
        }
        $start_balance = BalanceStartYear::find()->where(['between', 'created_at', strtotime($start_year), strtotime($finish_year)])->indexBy('account_id')->all();

        
        return $this->render('index',[
            'models_account' => $models_account,
            'array_balance' => $array_balance,
            'start_balance' => $start_balance,
            'default_currency' => $default_currency,
            'curency_rate_today' => $curency_rate_today,

            ]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
