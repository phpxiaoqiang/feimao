<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "yz_commentlabel".
 *
 * @property integer $id
 * @property string $name
 * @property integer $state
 * @property string $created_at
 * @property string $updated_at
 */
class Commentlabel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yz_commentlabel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['state'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 500],
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
            'state' => 'State',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
