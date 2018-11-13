<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Teacher;
/* @var $this yii\web\View */
/* @var $searchModel common\models\YrclassSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '班级管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yrclass-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增班级', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('导出Excel', ['excel'], ['class' => 'btn btn-info']) ?>

    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
          //  'cid',
            'class_table',
//            'teacher_id',
            ['label'=>'老师名称',  'attribute' => 'teacher_id',  'value' => 'teacher.name' ],//<=====加入这句

            [
                'attribute' => 'student_sum',
                'format'=>'raw',
                'value'=>function($model){
                    return Html::a($model->student_sum,"/studentxclass/index?id={$model->id}", ['target'=> '_blank']);
                  }
            ] ,
            // 'is_graduation',
            // 'start_time',
            // 'teacher_money',
            // 'created_at',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{view} {emotion}  {comment}  {update} {delete}',
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
