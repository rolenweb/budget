<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Transaction */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Транзакции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'models_clinent' => $models_clinent,
        'models_account' => $models_account,
        'models_type' => $models_type,
    ]) ?>

</div>
