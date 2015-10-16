<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\helpers\Url;
use app\models\U;


/* @var $this yii\web\View */
/* @var $model app\models\MGoods */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '商品管理', 'url' => ['index', 'pub_userid' => $model->pub_userid]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgoods-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->goods_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->goods_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
         &nbsp;&nbsp;&nbsp;&nbsp;
        <?php 
            // admin 才能发布商品
            if (Yii::$app->user->identity->role == 1) {
        ?>
            <button type="button" class="btn btn-success btn-lg" id="publish" style="width:120px">发布</button>
            &nbsp;&nbsp;
            <button type="button" class="btn btn-danger btn-lg" id="unpublish" style="width:120px">下架</button>
        <?php } ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        //'options' => ['class' => 'table table-striped table-bordered detail-view'],
        'template' => '<tr><th width=20%>{label}</th><td>{value}</td></tr>',
        //'options' => ['class' => 'table table-striped table-bordered detail-view'],
        'options' => ['class' => 'table table-striped detail-view'],
        'attributes' => [
            'goods_id',
            'title',

            [
                'label' => '发布者',
                'value' => $model->getPubUserName($model),
                'format'=> 'html',
            ],

            [
                'label' => '发布状态',
                'value' => $model->getStatus($model),
                'format'=> 'html',
            ],

            'brand',
            'model',
            'prod_area',
            'descript',
            //'price',
            //'price_hint',
            //'price_old',
            //'list_img_url:url',
            [
                'label' => '商品小图',
                'value' => '<img width=90px height=60px src=' . $model->list_img_url . '>',
                'format'=> 'html',
            ],
            //'body_img_url:url',
            
            [
                'label' => '商品大图',
                /*
                'value' => function($model){
                    $len = 0;
                    $imgHtml = "";
                    $imgs = explode(";",$model->body_img_url);
                    foreach ($imgs as $img) {
                        $len++;
                        if(sizeof($imgs) == $len) break; //分号分割后，数组最后一项为空，剔除
                        $imgHtml = $imgHtml . '<img src=' . $img . '>';
                    }
                    return $imgHtml;
                },
                */
                'value' => $model->getViewGoodsPics($model),
                'format'=> 'html',
            ],
            //'detail:ntext',
            [
                'attribute' => 'detail',
                'format'=> 'html',
            ],


            'quantity',
        ],
    ]) ?>

</div>


<script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function() {
        
            $('#publish').click (function () {
                //alert('confirmAjax');
                //if (!confirm("确定要发布吗?"))
                //   return;
                var args = {
                    'classname':    '\\app\\models\\MGoods',
                    'funcname':     'confirmAjax',
                    'params':       {
                        'goods_id': '<?= $model->goods_id ?>',
                        'status': 1,  
                    }
                };
                $.ajax({
                    url:        "<?= \yii\helpers\Url::to(['site/siteajax'], true) ; ?>",
                    type:       "GET",
                    cache:      false,
                    dataType:   "json",
                    data:       "args=" + JSON.stringify(args),
                    success:    function(ret) { 
                        if (0 === ret['code']) 
                        {
                            alert("商品成功发布！");
                            location.href = '<?= Url::to() ?>';
                        } 
                        else
                        {
                             alert("error");
                        }
                    },                        
                    error:      function(){
                        alert('发送失败。');
                    }
                });
            });


            $('#unpublish').click (function () {
                //alert('confirmAjax');
                var args = {
                    'classname':    '\\app\\models\\MGoods',
                    'funcname':     'confirmAjax',
                    'params':       {
                        'goods_id': '<?= $model->goods_id ?>',
                        'status': 0,
                    }
                };
                $.ajax({
                    url:        "<?= \yii\helpers\Url::to(['site/siteajax'], true) ; ?>",
                    type:       "GET",
                    cache:      false,
                    dataType:   "json",
                    data:       "args=" + JSON.stringify(args),
                    success:    function(ret) { 
                        if (0 === ret['code']) 
                        {
                            alert("商品成功下架！");
                            location.href = '<?= Url::to() ?>';
                        } 
                        else
                        {
                             alert("error");
                        }
                    },                        
                    error:      function(){
                        alert('发送失败。');
                    }
                });
            });
            

    });
    </script>
