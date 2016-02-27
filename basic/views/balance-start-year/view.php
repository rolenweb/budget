<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BalanceStartYear */

$this->title = $model->account->name;
$this->params['breadcrumbs'][] = ['label' => 'Баланс на начало года', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="balance-start-year-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>Название</th>
                    <td><?= Html::encode($model->account->name) ?></td>
                </tr>
                <tr>
                    <th>Остаток</th>
                    <td><?= Html::encode($model->amount) ?></td>
                </tr>
                <tr>
                    <th>Валюта</th>
                    <td><?= Html::encode($model->account->currency->name) ?></td>
                </tr>
                <tr>
                    <th>Пользователь</th>
                    <td><?= Html::encode($model->client->firstname) ?> <?= Html::encode($model->client->lastname) ?></td>
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
