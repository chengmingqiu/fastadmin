<?php
return [
    'title' => "官网文档",
    'description' => '',
    'template' => 'apple', // 苹果绿:apple 葡萄紫:grape
    'class' => [
        'app\api\controller\HomePage',
        'app\api\controller\Product',
        'app\api\controller\Series',
       	'app\api\controller\SeriesBrand',
       	'app\api\controller\Rele',


        //app
        'app\api\controller\APPHomePage'
    ],
];