<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MGoods;
use app\models\User;


/**
 * MGoodsSearch represents the model behind the search form about `app\models\MGoods`.
 */
class MGoodsSearch extends MGoods
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id', 'goods_kind', 'price', 'price_old', 'quantity','status'], 'integer'],
            [['title', 'descript', 'price_hint', 'detail', 'list_img_url', 'body_img_url','create_time', 'update_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $pub_userid)
    {
        //$query = MGoods::find();

        if($pub_userid == -1) /*guest*/
        {
             $query = MGoods::find()->where(['status' => 1]);
        }
        else
        {
            $user = User::findOne(["id" => $pub_userid]);
            if($user->role == 1)
                $query = MGoods::find();
            else
                $query = MGoods::find()->where(["pub_userid" => $pub_userid]);  
        }


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'goods_id' => $this->goods_id,
            'goods_kind' => $this->goods_kind,
            'price' => $this->price,
            'price_old' => $this->price_old,
            'quantity' => $this->quantity,
            'status' => $this->status,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'descript', $this->descript])
            ->andFilterWhere(['like', 'price_hint', $this->price_hint])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'list_img_url', $this->list_img_url])
            ->andFilterWhere(['like', 'body_img_url', $this->body_img_url]);

        return $dataProvider;
    }
}
