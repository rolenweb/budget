<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Accounts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accounts-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
      
    <?= $form->field($model, 'client_id')->dropDownList(ArrayHelper::map($models_clinent, 'id', 'firstname'))->label(); ?>  
    
    <?= $form->field($model, 'currency_id')->dropDownList(ArrayHelper::map($models_currency, 'id', 'name'))->label(); ?> 
    
    <?= $form->field($model, 'type')->dropDownList(ArrayHelper::map($models_type, 'id', 'name'))->label(); ?> 
    
    <?= $form->field($model, 'status')->dropDownList([1 => 'Активный', 2 => 'Неактивный'])->label(); ?> 
    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
