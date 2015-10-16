<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\SignupForm;
use app\models\User;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = '用户注册';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <!--
    <p>Please fill out the following fields to signup:</p>
    -->
 <p>&nbsp;</p>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => ['enctype' => 'multipart/form-data']]); ?>


                <?= $form->field($model, 'username')->label("用户名") ?>
                <?= $form->field($model, 'password')->label("密码")->passwordInput() ?>

                <?= $form->field($model, 'mobile')->label("手机号码") ?>
                <?= $form->field($model, 'email')->label("电子邮箱") ?>

                <?= $form->field($model, 'usertype')->label("用户类型")->dropDownList(SignupForm::getUsertypeOption()) ?>
       
                <?= $form->field($model, 'user_extra1')->label("用户附加信息")->hint("当用户类型为'个人'时请填写个人身份证号；当用户类型为'公司'时填写公司名称") ?>
                <?= $form->field($model, 'files[]')->label("照片")->fileInput(['multiple' => true, 'accept' => 'image/*'])->hint("当用户类型为'个人'时上传个人身份证正反面(2张)；当用户类型为'公司'时上传企业执照(2张)")  ?>

                <div class="form-group">
                    <?= Html::submitButton('注册', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
                 <?= Html::a('我已是会员, 直接登录', ['site/login']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
