<?php 
namespace backend\controllers;
use Yii;
use Template;
use yii\web\Controller;
use common\models\OpenCard;
use common\models\Yrclass;
use common\models\Teacher;
use common\models\Student;
use common\models\YzWxuser;
use common\models\Line;
use common\models\Studentxclass;
use common\models\YzCateGory;
// use app\Chat\Template;
use common\models\Card;
use yii\data\ActiveDataProvider;
class PunchController extends Controller{
	public function actionIndex() {

		 $class_id = $_GET['c_id'];//传入班级id
//		$class_id = 22;
		//查询老师id和分类id
		$class = YrClass::find()->where(['id'=>$class_id])->asArray()->one();
		$teacher_id = $class['teacher_id'];
		$fenlei_id = $class['cid'];

		$fenlei = YzCateGory::find()->where(['id'=>$fenlei_id])->asArray()->one();

		$student = Studentxclass::find()->where(['c_id'=>$class_id])->asArray()->all();


		
		$teacher = Teacher::find()->where(['id'=>$teacher_id])->asArray()->one();
		// dd($teacher);
		// die;
		$omodel = new OpenCard();
		return $this->render('index',['student'=>$student,'class'=>$class,'fenlei'=>$fenlei,'teacher'=>$teacher,'omodel'=>$omodel,'c_id'=>$class_id]);
	}
	//查询模板消息需要的数据
	public function search($sid,$cid,$tid) {
		//查询家长openid
		$student = Student::findOne($sid);
		$res = $student->hasOne(YzWxuser::className(),['id'=>'p_id'])->asArray()->one();
		$openid = $res['openid'];
		// dd($openid);
		// exit;


		$student = Student::find()->where(['id'=>$sid])->asArray()->one();
		$student_name = $student['name'];
		$card_id = $student['card_type'];
		
		//查询会员金额情况
		$card = Card::find()->where(['id'=>$card_id])->asArray()->one();
		$money = $card['money'];
		$totle_hours = $card['hours'];
		$m = $money/$totle_hours;//每节课的金额
		
		//本次消费1课时，增加studentxclass表中对应的课时
		$k = Studentxclass::find()->where(['s_id'=>$sid,'c_id'=>$cid])->asArray()->one();
		$h = $k['hours']+1;
		$id = $k['id'];
		$time = Studentxclass::findOne($id);
		// dd($time);
		$time->hours = $h;
		
		$time->save();
		// dd($ss);
		//查询课时情况
		$keshi = Studentxclass::find()->where(['s_id'=>$sid])->asArray()->all();
		// dd($keshi);
		$hours = 0;
		foreach($keshi as $value) {
			// dd($value);
			$hours += $value['hours']; //所有消费课时
		}
		$totm = $m*$hours;//总消费金额
		$shours = $totle_hours-$hours;//剩余课时
		$smoney = $money-$totm;//剩余金额
		


		$class = YrClass::find()->where(['id'=>$cid])->asArray()->one();
		$className = $class['name'];
		$class_table = $class['class_table'];
		
		$teacher = Teacher::find()->where(['id'=>$tid])->asArray()->one();
		$teacher_name = $teacher['name'];
		// dd($teacher_name);
		// exit;
		$all = array(
			'openid'=>$openid,
			'student_name'=>$student_name,
			'class'=>$className,
			'class_table'=>$class_table,
			'teacher'=>$teacher_name,
			'one_time'=>1,
			'one_money'=>$m,
			'tot_money'=>$totm,
			'tot_time'=>$hours,
			's_hours'=>$shours,
			's_money'=>$smoney
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
	public function actionPunch($identity,$sid="",$cid="",$name="",$time="",$person="",$tid="") {
		
	 	$openInsert = new OpenCard();
		$openInsert->c_id = $cid;
		$openInsert->s_id = $sid;
		$openInsert->identity = $identity;
		$openInsert->name = $name;
		$openInsert->push_time = date('Y-m-d H:i:s',time());
		$openInsert->punch = empty($person)?"管理员":$person; 
		$openInsert->class_time = $time;
		$openInsert->created_at = date('Y-m-d H:i:s',time());
		// $openInsert->updated_at = date('Y-m-d H:i:s',time());
		$openInsert->t_id = $tid; 
		
		if($identity == 1) {
			$res = $openInsert->save();
			if($res) {
				echo "1";
			}

		}
		// die;
		if($identity == 0) {
			$res = $openInsert->save();
			$all = $this->search($sid,$cid,$tid);//查询模板消息需要的数据
			if($res) {
				echo "1";
				$this->post($all);
			}
		}
	}

	//发送模板消息
	public function post($arr) { 
		//发送模板消息
		$tem = new Template($arr);
		$tem->send();

	}
}

 ?>