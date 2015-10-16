<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MAbout */

$this->title = '创建公司介绍';
$this->params['breadcrumbs'][] = ['label' => '关于公司', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mabout-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
