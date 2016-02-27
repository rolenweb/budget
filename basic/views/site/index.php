<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Rolen Balance';
?>
<div class="site-index">

    

    <div class="body-content">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>
                                Счет
                            </th>
                            <th>Валюта</th>
                            <th>
                                Баланс на начало года
                            </th>
                            <th>
                                Текущий баланс
                            </th>
                            <th>
                                Итог
                            </th>
                            
                        </tr>
                    </thead>
                    <tbody>
<?php
if ($models_account != NULL) {
    $total = 0;
    foreach ($models_account as $account) {
        if ($default_currency->name == $account->currency->name) {
            $local_total = $start_balance[$account->id]->amount+$array_balance[$account->id];
        }
        else{
            $local_total = ($start_balance[$account->id]->amount+$array_balance[$account->id])*$curency_rate_today[$account->currency->id]->rate;
        }
        $total += $local_total;
        
?>
                        <tr>
                            <td>
                                <?= Html::encode($account->name) ?>
                            </td>
                            <td>
                                <?= Html::encode($account->currency->name) ?>
                            </td>
                            <td>
                                <?= Html::encode($start_balance[$account->id]->amount) ?>
                            </td>
                            <td>
                                <?= Html::encode($array_balance[$account->id]) ?>
                            </td>
                            <td><?= $local_total ?> <?= $default_currency->name ?></td>
                        </tr>
<?php        
    }
}
?>                       
                        <tr>
                            <td colspan="4">ИТОГО</td>
                            <td><?= $total ?> <?= $default_currency->name ?></td>
                        </tr> 
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row top10">
            <div class="col-lg-3 text-center">
                
                <?= Html::a('Счета',['accounts/index'],['class' => 'btn btn-success text-center']) ?>
            </div>
            <div class="col-lg-3 text-center">
                
                <?= Html::a('Типы счетов',['type-accounts/index'],['class' => 'btn btn-success text-center']) ?>
            </div>
            <div class="col-lg-3 text-center">
                
                <?= Html::a('Баланс на начало года',['balance-start-year/index'],['class' => 'btn btn-success text-center']) ?>
            </div>
            <div class="col-lg-3 text-center">
                
                <?= Html::a('Пользователи',['client/index'],['class' => 'btn btn-success text-center']) ?>
            </div>
            

            
        </div>
        <div class="row top10">
            <div class="col-lg-3 text-center">
                
                <?= Html::a('Валюта',['currency/index'],['class' => 'btn btn-success text-center']) ?>
            </div>
            <div class="col-lg-3 text-center">
                
                <?= Html::a('Конвертация валюты',['currency-rates/index'],['class' => 'btn btn-success text-center']) ?>
            </div>
            <div class="col-lg-3 text-center">
                
                <?= Html::a('Транзакции',['transaction/index'],['class' => 'btn btn-success text-center']) ?>
            </div>
           
            <div class="col-lg-3 text-center">
                
                <?= Html::a('Комментарии',['comment/index'],['class' => 'btn btn-success text-center']) ?>
            </div>
            
        </div>
        <div class="row top10">
            <div class="col-lg-3 text-center">
                
                <?= Html::a('Тип расходов/доходов',['type-debit-credit/index'],['class' => 'btn btn-success text-center']) ?>
            </div>
        </div>

    </div>
</div>
