<?php

namespace app\controllers;

use Yii;
use app\models\MOrder;
use app\models\MOrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\U;
/**
 * OrderController implements the CRUD actions for MOrder model.
 */
class OrderController extends Controller
{
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
     * Lists all MOrder models.
     * @return mixed
     */
    public function actionIndex($userid)
    {
        $searchModel = new MOrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $userid);

        if (isset($_GET['download'])) {
            
            $filepathname = Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR.'order'."-{$date}.csv";
            $fh = fopen($filepathname, 'w');
            //在写入数据之前先把bom头写到文件里
            fwrite($fh,"\xEF\xBB\xBF");
            fprintf($fh, "订单号, 商品, 订单时间, 订单状态, 用户姓名, 联系电话\n");

             if (Yii::$app->user->identity->role == 1)
                $orders = MOrder::find()->all();
             else
                $orders = MOrder::find()->where(['userid' => $userid])->all();


            if(!empty($orders))
            {
                foreach ($orders as $order) 
                {
                    $status = ($order->status==1)?"已申请":"已处理";


                    fprintf($fh, "%s, %s, %s, %s, %s, %s\n", $order->oid, $order->title, $order->create_time, $status, $order->username, $order->usermobile);
                }
            }

            fclose($fh);
            iconv("UTF-8", "GB2312", "$filepathname"); 
            Yii::$app->response->sendFile($filepathname);
            return;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MOrder model.
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
     * Creates a new MOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MOrder();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->order_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MOrder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        U::W("+++++++++++++++++++++actionUpdate++++++++++++++++++++++++++++");
        if ($model->load(Yii::$app->request->post())) {
            U::W($model);
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->order_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MOrder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MOrder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
