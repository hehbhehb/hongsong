<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MUser */

$this->title = 'Create Muser';
$this->params['breadcrumbs'][] = ['label' => 'Musers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="muser-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
