<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\ProjectTransactionType;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = $model->domain;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$transactions = $model->transactions;
?>
<div class="project-view">

    <h3><?= Html::encode($this->title) ?></h3>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'domain',
            'description:html',
            
            [
                'label' => 'Created',
                'value' => $model->group->title,
            ],
            [
                'label' => 'Created',
                'value' => $model->statusName,
            ],
            [
                'label' => 'Created',
                'value' => date("d/m/Y",$model->created_at),
            ],
            [
                'label' => 'Updated',
                'value' => date("d/m/Y",$model->updated_at),
            ],
        ],
    ]) ?>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    

    <h3>Transaction</h3>
    <table class="table table-bordered">
        <tbody>
            <?php foreach($transactions as $transaction): ?>
            <tr>
                <td>
                    <?= $transaction->title ?>
                </td>
                <td>
                    <?= $transaction->description ?>
                </td>
                <td>
                    <?= ($transaction->type->type === ProjectTransactionType::TYPE_COST) ? -$transaction->value: 0 ?>
                </td>
                <td>
                    <?= ($transaction->type->type === ProjectTransactionType::TYPE_INCOME) ? $transaction->value: 0 ?>
                </td>
            </tr>
            <?php endforeach; ?>        
            <tr>
                <th colspan="3">
                    Total
                </th>
                <th>
                    <?= $model->profit ?>
                </th>
            </tr>
        </tbody>
    </table>
    

</div>
