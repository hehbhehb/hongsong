<?php

namespace app\controllers;

use Yii;
use app\models\MGoods;
use app\models\MGoodsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use Imagine\Image\ImagineInterface;
use Imagine\Image\ManipulatorInterface;

use yii\imagine\Image;
use app\models\U;
use  yii\web\UploadedFile;
/**
 * GoodsController implements the CRUD actions for MGoods model.
 */
class GoodsController extends Controller
{
	
	public function actions()
    {
        return [
            'imagesget' => [
                'class' => 'vova07\imperavi\actions\GetAction',
                'url' => Yii::$app->request->getHostInfo(). Yii::getAlias('@web/wysiwyg/'),                
                'path' => '@webroot/wysiwyg',
                'type' => \vova07\imperavi\actions\GetAction::TYPE_IMAGES,
            ],
            'imageupload' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                'url' => Yii::$app->request->getHostInfo(). Yii::getAlias('@web/wysiwyg/'),
                'path' => '@webroot/wysiwyg',
            ],            
        ];
    }
	
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all MGoods models.
     * @return mixed
     */
    public function actionIndex($pub_userid, $goods_kind)
    {
        $searchModel = new MGoodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $pub_userid, $goods_kind);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MGoods model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MGoods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MGoods();

        if ($model->load(Yii::$app->request->post())) {

            //上传列表小图片， 单文件上传
            $model->file = UploadedFile::getInstance($model, 'file');
            if(!empty($model->file))
            {
                $targetFileId = date("YmdHis").'-'.uniqid();
                $ext = pathinfo($model->file->name, PATHINFO_EXTENSION);
                $targetFileName = "{$targetFileId}.{$ext}";
                $targetFile = Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . MGoods::PHOTO_PATH . DIRECTORY_SEPARATOR . $targetFileName;

                $model->file->saveAs($targetFile);

                $model->list_img_url = "/goods/photo/{$targetFileName}";
            }

           
            //上传产品大图片图片， 多文件上传， 最多3张图
            $tmpStr2="";
            $model->files = UploadedFile::getInstances($model, 'files');
            foreach ($model->files as $file) 
            {
                $targetFileId = date("YmdHis").'-'.uniqid();
                $ext = pathinfo($file->name, PATHINFO_EXTENSION);
                $targetFileName = "{$targetFileId}.{$ext}";

                $targetFile = Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . MGoods::PHOTO_PATH . DIRECTORY_SEPARATOR . $targetFileName;
                $file->saveAs($targetFile);

                $tmpStr2 =  $tmpStr2 . "/goods/photo/{$targetFileName};";
            }
            $model->body_img_url = $tmpStr2;

            //保存发布者id
            $model->pub_userid = Yii::$app->user->identity->id;

            $model->save();

            //邮件发送
            $mail = Yii::$app->mailer->compose();
            $mail->setTo('1443594559@qq.com');//send to gtsun
            //$mail->setTo('zengkai001@163.com');//send to kzeng
            $mail->setSubject('有新商品发布，请审核');
            $mail->setHtmlBody('商品名 '.$model->title);
            if($mail->send()){
                //echo '成功';
                U::W("===========mail send ok ==============");
            }else{
                //echo '失败';
                U::W("===========mail send failed ==============");
            }

            return $this->redirect(['index', 'pub_userid' => Yii::$app->user->identity->id, 'goods_kind' => 0]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Updates an existing MGoods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            
            //上传列表小图片， 单文件上传
            $model->file = UploadedFile::getInstance($model, 'file');
            if(!empty($model->file))
            {
                $targetFileId = date("YmdHis").'-'.uniqid();
                $ext = pathinfo($model->file->name, PATHINFO_EXTENSION);
                $targetFileName = "{$targetFileId}.{$ext}";
                $targetFile = Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . MGoods::PHOTO_PATH . DIRECTORY_SEPARATOR . $targetFileName;

                $model->file->saveAs($targetFile);

                $model->list_img_url = "/goods/photo/{$targetFileName}";
            }

            //上传产品大图片图片， 多文件上传， 最多3张图
            $tmpStr="";
            $model->files = UploadedFile::getInstances($model, 'files');

            if(!empty($model->files))
            {
                foreach ($model->files as $file) 
                {
                    $targetFileId = date("YmdHis").'-'.uniqid();
                    $ext = pathinfo($file->name, PATHINFO_EXTENSION);
                    $targetFileName = "{$targetFileId}.{$ext}";
                    $targetFile = Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . MGoods::PHOTO_PATH . DIRECTORY_SEPARATOR . $targetFileName;
                    $file->saveAs($targetFile);

                    $tmpStr =  $tmpStr . "/goods/photo/{$targetFileName};";
                }
                 $model->body_img_url = $tmpStr;
            }

            //保存发布者id
            $model->pub_userid = Yii::$app->user->identity->id;

            $model->save();
            return $this->redirect(['view', 'id' => $model->goods_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MGoods model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index', 'pub_userid' => Yii::$app->user->identity->id, 'goods_kind' => 0]);
    }

    /**
     * Finds the MGoods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MGoods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MGoods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
