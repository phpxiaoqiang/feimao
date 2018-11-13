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
        $id = Yii::$app->request->get('id');

        $res = Counselor::findOne($id);   //此方法返回 主键 id=1  的一条数据(举个例子)；
        $average = Comment::find()->andWhere(['state' => '1', 'c_id' => $id])->average('score');
        $score = round($average);
        $data = Comment::find()
            ->alias('c')
            ->select(['content', 'c.created_at', 'w.nickname', 'w.headimgurl'])
            ->leftJoin('yz_wxuser as w', ' c.p_id =w.id')->asArray();

        $labelComment = Commentlabel::findBySql('SELECT c.name AS name,COUNT(l.id) AS cou FROM yz_commentlabel AS c RIGHT JOIN yz_counselor_commentlabel AS l ON l.cl_id =c.id WHERE l.c_id =' . $id . ' GROUP BY c.name')->asArray()->all();
//        var_dump($labelComment[1]['name']);die;
        $pages = new Pagination(['totalCount' => $data->where(['c_id' => $id, 'state' => 1])->count(), 'pageSize' => '5']);    //实例化分页类,带上参数(总条数,每页显示条数)
        $dataCount = $data->where(['c_id' => $id, 'state' => 1])->count();
        if (!empty($_GET['new'])) {
            $model = $data->offset($pages->offset)->where(['c_id' => $id, 'state' => 1])->orderBy('c.id desc')->limit($pages->limit)->all();
        } else {
            $model = $data->offset($pages->offset)->where(['c_id' => $id, 'state' => 1])->limit($pages->limit)->all();
        }
        if (Yii::$app->request->isAjax) {

            return $this->renderPartial('list', [
                'model' => $model,
            ]);

        } else {
            return $this->render('index', [
                'res' => $res,
                'model' => $model,
                'pages' => $pages,
                'score' => $score,
                'dataCount' => $dataCount,
                'labelComment' => $labelComment
            ]);
        }
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