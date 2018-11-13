<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
/**
 * This is the model class for table "yz_category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $sort
 * @property integer $state
 * @property string $created_at
 * @property string $updated_at
 * @property string $pic
 */
class Category extends \yii\db\ActiveRecord
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
        return 'yz_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'sort', 'state'], 'required'],
            [['sort', 'state'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['subname', 'pic'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'subname' => 'Subname',
            'sort' => '排序',
            'state' => '状态',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'pic' => 'Pic',
        ];
    }
}
