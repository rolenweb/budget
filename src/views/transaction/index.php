<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Транзакции';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Сумма</th>
                    <th>Валюта</th>
                    <th>Счет</th>
                    <th>Тип</th>
                    <th>Тип(название)</th>
                   
                    <th>Создан</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
<?php
if ($models_transaction != NULL) {

    foreach ($models_transaction as $transaction) {
?>
                <tr>
                    <td>
                        <?= Html::encode($transaction->name) ?>
                    </td>
                    <td>
                        <?= Html::encode($transaction->amount) ?>
                    </td>
                    <td>
                        <?= Html::encode($transaction->account->currency->name) ?>
                    </td>
                    <td>
                        <?= Html::encode($transaction->account->name) ?>
                    </td>
                    <td>
<?php
if ($transaction->type->type == 1) {
    echo "Доход";
}
else{
    echo "Расход";
}
?>                    

                    </td>
                    <td>
                        <?= Html::encode($transaction->type->name) ?>
                    </td>
                    
                    <td>
                        <?= Html::encode(date("d-m-y H:i",$transaction->created_at)) ?>
                    </td>
                    <td>
                        <?= Html::a(Html::tag('i','',['class' => 'fa fa-eye']),['transaction/view','id' => $transaction->id],['class' => 'btn btn-default btn-sm']) ?>
                        <?= Html::a(Html::tag('i','',['class' => 'fa fa-pencil']),['transaction/update','id' => $transaction->id],['class' => 'btn btn-default btn-sm']) ?>
                    </td>
                </tr>
<?php        
    }
}
?>            
            </tbody>
        </table>
    </div>
    <div>
        <?php
    echo LinkPager::widget([
        'pagination' => $pages,
    ]);

        ?>
    </div>

</div>
