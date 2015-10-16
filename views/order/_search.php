<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MOrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="morder-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'order_id') ?>

    <?= $form->field($model, 'oid') ?>

    <?= $form->field($model, 'feesum') ?>

    <?= $form->field($model, 'create_time') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'goods_id') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'userid') ?>

    <?php // echo $form->field($model, 'username') ?>

    <?php // echo $form->field($model, 'usermobile') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'memo') ?>

    <?php // echo $form->field($model, 'memo_reply') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
