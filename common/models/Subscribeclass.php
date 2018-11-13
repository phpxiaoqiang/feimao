<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use frontend\models\Wxuser;
use common\models\Category;
/**
 * This is the model class for table "subscribe_class".
 *
 * @property integer $id
 * @property string $class_name
 * @property integer $dance
 * @property string $created_at
 * @property string $updated_at
 * @property integer $tel
 * @property string $subscribe_mark
 * @property string $p_name
 * @property string $s_name
 * @property integer $p_id
 */
class Subscribeclass extends \yii\db\ActiveRecord
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
        return 'subscribe_class';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dance', 'p_id', 'cid'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['class_name'], 'string', 'max' => 300],
            [['tel'], 'string', 'max' => 300],
            [['subscribe_mark'], 'string', 'max' => 100],
            [['p_name', 's_name'], 'string', 'max' => 50],
        ];
    }
    public function getCategory(){
        return $this->hasOne(Category::className(),['id'=>'dance']);
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'class_name' => '课程名称',
            'dance' => '舞种分类',
            'created_at' => '预约时间',
            'updated_at' => '更新时间',
            'tel' => '手机号',
            'subscribe_mark' => '预约备注',
            'p_name' => '家长姓名',
            's_name' => '学生姓名',
            'p_id' => '家长id',
            'cid' => '课程id',
        ];
    }
}
