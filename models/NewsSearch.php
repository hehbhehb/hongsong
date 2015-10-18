<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\News;

/**
 * NewsSearch represents the model behind the search form about `app\models\News`.
 */
class NewsSearch extends News
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['news_id', 'cat', 'clickcnt'], 'integer'],
            [['title', 'content', 'create_time', 'update_time'], 'safe'],
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
    public function search($params, $cat)
    {
        if(Yii::$app->user->isGuest)
        {
            $isAdmin = false;
        }
        else
        {
            if (Yii::$app->user->identity->role == 1)
            {
                $isAdmin = true;
            }
            else /*role == 0*/
            {
                $isAdmin = false;
            }
        }

        if($isAdmin)
            $query = News::find();
        else
            $query = News::find()->where(['cat' => $cat]);


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
            'news_id' => $this->news_id,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'cat' => $this->cat,
            'clickcnt' => $this->clickcnt,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
