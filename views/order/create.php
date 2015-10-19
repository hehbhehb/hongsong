<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MOrder */

$this->title = 'Create Morder';
$this->params['breadcrumbs'][] = ['label' => 'Morders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="morder-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
