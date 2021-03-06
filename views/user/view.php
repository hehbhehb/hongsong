<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MUser */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '用户管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="muser-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '删除该用户，确定?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
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
            'status',
            'created_at:datetime',
            'updated_at:datetime',
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
        ],
    ]) ?>

</div>
