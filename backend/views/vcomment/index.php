<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\VcommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '评论列表';
// $this->params['breadcrumbs'][] = $this->title;
?>
<ul class="breadcrumb">
    <li><a href="/">首页</a></li>
    <li><a href="/vanwer/index">大V解答</a></li>
    <li class="active">评论列表</li>
</ul>
<div class="vcomment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?//= Html::a('Create Vcomment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'p_id',
            'e_id',
            'content',
            'score',
            // 'state',
            // 'created_at',
            // 'updated_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{delete}',
                'buttons' => [
                  
                    'delete' => function ($url, $model, $key) {
                        return Html::a('删除', ['delete', 'id' => $model->id,'eid'=>$_GET['id']], [
                            'class' => 'btn btn-danger btn-xs',
                            'data' => [
                                'confirm' => '你确定要删除吗?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ]
            ],
            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
