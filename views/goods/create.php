<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MGoods */

$this->title = '新增商品';
$this->params['breadcrumbs'][] = ['label' => '商品管理', 'url' => ['index', 'pub_userid' => Yii::$app->user->identity->id, 'goods_kind' => 0]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgoods-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
