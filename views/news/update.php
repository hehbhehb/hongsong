<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = '修改新闻: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '新闻管理', 'url' => ['index', 'cat' => 0]];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->news_id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="news-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
