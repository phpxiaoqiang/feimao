<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "yz_label".
 *
 * @property integer $id
 * @property string $name
 * @property integer $c_id
 */
class Label extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yz_label';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
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
            'c_id' => 'C ID',
        ];
    }
}
