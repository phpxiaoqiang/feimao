<?php
use common\models\Studentxclass;
use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Yrclass;
use common\models\Opencard;
$Id = Yii::$app->request->get('id');
$name = Yrclass::find()->where(['id'=>$Id])->one();
/* @var $this yii\web\View */
/* @var $searchModel common\models\StudentxclassSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '班级:'.$name->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="studentxclass-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增学生', ['create?id='.$Id], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
             'total_hours',
             'hours'=>['value'=>function($model,$key){
                    $val = Opencard::find()->where(['c_id'=>$model->c_id,'s_id'=>$model->s_id])->sum('class_time');
                    $val = empty($val)?0:$val;
                    $hours = Studentxclass::find()->where(['s_id'=>$model->s_id,'c_id'=>$model->c_id])->asArray()->one()['hours'];
                    return $val + $hours;
             },'header'=>"消费时间"],
             'p_name',
             's_tel',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('查看', $url,['class' => 'btn btn-primary btn-xs']);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('修改', $url,['class' => 'btn btn-success btn-xs']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('删除', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger btn-xs',
                            'data' => [
                                'confirm' => '你确定要删除吗?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ]
            ],
        ],
    ]); ?>
</div>
