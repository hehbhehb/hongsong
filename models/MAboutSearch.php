<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MAbout;

/**
 * MAboutSearch represents the model behind the search form about `app\models\MAbout`.
 */
class MAboutSearch extends MAbout
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['about_id', 'com_tel'], 'integer'],
            [['com_name', 'com_addr', 'com_voice', 'com_content'], 'safe'],
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
        $query = MAbout::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //分页粒度
            //'pagination' => [
            //    'pageSize' => 20,
            //],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'about_id' => $this->about_id,
            'com_tel' => $this->com_tel,
        ]);

        $query->andFilterWhere(['like', 'com_name', $this->com_name])
            ->andFilterWhere(['like', 'com_addr', $this->com_addr])
            ->andFilterWhere(['like', 'com_voice', $this->com_voice])
            ->andFilterWhere(['like', 'com_content', $this->com_content]);

        return $dataProvider;
    }
}
