<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Transaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-form">

    <?php $form = ActiveForm::begin(); ?>

    
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'client_id')->dropDownList(ArrayHelper::map($models_clinent, 'id', 'firstname'), ['prompt' => 'Выбрать'])->label(); ?> 

    <?= $form->field($model, 'account_id')->dropDownList(ArrayHelper::map($models_account, 'id', 'name'))->label(); ?> 
    
    <?= $form->field($model, 'type_debit_credit_id')->dropDownList(ArrayHelper::map($models_type, 'id', 'name'))->label(); ?> 
    
    <?= $form->field($model, 'comment_id')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([1 => 'Активный', 2 => 'Неактивный'])->label(); ?> 

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
