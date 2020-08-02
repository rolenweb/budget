<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TypeDebitCredit */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Расходы и доходы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-debit-credit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'models_type' => $models_type,
    ]) ?>

</div>
