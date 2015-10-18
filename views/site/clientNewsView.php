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
<div class="mgoods-view">

    <h2><?= Html::encode($model->title) ?></h2>


    <?= DetailView::widget([
        'model' => $model,
        //'options' => ['class' => 'table table-striped table-bordered detail-view'],
        'template' => '<tr><th width=20%>{label}</th><td>{value}</td></tr>',
        'options' => ['class' => 'table table-striped detail-view'],
        'attributes' => [
            'news_id',
            'title',
            //'content:ntext',
            [
                'attribute' => 'content',
                'format'=> 'html',
            ],
            'create_time',
            'update_time',
            //'cat',
            [
                'label' => '类别',
                'value' => $model->getCat($model),
                'format'=> 'html',
            ],
            'clickcnt',
        ],
    ]) ?>

</div>


<script type="text/javascript">

</script>
