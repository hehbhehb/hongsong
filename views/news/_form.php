<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\News;

use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <!--
    <//?= $form->field($model, 'cat')->textInput() ?>
    -->

    <?= $form->field($model, 'cat')->dropDownList(News::getCatOption()) ?>

    <!--
    <//?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
    -->


    <?php echo $form->field($model, 'content')->widget(Widget::className(), [
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
            'imageManagerJson' => Url::to(['/news/imagesget']),
            'imageUpload' => Url::to(['/news/imageupload']),
        ]
    ]); ?>


    <!--
    <//?= $form->field($model, 'create_time')->textInput() ?>

    <//?= $form->field($model, 'update_time')->textInput() ?>

     <//?= $form->field($model, 'clickcnt')->textInput() ?>
    -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
