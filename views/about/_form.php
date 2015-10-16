<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


use app\models\MAbout;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model app\models\MAbout */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mabout-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'com_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'com_addr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'com_tel')->textInput() ?>

    <?= $form->field($model, 'com_voice')->textInput(['maxlength' => true]) ?>

    <!--
    <//?= $form->field($model, 'com_content')->textarea(['rows' => 6]) ?>
    -->
    <?= $form->field($model, 'files[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->hint('最多10首页轮播大图，图片建议尺寸：900像素 * 300像素')  ?>

    <?php echo $form->field($model, 'com_content')->widget(Widget::className(), [
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
            'imageManagerJson' => Url::to(['/about/imagesget']),
            'imageUpload' => Url::to(['/about/imageupload']),
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
