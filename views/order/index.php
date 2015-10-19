<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\User;
use app\models\MGoods;
use app\models\MOrder;
use app\models\U;


/* @var $this yii\web\View */
/* @var $searchModel app\models\MOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '订单管理';
$this->params['breadcrumbs'][] = $this->title;


if(Yii::$app->user->isGuest)
{
    $isAdmin = false;
    $isMember = false;
    $opt = '';
}
else
{
    if (Yii::$app->user->identity->role == 1)
    {
        $isAdmin = true;
        $isMember = false;
        $opt = '{view} {update} {delete}';
    }
    else /*role == 0*/
    {
        $isAdmin = false;
        $isMember = true;
        $opt = '{view}';
    }
}

?>
<div class="morder-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--
    <p>
        <//?= Html::a('Create Morder', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    -->
    <p>
    <?php echo Html::a('下载 <i class="glyphicon glyphicon-arrow-down"></i>', U::current(['download' => 1]), ['class' => 'btn btn-success', 'data-pjax' => '0',]); ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showOnEmpty'=>false,
        'tableOptions' =>['class' => 'table table-striped'],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'order_id',
            'oid',
            // 'goods_id',
            'title',
            [
                'visible' => $isAdmin,
                'attribute' => 'username',
            ],
            [
                'visible' => $isAdmin,
                'attribute' => 'usermobile',
            ],

            //'feesum',
            'create_time',
            //'status',
            [
                'attribute' => 'status',
                'label' => '订单状态',
                'value'=>function ($model, $key, $index, $column) { 
                        return MOrder::getStatusOption($model->status); 
                 },
                'filter'=> MOrder::getStatusOption(),
                'headerOptions' => array('style'=>'width:90px;'),
            ],

            // 'userid',
            // 'address',
            // 'memo',
            // 'memo_reply',


            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => array('style'=>'width:90px;'),   
                //'template' => '{update} {delete}',
                'template' => $opt,
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                        ]);
                    },
             
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('yii', 'Delete'),
                            'data-confirm' => Yii::t('yii', '确认要删除?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ]);
                    }
            
                ],
            ],


        ],
    ]); ?>

</div>
