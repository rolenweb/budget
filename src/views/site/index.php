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
                                Account
                            </th>
                            <th>Currency</th>
                            <th>Total</th>
                            <th>
                                Total(<?= $default_currency->name ?>)
                            </th>
                            
                        </tr>
                    </thead>
                    <tbody>
<?php
if ($models_account != NULL) {
    $total = 0;
    foreach ($models_account as $account) {
        $total_in_currency = $start_balance[$account->id]->amount+$array_balance[$account->id];
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
                            <td><?= number_format($total_in_currency) ?></td>
                            <td><?= number_format($local_total) ?> </td>
                        </tr>
<?php        
    }
}
?>                       
                        <tr>
                            <th colspan="3">ИТОГО</th>
                            <th><?= number_format($total) ?> </th>
                        </tr> 
                    </tbody>
                </table>
            </div>
        </div>
        
       

    </div>
</div>
