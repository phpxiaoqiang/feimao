<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
/**
 * This is the model class for table "yz_v_emotion".
 *
 * @property integer $id
 * @property string $name
 * @property string $pic
 * @property integer $a_id
 * @property integer $sort
 * @property integer $state
 * @property string $created_at
 * @property string $updated_at
 */
class Emotion extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    public function getVanswer(){
        return $this->hasOne(Vanswer::className(),['id'=>'a_id']);
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yz_v_emotion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['a_id','sort','state'], 'required'],
            [['a_id', 'sort', 'state'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['pic'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '情感包id',
            'name' => '情感包名称',
            'pic' => '情感包图片',
            'a_id' => '大V姓名id',
            'sort' => '排序',
            'state' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
}
