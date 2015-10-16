<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MAboutSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mabout-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'about_id') ?>

    <?= $form->field($model, 'com_name') ?>

    <?= $form->field($model, 'com_addr') ?>

    <?= $form->field($model, 'com_tel') ?>

    <?= $form->field($model, 'com_voice') ?>

    <?php // echo $form->field($model, 'com_content') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
