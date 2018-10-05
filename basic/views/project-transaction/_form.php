<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use app\models\ProjectTransactionType;
use app\models\Project;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectTransaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-transaction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'project_id')->dropDownList(ArrayHelper::map(Project::find()->all(), 'id', 'domain'), ['prompt' => 'Выбрать'])->label(); ?> 

    <?= $form->field($model, 'type_id')->dropDownList(ArrayHelper::map(ProjectTransactionType::find()->all(), 'id', 'title'), ['prompt' => 'Выбрать'])->label(); ?> 

    <?= $form->field($model, 'value')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
