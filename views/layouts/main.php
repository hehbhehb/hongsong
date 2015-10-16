<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\MAbout;

AppAsset::register($this);

$about = MAbout::find()->one();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--
    <LINK href="favicon1.ico" type="image/x-icon" rel=icon>
    <LINK href="favicon1.ico" type="image/x-icon" rel="shortcut icon">
    -->

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

        <?php
        if(Yii::$app->user->isGuest)
        {
            $isAdmin = false;
            $isMember = false;
        }
        else
        {
            if (Yii::$app->user->identity->role == 1)
            {
                $isAdmin = true;
                $isMember = false;
            }
            else /*role == 0*/
            {
                $isAdmin = false;
                $isMember = true;
            }
        }

        NavBar::begin([
             //'brandLabel' => Html::img($asset->baseUrl . '/logo.png'),
            'brandLabel' => empty($about->com_name)?"":$about->com_name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],

        ]);
        /*
        $menuItems = [
            ['label' => '首页', 'url' => ['/site/index']],
            ['label' => '关于', 'url' => ['/site/about']],
            ['label' => '联系', 'url' => ['/site/contact']],
        ];

            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => '注册', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => '登录', 'url' => ['/site/login']];
            } else {

            //if (Yii::$app->user->identity->role == 1) {
                $menuItems[] = [
                    'label' => '商品',
                    'url' => ['/goods/index','pub_userid'=>Yii::$app->user->identity->id],
                    'linkOptions' => ['data-method' => 'post']
                ];
            //}

            $menuItems[] = [
                'label' => '退出 (' . Yii::$app->user->identity->username . ')',
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post']
            ];
        }
        */

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'encodeLabels' => false,
            //'items' => $menuItems,
            'items' => [
                ['label' => '首页', 'url' => ['/site/index']],
                ['label' => '关于', 'url' => ['/site/about']],
                ['label' => '联系', 'url' => ['/site/contact']],

                ['label' => '商品列表', 'url' => ['/site/client-goods-list']],

                [
                    'label' => '会员',
                    'visible' => $isMember,
                    'items' => [
                        ['label' => '商品发布','url' => ['/goods/index','pub_userid'=>Yii::$app->user->identity->id],'linkOptions' => ['data-method' => 'post']],
                        ['label' => '我的订单','url' => ['/order/index','userid'=>Yii::$app->user->identity->id],'linkOptions' => ['data-method' => 'post']],
                        '<li class="divider"></li>',

                    ]
                ],   

                [
                    'label' => '管理',
                    'visible' => $isAdmin,
                    'items' => [
                        ['label' => '网站配置','url' => ['/about/index'],'linkOptions' => ['data-method' => 'post']],
                        ['label' => '用户管理','url' => ['/user/index'],'linkOptions' => ['data-method' => 'post']],
                        ['label' => '商品管理','url' => ['/goods/index','pub_userid'=>Yii::$app->user->identity->id],'linkOptions' => ['data-method' => 'post']],
                        ['label' => '订单管理','url' => ['/order/index','userid'=>Yii::$app->user->identity->id],'linkOptions' => ['data-method' => 'post']],
                        '<li class="divider"></li>',

                    ]
                ],      

                Yii::$app->user->isGuest?
                ['label' => '登录', 'url' => ['/site/login']]:
                [
                    'label' => '<span class="glyphicon glyphicon-user"></span> '.Html::encode(Yii::$app->user->identity->username),
                    'items' => [
                        //['label' => '修改设置','url' => ['/site/profile'],'linkOptions' => ['data-method' => 'post']],
                        //'<li class="divider"></li>',
                        ['label' => '退出','url' => ['/site/logout'],'linkOptions' => ['data-method' => 'post']],
                    ]
                ],

            ],
        ]);
        NavBar::end();
    ?>


    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">
        <span class="glyphicon glyphicon-globe"></span>
        <?= empty($about->com_name)?"":$about->com_name ?>&copy; <?= date('Y') ?> 
        &nbsp;&nbsp;
        <span class="glyphicon glyphicon-home"></span>
        <?= empty($about->com_addr)?"":$about->com_addr ?></p>
        &nbsp;&nbsp;
        <span class="glyphicon glyphicon-earphone"></span>
        <?= empty($about->com_addr)?"":$about->com_tel ?></p>
		<!--
        <p class="pull-right"><//?= Yii::powered() ?></p>
		-->

    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
