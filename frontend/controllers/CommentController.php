<?php

namespace frontend\controllers;

use common\models\Comment;
use common\models\Commentlabel;
use common\models\Counselor;
use Yii;
use yii\data\Pagination;
use yii\db\Expression;

class CommentController extends BaseController
{
    public function actionIndex()
    {

        return $this->render('index');
    }

    public function actionComment()
    {

        $id = Yii::$app->request->get('id');
        $res = Counselor::findOne($id);   //此方法返回 主键 id=1  的一条数据(举个例子)；
        $labelComment = Commentlabel::find()->all();
        return $this->render('comment', [
            'res' => $res,
            'labelComment' => $labelComment
        ]);
    }

    public function actionReceive()
    {
        $star = Yii::$app->request->post('star');
        $tag = Yii::$app->request->post('tag');
        $content = Yii::$app->request->post('content');
        $cid = Yii::$app->request->post('cid');
        $pid = Yii::$app->user->id;
        $model = new Comment();
        $model->p_id = $pid;
        $model->c_id = $cid;
        $model->score = $star;
        $model->content = $content;
        $model->s_id = Yii::$app->request->post('sid');
        $model->state = 1;
        $model->created_at = new Expression('NOW()');
        if ($model->save()) {
            $arr = [];
            for ($i = 0; $i < count($tag); $i++) {
                $arr[$i][] = $tag[$i];
                $arr[$i][] = $cid;
                $arr[$i][] = new Expression('NOW()');
                $arr[$i][] = new Expression('NOW()');
            }
            Yii::$app->db->createCommand()->batchInsert('yz_counselor_commentlabel', ['cl_id', 'c_id', 'created_at', 'updated_at'], $arr)->execute();
            echo 1;
        } else {
            echo 403;
        }
    }

}