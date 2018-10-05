<?php
$this->title = 'Отчет';

if (empty($type)) {
    echo $this->render('chart/_default',[
        'chart' => $chart,
    ]);

    echo $this->render('table/_default',[
       'chart' => $chart,   
       'byType' => $byType,  
    ]);                          
}

?>
