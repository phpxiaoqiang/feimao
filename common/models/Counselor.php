<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
/**
 * This is the model class for table "yz_counselor".
 *
 * @property integer $id
 * @property string $name
 * @property string $avatar
 * @property string $photo
 * @property string $desc
 * @property integer $subscribe_price
 * @property string $subscribe_num
 * @property integer $category_id
 * @property integer $sort
 * @property integer $state
 * @property string $created_at
 * @property string $updated_at
 */
class Counselor extends \yii\db\ActiveRecord
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
        return 'yz_counselor';
    }

    public function getCategory(){
        return $this->hasOne(Category::className(),['id'=>'category_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'avatar', 'subscribe_price', 'subscribe_voice_price', 'category_id', 'state'], 'required'],
            [['subscribe_price', 'subscribe_voice_price', 'category_id', 'sort', 'state'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'avatar','photo', 'subscribe_num','uid'], 'string', 'max' => 255],
            [['desc'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '姓名',
            'avatar' => '头像',
            'photo' => '详情写真图',
            'desc' => '描述',
            'subscribe_price' => '文字金额(元)',
            'subscribe_voice_price' => '语音金额(元)',
            'subscribe_num' => '预约人数',
            'category_id' => '分类名称',
            'sort' => '排序',
            'state' => '状态',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'uid' => '用户系统秘钥',
        ];
    }

    public function getLabel(){
        return $this->hasMany(Label::className(),['c_id'=>'id']);
    }
    public function getSubscribe(){
        return $this->hasMany(Subscribe::className(),['counselor_id'=>'id'])->where(['is_buy'=>'1']);
    }
}
