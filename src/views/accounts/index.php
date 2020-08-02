<?php

use yii\helpers\Html;

//
/* @var $this yii\web\View */
/* @var $searchModel app\models\AccountsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Счета';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить счет', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>
                        Название
                    </th>
                    <th>
                        Пользователь
                    </th>
                    <th>
                        Валюта
                    </th>
                    <th>
                        Тип
                    </th>
                    <th>Создан</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
<?php
if ($models_account != NULL) {
    foreach ($models_account as $account) {
?>
                <tr>
                    <td>
                        <?= Html::encode($account->name) ?>
                    </td>
                    <td>
                        <?= Html::encode($account->client->firstname) ?> <?= Html::encode($account->client->lastname) ?>
                    </td>
                    <td>
                        <?= Html::encode($account->currency->name) ?>
                    </td>
                    <td>
                        <?= Html::encode($account->typeaccounts->name) ?>
                    </td>
                    <td>
                        <?= Html::encode(date("d-m-y",$account->created_at)) ?>
                    </td>
                    
                    <td>
<?php
if ($account->status == 1) {
    echo "Активный";
}
else{
    echo "Не активный";
}
?>                        
                    </td>
                    <td>
                        <?= Html::a(Html::tag('i','',['class' => 'fa fa-eye']),['accounts/view','id' => $account->id],['class' => 'btn btn-default btn-sm']) ?>
                        <?= Html::a(Html::tag('i','',['class' => 'fa fa-pencil']),['accounts/update','id' => $account->id],['class' => 'btn btn-default btn-sm']) ?>
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
