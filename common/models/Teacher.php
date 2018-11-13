<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
/**
 * This is the model class for table "teacher".
 *
 * @property integer $id
 * @property string $name
 * @property string $pic
 * @property integer $sex
 * @property integer $age
 * @property string $major
 * @property string $class
 * @property integer $is_binding
 * @property string $mark
 * @property integer $is_ob
 * @property string $created_at
 * @property string $updated_at
 */
class Teacher extends \yii\db\ActiveRecord
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
        return 'teacher';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','sex','major','is_ob'],'required'],
            [['sex', 'age', 'is_binding', 'is_ob', 't_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['pic', 'mark'], 'string', 'max' => 500],
            [['major'], 'string', 'max' => 200],
            [['class'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '老师姓名',
            'pic' => '老师头像',
            'sex' => '性别',
            'age' => '年龄',
            'major' => '专业',
            'class' => '班级',
            'is_binding' => '是否绑定服务号',
            'mark' => '备注',
            'is_ob' => '是否在职',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            't_id' => '老师id',
        ];
    }
}
