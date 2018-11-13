<?php

namespace frontend\controllers;
use Yii;
use yii\helpers\ArrayHelper;
use common\models\Category;
use common\models\Banner;
use common\models\Post;
use common\models\Comment;
use common\models\Media;
use common\models\Subscribe;
use common\models\Orders;
use frontend\models\Wxuser as User;
class TestchatController extends BaseController
{
    public function actionIndex(){
        $oid = Yii::$app->request->get('oid',null);
        $order = Orders::find()
                       ->where(['oid'=>$oid])
                       ->with(['subscribe'=>function($query){
                           $query->select('subscribe_startTime,subscribe_endTime');
                       }])
                       ->asArray()
                       ->one();
        $isRoomUsers = false;
        $utype = null;
        $starttime = 0;
        $endtime = 0;
        if(empty($order))
            return ;
        $starttime = strtotime($order['subscribe']['subscribe_startTime']);
        $endtime = strtotime($order['subscribe']['subscribe_endTime']);
        if($endtime < time()){
            if(Yii::$app->user->id == $order['uid']){
                if(!Comment::find()->where(['p_id'=>Yii::$app->user->id,'c_id'=>$order['cid']])->exists()){
                    $this->redirect('/comment/comment?id='.$order['cid']);
                }
            }
            $this->redirect('/');
        }
        $usend = [1=>'say',2=>'audio'];
        $connection = Yii::$app->db;
        $command = $connection->createCommand("SELECT wx.id FROM yz_counselor yc JOIN yz_wxuser wx ON wx.openid = yc.`uid` WHERE yc.`id`= :cid");
        $command->bindParam(':cid', $order['cid']);
        $teacher_id = $command->queryScalar();
        if(Yii::$app->user->id == $order['uid']){
            $isRoomUsers = true;
            $utype = 'student';
        }else if(Yii::$app->user->id == $teacher_id){
            $isRoomUsers = true;
            $utype = 'teacher';
        }
        if(!$isRoomUsers){
            $this->redirect('/');
        }
        $data = [
            'student_id' => $order['uid'],
            'teacher_id' => $teacher_id,
            'utype' => $utype,
            'starttime' => $starttime,
            'endtime' => $endtime,
            'usend' => $usend[$order['type']],
            'uicon' => User::findIdentity(Yii::$app->user->id)->headimgurl,
            'uid' => Yii::$app->user->id,
            'cid' => $order['cid'],
            'sid' => $order['sid']
        ];
        
        return $this->render('chat',$data);

    }
}
