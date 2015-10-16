<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MOrder;

/**
 * MOrderSearch represents the model behind the search form about `app\models\MOrder`.
 */
class MOrderSearch extends MOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'feesum', 'status', 'goods_id', 'userid'], 'integer'],
            [['oid', 'create_time', 'title', 'username', 'usermobile', 'address', 'memo', 'memo_reply'], 'safe'],
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
    public function search($userid)
    {
        //$query = MOrder::find();
        $user = User::findOne(["id" => $userid]);

        if($user->role == 1)
            $query = MOrder::find();
        else
            $query = MOrder::find()->where(["userid" => $user->id]);

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
            'order_id' => $this->order_id,
            'feesum' => $this->feesum,
            'create_time' => $this->create_time,
            'status' => $this->status,
            'goods_id' => $this->goods_id,
            'userid' => $this->userid,
        ]);

        $query->andFilterWhere(['like', 'oid', $this->oid])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'usermobile', $this->usermobile])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'memo', $this->memo])
            ->andFilterWhere(['like', 'memo_reply', $this->memo_reply]);

        return $dataProvider;
    }
}
