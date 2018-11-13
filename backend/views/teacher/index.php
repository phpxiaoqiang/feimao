<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TeacherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '老师管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建老师', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('导出Excel', ['excel'], ['class' => 'btn btn-info']) ?>

    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'attribute' => 'pic',
                'label'=>'头像',
                'format'=>'raw',
                'value'=>function($model){
                    return Html::img($model->pic,['width' => 100]);
                }
            ],
            [
                    'attribute' => 'sex',
                    'value' => function($model) {
                             return $model->sex == 1 ? '男' : '女';
                             },

            ],
            'age',
            // 'major',
            // 'class',
            // 'is_binding',
            // 'mark',
            // 'is_ob',
            // 'created_at',
            // 'updated_at',

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
