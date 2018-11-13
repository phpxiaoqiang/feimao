<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Counselor;

/**
 * CounselorSearch represents the model behind the search form about `common\models\Counselor`.
 */
class CounselorSearch extends Counselor
{
    public $category_name; //<=====就是加在这里
//    public $CounselorSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'state'], 'integer'],
            [['name' ,'category_name'], 'safe'],
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
        $query = Counselor::find();
        // add conditions that should always apply here
        $query->joinWith(['category']);//<=====加入这句
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);

//        $dataProvider->setSort([
//            'attributes' => [
//                /* 其它字段不要动 */
//                /*  下面这段是加入的 */
//                /*=============*/
//                'category_name' => [
//                    'asc' => ['category.name' => SORT_ASC],
//                    'desc' => ['category.name' => SORT_DESC],
//                    'label' => '分类名称'
//                ],
//                /*=============*/
//            ]
//        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'yz_counselor.id' => $this->id,
            'subscribe_price' => $this->subscribe_price,
            'subscribe_voice_price'=>$this->subscribe_voice_price,
            'category_id' => $this->category_id,
            'yz_counselor.state' => $this->state,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'yz_counselor.name', $this->name])
            ->andFilterWhere(['like', 'avatar', $this->avatar])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'subscribe_num', $this->subscribe_num]);
//        $query->andFilterWhere(['like', 'yz_category.name', $this->category_name]) ;//<=====加入这句
        $query->andFilterWhere(['like', 'yz_category.name', $this->category_name]) ;//<=====加入这句
        return $dataProvider;
    }
}
