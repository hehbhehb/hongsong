<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '公司介绍';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    img {
        width: 100%;
    }
</style>
<div class="site-about">
	<!--
    <h3><//?= empty($about)?"":$about->com_name ?></h3>
    -->

	<p>

	<?= empty($about)?"":$about->com_content ?>

	</p>
	<!--
    <p>This is the About page. You may modify the following file to customize its content:</p>

    <code><//?= __FILE__ ?></code>
    -->


</div>
