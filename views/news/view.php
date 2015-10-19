<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '新闻管理', 'url' => ['index', 'cat' => 0]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->news_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->news_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '删除这条新闻，确定?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'template' => '<tr><th width=25%>{label}</th><td>{value}</td></tr>',
        //'options' => ['class' => 'table table-striped table-bordered detail-view'],
        'options' => ['class' => 'table table-striped detail-view'],
        'attributes' => [
            'news_id',
            'title',
            //'content:ntext',
            [
                'attribute' => 'content',
                'format'=> 'html',
            ],
            'create_time',
            'update_time',
            //'cat',
            [
                'label' => '类别',
                'value' => $model->getCat($model),
                'format'=> 'html',
            ],
            'clickcnt',
        ],
    ]) ?>

</div>
