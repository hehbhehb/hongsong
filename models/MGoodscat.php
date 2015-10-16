<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "goodscat".
 *
 * @property integer $id
 * @property string $cat
 * @property integer $value
 */
class MGoodscat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goodscat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat', 'value'], 'required'],
            [['value'], 'integer'],
            ['value', 'unique'],
            [['cat'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cat' => '商品分类',
            'value' => '权重',
        ];
    }
}
