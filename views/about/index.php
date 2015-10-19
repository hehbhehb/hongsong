<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MAboutSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '公司简介';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mabout-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' =>['class' => 'table table-striped'],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'about_id',
            'com_name',
            'com_addr',
            'com_tel',
            'com_voice',
            // 'com_content:ntext',
            [
                'attribute' => 'body_img_url',
                'label' => '首页轮播图',
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


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
