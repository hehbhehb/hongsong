<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MGoods */

$this->title = '修改商品: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '商品管理', 'url' => ['index', 'pub_userid' => Yii::$app->user->identity->id, 'goods_kind' => 0]];
//$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->goods_id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="mgoods-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
