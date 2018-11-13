<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Studentxclass;

/**
 * StudentxclassSearch represents the model behind the search form about `common\models\Studentxclass`.
 */
class StudentxclassSearch extends Studentxclass
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 's_id', 'c_id', 'total_hours', 'hours'], 'integer'],
            [['created_at', 'updated_at', 'name', 'p_name'], 'safe'],
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
        $query = Studentxclass::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            's_id' => $this->s_id,
            'c_id' => $this->c_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'total_hours' => $this->total_hours,
            'hours' => $this->hours,

        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'p_name', $this->p_name]);

        return $dataProvider;
    }
}
