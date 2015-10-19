<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\helpers\Url;
use app\models\U;

use app\models\MGoods;
use app\models\MUser;
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

    <h4>会员信息</h4>

    <?= DetailView::widget([
        'model' => $model,
        //'options' => ['class' => 'table table-striped table-bordered detail-view'],
        'template' => '<tr><th width=20%>{label}</th><td>{value}</td></tr>',
        'options' => ['class' => 'table table-striped detail-view'],
        'attributes' => [
            'id',
            'username',
            'mobile',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            //'status',
            'created_at:datetime',
            //'updated_at:datetime',
            //'role',
            [
                'label' => '角色',
                'value' => $model->getRole($model),
                'format'=> 'html',
            ],

            //'usertype',
            [
                'label' => '用户类型',
                'value' => $model->getUserType($model),
                'format'=> 'html',
            ],

            'user_extra1',

            [
                'label' => '用户附加图片信息',

                'value' => $model->getUserExtraInfoPics($model),
                'format'=> 'html',
            ],

            //'quantity',
        ],
    ]) ?>

</div>


<script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
  
</script>
