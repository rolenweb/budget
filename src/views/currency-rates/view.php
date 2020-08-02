<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CurrencyRates */

$this->title = $model->currency->name;
$this->params['breadcrumbs'][] = ['label' => 'Курсы валют', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="currency-rates-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>Название</th>
                    <td><?= Html::encode($model->currency->name) ?></td>
                </tr>
                <tr>
                    <th>Курс</th>
                    <td><?= Html::encode($model->rate) ?></td>
                </tr>
                
            </tbody>
        </table>
    </div>
    <p>
        <?= Html::a('Update', ['Редактировать', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['Удалить', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    

</div>
