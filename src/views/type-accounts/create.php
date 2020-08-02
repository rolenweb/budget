<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TypeAccounts */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Типы счетов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-accounts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
