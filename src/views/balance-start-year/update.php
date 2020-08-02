<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BalanceStartYear */

$this->title = 'Редактировать: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Баланс на начало года', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="balance-start-year-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'models_clinent' => $models_clinent,
        'models_account' => $models_account,
    ]) ?>

</div>
