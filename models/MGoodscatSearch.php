<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MGoodscat;

/**
 * MGoodscatSearch represents the model behind the search form about `app\models\MGoodscat`.
 */
class MGoodscatSearch extends MGoodscat
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'value'], 'integer'],
            [['cat'], 'safe'],
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
    public function search($params)
    {
        $query = MGoodscat::find();

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
            'id' => $this->id,
            'value' => $this->value,
        ]);

        $query->andFilterWhere(['like', 'cat', $this->cat]);

        return $dataProvider;
    }
}
