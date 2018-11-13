<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
/**
 * This is the model class for table "yz_banner".
 *
 * @property integer $id
 * @property string $title
 * @property string $pic
 * @property string $link
 * @property integer $sort
 * @property integer $state
 * @property string $created_at
 * @property string $updated_at
 */
class Banner extends \yii\db\ActiveRecord
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
        return 'yz_banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'pic', 'link', 'sort', 'state'], 'required'],
            [['sort', 'state'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'subtitle', 'pic', 'link'], 'string', 'max' => 255],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'subtitle' => 'Subtitle',
            'pic' => 'Pic',
            'link' => 'Link',
            'sort' => 'Sort',
            'state' => 'State',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
