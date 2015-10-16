<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MOrder */

$this->title = 'Create Morder';
$this->params['breadcrumbs'][] = ['label' => 'Morders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="morder-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
