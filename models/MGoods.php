<?php

namespace app\models;

use Yii;

use yii\helpers\Url;
use app\models\U;

use app\models\User;
use app\models\MGoods;
use app\models\MOrder;
use app\models\MGoodscat;

/**
 * This is the model class for table "goods".
 *
 * @property integer $goods_id
 * @property string $title
 * @property integer $goods_kind
 * @property string $descript
 * @property integer $price
 * @property string $price_hint
 * @property integer $price_old
 * @property string $detail
 * @property string $list_img_url
 * @property string $body_img_url
 * @property integer $quantity
 */
class MGoods extends \yii\db\ActiveRecord
{
	public $file;
    public $files;
	
    const CTRL_NO = 0;
    const CTRL_YES = 1;
	
	//goods_kind 字段为商品分类
    /*
    const GOODS_KIND_NONE = 0;
    const GOODS_KIND_A = 1;
    const GOODS_KIND_B = 2;
    const GOODS_KIND_C = 3;
    const GOODS_KIND_D = 4;
    const GOODS_KIND_E = 5;
    const GOODS_KIND_F = 6;
    const GOODS_KIND_G = 7;

    const GOODS_KIND_H = 8;
    const GOODS_KIND_I = 9;
    const GOODS_KIND_J = 10;
    const GOODS_KIND_K = 11;
    const GOODS_KIND_L = 12;
    const GOODS_KIND_M = 13;
    */

    const PHOTO_PATH = 'goods/photo';
    //const THUMB_PATH = 'thumb'; 
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['list_img_url', 'body_img_url', 'file', 'files', 'create_time', 'update_time'], 'safe'],
            [['goods_kind', 'quantity', 'price', 'price_old', 'pub_userid', 'status'], 'integer'],
            [['detail','brand','model','prod_area'], 'string'],
            [['title'], 'string', 'max' => 64],
            [['descript', 'list_img_url', 'body_img_url'], 'string', 'max' => 256],
            [['price_hint'], 'string', 'max' => 512],
            [['file'], 'file'],
            [['files'], 'file', 'maxFiles' => 3],
        ];
    }

    /**
     * @inheritdoc
     */

    static function getDetailCtrlOption($key=null)
    {
        $arr = array(
            self::CTRL_YES => '是',
            self::CTRL_NO => '否',
        );        
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

    static function getPicsCtrlOption($key=null)
    {
        $arr = array(
            self::CTRL_YES => '是',
            self::CTRL_NO => '否',
        );        
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
	 
    //发布状态 
    static function getStatusOption($key=null)
    {
        $arr = array(
            self::CTRL_NO => '未发布',
            self::CTRL_YES => '已发布',
        );        
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
     

	static function getGoodsKindOption($key=null)
    {
        $goodscat = MGoodscat::find()->asArray()->all();
        foreach ($goodscat as $gc) {
            $value = $gc['value'];
            $arr[$value] = "{$gc['cat']}";
        }

        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    } 


	
    public function attributeLabels()
    {
        return [
            'goods_id' => '商品编号',
            'title' => '商品名',
            'descript' => '描述',
            'price' => '现价',
            'price_hint' => '现价提示语',
            'price_old' => '市场价',
            'detail' => '商品详情',
            'list_img_url' => '商品小图',
            'body_img_url' => '商品图',
            'quantity' => '数量',
            'file' => '小图',
            'files' => '大图',
            'goods_kind' => '分类',
            'brand' => '品牌',
            'model' => '型号',
            'prod_area' => '产地',
            'pub_userid' => '发布者ID',
            'status' => '发布状态',
            'create_time' => '发布时间',
            'update_time' => '修改时间',
        ];
    }
	
    static function getViewGoodsPics($model)
    {
        $len = 0;
        $imgHtml = "";
        $imgs = explode(";",$model->body_img_url);
        foreach ($imgs as $img) {
            $len++;
            if(sizeof($imgs) == $len) break; //分号分割后，数组最后一项为空，剔除
            $imgHtml = $imgHtml . '<img src=' . $img . ' width=160> &nbsp;&nbsp;&nbsp;&nbsp;';
        }
        return $imgHtml;
    }

    static function getPubUserName($model)
    {
        $user = User::findOne(['id' => $model->pub_userid]);

        if(!empty($user))
        {
            return $user->username;
        }
        return "";
    }

    static function getStatus($model)
    {
        return ($model->status == 0)?"未发布":"已发布";
    }

    
    public static function confirmAjax($goods_id,$status)
    {
        $goods = self::findOne(['goods_id' => $goods_id]);

        if(empty($goods))
        {
            U::W("----------$goods is null--------");
            return \yii\helpers\Json::encode(['code' => 1]);
        }

        $goods->status = $status;
        $goods->save(false);
        return \yii\helpers\Json::encode(['code' => 0]);
    }

    public static function zujieAjax($goods_id, $user_id)
    {
        $goods = MGoods::findOne(['goods_id' => $goods_id]);
        $user = User::findOne(['id' => $user_id]);
        
        U::W($goods);

        $order = new MOrder;

        if(empty($goods) || empty($user))
        {
            U::W("----------goods or user is null--------");
            return \yii\helpers\Json::encode(['code' => 1]);
        }

        $order->oid = uniqid();
        $order->feesum = 0;
        $order->status = 1;
        $order->goods_id = $goods->goods_id;
        $order->title = $goods->title;
        $order->userid = $user->id;
        $order->username = $user->username;
        $order->usermobile = $user->mobile;
        $order->address = "--";
        $order->memo = "--";
        $order->memo_reply = "--";

        $order->save(false);
        return \yii\helpers\Json::encode(['code' => 0]);
    }

    

}
