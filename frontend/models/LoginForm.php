<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use frontend\models\Wxuser;
/**
 * Login form
 */
class LoginForm extends Model
{
    public $nickname;
    public $openid;
    public $sex;
    public $province;
    public $city;
    public $country;
    public $headimgurl;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['openid'], 'required'],
            [['sex'], 'integer'],
//            [['created_at', 'updated_at'], 'safe'],
            [['openid'], 'string', 'max' => 64],
            [['nickname'], 'string', 'max' => 5000],
            [['headimgurl'], 'string', 'max' => 255],
            [['province', 'city', 'country'], 'string', 'max' => 100],
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(),3600 * 24 * 30);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return Wxuser|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = Wxuser::findByOpenId($this->openid);
        }

        return $this->_user;
    }
}
