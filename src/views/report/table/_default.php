<?php
use yii\helpers\Html;

echo Html::beginTag('table',['class' => 'table table-border']);
	echo Html::beginTag('thead');
		echo Html::beginTag('tr');
			echo Html::beginTag('th');

			echo Html::endTag('th');
			if (empty($chart['months']) === false) {
				foreach ($chart['months'] as $n => $month) {
					echo Html::beginTag('th');
						echo $month;
					echo Html::endTag('th');
				}
			}
			echo Html::beginTag('th');
				echo 'Total';
			echo Html::endTag('th');
		echo Html::endTag('tr');
	echo Html::endTag('thead');
	echo Html::beginTag('tbody');
		echo Html::beginTag('tr');
			echo Html::beginTag('th');
				echo 'Доход';
			echo Html::endTag('th');
			if (empty($chart['profit']) === false) {
				$total_profit = 0;
				foreach ($chart['profit'] as $n => $profit) {
					$total_profit += $profit['y'];
					echo Html::beginTag('td');
						echo number_format($profit['y']);
					echo Html::endTag('td');
				}
				echo Html::beginTag('th');
					echo number_format($total_profit);
				echo Html::endTag('th');
			}	
		echo Html::endTag('tr');
		if (empty($byType['profit']) === false) {
			foreach ($byType['profit'] as $type_profit) {
				echo Html::beginTag('tr',['class' => 'info']);
					echo Html::beginTag('th');
						echo $type_profit['name'];
					echo Html::endTag('th');
					if (empty($type_profit['value']) === false) {
						$total_profit_type = 0;
						if (empty($chart['months']) === false) {
							foreach ($chart['months'] as $n => $month) {

								$total_profit_type += (empty($type_profit['value'][date("Y-m",strtotime($month))]) === false) ? $type_profit['value'][date("Y-m",strtotime($month))] : 0;
								echo Html::beginTag('td');
									echo (empty($type_profit['value'][date("Y-m",strtotime($month))]) === false) ? number_format($type_profit['value'][date("Y-m",strtotime($month))]) : 0;
								echo Html::endTag('td');
							}
						}
						echo Html::beginTag('th');
							echo number_format($total_profit_type);
						echo Html::endTag('th');
					}	
				echo Html::endTag('tr');
			}
		}
		echo Html::beginTag('tr');
			echo Html::beginTag('th');
				echo 'Расход';
			echo Html::endTag('th');
			if (empty($chart['lost']) === false) {
				$total_lost = 0;
				foreach ($chart['lost'] as $n => $lost) {
					$total_lost += $lost['y'];
					echo Html::beginTag('td');
						echo number_format($lost['y']);
					echo Html::endTag('td');
				}
				echo Html::beginTag('th');
					echo number_format($total_lost);
				echo Html::endTag('th');
			}	
		echo Html::endTag('tr');
		if (empty($byType['lost']) === false) {
			foreach ($byType['lost'] as $type_lost) {
				echo Html::beginTag('tr',['class' => 'warning']);
					echo Html::beginTag('th');
						echo $type_lost['name'];
					echo Html::endTag('th');
					if (empty($type_lost['value']) === false) {
						$total_lost_type = 0;
						if (empty($chart['months']) === false) {
							foreach ($chart['months'] as $n => $month) {

								$total_lost_type += (empty($type_lost['value'][date("Y-m",strtotime($month))]) === false) ? $type_lost['value'][date("Y-m",strtotime($month))] : 0;
								echo Html::beginTag('td');
									echo (empty($type_lost['value'][date("Y-m",strtotime($month))]) === false) ? number_format($type_lost['value'][date("Y-m",strtotime($month))]) : 0;
								echo Html::endTag('td');
							}
						}
						echo Html::beginTag('th');
							echo number_format($total_lost_type);
						echo Html::endTag('th');
					}	
				echo Html::endTag('tr');
			}
		}
		echo Html::beginTag('tr');
			echo Html::beginTag('th');
				echo 'Баланс';
			echo Html::endTag('th');
			if (empty($chart['balance']) === false) {
				$total_balance = 0;
				foreach ($chart['balance'] as $n => $balance) {
					$total_balance += $balance['y'];
					echo Html::beginTag('td');
						echo number_format($total_balance['y']);
					echo Html::endTag('td');
				}
				echo Html::beginTag('th');
					echo number_format($total_balance);
				echo Html::endTag('th');
			}	
		echo Html::endTag('tr');
		
	echo Html::endTag('tbody');
echo Html::endTag('table');
?>