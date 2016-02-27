<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel app\models\BalanceStartYearSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Баланс на начало года';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="balance-start-year-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Счет</th>
                    <th>Остаток</th>
                    <th>Валюта</th>
                    <th>Пользователь</th>
                    <th>Статус</th>
                    <th>Создан</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
<?php
if ($models_start_balance != NULL) {
    foreach ($models_start_balance as $start_balance) {
?>
                <tr>
                    <td>
                        <?= Html::encode($start_balance->account->name) ?>
                    </td>
                    <td>
                        <?= Html::encode($start_balance->amount) ?>
                    </td>
                    <td>
                        <?= Html::encode($start_balance->account->currency->name) ?>
                    </td>
                    <td>
                        <?= Html::encode($start_balance->client->firstname) ?> <?= Html::encode($start_balance->client->lastname) ?>
                    </td>
                    <td>
<?php
if ($start_balance->status == 1) {
    echo "Активный";
}
else{
    echo "Неактивный";
}
?>                        
                    </td>
                    <td>
                        <?= Html::encode(date("d-m-y",$start_balance->created_at)) ?>
                    </td>
                    <td>
                        <?= Html::a(Html::tag('i','',['class' => 'fa fa-eye']),['balance-start-year/view','id' => $start_balance->id],['class' => 'btn btn-default btn-sm']) ?>
                        <?= Html::a(Html::tag('i','',['class' => 'fa fa-pencil']),['balance-start-year/update','id' => $start_balance->id],['class' => 'btn btn-default btn-sm']) ?>
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
