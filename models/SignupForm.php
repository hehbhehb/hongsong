<?php
namespace app\models;

use app\models\User;
use app\models\SignupForm;

use yii\base\Model;
use Yii;

use Imagine\Image\ImagineInterface;
use Imagine\Image\ManipulatorInterface;

use yii\imagine\Image;
use app\models\U;
use  yii\web\UploadedFile;
/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $mobile;
    public $usertype;
    
    public $files;
    public $user_extra1;
    public $user_extra2;

    
    const PHOTO_PATH = 'user/photo';


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => '此用户名已经存在。'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['mobile', 'required'],
            ['mobile', 'string', 'min' => 11, 'max' => 11],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => '此邮箱已经存在。'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['usertype', 'integer'],

            //若用户类型为个人时user_extra1存放身份证号，若用户类型为公司时user_extra1存放公司名称；
            ['user_extra1', 'filter', 'filter' => 'trim'],
            ['user_extra1', 'required'],
            ['user_extra1', 'string', 'min' => 2, 'max' => 128],

            //若用户类型为个人时user_extra2存放身份证号照片两张，若用户类型为公司时user_extra2存放公司执照照片2张
            ['user_extra2', 'safe'],

            //[['files'], 'safe'],
            [['files'], 'file', 'maxFiles' => 2],

        ];
    }


    
    public function attributeLabels()
    {
        return [
            'user_extra1' => '用户附加信息',

        ];
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();

            $user->user_extra1 = $this->user_extra1;
            //上传用户信息图片， 多文件上传， 最多2张图
            $tmpStr2="";
            $this->files = UploadedFile::getInstances($this, 'files');
            foreach ($this->files as $file) 
            {
            //$user->files = UploadedFile::getInstances($user, 'files');
            //foreach ($user->files as $file) 
            //{
                $targetFileId = date("YmdHis").'-'.uniqid();
                $ext = pathinfo($file->name, PATHINFO_EXTENSION);
                $targetFileName = "{$targetFileId}.{$ext}";

                $targetFile = Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . SignupForm::PHOTO_PATH . DIRECTORY_SEPARATOR . $targetFileName;
                $file->saveAs($targetFile);

                $tmpStr2 =  $tmpStr2 . "{$targetFile};";
            }
            $user->user_extra2 = $tmpStr2;

            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }

    static function getUsertypeOption($key=null)
    {
        $arr = array(
            1 => '个人',
            2 => '企业',
        );        
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

}
