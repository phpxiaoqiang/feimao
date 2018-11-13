<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Teacher;

/**
 * TeacherSearch represents the model behind the search form about `common\models\Teacher`.
 */
class TeacherSearch extends Teacher
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['id', 'sex', 'age', 'is_binding', 'is_ob'], 'integer'],
            [['name', 'pic', 'major', 'class', 'mark', 'created_at', 'updated_at'], 'safe'],
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
        $query = Teacher::find();

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
            'sex' => $this->sex,
            'age' => $this->age,
            'is_binding' => $this->is_binding,
            'is_ob' => $this->is_ob,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'pic', $this->pic])
            ->andFilterWhere(['like', 'major', $this->major])
            ->andFilterWhere(['like', 'class', $this->class])
            ->andFilterWhere(['like', 'mark', $this->mark]);

        return $dataProvider;
    }
}
