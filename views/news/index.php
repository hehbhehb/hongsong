<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\News;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '新闻管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建新闻', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showOnEmpty'=>false,
        'tableOptions' =>['class' => 'table table-striped'],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'news_id',
            'title',
            //'content:ntext',
            'create_time',
            //'update_time',
            //'cat',

            [
                'attribute' => 'cat',
                'label' => '分类',
                'value'=>function ($model, $key, $index, $column) { 
                        return News::getCatOption($model->cat); 
                 },
                'filter'=> News::getCatOption(),
                'headerOptions' => array('style'=>'width:90px;'),
            ],
 
            'clickcnt',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
