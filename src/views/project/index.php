<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Project', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'=>function ($model, $key, $index, $grid){
            $class = ($model->status === $model::STATUS_STAR) ? 'warning' : null;
            return [
                'key'=>$key,
                'index'=>$index,
                'class'=>$class
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'domain',
            'description:html',
            [
                'attribute'=>'group_id',
                'label' => 'Group',
                'content'=>function($data){
                    return $data->group->title;
                }
                
            ],
            
            [
                'attribute'=>'status',
                'label' => 'Status',
                'content'=>function($data){
                    return $data->statusName;
                }
                
            ],
            [
                //'attribute'=>'status',
                'label' => 'Profit',
                'contentOptions' =>function ($model, $key, $index, $column){
                    return ['class' => ($model->profit < 0) ? 'danger' : null];
                },
                'content'=>function($data){
                    return $data->profit;
                }
                
            ],
            [
                'attribute'=>'created_at',
                'label' => 'Created',
                'content'=>function($data){
                    return date("d/m/Y",$data->created_at);
                }
                
            ],
            [
                'attribute'=>'updated_at',
                'label' => 'Updated',
                'content'=>function($data){
                    return date("d/m/Y",$data->updated_at);
                }
                
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
