<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '时间表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscribe-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('添加时间表', ['create?id='.$id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('批量添加', ['batchcreate?id='.$id], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            ['attribute' => 'counselor_id',  'value' => 'counselor.name'],
            'subscribe_startTime',
            'subscribe_endTime',
//            [
//                'attribute' => 'subscribe_startTime',
//                'label' => '预约开始时间',
//                'value' => function($model) {
//                    return strtotime($model->subscribe_startTime);
//                },
//            ],
            [
                'attribute' => 'is_buy',
                'label' => '是否可预约',
                'value' => function($model) {
                    return $model->is_buy == 1 ? '是' : '否';
                },
            ],
             'sort',
//            [
//                'attribute' => 'state',
//                'label' => '状态',
//                'value' => function($model) {
//                    return $model->state == 1 ? '正常' : '隐藏';
//                },
//            ]      [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{update} {delete}',
                'buttons' => [
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
            ],,
            // 'created_at',
            // 'updated_at',


        ],
    ]); ?>
</div>
