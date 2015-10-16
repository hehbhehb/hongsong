<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MOrder */

$this->title = '修改订单: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '订单管理', 'url' => ['index', 'userid' => $model->userid]];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->order_id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="morder-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
