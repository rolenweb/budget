<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Accounts */

$this->title = 'Добавить счет';
$this->params['breadcrumbs'][] = ['label' => 'Счета', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'models_clinent' => $models_clinent,
        'models_currency' => $models_currency,
        'models_type' => $models_type,
    ]) ?>

</div>
