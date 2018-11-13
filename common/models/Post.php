<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
/**
 * This is the model class for table "yz_post".
 *
 * @property integer $id
 * @property string $title
 * @property string $pic
 * @property string $content
 * @property integer $counselor_id
 * @property integer $sort
 * @property integer $state
 * @property integer $created_at
 * @property integer $updated_at
 */
class Post extends \yii\db\ActiveRecord
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
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yz_post';
    }
//    public function getCounselor(){
//        return $this->hasOne(Counselor::className(),['id'=>'counselor_id']);
//    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'counselor_id', 'sort', 'state'], 'required'],
            [['content'], 'string'],
            [['counselor_id', 'sort', 'state', 'sub_num'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'pic'], 'string', 'max' => 255],
            [['desc'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '自增ID',
            'title' => '文章标题',
            'pic' => '文章图片',
            'content' => '文章内容',
            'counselor_id' => '课程分类',
            'sort' => '排序',
            'state' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'sub_num' => '预约人数',
            'desc' => '描述',
        ];
    }


}
