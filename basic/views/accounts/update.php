<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Accounts */

$this->title = 'Редактировать: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Счеиа', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="accounts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'models_clinent' => $models_clinent,
        'models_currency' => $models_currency,
        'models_type' => $models_type,
    ]) ?>

</div>
