<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MGoodscat */

$this->title = '新建商品分类';
$this->params['breadcrumbs'][] = ['label' => '商品分类管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgoodscat-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
