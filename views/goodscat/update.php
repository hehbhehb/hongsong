<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MGoodscat */

$this->title = '修改商品分类: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '商品分类管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="mgoodscat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
