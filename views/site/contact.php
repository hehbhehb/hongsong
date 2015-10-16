<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

$this->title = '留言';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
    $this->registerJs(
       '$(".flash-success").animate({opacity: 1.0}, 3000).fadeOut("slow");$(".flash-error").animate({opacity: 1.0}, 3000).fadeOut("slow");',
       yii\web\View::POS_READY
    );
?>

<?php if (Yii::$app->session->hasFlash('success')) {?>
    <div class="alert alert-success flash-success">
        <?php echo Yii::$app->session->getFlash('success'); ?>
    </div>
<?php } else if(Yii::$app->session->hasFlash('error')){ ?>
    <div class="alert alert-danger flash-error">
        <?php echo Yii::$app->session->getFlash('error'); ?>
    </div>
<?php } else {?>

<?php } ?>

<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        如果您有任何业务问题咨询或宝贵建议，请留言，以便我们和您保持联系哦！谢谢。
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <?= $form->field($model, 'name')->label("用户名") ?>
                <?= $form->field($model, 'email')->label("电子邮箱") ?>
                <?= $form->field($model, 'subject')->label("主题") ?>
                <?= $form->field($model, 'body')->label("内容")->textArea(['rows' => 6]) ?>
                <?= $form->field($model, 'verifyCode')->label("验证码")->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>
                <div class="form-group">
                    <?= Html::submitButton('提交', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
