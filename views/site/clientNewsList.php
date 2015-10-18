<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\News;
use app\models\NewsSearch;
/* @var $this yii\web\View */
/* @var $searchModel app\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use app\models\U;


$this->title = '新闻列表';
//$this->params['breadcrumbs'][] = $this->title;

?>
<div class="News-index">

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

            'news_id',
            'title',
            //'content:ntext',
            'create_time',
            //'update_time',
            //'cat',

            /*
            [
                'attribute' => 'cat',
                'label' => '分类',
                'value'=>function ($model, $key, $index, $column) { 
                        return News::getCatOption($model->cat); 
                 },
                'filter'=> News::getCatOption(),
                'headerOptions' => array('style'=>'width:90px;'),
            ],
            */

            'clickcnt',
   
            [
                'class' => 'yii\grid\ActionColumn',

                'template' => '{client-news-view}',
                'buttons' => [
                    'client-news-view' => function ($url, $model) {
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