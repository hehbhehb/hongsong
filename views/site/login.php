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
                <div style="color:#999;margin:1em 0">
                    我忘记了密码 <?= Html::a('找回密码', ['site/request-password-reset']) ?>
                </div>
                <div class="form-group">
                    <?= Html::submitButton('登录', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

                </div>
                <?= Html::a('免费注册会员', ['site/signup']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
