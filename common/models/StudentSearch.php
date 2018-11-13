<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Student;

/**
 * StudentSearch represents the model behind the search form about `common\models\Student`.
 */
class StudentSearch extends Student
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'age',  'card_type', 'subscribe_class', 'is_binding'], 'integer'],
            //[['id', 'sex', 'age', 'parent_tel', 'card_type', 'subscribe_class', 'is_binding'], 'integer'],
            [['name', 'parent_name', 'school', 'class', 'subscribe_mark', 'subscribe_time', 'mark', 'created_at', 'updated_at'], 'safe'],
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
        $query = Student::find();

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
            'sex' => $this->sex,
            'age' => $this->age,

            'card_type' => $this->card_type,
            'subscribe_class' => $this->subscribe_class,
            'subscribe_time' => $this->subscribe_time,
            'is_binding' => $this->is_binding,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'parent_name', $this->parent_name])
            ->andFilterWhere(['like', 'school', $this->school])
            ->andFilterWhere(['like', 'class', $this->class])
            ->andFilterWhere(['like', 'subscribe_mark', $this->subscribe_mark])
            ->andFilterWhere(['like', 'mark', $this->mark])
            ->andFilterWhere(['like', 'parent_tel', $this->parent_tel]);

        return $dataProvider;
    }
}
