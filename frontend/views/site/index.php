<?php

/* @var $this yii\web\View */

//use sjaakp\gcharts\Chart;
use sjaakp\gcharts\LineChart;
use sjaakp\gcharts\PieChart;
use practically\chartjs\Chart;

$this->title = 'Petrol Station Management System';
?>
<div class="site-index">

    <div class="jumbotron">
        <?php
        $products = \frontend\models\Grade::find()->all();
        $sales = array();
        $data = array();
        if($products != null){
            foreach ($products as $product){
                $sales[] = [
                       'name' => $product->name,
                       'data' => \frontend\models\Sales::getMonthlySalesByProductId($product->id),
                ];
            }
        }
        $item_key_data = array_keys($sales);
        $itemsArraySize = count($sales);

        for($i=0; $i< $itemsArraySize; $i++){
            $data[] = $sales[$i];
        }




        echo \dosamigos\highcharts\HighCharts::widget([
            'clientOptions' => [
                'chart' => [
                    'type' => 'line'
                ],
                'title' => [
                    'text' => 'Monthly sales'
                ],
                'xAxis' => [
                    'categories' => [
                        'Jan',
                        'Feb',
                        'Mar',
                        'Apr',
                        'May',
                        'Jun',
                        'Jul',
                        'Aug',
                        'Sep',
                        'Oct',
                        'Nov',
                        'Dec',
                    ]
                ],
                'yAxis' => [
                    'title' => [
                        'text' =>'Total Amount'
                    ]
                ],
                'series' => $data
            ]
        ]);
        ?>

    </div>


</div>
