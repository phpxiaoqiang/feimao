<?php

namespace common\models;

use Yii;
use common\models\BaseModel;
/**
 * This is the model class for table "yz_media".
 *
 * @property integer $id
 * @property string $title
 * @property string $pic
 * @property integer $playNum
 * @property integer $type
 * @property integer $sort
 * @property integer $state
 * @property string $created_at
 * @property string $updated_at
 */
class Media extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yz_media';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pic', 'type', 'sort', 'state'], 'required'],
            [['playNum', 'type', 'sort', 'state'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'pic', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'pic' => '展示图',
            'playNum' => '播放数量',
            'type' => '媒体类型',
            'sort' => '排序',
            'state' => '状态',
            'link' => 'Link',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
