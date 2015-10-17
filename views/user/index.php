<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="muser-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建用户', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showOnEmpty'=>false,
        'tableOptions' =>['class' => 'table table-striped'],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'mobile',
            //'auth_key',
            //'password_hash',
            // 'password_reset_token',
            'email:email',
            // 'status',
            //'created_at',
            [
                'value' => function($data) {
                    return date('Y-m-d H:i:s',$data->created_at); 
                }
            ],

            // 'updated_at',
            // 'role',
            // 'usertype',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
