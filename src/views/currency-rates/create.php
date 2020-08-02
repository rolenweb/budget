<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CurrencyRates */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Куры валют', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="currency-rates-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'models_currency' => $models_currency,
    ]) ?>

</div>
