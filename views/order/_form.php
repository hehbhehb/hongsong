<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\MOrder;
/* @var $this yii\web\View */
/* @var $model app\models\MOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="morder-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--
    <//?= $form->field($model, 'oid')->textInput(['maxlength' => true]) ?>
    -->

    <!--
    <//?= $form->field($model, 'feesum')->textInput() ?>

    <//?= $form->field($model, 'create_time')->textInput() ?>
    -->

    <!--
    <//?= $form->field($model, 'status')->textInput() ?>
    -->


    <?= $form->field($model, 'status')->dropDownList(MOrder::getStatusOption()) ?>

    <!--
    <//?= $form->field($model, 'goods_id')->textInput() ?>

    <//?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <//?= $form->field($model, 'userid')->textInput() ?>

    <//?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <//?= $form->field($model, 'usermobile')->textInput(['maxlength' => true]) ?>

    <//?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <//?= $form->field($model, 'memo')->textInput(['maxlength' => true]) ?>
    -->

    <?= $form->field($model, 'memo_reply')->label("给用户回复")->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
