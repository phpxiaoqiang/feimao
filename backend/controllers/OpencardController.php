<?php
namespace backend\controllers;

use common\models\Qiniu;
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
// use app\Chat\Template;
use common\models\Card;
use yii\data\ActiveDataProvider;

class OpencardController extends Controller
{

    public function actionIndex()
    {
        $start = Yii::$app->request->get('start');
//        $start = strtotime($start);
        $end = Yii::$app->request->get('end');
//        $end = strtotime($end);
        if(!empty($start) && !empty($end)){
//            echo 'aaa';die;

//            $query = Opencard::find()->addWhere(['and', 'push_time>='.$start, 'push_time<='.$end])->orderBy('push_time DESC')->createCommand()->getRawSql();
//            $query =Opencard::findBySql('select * from open_card where push_time >=from_unixtime('.$start.') and push_time<=from_unixtime('.$end.')')->orderBy('push_time DESC')->asArray()->all();
        $query = Opencard::find()->where([
            'and',
            'created_at>=:id',
            'created_at<=:pack_name'
        ], [
            ':id' => $start,
            ':pack_name' =>$end
        ])->orderBy('push_time DESC');
//            var_dump($query);die;
        }else{
            $query = Opencard::find()->orderBy('push_time DESC');
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 22
            ],
        ]);
        return $this->render("index", ['dataProvider' => $dataProvider]);

    }

    public function actionAdd()
    {
        $class = new Yrclass();
        $card = Yrclass::find()->asArray()->all();
        return $this->render('add', ['class' => $class, 'card' => $card]);
        // $class = Yrclass::find()->asArray()->all();
        // // dd($class);
        // return $this->render('add',['class'=>$class]);
    }

    public function actionSel()
    {

        if (Yii::$app->request->isGet) {
            return $this->redirect(['opencard/add']);
        }
        $c_id = $_POST['YrClass']['name']; //班级id
        $time = $_POST['YrClass']['start_time']; //打卡时间                                          //获取班级 time 那天 所有的打卡信息
        if (empty($c_id) || empty($time)) {
            return $this->redirect(['opencard/add']);
        }
        $class = Yrclass::find()->where(['id' => $c_id])->asArray()->one();
        $t_id = $class['teacher_id'];
        $teacher = Teacher::find()->select('id,name,created_at')->where(['id' => $t_id])->asArray()->one();
        $info = Opencard::find()->where(['c_id' => $c_id, 't_id' => $t_id, 'left(push_time,10)' => substr($time, 0, 10), 'identity' => '1'])->one();
        if (empty($info)) $teacher['created_at'] = null;
        $student = Studentxclass::find()->where(['c_id' => $c_id])->asArray()->All();
        foreach ($student as $key => $item) {
            $info = Opencard::find()->where(['c_id' => $c_id, 's_id' => $item['s_id'], 'left(push_time,10)' => substr($time, 0, 10), 'identity' => '0'])->one();
            if (empty($info)) $student[$key]['created_at'] = null;
        }
        return $this->render('sel', ['teacher' => $teacher, 'student' => $student, 'c_id' => $c_id, 'time' => $time . ":00"]);

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
    *$person 打卡人
    *$tid  教师id
     */
    public function actionPunch($identity, $cid = "", $sid = "", $name = "", $tid = "", $time)
    {
        if ($identity == 1) {
            $info = Opencard::find()->where(["t_id" => $tid, "left(push_time,10)" => substr($time, 0, 10), 'c_id' => $cid, 'identity' => $identity])->one();
            if (!empty($info)) return json_encode(['msg' => "该老师当天已签到", "data" => 1]);
        } else {
            $info = Opencard::find()->where(["s_id" => $sid, "left(push_time,10)" => substr($time, 0, 10), 'c_id' => $cid, 'identity' => $identity])->one();
            if (!empty($info)) return json_encode(['msg' => "该学生当天已签到", "data" => 1]);
        }
        // $person = $identity == 1?"老师":"学生";
        $openInsert = new Opencard();
        $openInsert->c_id = $cid;
        $openInsert->s_id = $sid;
        $openInsert->class_time = (float)Yrclass::find()->where(['id' => $cid])->one()['hours'];
        $openInsert->push_time = $time;
        $openInsert->punch = "管理员";
        $openInsert->t_id = $tid;
        $openInsert->name = $name;
        $openInsert->identity = $identity;
        if ($identity == 1) {
            $res = $openInsert->save();
            echo "1";
        }
        if ($identity == 0) {
            $res = $openInsert->save();
            echo "1";
            $all = $this->search($sid, $cid, $tid);//查询模板消息需要的数据
            if ($res) {
                $this->post($all);
            }
            // die;
        }
    }


    //发送模板消息
    public function post($arr)
    {
        //发送模板消息
        $tem = new Template($arr);
        $tem->send();

    }


    //删除打卡
    public function actionDel()
    {
        // $id = 35;
        $time = $_GET['time'];
        $identity = $_GET['identity'];
        $cid = $_GET['cid'];
        if ($identity == 0) {
            $sid = $_GET['sid'];
            Opencard::find()->where(['left(push_time,10)' => substr($time, 0, 10), 'identity' => $identity, 's_id' => $sid, 'c_id' => $cid])->one()->delete();
            echo 1;
            exit;
        } else {
            $tid = $_GET['tid'];
            Opencard::find()->where(['left(push_time,10)' => substr($time, 0, 10), 'identity' => $identity, 't_id' => $tid, 'c_id' => $cid])->one()->delete();
            echo 1;
            exit;
        }
        echo 0;
    }

    //导出excel
    public function actionExcel()
    {
        $start = Yii::$app->request->get('start');
        $start = strtotime($start);
        $end = Yii::$app->request->get('end');
        $end = strtotime($end);
        if(!empty($start) && !empty($end)){

            $result =Opencard::findBySql('select id,identity,name,push_time,punch from open_card where push_time >=from_unixtime('.$start.') and push_time<=from_unixtime('.$end.')')->orderBy('push_time DESC')->asArray()->all();

        }else{
            $result = Opencard::find()->select(['id', 'identity', 'name', 'push_time', 'punch'])->orderBy('push_time DESC')->asArray()->all();
        }
//        var_dump($start);die;
        //查询打卡表数据


       // $count = Yii::$app->db->createCommand('select * from open_card where created_at >=from_unixtime(1382544000) and created_at<=from_unixtime(1523789395)')->queryScalar();
        //$result =Opencard::findBySql('select id,identity,name,push_time,punch from open_card where created_at >=from_unixtime('.$start.') and created_at<=from_unixtime('.$end.')')->orderBy('push_time DESC')->asArray()->all();
//       var_dump($COUNT);die;
//        $result = Opencard::find()->select(['id', 'identity', 'name', 'push_time', 'punch'])->where([
//            'and',
//            'created_at>=:id',
//            'created_at<=:pack_name'
//        ], [
//            ':id' => from_unixtime($start),
//            ':pack_name' =>from_unixtime($end)
//        ])->orderBy('push_time DESC')->asArray()->all();


//        $connection  = Yii::$app->db;
//        $sql= "select * from open_card";
//        $command = $connection->createCommand($sql);
//        $res     = $command->queryAll($sql);
//        var_dump($result);die;
        $dataResult = $result;      //todo:导出数据（自行设置）
        //查询班级
        foreach ($dataResult as $key => $val) {
            $card = Opencard::findOne($val['id']);
            $class = $card->hasOne(Yrclass::className(), ['id' => 'c_id'])->asArray()->one();
            $dataResult[$key]['id'] = $class['name'];
        }

        $headTitle = "<h1>打卡信息</h1>";
        $time = time();
        $title = date('Y-m-d', $time) . "打卡信息表";
        $headtitle = "<tr style='height:50px;border-style:none;><th border=\"0\" style='height:60px;width:270px;font-size:22px;' colspan='11' >{$headTitle}</th></tr>";
        $titlename = "<tr> 
                    <th style='width:70px;' >班级</th> 
                    <th style='width:70px;' >老师or学生</th> 
                    <th style='width:90px;'>姓名</th> 
                    <th style='width:140px;'>打卡时间</th> 
                    <th style='width:100px;'>打卡人</th> 
                </tr>";
        $filename = $title . ".xls";
        $this->excelData($dataResult, $titlename, $headtitle, $filename);

    }


    public function excelData($datas, $titlename, $title, $filename)
    {
        $str = "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\"\r\nxmlns:x=\"urn:schemas-microsoft-com:office:excel\"\r\nxmlns=\"http://www.w3.org/TR/REC-html40\">\r\n<head>\r\n<meta http-equiv=Content-Type content=\"text/html; charset=utf-8\">\r\n</head>\r\n<body>";
        $str .= "<table border=1><head>" . $titlename . "</head>";
        // $str .= $title;
        foreach ($datas as $key => $rt) {
            $str .= "<tr>";
            foreach ($rt as $k => $v) {
                if ($k == 'identity') {
                    switch ($v) {
                        case 1:
                            $v = "老师";
                            # code...
                            break;

                        default:
                            $v = "学生";
                            # code...
                            break;
                    }
                }
                $str .= "<td>{$v}</td>";
            }
            $str .= "</tr>\n";
        }
        $str .= "</table></body></html>";
        header("Content-Type: application/vnd.ms-excel; name='excel'");
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=" . $filename);
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Pragma: no-cache");
        header("Expires: 0");
        exit($str);
    }

}


?>
