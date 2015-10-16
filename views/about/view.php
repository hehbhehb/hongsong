<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MAbout */

$this->title = $model->about_id;
$this->params['breadcrumbs'][] = ['label' => '公司简介', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mabout-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->about_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->about_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'template' => '<tr><th width=20%>{label}</th><td>{value}</td></tr>',
        'options' => ['class' => 'table table-striped detail-view'],
        'attributes' => [
            //'about_id',
            'com_name',
            'com_addr',
            'com_tel',
            'com_voice',
            //'com_content:ntext',
            [
                'attribute' => 'com_content',
                'format'=> 'html',
            ],

        ],
    ]) ?>

</div>
