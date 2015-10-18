<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = '登录';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">

    <h1><?= Html::encode($this->title) ?></h1>
    <!--
    <p>Please fill out the following fields to login:</p>
    -->
 <p>&nbsp;</p>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'username')->label("用户名") ?>
                <?= $form->field($model, 'password')->passwordInput()->label("密码") ?>
                <?= $form->field($model, 'rememberMe')->label("记住")->checkbox() ?>

                <div class="form-group">
                    <?= Html::submitButton('登录', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

                </div>

                 <?= Html::a('忘了密码？', ['site/request-password-reset']) ?> | 
                 <?= Html::a('免费注册会员', ['site/signup']) ?> | 
                 <?= Html::a('意见反馈', ['site/contact']) ?>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
