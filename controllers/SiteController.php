<?php
namespace app\controllers;

use Yii;
use app\models\LoginForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\SignupForm;
use app\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use app\models\MAbout;
use app\models\MGoods;
use app\models\MGoodsSearch;

use app\models\News;
use app\models\NewsSearch;

use app\models\MUser;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $goods = MGoods::find()->where(['status' => 1])->orderBy(['create_time' => DESC])->limit(24)->all();
        $about = MAbout::find()->one();

        return $this->render('index',['goods' => $goods, 'about' => $about]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', '感谢您与我们联系。 我们将尽快回复您.');
            } else {
                Yii::$app->session->setFlash('error', '送电子邮件时出现错误。');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        //$about = MAbout::findOne(['about_id' => 1]);
        $about = MAbout::find()->one();

        return $this->render('about', ['about' => $about]);
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }


    public function actionSiteajax($args) {
        $args = json_decode($args, true);
        return call_user_func_array(array($args['classname'], $args['funcname']), $args['params']);
    }


    public function actionClientGoodsView($id)
    {
        $g = MGoods::findOne(['goods_id' => $id]);
        return $this->render('clientGoodsView', ['model' => $g]);
    }


    public function actionClientGoodsList($goods_kind)
    {
        //$g = MGoods::find()->where(['status' => 1])->all();
        //return $this->render('clientGoodsList', ['model' => $g]);
        //guest 视图， 传参数 -1 ， 取状态为已发布的所有商品
        $guest = -1;
        //$goods_kind = 0;
        $searchModel = new MGoodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $guest, $goods_kind);

        return $this->render('clientGoodsList', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    //前端新闻页面显示
    public function actionClientNewsList($cat)
    {
        //cat 新闻类别 1 行业新闻， 2 公司动态
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $cat);

        return $this->render('clientNewsList', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionClientNewsView($id)
    {
        $news = News::findOne(['news_id' => $id]);
        $news->clickcnt ++;
        $news->save(false);

        return $this->render('clientNewsView', ['model' => $news]);
    }

    public function actionClientUserView($id)
    {
        $user = MUser::findOne(['id' => $id]);

        return $this->render('clientUserView', ['model' => $user]);
    }

    public function actionMail()
    {
        //邮件发送
        $mail = Yii::$app->mailer->compose();
        $mail->setTo('zengkai001@163.com');
        $mail->setSubject('邮箱测试');
        $mail->setHtmlBody('asgdadgagadhdrhasdsadsadasearharhae');
        if($mail->send()){
            echo '成功';
        }else{
            echo '失败';
        }
    }

}
