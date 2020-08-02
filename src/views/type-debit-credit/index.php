<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TypeDebitCreditSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Типы расходов/доходов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-debit-credit-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Тип</th>
                    <th>Родитель</th>
                    <th>Создан</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
<?php
if ($models_type != NULL) {
    foreach ($models_type as $type) {
?>
                <tr>
                    <td>
                        <?= Html::encode($type->name) ?>
                    </td>
                    <td>
<?php
if ($type->type == 1) {
    echo "Доход";
}
else{
    echo "Расход";
}
?>                        
                    </td>
                    <td>
                        <?= Html::encode($type->parent->name) ?>
                    </td>
                    <td>
                        <?= Html::encode(date("d-m-y",$type->created_at)) ?>
                    </td>
                    <td>
<?php
if ($type->status == 1) {
    echo "Активный";
}
else{
    echo "Неактивный";
}
?>                        
                    </td>
                    <td>
                        <?= Html::a(Html::tag('i','',['class' => 'fa fa-eye']),['type-debit-credit/view','id' => $type->id],['class' => 'btn btn-default btn-sm']) ?>
                        <?= Html::a(Html::tag('i','',['class' => 'fa fa-pencil']),['type-debit-credit/update','id' => $type->id],['class' => 'btn btn-default btn-sm']) ?>
                    </td>

                </tr>
<?php        
    }
}
?>            
            </tbody>
        </table>
    </div>

</div>
