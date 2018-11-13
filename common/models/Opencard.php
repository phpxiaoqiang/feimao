<?php

namespace common\models;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

class Opencard extends \yii\db\ActiveRecord
{
   

/**
 * @inheritdoc
 * 插入创建者及创建时间/更新者及更新时间
 */
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
        return 'open_card';
    }
}
