<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Transaction */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Транзакции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>Название</th>
                    <td><?= Html::encode($model->name) ?></td>
                </tr>
                <tr>
                    <th>Пользователь</th>
                    <td><?= Html::encode((empty($model->client->firstname) === false) ? $model->client->firstname : '') ?> <?= Html::encode((empty($model->client->lastname) === false) ? $model->client->lastname : '') ?></td>
                </tr>
                <tr>
                    <th>Сумма</th>
                    <td><?= Html::encode($model->amount) ?></td>
                </tr>
                <tr>
                    <th>Валюта</th>
                    <td><?= Html::encode($model->account->currency->name) ?></td>
                </tr>
                <tr>
                    <th>Счет</th>
                    <td><?= Html::encode($model->account->name) ?></td>
                </tr>
                <tr>
                    <th>Тир</th>
                    <td>
<?php
if ($model->type->type == 1) {
    echo "Доход";
}
else{
    echo "Расход";
}
?>                    
                    </td>
                </tr>
                <tr>
                    <th>Тип(название)</th>
                    <td><?= Html::encode($model->type->name) ?></td>
                </tr>
                <tr>
                    <th>Коммнетарий</th>
                    <td><?= Html::encode((empty($model->comment->comment) === false) ? $model->comment->comment : '') ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    

</div>
