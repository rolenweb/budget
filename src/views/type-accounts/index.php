<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TypeAccountsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Типы счетов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-accounts-index">

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
                    <th>Создан</th>
                    <th>Обновлен</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
<?php
if ($models_type_account != NULL) {
    foreach ($models_type_account as $type_account) {
?>
                <tr>
                    <td>
                        <?= Html::encode($type_account->name) ?>
                    </td>
                    <td>
                        <?= Html::encode(date("d-m-y", $type_account->created_at)) ?>
                    </td>
                    <td>
                        <?= Html::encode(date("d-m-y", $type_account->updated_at)) ?>
                    </td>
                    <td>
<?php
if ($type_account->status == 1) {
    echo "Активный";
}
else{
    echo "Неактивный";
}
?>                        
                    </td>
                    <td>
                        <?= Html::a(Html::tag('i','',['class' => 'fa fa-eye']),['type-accounts/view','id' => $type_account->id],['class' => 'btn btn-default btn-sm']) ?>
                        <?= Html::a(Html::tag('i','',['class' => 'fa fa-pencil']),['type-accounts/update','id' => $type_account->id],['class' => 'btn btn-default btn-sm']) ?>
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
