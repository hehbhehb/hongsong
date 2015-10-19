<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\helpers\Url;
use app\models\U;

use app\models\MGoods;

/* @var $this yii\web\View */
/* @var $model app\models\MGoods */

//$this->title = $model->title;
//$this->params['breadcrumbs'][] = ['label' => '商品管理', 'url' => ['index', 'pub_userid' => $model->pub_userid]];
//$this->params['breadcrumbs'][] = $this->title;
?>

<style type="text/css">
    img {
        width: 100%;
    }
</style>

<div class="mgoods-view">

    <h4><?= Html::encode($model->title) ?></h4>

    <img style="width: 80% " src='<?= $model->list_img_url?>' >

    <?= DetailView::widget([
        'model' => $model,
        //'options' => ['class' => 'table table-striped table-bordered detail-view'],
        'template' => '<tr><th width=20%>{label}</th><td>{value}</td></tr>',
        'options' => ['class' => 'table table-striped detail-view'],
        'attributes' => [
            //'goods_id',
            /*
            [
                'label' => '商品小图',
                'value' => '<img src=' . $model->list_img_url . '>',
                'format'=> 'html',
            ],
            */

            'title',
            /*
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
               */

            'brand',
            'model',
            'prod_area',
            'descript',
            //'price',
            //'price_hint',
            //'price_old',
            //'list_img_url:url',


            /*
  
            //'body_img_url:url',
            
            [
                'label' => '商品大图',
                'value' => $model->getViewGoodsPics($model),
                'format'=> 'html',
            ],
            */

            //'detail:ntext',
            /*
            [
                'attribute' => 'detail',
                'format'=> 'html',
            ],
            */


            //'quantity',
        ],
    ]) ?>

    <?= $model->detail ?>
    <center>
    <!--
    <button type="button" class="btn btn-success btn-lg" id="zujie" style="height:50px;width:160px">我要租借</button>
    -->
    <button type="button" class="btn btn-success btn-lg btn-block" id="zujie">我要租借</button>
    <!--
    &nbsp;&nbsp;
    <button type="button" class="btn btn-danger btn-lg" id="dyj100" style="height:80px">100元代金券 (-10000分)</button>
    -->
    </center>
    <br>
    <div class="alert alert-danger" role="alert" id="hint">
          <?= Html::a('请先登录 >>', ['site/login']) ?>
    </div>
    <div class="alert alert-success" role="alert" id="order">
          租借申请订单已生成  &nbsp;&nbsp;<?= Html::a('我的订单 >>', ['order/index','userid'=>Yii::$app->user->identity->id]) ?>
    </div>

</div>


<script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
    $("#hint").hide();
    $("#order").hide();

     var isGuest = '<?= (Yii::$app->user->isGuest)?1:0 ?>';


    $(document).ready(function() {
            
        
            $('#zujie').click (function () {

                //alert('confirmAjax');
                // if (!confirm("确定要租借吗?"))
                //   return;

                if(isGuest == 1)
                {
                    //alert("you are guest");
                    //$("#hint").show();
                    location.href = '<?php echo Url::to(["site/login"]); ?>';
                    return false;
                }
                else
                {
                    var user_id = '<?= Yii::$app->user->identity->id ?>';
                }

                var args = {
                    'classname':    '\\app\\models\\MGoods',
                    'funcname':     'zujieAjax',
                    'params':       {
                        'goods_id': '<?= $model->goods_id ?>',    
                        'user_id': user_id,
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
                            //alert("租借成功！");
                            //location.href = '<?= Url::to() ?>';
                            $("#order").show();
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
