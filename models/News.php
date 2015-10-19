<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $news_id
 * @property string $title
 * @property string $content
 * @property string $create_time
 * @property string $update_time
 * @property integer $cat
 * @property integer $clickcnt
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'cat'], 'required'],
            [['content'], 'string'],
            [['create_time', 'update_time', 'clickcnt'], 'safe'],
            [['cat', 'clickcnt'], 'integer'],
            [['title'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'news_id' => '编号',
            'title' => '标题',
            'content' => '内容',
            'create_time' => '创建',
            'update_time' => '更新',
            'cat' => '类别',
            'clickcnt' => '阅读',
        ];
    }


    static function getCatOption($key=null)
    {
        $arr = array(
            1 => '行业新闻',
            2 => '公司动态',
        );        
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

    static function getCat($model)
    {
        return ($model->cat == 1)?"行业新闻":"公司动态";
    }
    
}
