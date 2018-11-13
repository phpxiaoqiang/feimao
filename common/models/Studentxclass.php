<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
/**
 * This is the model class for table "student_x_class".
 *
 * @property integer $id
 * @property integer $s_id
 * @property integer $c_id
 * @property string $created_at
 * @property string $updated_at
 */
class Studentxclass extends \yii\db\ActiveRecord
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
    public static function tableName()
    {
        return 'student_x_class';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['s_id', 'c_id'], 'integer'],
            [['total_hours', 'hours'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'p_name'], 'string', 'max' => 300],
            [['s_tel'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            's_id' => '学生id',
            'c_id' => '班级id',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'total_hours' => '总课时',
            'hours' => '已上课时',
            'name' => '学生姓名',
            'p_name' => '家长姓名',
            's_tel' => '联系方式',
        ];
    }
}
