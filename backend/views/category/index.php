<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '情感分类管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加情感分类', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'label' => 'ID',
            ],
            [
                'attribute' => 'name',
                'label' => '名称',
            ],
            [
                'attribute' => 'subname',
                'label' => '子标题',
            ],
            [
                'attribute' => 'pic',
                'label'=>'展示图',
                'format'=>'raw',
                'value'=>function($model){
                    return Html::img($model->pic,['width' => 100]);
                }
            ],
            [
                'attribute' => 'sort',
                'label' => '排序',
            ],
//            [
//                'attribute' => 'state',
//                'value' => function($model) {
//                    return $model->state == 1 ? '正常' : '隐藏';
//                },
//            ],
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
