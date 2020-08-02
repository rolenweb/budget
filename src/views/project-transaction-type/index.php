<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectTransactionTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Project Transaction Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-transaction-type-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            
            [
                'attribute'=>'type',
                'label' => 'Type',
                'content'=>function($data){
                    return $data->typeName();
                }
                
            ],
            [
                'attribute'=>'currency_id',
                'label' => 'Currency',
                'content'=>function($data){
                    return $data->currency->name;
                }
                
            ],
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
        <?= Html::a('Create Project Transaction Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
