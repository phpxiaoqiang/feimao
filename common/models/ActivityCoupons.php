<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use frontend\models\Wxuser;
/**
 * 
 * 
 * 
 * This is the model class for table "yz_activity_coupons".
 *
 * @property integer $id
 * @property integer $p_id
 * @property integer $o_id
 * @property integer $expiretime
 * @property integer $money
 * @property integer $state
 * @property integer $receivetime
 * @property string $created_at
 * @property string $updated_at
 */
class ActivityCoupons extends \yii\db\ActiveRecord
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

    public function getWxuser()
    {
        return $this->hasOne(Wxuser::className(), ['id' => 'p_id']);
    }
    /**
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
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yz_activity_coupons';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p_id', 'o_id', 'expiretime', 'money', 'state', 'receivetime'], 'integer'],
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
            'p_id' => '用户id',
            'o_id' => '订单id',
            'expiretime' => '活动到期时间',
            'money' => '活动优惠金额',
            'state' => '领取状态（领取：0和使用：1）',
            'receivetime' => '领取时间',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
}
