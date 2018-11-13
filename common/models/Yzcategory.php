<?php

namespace common\models;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class Yzcategory extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'yz_category';
    }
}
