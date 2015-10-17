<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $mobile
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $role
 * @property integer $usertype
 */
class MUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'mobile', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at', 'role', 'usertype'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['mobile', 'auth_key'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'mobile' => '手机号',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => '电子邮箱',
            'status' => '状态',
            'created_at' => '注册时间',
            'updated_at' => '修改时间',
            'role' => '用户角色',
            'usertype' => '用户类型',
            'user_extra1' =>'用户附加信息',
        ];
    }

    static function getUserType($model)
    {
        return ($model->usertype == 1)?"个人":"公司";
    }

    static function getRole($model)
    {
        return ($model->role == 1)?"管理员":"会员";
    }


    static function getUserExtraInfoPics($model)
    {
        $len = 0;
        $imgHtml = "";
        $imgs = explode(";",$model->user_extra2);
        foreach ($imgs as $img) {
            $len++;
            if(sizeof($imgs) == $len) break; //分号分割后，数组最后一项为空，剔除
            $imgHtml = $imgHtml . '<img src=' . $img . ' width=160> &nbsp;&nbsp;&nbsp;&nbsp;';
        }
        return $imgHtml;
    }



}
