<?php

namespace backend\controllers;

use Yii;
use backend\models\UserBackend;
use backend\models\AuthAssignment;
use backend\models\AuthItem;
use backend\models\UserBackendSearch;
use backend\controllers\BaseController;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserBackendController implements the CRUD actions for UserBackend model.
 */
class UserBackendController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all UserBackend models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserBackendSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserBackend model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserBackend model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserBackend();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserBackend model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserBackend model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserBackend model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserBackend the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserBackend::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSignup ()
    {
        // 实例化一个表单模型，这个表单模型我们还没有创建，等一下后面再创建
        $model = new \backend\models\SignupForm();

        // 下面这一段if是我们刚刚分析的第二个小问题的实现，下面让我具体的给你描述一下这几个方法的含义吧
        // $model->load() 方法，实质是把post过来的数据赋值给model的属性
        // $model->signup() 方法, 是我们要实现的具体的添加用户操作
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            // 添加完用户之后，我们跳回到index操作即列表页
            return $this->redirect(['index']);
        }

        // 下面这一段是我们刚刚分析的第一个小问题的实现
        // 渲染添加新用户的表单
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionCreatePermission(){
        $auth = Yii::$app->authManager;
        $create = $auth->createPermission("lijinze");
        $create->description = 'test';
        $auth->add($create);
    }

    public function actionCreaterole(){
        $auth = Yii::$app->authManager;
        $create = $auth->createRole("lijinze_role");
        $create->description = 'test';
        $auth->add($create);
    }

    public function actionPermission($id){
        $model = new AuthAssignment;
        $assignment = $model->find()->select('item_name')->where(['user_id'=>$id])->all();
        $existAssignments = [];
        foreach($assignment as $existAssignment){
            $existAssignments[] = $existAssignment->item_name;
        }
        $model->item_name = $existAssignments;
        if(\Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $post['AuthAssignment']['item_name'] = empty($post['AuthAssignment']['item_name'])?[]:$post['AuthAssignment']['item_name'];
            $newAssignments = array_diff($post['AuthAssignment']['item_name'],$existAssignments);
            $deleteAssignments = array_diff($existAssignments,$post['AuthAssignment']['item_name']);
            $newAssignments = array_map(function($value)use($id){
                        return [
                            $value,$id,time()
                        ];
                    },$newAssignments);
            $connection = Yii::$app->db;
            $connection->createCommand()->batchInsert('yz_auth_assignment',['item_name','user_id','created_at'],$newAssignments)->execute();
            AuthAssignment::deleteAll(['and','user_id = '.$id,['in','item_name',$deleteAssignments]]);
            return $this->redirect(['permission','id'=>$id]);
            // return $this->refresh();
        }elseif(\Yii::$app->request->isGet){
            $authitem = AuthItem::find()->where(['type'=>2])->all();
            $data = [];
            foreach($authitem as $item){
                $data[$item->name]=$item->description;
            }
            return $this->render('permission',[
                'model' => $model,
                'data' => $data,
            ]);
        }
    }
}
