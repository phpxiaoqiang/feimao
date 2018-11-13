
<?php

use yii\helpers\Html; 
use yii\grid\GridView; 

/* @var $this yii\web\View */ 
/* @var $searchModel common\models\VanwerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */ 

$this->title = '大V解答'; 
$this->params['breadcrumbs'][] = $this->title; 
?> 
<div class="vanswer-index"> 

    <h1><?= Html::encode($this->title) ?></h1> 
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?> 

    <p> 
        <?= Html::a('新增大V', ['create'], ['class' => 'btn btn-success']) ?> 
    </p> 
    <?= GridView::widget([ 
        'dataProvider' => $dataProvider, 
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'], 

            'id',
            'name',
            'introduce',
            [
                'attribute' => 'pic',
                'format'=>'raw',
                'value'=>function($model){
                    return Html::img($model->pic,['width' => 100]);
                }
            ],
            // 'state',
            'sort',
            // 'pic',
            // 'created_at',
            // 'updated_at',

            // ['class' => 'yii\grid\ActionColumn'], 
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{view} {emotion}  {comment}  {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('查看', $url,['class' => 'btn btn-primary btn-xs']);
                    },
                    'emotion' => function ($url, $model, $key) {

                        return Html::a('情感问题', '/problem/index?id=' . $model->id,['class' => 'btn btn-info btn-xs']);
                    },
                    'comment' => function ($url, $model, $key) {

                        return Html::a('评论', '/vcomment/index?id=' . $model->id,['class' => 'btn btn-warning btn-xs']);
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