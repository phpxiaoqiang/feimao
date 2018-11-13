<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserBackendSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '添加后台用户';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-backend-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加新用户', ['signup'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'label' => 'ID',
            ],
            [
                'attribute' => 'username',
                'label' => '用户名',
            ],

//            'auth_key',
//            'password_hash',
//            'email:email',
            // 'created_at',
            // 'updated_at',

//            ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{view} {update} {delete} {permission}',
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
                    'permission' => function ($url, $model, $key){
                        return Html::a('权限',$url,[ 'id' => $model->id],[
                            'class' => 'btn btn-danger btn-xs',
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>
</div>
