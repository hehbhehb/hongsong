<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "about".
 *
 * @property string $about_id
 * @property string $com_name
 * @property string $com_addr
 * @property integer $com_tel
 * @property string $com_voice
 * @property string $com_content
 */
class MAbout extends \yii\db\ActiveRecord
{


    public $files;
    const PHOTO_PATH = 'about/photo';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'about';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['com_name', 'com_addr', 'com_tel', 'com_voice', 'com_content'], 'required'],
            [['com_tel'], 'integer'],
            [['com_content'], 'string'],
            [['com_name', 'com_addr'], 'string', 'max' => 128],
            [['com_voice'], 'string', 'max' => 256],
            [['body_img_url'], 'string', 'max' => 512],
            [['body_img_url', 'files'], 'safe'],
            [['files'], 'file', 'maxFiles' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'about_id' => 'About ID',
            'com_name' => '公司名称',
            'com_addr' => '公司地址',
            'com_tel' => '电话',
            'com_voice' => '公司愿景',
            'com_content' => '公司介绍',
            'files' => '轮播图',
        ];
    }
}
