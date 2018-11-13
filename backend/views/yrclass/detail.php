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
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
//            [
//                'attribute' => 'sex',
//                'value' => function($model) {
//                    return $model->sex == 1 ? '男' : '女';
//                },
//            ],
//            'age',
            'parent_name',
            'parent_tel',
//            'total_hours',
//            'hours',
            // 'school',
            // 'card_type',
            // 'class',
            // 'subscribe_class',
            // 'subscribe_mark',
            // 'subscribe_time',
            // 'is_binding',
            // 'mark',
            // 'create_at',
            // 'update_at',

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
