<?php 
namespace frontend\controllers;
use Yii;
use yii\data\Pagination;
use common\models\Opencard;
use common\models\Yrclass;
use common\models\Teacher;
use common\models\Student;
use common\models\YzWxuser;
use common\models\Line;
use common\models\Studentxclass;
// use app\Chat\Template;
use common\models\Card;
class OpencardController extends Controller{
	
	public function actionIndex() {
		$c_id  = $GET['bid'];                    //班级id
		$t_id = $_GET['tid'];              //老师的id
		if( empty($c_id) || empty($t_id) ){
			return $this->redirect(['order/index']);
		}
		$tmodel = new Teacher();
		$smodel = new Student();
		$omodel = new Opencard();
		//查询教师信息
		$teacher = Teacher::find()->select('id,name')->where(['id'=>$t_id])->asArray()->one();

		//查询学生信息
		// $res = Line::find()->where(['class_id'=>$c_id])->asArray()->all();
		$res = Studentxclass::find()->where(['c_id'=>$c_id])->asArray()->all();                   //根据班级名称查学生
		$s_id = [];//如果 $res为空,则 $s_id undefined,须声明
		foreach($res as $value) {                 
			$s_id[] = $value['s_id'];
		}
		$student = [];
		foreach($s_id as $val) {
			$student[] = Student::find()->where(['id'=>$val])->asArray()->one();   //根据学生id,查学生
		}
		return $this->render('index',['teacher'=>$teacher,'student'=>$student,'tmodel'=>$tmodel,'smodel'=>$smodel,'omodel'=>$omodel,'c_id'=>$c_id]);
	   
	}

}

 ?>