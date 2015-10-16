<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\MGoods;
use app\models\MGoodsSearch;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MGoodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use app\models\U;


$this->title = '商品列表';
//$this->params['breadcrumbs'][] = $this->title;

?>
<div class="mgoods-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--
    <p>
        <//?= Html::a('新增商品', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    -->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' =>['class' => 'table table-striped'],
        'summary'=>'',
        //当没数据时，不显示表头
        //'showOnEmpty'=>true,

        //'layout'=>"{sorter}\n{pager}\n{summary}\n{items}",

        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'goods_id',
            [
                'attribute' => 'goods_id',
                'label' => '商品编号',
                'headerOptions' => array('style'=>'width:50px;'),
            ],

            [
                'attribute' => 'list_img_url',
                'label' => '仪表图',
                'format' => 'html',
                'value' => function($model, $key, $index, $column){
                        return '<img src=' . $model->list_img_url .' width=120px height=90px>';
                },  
                'headerOptions' => array('style'=>'width:80px;'),        
            ],
            'title',
            //'goods_kind',
            [
                'attribute' => 'goods_kind',
                'label' => '分类',
                'value'=>function ($model, $key, $index, $column) { 
                        return MGoods::getGoodsKindOption($model->goods_kind); 
                 },
                'filter'=> MGoods::getGoodsKindOption(),
                'headerOptions' => array('style'=>'width:120px;'),
            ],
            //'descript',
            [
                'attribute' => 'create_time',
                'label' => '发布时间',
                'format' =>  ['date', 'php:Y-m-d H:i:s'],
                //'format' =>  ['date', 'php:Y-m-d'],
                'headerOptions' => array('style'=>'width:120px;'),
            ],

            //'price',
            //[
            //    'attribute' => 'price',
            //    'headerOptions' => array('style'=>'width:80px;'),
            //],

            //'price_hint',
            //'price_old',
            //[
             //   'attribute' => 'price_old',
              //  'headerOptions' => array('style'=>'width:80px;'),
            //],            
            // 'price_old_hint',
            // 'detail:ntext',
            // 'list_img_url:url',


            // 'body_img_url:url',
            /*
            [
                'attribute' => 'body_img_url',
                'label' => '大图',
                'format' => 'html',
                'value' => function($model, $key, $index, $column){
                        $len = 0;
                        $imgHtml = "";
                        $imgs = explode(";",$model->body_img_url);
                        foreach ($imgs as $img) {
                            $len++;
                            if(sizeof($imgs) == $len) break; //分号分割后，数组最后一项为空，剔除
                            $imgHtml = $imgHtml . '<img src=' . $img . ' width=45px height=45px>';
                        }
                        return $imgHtml;
                },    
                'headerOptions' => array('style'=>'width:160px;'),      
            ],
            */


            // 'quantity',
            // 'office_ctrl',
            // 'package_ctrl',
            //'detail_ctrl',
			/*
            [
                'attribute' => 'detail_ctrl',
                'label' => '显示详情',
                'value'=>function ($model, $key, $index, $column) { 
                        return MGoods::getDetailCtrlOption($model->detail_ctrl); 
                 },
                'filter'=> MGoods::getDetailCtrlOption(),
                'headerOptions' => array('style'=>'width:90px;'),
            ],
			*/
            // 'pics_ctrl',

            /*
            [
                'attribute' => 'status',
                'format' => 'html',
                'label' => '发布状态',
                'value'=>function ($model, $key, $index, $column) { 
                        if($model->status == 0)
                            return "<span style='color:red'>".MGoods::getStatusOption($model->status)."</span>"; 
                        else
                            return "<span style='color:green'>".MGoods::getStatusOption($model->status)."</span>"; 
                 },
                'filter'=> MGoods::getStatusOption(),
                'headerOptions' => array('style'=>'width:120px;'),
            ],
            */

            [
                'class' => 'yii\grid\ActionColumn',

                'template' => '{client-goods-view}',
                'buttons' => [
                    'client-goods-view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => Yii::t('yii', 'View'),
                            'data-pjax' => '0',
                        ]);
                    }
            
                ],
            ],




        ],
    ]); ?>

</div>