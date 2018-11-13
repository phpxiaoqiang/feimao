<?php

namespace common\models;

use frontend\models\Wxuser;
use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "yz_comment".
 *
 * @property integer $id
 * @property integer $p_id
 * @property integer $c_id
 * @property string $content
 * @property integer $score
 * @property string $created_at
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yz_comment';
    }
    public function getWxuser(){
        return $this->hasOne(Wxuser::className(),['id'=>'p_id']);
    }
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
    public function rules()
    {
        return [
            [['p_id', 'c_id', 'score', 'state','s_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['content'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'p_id' => 'P ID',
            'c_id' => 'C ID',
            'content' => '评论内容',
            'score' => 'Score',
            'state' => 'State',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
