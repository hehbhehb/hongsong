<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\MGoods;


use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model app\models\MGoods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mgoods-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'goods_kind')->dropDownList(MGoods::getGoodsKindOption()) ?>

    <?php
        if (Yii::$app->user->identity->role == 1) 
        {
    ?>
        <p><?= Html::a('新建商品分类', ['goodscat/index']) ?></p>
    <?php 
        }
    ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'model')->textInput(['maxlength' => 128]) ?>
    <?= $form->field($model, 'brand')->textInput(['maxlength' => 128]) ?>
    <?= $form->field($model, 'prod_area')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'descript')->textInput(['maxlength' => 256]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'price_hint')->textInput(['maxlength' => 512]) ?>

    <!--
    <//?= $form->field($model, 'price_old')->textInput() ?>
    -->

    <!--
    <//?= $form->field($model, 'detail')->textarea(['rows' => 6]) ?>
    -->

    <?php echo $form->field($model, 'detail')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'zh_cn',
            'minHeight'=>200,
            'maxHeight'=>400,
            'buttonSource'=>true,
            'convertDivs'=>false,
            'removeEmptyTags'=>false,
            'plugins' => [
                'clips',
                'fullscreen',
                'fontcolor',
                'fontfamily',
                'fontsize',
                'limiter',
                'table',
                'textexpander',
                'textdirection',
                'video',
                'definedlinks',
                'filemanager',
                'imagemanager',
            ],
            'imageManagerJson' => Url::to(['/goods/imagesget']),
            'imageUpload' => Url::to(['/goods/imageupload']),
        ]
    ]); ?>
    
    <!--
    <//?= $form->field($model, 'list_img_url')->textInput(['maxlength' => 256]) ?>
    -->
    <?= $form->field($model, 'file')->fileInput()->hint('1张商品列表小图，图片建议尺寸：120像素 * 120像素')  ?>

    <!--
    <//?= $form->field($model, 'body_img_url')->textInput(['maxlength' => 512]) ?>
    -->
     <?= $form->field($model, 'files[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->hint('最多3张商品展示大图，图片建议尺寸：700像素 * 500像素')  ?>


<!--
    <//?= $form->field($model, 'quantity')->textInput() ?>
-->

<!--
    <//?= $form->field($model, 'office_ctrl')->textInput() ?>

    <//?= $form->field($model, 'package_ctrl')->textInput() ?>

    <//?= $form->field($model, 'detail_ctrl')->textInput() ?>

    <//?= $form->field($model, 'pics_ctrl')->textInput() ?>
-->


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
