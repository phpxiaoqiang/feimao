<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '评论列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [

            'id',
            //'p_id',
            ['label'=>'用户昵称',  'attribute' => 'p_id',  'value' => 'wxuser.nickname' ],//<=====加入这句
            'content',
//            'score',
            // 'created_at',
//            [
//                'class' => 'yii\grid\ActionColumn',
//                'header' => '操作',
//                'template' => '{delete}',
//                'buttons' => [
//                    'delete' => function ($url, $model, $key) {
//                        return $model->status == 'editable' ?
//                            Html::a('<span class="glyphicon glyphicon-user"></span>', $url, ['title' => '审核'] ) : '';
//                    },
//                ],
//                'headerOptions' => ['width' => '80'],
//            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => ' {delete}',
                'buttons' => [
                    'delete' => function ($url, $model, $key) {
                        return Html::a('删除', ['delete', 'id'=> $model->id,'c_id'=>$_GET['id']], [
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
