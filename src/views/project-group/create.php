<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProjectGroup */

$this->title = 'Create Project Group';
$this->params['breadcrumbs'][] = ['label' => 'Project Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-group-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
