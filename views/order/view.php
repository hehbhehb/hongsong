<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MOrder */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '订单管理', 'url' => ['index', 'userid' => $model->userid]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="morder-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <!--
    <p>
        <//?= Html::a('修改', ['update', 'id' => $model->order_id], ['class' => 'btn btn-primary']) ?>
        <//?= Html::a('删除', ['delete', 'id' => $model->order_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    -->

    <?= DetailView::widget([
        'model' => $model,
        'template' => '<tr><th width=20%>{label}</th><td>{value}</td></tr>',
        'options' => ['class' => 'table table-striped detail-view'],
        'attributes' => [
            'order_id',
            'oid',
            'feesum',
            'create_time',
            'status',
            'goods_id',
            'title',
            'userid',
            'username',
            'usermobile',
            'address',
            'memo',
            'memo_reply',
        ],
    ]) ?>

</div>
