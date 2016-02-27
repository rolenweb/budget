<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\TypeDebitCredit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="type-debit-credit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'type')->dropDownList([1 => 'Доход', 2 => 'Расход'])->label(); ?> 

    <?= $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map($models_type, 'id', 'name'), ['prompt' => 'Нет'])->label(); ?>     

    <?= $form->field($model, 'status')->dropDownList([1 => 'Активный', 2 => 'Неактивный'])->label(); ?> 

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
