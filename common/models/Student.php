<?php

namespace common\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
/**
 * This is the model class for table "student".
 *
 * @property integer $id
 * @property string $name
 * @property integer $sex
 * @property integer $age
 * @property string $parent_name
 * @property integer $parent_tel
 * @property string $school
 * @property integer $card_type
 * @property string $class
 * @property integer $subscribe_class
 * @property string $subscribe_mark
 * @property string $subscribe_time
 * @property integer $is_binding
 * @property string $mark
 * @property string $create_at
 * @property string $update_at
 */
class Student extends \yii\db\ActiveRecord
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
        return 'student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','sex','parent_tel'],'required'],
            [['sex', 'age','card_type', 'subscribe_class', 'is_binding', 'p_id'], 'integer'],
            [['subscribe_time', 'created_at', 'updated_at'], 'safe'],
            [['name', 'parent_name'], 'string', 'max' => 100],
            [['school'], 'string', 'max' => 200],
            [['class'], 'string', 'max' => 300],
            [['parent_tel'], 'string', 'max' => 50],
            [['subscribe_mark', 'mark'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '学生姓名',
            'sex' => '性别',
            'age' => '年龄',
            'parent_name' => '家长姓名',
            'parent_tel' => '家长电话',
            'school' => '学校',
            'card_type' => '卡类型',
            'class' => '班级',
            'subscribe_class' => '预约课程',
            'subscribe_mark' => '预约备注',
            'subscribe_time' => '预约时间',
            'is_binding' => '是否绑定服务号',
            'mark' => '备注',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'p_id' => '家长id',
        ];
    }
}
