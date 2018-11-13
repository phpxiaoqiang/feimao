<?php

namespace common\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use common\models\Teacher;

/**
 * This is the model class for table "yr_class".
 *
 * @property integer $id
 * @property string $name
 * @property integer $cid
 * @property string $class_table
 * @property integer $teacher_id
 * @property integer $student_sum
 * @property integer $is_graduation
 * @property string $start_time
 * @property integer $teacher_money
 * @property integer $total_hours
 * @property string $created_at
 * @property string $updated_at
 * @property integer $hours
 */
class YrClass extends \yii\db\ActiveRecord
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
        return 'yr_class';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class_table','total_hours', 'hours','name','cid', 'teacher_id', 'is_graduation', 'teacher_money'],'required'],
            [['cid', 'teacher_id', 'student_sum', 'is_graduation', 'teacher_money'], 'integer'],
            [['start_time', 'created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 200],
            [['total_hours', 'hours'], 'number'],
            [['class_table'], 'string', 'max' => 500],
        ];
    }

    public function getTeacher()
    {
        return $this->hasOne(Teacher::className(), ['id' => 'teacher_id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'cid' => '分类',
            'class_table' => '上课时间',
            'teacher_id' => '舞蹈老师',
            'student_sum' => '学生人数',
            'is_graduation' => '是否毕业',
            'start_time' => '开班时间',
            'teacher_money' => '老师薪资',
            'total_hours' => '总课时',
            'created_at' => ' 创建时间',
            'updated_at' => '更新时间',
            'hours' => '课时',
        ];
    }

    public function getStudent()
    {
        return $this->hasMany(Studentxclass::className(), ['cid' => 'id']);
    }
}
