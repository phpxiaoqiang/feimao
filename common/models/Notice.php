<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "yz_notice".
 *
 * @property integer $id
 * @property string $oid
 * @property string $user_openId
 * @property string $counselor_openId
 * @property integer $start_time
 * @property integer $state
 * @property string $created_at
 * @property string $updated_at
 */
class Notice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yz_notice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['oid', 'user_openId', 'counselor_openId', 'start_time'], 'required'],
            [['start_time', 'state'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['oid'], 'string', 'max' => 255],
            [['user_openId', 'counselor_openId'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'oid' => 'Oid',
            'user_openId' => 'User Open ID',
            'counselor_openId' => 'Counselor Open ID',
            'start_time' => 'Start Time',
            'state' => 'State',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
