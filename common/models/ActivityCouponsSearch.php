<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ActivityCoupons;

/**
 * ActivityCouponsSearch represents the model behind the search form about `common\models\ActivityCoupons`.
 */
class ActivityCouponsSearch extends ActivityCoupons
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'p_id', 'o_id', 'expiretime', 'money', 'state'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
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
        $query = ActivityCoupons::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]], 
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
            'p_id' => $this->p_id,
            'o_id' => $this->o_id,
            'expiretime' => $this->expiretime,
            'money' => $this->money,
            'state' => $this->state,
            'receivetime' => $this->receivetime,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
