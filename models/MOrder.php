<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $order_id
 * @property string $oid
 * @property integer $feesum
 * @property string $create_time
 * @property integer $status
 * @property integer $goods_id
 * @property string $title
 * @property integer $userid
 * @property string $username
 * @property string $usermobile
 * @property string $address
 * @property string $memo
 * @property string $memo_reply
 */
class MOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['oid', 'feesum', 'status', 'goods_id', 'title', 'userid', 'username', 'usermobile', 'address', 'memo', 'memo_reply'], 'required'],
            [['feesum', 'status', 'goods_id', 'userid'], 'integer'],
            [['create_time'], 'safe'],
            [['oid', 'username'], 'string', 'max' => 32],
            [['title', 'address'], 'string', 'max' => 128],
            [['usermobile'], 'string', 'max' => 16],
            [['memo', 'memo_reply'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'oid' => '订单号',
            'feesum' => '价格',
            'create_time' => '创建时间',
            'status' => '状态',
            'goods_id' => '商品编号',
            'title' => '商品名',
            'userid' => '用户编号',
            'username' => '用户名',
            'usermobile' => '手机',
            'address' => '地址',
            'memo' => '用户备注',
            'memo_reply' => '回复',
        ];
    }

    //订单状态 （订单状态流转 需考虑）
    static function getStatusOption($key=null)
    {
        $arr = array(
            1 => '已申请',
            2 => '已处理',
        );        
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
     
}
