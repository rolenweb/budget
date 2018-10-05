<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\ProjectTransactionType;
use app\models\Currency;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectTransactionType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-transaction-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList(ProjectTransactionType::listDD(), ['prompt' => 'Выбрать'])->label(); ?> 

    <?= $form->field($model, 'currency_id')->dropDownList(ArrayHelper::map(Currency::find()->all(), 'id', 'name'), ['prompt' => 'Выбрать'])->label(); ?> 

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
