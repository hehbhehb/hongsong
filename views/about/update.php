<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MAbout */

$this->title = '修改公司介绍: ' . ' ' . $model->about_id;
$this->params['breadcrumbs'][] = ['label' => '关于公司', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->about_id, 'url' => ['view', 'id' => $model->about_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mabout-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
