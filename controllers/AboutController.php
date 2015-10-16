<?php

namespace app\controllers;

use Yii;
use app\models\MAbout;
use app\models\MAboutSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use Imagine\Image\ImagineInterface;
use Imagine\Image\ManipulatorInterface;

use yii\imagine\Image;
use app\models\U;
use  yii\web\UploadedFile;



/**
 * AboutController implements the CRUD actions for MAbout model.
 */
class AboutController extends Controller
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
     * Lists all MAbout models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MAboutSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MAbout model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MAbout model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*
    public function actionCreate()
    {
        $model = new MAbout();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->about_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    */

    public function actionCreate()
    {
        $model = new MAbout();

        if ($model->load(Yii::$app->request->post())) {
            //上传首页轮播大图片图片， 多文件上传， 最多10张图
            $tmpStr="";
            $model->files = UploadedFile::getInstances($model, 'files');
            foreach ($model->files as $file) 
            {
                $targetFileId = date("YmdHis").'-'.uniqid();
                $ext = pathinfo($file->name, PATHINFO_EXTENSION);
                $targetFileName = "{$targetFileId}.{$ext}";

                $targetFile = Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . MAbout::PHOTO_PATH . DIRECTORY_SEPARATOR . $targetFileName;
                $file->saveAs($targetFile);

                $tmpStr =  $tmpStr . "/site1/web/about/photo/{$targetFileName};";
            }
            $model->body_img_url = $tmpStr;
            $model->save();
            return $this->redirect(['view', 'id' => $model->about_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Updates an existing MAbout model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    /*
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->about_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    */

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            //上传首页轮播大图片图片， 多文件上传， 最多10张图
            $tmpStr="";
            $model->files = UploadedFile::getInstances($model, 'files');

            if(!empty($model->files))
            {
                foreach ($model->files as $file) 
                {
                    $targetFileId = date("YmdHis").'-'.uniqid();
                    $ext = pathinfo($file->name, PATHINFO_EXTENSION);
                    $targetFileName = "{$targetFileId}.{$ext}";
                    $targetFile = Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . MAbout::PHOTO_PATH . DIRECTORY_SEPARATOR . $targetFileName;
                    $file->saveAs($targetFile);

                    $tmpStr =  $tmpStr . "/site1/web/about/photo/{$targetFileName};";
                }
                 $model->body_img_url = $tmpStr;
            }

            $model->save();

            U::W($tmpStr);
            U::W($model);
            U::W("++++++++++++++++++++++++++++++");
            return $this->redirect(['view', 'id' => $model->about_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MAbout model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MAbout model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return MAbout the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MAbout::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
