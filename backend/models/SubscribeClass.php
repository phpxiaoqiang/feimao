<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subscribe_class".
 *
 * @property integer $id
 * @property string $class_name
 * @property string $pic
 * @property string $content
 * @property integer $sort
 * @property integer $subscribe_num
 * @property integer $is_online
 * @property string $created_at
 * @property string $updated_at
 */
class SubscribeClass extends \yii\db\ActiveRecord
{
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
            [['content'], 'string'],
            [['sort', 'subscribe_num', 'is_online'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['class_name'], 'string', 'max' => 300],
            [['pic'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'class_name' => 'Class Name',
            'pic' => 'Pic',
            'content' => 'Content',
            'sort' => 'Sort',
            'subscribe_num' => 'Subscribe Num',
            'is_online' => 'Is Online',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
