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
use app\models\TypeDebitCredit;

error_reporting(0);

class ReportController extends Controller
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

    public function actionIndex($year = null, $type = null)
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

        
        $query_profit = Transaction::find()->joinWith(['account.currency','type'])->where([
                'and',
                    [
                        'between','transaction.created_at',strtotime($start_year),strtotime($finish_year)
                    ],
                    [
                        'type_debit_credit.type' => TypeDebitCredit::PROFIT
                    ],
                    [
                        'not in','type_debit_credit_id',[TypeDebitCredit::START_BALANCE,TypeDebitCredit::TRANSFER_PROFIT]
                    ]
            ]);

        $query_lost = Transaction::find()->joinWith(['account.currency','type'])->where([
                'and',
                    [
                        'between','transaction.created_at',strtotime($start_year),strtotime($finish_year)
                    ],
                    [
                        'type_debit_credit.type' => TypeDebitCredit::LOST
                    ],
                    [
                        'not in','type_debit_credit_id',[TypeDebitCredit::TRANSFER_LOST]
                    ]
            ]);

        $profit = $this->byMonth($query_profit->all());

        $lost = $this->byMonth($query_lost->all());

        $months = $this->createMonth($start_year,$finish_year);

        $chart = [];
        foreach ($months as $n => $month) {
            $month_profit = (empty($profit[$month]) === false) ? $profit[$month] : 0;
            $month_lost = (empty($lost[$month]) === false) ? $lost[$month] : 0;
            $month_balance = $month_profit-$month_lost;
            $chart['months'][$n] = date("F Y",strtotime($month));
            $chart['profit'][$n]['y'] = $month_profit;
            $chart['profit'][$n]['color'] = 'blue';
            $chart['lost'][$n]['y'] = $month_lost;
            $chart['lost'][$n]['color'] = 'orange';
            $chart['balance'][$n]['y'] = $month_profit-$month_lost;
            $chart['balance'][$n]['color'] = ($month_balance > 0) ? 'green' : 'red';
        }

        
        
        $byType = [
            'profit' => $this->byTypeMonth($query_profit->all()),
            'lost' => $this->byTypeMonth($query_lost->all()),
        ];

        
                
        return $this->render('index',[
            'chart' => $chart,
            'type' => $type,
            'byType' => $byType,
        ]);
    }

    public function byMonth($list)
    {
        $out = [];
        foreach ($list as $key => $item) {
            if ($item->account->currency->defaultCurrency === 'yes') {
                $out[date("Y-m",$item->created_at)] += $item->amount;
            }else{
                $out[date("Y-m",$item->created_at)] += $item->amount*$item->account->currency->lastRate->rate;
            }
        }
        return $out;
    }

    public function byTypeMonth($list)
    {
        $out = [];
        foreach ($list as $key => $item) {
            if (empty($item->type->parent) === false) {
                if (empty($item->type->parent->parent) === false) {
                    $type = $item->type->parent->parent;
                }else{
                    $type = $item->type->parent;
                }
            }else{
                $type = $item->type;
            }
            
            if ($item->account->currency->defaultCurrency === 'yes') {
                $out[$type->id]['value'][date("Y-m",$item->created_at)] += $item->amount;
                $out[$type->id]['name'] = $type->name;
            }else{
                $out[$type->id]['value'][date("Y-m",$item->created_at)] += $item->amount*$item->account->currency->lastRate->rate;
                $out[$type->id]['name'] = $type->name;
            }
        }
        return $out;
    }

    public function createMonth($start,$end)
    {
        $out = [];
        $curent_month = date("Y-m",strtotime($start));
        $end_month = date("Y-m",strtotime($end));
        while ($curent_month <= $end_month) {
            $out[] = $curent_month;
            $curent_month = date("Y-m",strtotime("+1 month",strtotime($curent_month)));
        }
        return $out;
    }
}
