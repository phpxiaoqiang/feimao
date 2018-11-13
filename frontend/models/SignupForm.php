<?php

namespace frontend\models;

use yii\base\Model;
use frontend\models\Wxuser;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
/**
 * Signup form
 */
class SignupForm extends Model
{
    public $nickname;
    public $openid;
    public $sex;
    public $province;
    public $city;
    public $country;
    public $headimgurl;

//    public function behaviors()
//    {
//        return [
//            [
//                'class' => TimestampBehavior::className(),
//                'createdAtAttribute' => 'created_at',
//                'updatedAtAttribute' => 'updated_at',
////                'value' => new Expression('NOW()'),
//            ],
//        ];
//    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['openid'], 'required'],
            [['sex'], 'integer'],
            [['created_at'], 'safe'],
            [['openid'], 'string', 'max' => 64],
            [['nickname'], 'string', 'max' => 5000],
            [['headimgurl'], 'string', 'max' => 255],
            [['province', 'city', 'country'], 'string', 'max' => 100],
        ];
    }

    /**
     * Signs user up.
     *
     * @return $userinfo
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new Wxuser();
        $user->nickname = $this->filterEmoji($this->nickname);
        $user->openid = $this->openid;
        $user->sex = $this->sex;
        $user->province = $this->province;
        $user->city = $this->city;
        $user->country = $this->country;
        $user->headimgurl = $this->headimgurl;
        return $user->save(false) ? $user : null;
    }
    public function filterEmoji($str)
    {
        $str = preg_replace_callback(
            '/./u',
            function (array $match) {
                return strlen($match[0]) >= 4 ? '' : $match[0];
            },
            $str);

        return $str;
    }
}
