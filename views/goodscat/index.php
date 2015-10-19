<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MGoodscatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商品分类管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgoodscat-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建商品分类', ['create'], ['class' => 'btn btn-success']) ?>
        &nbsp;&nbsp;
        <?= Html::a('返回新增商品', ['goods/create']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'cat',
            'value',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
