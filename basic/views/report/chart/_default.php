<?php
use miloschuman\highcharts\Highcharts;

        $series = [
                ['showInLegend' => false, 'name' => 'Доход', 'data' => $chart['profit']],
                ['showInLegend' => false, 'name' => 'Расход', 'data' => $chart['lost']],
                ['showInLegend' => false, 'name' => 'Баланс', 'data' => $chart['balance']],
            ];

echo HighCharts::widget([
    'options' => [
        'chart' => [
                'type' => 'column'
        ],
        'title' => [
             'text' => 'Баланс'//$title
             ],
        'xAxis' => [

            'categories' => $chart['months'],
            'crosshair' => true,
            //'plotBands' => $plotBands
            

        ],
        'yAxis' => [
            'title' => [
                'text' => 'RUB'//$ytitle
            ]
        ],
        'tooltip' => [
            'valueSuffix' => ''//$valueSuffix
        ],
        'plotOptions' => [
            'column' => [
                'stacking' => 'normal',
            ],
            'series' => [
                /*'cursor' => 'pointer',
                'point' => [
                    'events' => [
                        'click' => new JsExpression('function () {loadDataBar(this.options.url,this.options.invoices);}')
                    ]
                ]*/
            ]
        ],
        'series' => $series
        
    ]
]);      
?>