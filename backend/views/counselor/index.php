<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CounselorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '咨询师管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="counselor-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加咨询师', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            [
                'attribute' => 'avatar',
                'format'=>'raw',
                'value'=>function($model){
                    return Html::img($model->avatar,['width' => 100]);
                }
            ],
//            'desc:ntext',
            [
                'attribute' => 'subscribe_price',
                'format'=>'raw',
                'value'=>function($model){
                    return Html::encode($model->subscribe_price/100);
                }
            ],
            [
                'attribute' => 'subscribe_voice_price',
                'format'=>'raw',
                'value'=>function($model){
                    return Html::encode($model->subscribe_voice_price/100);
                }
            ],
//            'subscribe_price',
           // 'subscribe_voice_price',
           // 'subscribe_voice_price',
             'subscribe_num',
            'sort',
            ['label'=>'分类名称',  'attribute' => 'category_name',  'value' => 'category.name' ],//<=====加入这句

//            ['attribute' => 'category_id',  'value' => 'category.name'],
//            [
//                'attribute' => 'state',
//                'label' => '状态',
//                'value' => function($model) {
//                    return $model->state == 1 ? '正常' : '隐藏';
//                },
//            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{view} {comment} {update} {subscribe} {delete} ',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('查看', $url,['class' => 'btn btn-primary btn-xs']);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('修改', $url,['class' => 'btn btn-success btn-xs']);
                    },
                    'subscribe' => function ($url, $model, $key) {

                        return Html::a('时间表', '/subscribe/index?id=' . $model->id,['class' => 'btn btn-info btn-xs']);
                    },
                    'comment' => function ($url, $model, $key) {

                        return Html::a('评论', '/comment/index?id=' . $model->id,['class' => 'btn btn-info btn-xs']);
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
