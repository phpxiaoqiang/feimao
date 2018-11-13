<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Vanswer;
$Vanswer = Vanswer::findOne($_GET['id']);
// var_dump($Vanswer->name);die;
/* @var $this yii\web\View */
/* @var $searchModel common\models\EmotionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<ul class="breadcrumb">
    <li><a href="/">首页</a></li>
    <li><a href="/vanswer/index">大V列表</a></li>
    <li class="active">大V<?=$Vanswer->name?>：情感包列表</li>
</ul>
<div class="emotion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
     <a class="btn btn-success" href="/emotion/create?id=<?=$_GET['id']?>">新增情感包</a>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'attribute' =>'pic',
                'format'=>'raw',
                'value'=>function($model){
                    return Html::img($model->pic,['width' => 100]);
                }
            ],
            // 'a_id',
            'sort',
            // 'state',
            // 'created_at',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{view} {comment} {problem} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('查看', $url,['class' => 'btn btn-primary btn-xs']);
                    },
                    'comment' => function ($url, $model, $key) {

                        return Html::a('评论', '/vcomment/index?id=' . $model->id,['class' => 'btn btn-info btn-xs']);
                    },
                    'problem'=>function($url, $model, $key){
                        return Html::a('问题列表','/problem/index?cid='.$_GET['id'].'&eid=' . $model->id,['class' => 'btn btn-warning btn-xs']); 
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
