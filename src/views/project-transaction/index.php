<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectTransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Project Transactions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-transaction-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description:html',
            
            [
                'attribute'=>'project_id',
                'label' => 'Project',
                'content'=>function($data){
                    return $data->project->domain;
                }
                
            ],
            [
                'attribute'=>'type_id',
                'label' => 'Type',
                'content'=>function($data){
                    return $data->type->title;
                }
                
            ],
            'value',
            [
                'attribute'=>'created_at',
                'label' => 'Создана',
                'content'=>function($data){
                    return date("d/m/Y",$data->created_at);
                }
                
            ],
            [
                'attribute'=>'updated_at',
                'label' => 'Обновлена',
                'content'=>function($data){
                    return date("d/m/Y",$data->updated_at);
                }
                
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <p class="text-right">
        <?= Html::a('Create Project Transaction', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
