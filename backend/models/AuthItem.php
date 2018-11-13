<?php

namespace backend\models;

use Yii;

class AuthItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yz_auth_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','type','description'], 'required'],
            [['type','created_at'], 'integer'],
            [['name','description'], 'string'],
            [['name','type','description'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => '权限url',
            'type' => '角色or权限',
            'description' => '详情',
            'created_at' => '创建时间'
        ];
    }
}
