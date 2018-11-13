<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '广告轮播管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加广告轮播', ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute' => 'title',
                'label' => '标题',
            ],
            [
                'attribute' => 'subtitle',
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
                'attribute' => 'link',
                'label' => '链接',
            ],
            [
                'attribute' => 'sort',
                'label' => '排序',
            ],
//            [
//                'attribute' => 'state',
//                'label' => '状态',
//                'value' => function($model) {
//                    return $model->state == 1 ? '正常' : '隐藏';
//                },
//            ],
//            [
//                'attribute' => 'created_at',
//                'label' => '创建时间',
//            ],
//            [
//                'attribute' => 'updated_at',
//                'label' => '更新时间',
//            ],
//            ['class' => 'yii\grid\ActionColumn'],
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
        ]
    ]); ?>
</div>
