<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\U;

/* @var $this yii\web\View */
$this->title = 'demo';
?>
<div class="site-index">

    <!--
    <div class="jumbotron">
        <h4>Congratulations!</h4>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>
    -->
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <?php 
      $imgs = explode(";",$about->body_img_url);
      //分号分割后，数组最后一项为空，剔除
      $pic_cnt = sizeof($imgs) - 1; 
      for ($i=0; $i<$pic_cnt; $i++) {
      if($i == 0)
      {
    ?>
    <li data-target="#carousel-example-generic" data-slide-to="<?= $i ?>" class="active"></li>
     <?php
       } 
       else 
       {
    ?>
      <li data-target="#carousel-example-generic" data-slide-to="<?= $i ?>"></li>
    <?php 
        }
      }
    ?>

  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <?php 
      $imgs = explode(";",$about->body_img_url);
      //分号分割后，数组最后一项为空，剔除
      $pic_cnt = sizeof($imgs) - 1; 
      for ($i=0; $i<$pic_cnt; $i++) {
      if($i == 0)
      {
    ?>
    <div class="item active">
      <img src='<?= $imgs[$i] ?>' width="100%">
      <div class="carousel-caption">
      </div>
    </div>
    <?php
       } 
       else 
       {
    ?>
      <div class="item">
        <img src='<?= $imgs[$i] ?>' width="100%">
        <div class="carousel-caption">
        </div>
      </div>
    <?php 
        }
      }
    ?>

  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

    <div class="body-content">
      <br>

        <?php 
          $n = 0;
          foreach ($goods as $g) 
          {
        ?>
        <?php if($n%4 == 0) {?>
              <div class="row">
        <?php } ?>
          <div class="col-xs-12 col-md-3">
            <div class="thumbnail">
              <img src="<?= $g->list_img_url ?>" alt="<?= $g->title ?>">
              <div class="caption">
                <h3><?= $g->title ?></h3>

                <p><?=  mb_substr($g->descript, 0, 32, 'utf-8')."..."  ?></p>
               
                <p>
                 <?= Html::a('更多', ['site/client-goods-view', 'id' => $g->goods_id], ['class' => 'btn btn-primary']) ?>
                </p>
              </div>
            </div>
          </div>
        <?php if(($n+1)%4 == 0) {?>
            </div>
        <?php } ?>
        <?php
            $n = $n + 1;
          }
        ?>

  </div>
