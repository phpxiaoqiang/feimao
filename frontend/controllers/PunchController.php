<?php
namespace frontend\controllers;

use Yii;
use Template;
use yii\web\Controller;
use common\models\Opencard;
use common\models\Yrclass;
use common\models\Teacher;
use common\models\Student;
use common\models\YzWxuser;
use common\models\Line;
use common\models\Studentxclass;
use common\models\Yzcategory;
// use app\Chat\Template;
use common\models\Card;
use yii\data\ActiveDataProvider;

class PunchController extends BaseController
{
    public function actionIndex()
    {
        $c_id = $_GET['c_id'];//传入班级id
        $time = date("Y-m-d H:i:s");
        $class = Yrclass::find()->where(['id' => $c_id])->asArray()->one();
        $t_id = $class['teacher_id'];
        $teacher = Teacher::find()->select('id,name,created_at,pic')->where(['id' => $t_id])->asArray()->one();
        $class = YrClass::find()->where(['id' => $c_id])->asArray()->one();
        $fenlei_id = $class['cid'];
        $fenlei = Yzcategory::find()->where(['id' => $fenlei_id])->asArray()->one();
        $info = Opencard::find()->where(['c_id' => $c_id, 't_id' => $t_id, 'left(push_time,10)' => substr($time, 0, 10), 'identity' => '1'])->one();
        if (empty($info)) $teacher['created_at'] = null;
        $student = Studentxclass::find()->where(['c_id' => $c_id])->asArray()->All();
        foreach ($student as $key => $item) {
            $info = Opencard::find()->where(['c_id' => $c_id, 's_id' => $item['s_id'], 'left(push_time,10)' => substr($time, 0, 10), 'identity' => '0'])->one();
            if (empty($info)) $student[$key]['created_at'] = null;
        }
        return $this->render('index', ['teacher' => $teacher, 'class' => $class, 'fenlei' => $fenlei, 'student' => $student, 'c_id' => $c_id, 'time' => $time]);
    }

    //查询模板消息需要的数据
    public function search($sid, $cid, $tid)
    {
        $student = Student::findOne($sid);
        $res = $student->hasOne(YzWxuser::className(), ['id' => 'p_id'])->asArray()->one();
        $openid = $res['openid'];  //oexhm1MQumtJaocNYUYPyVJBencw
        $student = Student::find()->where(['id' => $sid])->asArray()->one();
        $student_name = $student['name'];
        $card_id = $student['card_type'];
        //查询会员金额情况
        $card = Card::find()->where(['id' => $card_id])->asArray()->one();
        $money = $card['money'];       //卡的钱
        $totle_hours = Studentxclass::find()->where(['s_id' => $sid])->sum('total_hours');
        $totle_hours = empty($totle_hours) ? 0 : $totle_hours;       //所有课时
        $m = number_format($money / $totle_hours,2);//每节课的金额
        $hours = Opencard::find()->where(['s_id' => $sid])->sum('class_time');
        $hours = empty($hours) ? 0 : $hours;         //所有消费课时
        $hours = $hours + Studentxclass::find()->where(['s_id' => $sid])->sum('hours');
//        $class_time = Opencard::find()->where(['c_id' => $cid, 's_id' => $sid])->one()['class_time'];
        $class_time = Yrclass::find()->where(['id'=>$cid])->one()['hours'];
        $totm = $m * $hours;//总消费金额
        $shours = $totle_hours - $hours;//剩余课时
        $smoney = $money - $totm;//剩余金额
        $class = YrClass::find()->where(['id' => $cid])->asArray()->one();
        $className = $class['name'];
        $class_table = $class['class_table'];
        $teacher = Teacher::find()->where(['id' => $tid])->asArray()->one();
        $teacher_name = $teacher['name'];
        $all = array(
            'openid' => $openid,
            'student_name' => $student_name,
            'class' => $className,
            'class_table' => $class_table,
            'teacher' => $teacher_name,
            'one_time' => $class_time,
            'one_money' => $class_time * $m,
            'tot_money' => $totm,
            'tot_time' => $hours,
            's_hours' => $shours,
            's_money' => $smoney
        );
        return $all;
    }

    /*
    *todo  打卡
    *$identity 身份
    *$name 学生姓名
    *$sid  学生id
    *$cid  班级id
    *$time 剩余课时
    *$person 打卡人
    *$tid  教师id
     */
    public function actionPunch($identity, $sid = "", $cid = "", $name = "", $time = "", $person = "", $tid = "")
    {
        $time = date('Y-m-d H:i:s', time());
        if ($identity == 1) {
            $info = Opencard::find()->where(["t_id" => $tid, "left(push_time,10)" => substr($time, 0, 10), 'c_id' => $cid, 'identity' => $identity])->one();
            if (!empty($info)) return json_encode(['msg' => "该老师当天已签到", "data" => 1]);
        } else {
            $info = Opencard::find()->where(["s_id" => $sid, "left(push_time,10)" => substr($time, 0, 10), 'c_id' => $cid, 'identity' => $identity])->one();
            if (!empty($info)) return json_encode(['msg' => "该学生当天已签到", "data" => 1]);
        }
        $openInsert = new Opencard();
        $openInsert->c_id = $cid;
        $openInsert->s_id = $sid;
        $openInsert->identity = $identity;
        $openInsert->name = $name;
        $openInsert->push_time = date('Y-m-d H:i:s', time());
        $openInsert->punch = empty($person) ? "管理员" : $person;
        $openInsert->class_time = (float)Yrclass::find()->where(['id' => $cid])->one()['hours'];
        $openInsert->created_at = date('Y-m-d H:i:s', time());
        // $openInsert->updated_at = date('Y-m-d H:i:s',time());
        $openInsert->t_id = $tid;

        if ($identity == 1) {
            $res = $openInsert->save();
            if ($res) {
                echo "1";
            }

        }
        // die;
        if ($identity == 0) {
            $res = $openInsert->save();
            $all = $this->search($sid, $cid, $tid);//查询模板消息需要的数据
            if ($res) {
                echo "1";
                $this->post($all);
            }
        }
    }

    //发送模板消息
    public function post($arr)
    {
        //发送模板消息
        $tem = new Template($arr);
        $tem->send();

    }
}

?>
