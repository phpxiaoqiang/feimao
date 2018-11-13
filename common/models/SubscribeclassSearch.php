<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Subscribeclass;

/**
 * SubscribeclassSearch represents the model behind the search form about `common\models\Subscribeclass`.
 */
class SubscribeclassSearch extends Subscribeclass
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dance', 'p_id', 'cid'], 'integer'],
            [['class_name', 'created_at', 'updated_at', 'subscribe_mark', 'p_name', 's_name'], 'safe'],
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
        $query = Subscribeclass::find();

        // add conditions that should always apply here


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]],
        ]);


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'dance' => $this->dance,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'p_id' => $this->p_id,
            'cid' => $this->cid,
        ]);

        $query->andFilterWhere(['like', 'class_name', $this->class_name])
            ->andFilterWhere(['like', 'subscribe_mark', $this->subscribe_mark])
            ->andFilterWhere(['like', 'p_name', $this->p_name])
            ->andFilterWhere(['like', 's_name', $this->s_name]);

        return $dataProvider;
    }
}
