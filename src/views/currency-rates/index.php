<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CurrencyRatesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Курсы валют';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="currency-rates-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

   <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Валюта</th>
                    <th>Курс</th>
                    <th>Дата</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
<?php
if ($models_currency_rate != NULL) {
    foreach ($models_currency_rate as $currency_rate) {
?>
                <tr>
                    <td>
                        <?= Html::encode($currency_rate->currency->name) ?>
                    </td>
                    <td>
                        <?= Html::encode($currency_rate->rate) ?>
                    </td>
                    <td>
                        <?= Html::encode(date("d-m-y",$currency_rate->created_at)) ?>
                    </td>
                    <td>
                        <?= Html::a(Html::tag('i','',['class' => 'fa fa-eye']),['currency-rates/view','id' => $currency_rate->id],['class' => 'btn btn-default btn-sm']) ?>
                        <?= Html::a(Html::tag('i','',['class' => 'fa fa-pencil']),['currency-rates/update','id' => $currency_rate->id],['class' => 'btn btn-default btn-sm']) ?>
                    </td>
                </tr>
<?php        
    }
}
?>            
            </tbody>
        </table>
    </div>

</div>
