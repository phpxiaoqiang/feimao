<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "yz_counselor_commentlabel".
 *
 * @property integer $id
 * @property integer $cl_id
 * @property integer $c_id
 * @property string $created_at
 * @property string $updated_at
 */
class CounselorCommentlabel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yz_counselor_commentlabel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cl_id', 'c_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cl_id' => 'Cl ID',
            'c_id' => 'C ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
