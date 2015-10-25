<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\MAbout;
use app\models\MGoodscat;
use app\models\MGoods;




AppAsset::register($this);

$about = MAbout::find()->one();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">

    <!--
    <meta name="viewport" content="width=device-width, initial-scale=1">
    -->

    <!-- Sets initial viewport load and disables zooming  -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

    <!-- Makes your prototype chrome-less once bookmarked to your phone's home screen -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">


    <!--
    <LINK href="favicon1.ico" type="image/x-icon" rel=icon>
    <LINK href="favicon1.ico" type="image/x-icon" rel="shortcut icon">
    -->
    <link rel="stylesheet" href="http://libs.useso.com/js/font-awesome/4.2.0/css/font-awesome.min.css">
    <?= Html::csrfMetaTags() ?>
    <title>首页</title>
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

        //get goods cat
        $goodscat = MGoodscat::find()->all();


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

        foreach ($goodscat as $gc) {
            if($gc->value == 0)/*全部*/
                $goodsCnt = MGoods::find()->where(['status' => 1])->count();
            else
                $goodsCnt = MGoods::find()->where(['status' => 1, 'goods_kind' => $gc->value])->count();

            if($goodsCnt == 0)
            {
                $menuItems[] = [
                    'label' => '<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> '.$gc->cat,
                    'url' => ['/site/client-goods-list','pub_userid'=>Yii::$app->user->isGuest?-1:Yii::$app->user->identity->id,'goods_kind'=>$gc->value],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            else
            {
                $menuItems[] = [
                    'label' => '<span class="badge">'.$goodsCnt.'</span> '.$gc->cat,
                    'url' => ['/site/client-goods-list','pub_userid'=>Yii::$app->user->isGuest?-1:Yii::$app->user->identity->id,'goods_kind'=>$gc->value],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }

        }

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'encodeLabels' => false,
            //'items' => $menuItems,
            'items' => [
                ['label' => '首页', 'url' => ['/site/index']],
                ['label' => '关于', 'url' => ['/site/about']],

                //['label' => '联系', 'url' => ['/site/contact']],
                //['label' => '商品列表', 'url' => ['/site/client-goods-list']],

                ($isAdmin)?"":
                [
                    'label' => '商品列表',
                    'items' => $menuItems,
                ],  

                ($isAdmin)?"":
                [
                    'label' => '新闻动态',
                    'items' => [
                        ['label' => '<i class="fa fa-chevron-right"></i> 行业新闻','url' => ['/site/client-news-list','cat'=>1],'linkOptions' => ['data-method' => 'post']],
                        ['label' => '<i class="fa fa-chevron-right"></i> 公司动态','url' => ['/site/client-news-list','cat'=>2],'linkOptions' => ['data-method' => 'post']],
                    ]
                ], 


                [
                    'label' => '会员',
                    'visible' => $isMember,
                    'items' => [
                        ['label' => '<i class="fa fa-tags"></i> 商品管理','url' => ['/goods/index','pub_userid'=>Yii::$app->user->identity->id, 'goods_kind' => 0],'linkOptions' => ['data-method' => 'post']],
                        ['label' => '<i class="fa fa-list"></i> 我的订单','url' => ['/order/index','userid'=>Yii::$app->user->identity->id],'linkOptions' => ['data-method' => 'post']],
                        '<li class="divider"></li>',
                        ['label' => '<i class="fa fa-user"></i> 会员信息','url' => ['/site/client-user-view','id'=>Yii::$app->user->identity->id],'linkOptions' => ['data-method' => 'post']],
                    ]
                ],   

                [
                    'label' => '管理',
                    'visible' => $isAdmin,
                    'items' => [
                        ['label' => '<i class="fa fa-user"></i> 用户管理','url' => ['/user/index'],'linkOptions' => ['data-method' => 'post']],
                        ['label' => '<i class="fa fa-tags"></i> 商品管理','url' => ['/goods/index','pub_userid'=>Yii::$app->user->identity->id, 'goods_kind' => 0],'linkOptions' => ['data-method' => 'post']],
                        ['label' => '<i class="fa fa-list"></i> 订单管理','url' => ['/order/index','userid'=>Yii::$app->user->identity->id],'linkOptions' => ['data-method' => 'post']],
                        '<li class="divider"></li>',
                        ['label' => '<i class="fa fa-newspaper-o"></i> 新闻管理','url' => ['/news/index', 'cat' => 0],'linkOptions' => ['data-method' => 'post']],
                        ['label' => '<i class="fa fa-cog"></i> 网站配置','url' => ['/about/index'],'linkOptions' => ['data-method' => 'post']],

                    ]
                ],      

                Yii::$app->user->isGuest?
                ['label' => '登录', 'url' => ['/site/login']]:
                [
                    'label' => '<span class="glyphicon glyphicon-user"></span> '.Html::encode(Yii::$app->user->identity->username),
                    'items' => [
                        //['label' => '修改设置','url' => ['/site/profile'],'linkOptions' => ['data-method' => 'post']],
                        //'<li class="divider"></li>',
                        ['label' => '<i class="fa  fa-sign-out"></i> 退出','url' => ['/site/logout'],'linkOptions' => ['data-method' => 'post']],
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

        <p align="center">
            <span class="glyphicon glyphicon-globe"></span>
            <?= empty($about->com_name)?"":$about->com_name ?>&copy; <?= date('Y') ?> 
            <br>
            <span class="glyphicon glyphicon-home"></span>
            <?= empty($about->com_addr)?"":$about->com_addr ?>
            &nbsp;&nbsp;

            <span class="glyphicon glyphicon-earphone"></span>
            <a href="tel:<?= empty($about->com_tel)?'':$about->com_tel ?>">
            <?= empty($about->com_tel)?"":$about->com_tel ?>
            </a>
        </p>
		<!--
        <p class="pull-right"><//?= Yii::powered() ?></p>
		-->

    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
