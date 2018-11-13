<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ActivityCouponsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '活动优惠展示';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-coupons-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            ['attribute' => 'p_id', 'value'=>'p_id'],
           ['attribute' => '微信昵称',  'value' => 'wxuser.nickname'],
            // ['label'=>'用户昵称',  'attribute' => 'p_id',  'value' => 'Wxuser.nickname' ],
            // 'o_id',
            ['label'=>'订单号',  'attribute' => 'o_id',  'value' => 'o_id' ],
         
            // 'expiretime:datetime',
            // 'money',
         
            [
               'attribute' => 'state',
               'label' => '状态',
               'value' => function($model) {
                   return $model->state == 1 ? '已使用' : '已领取';
               },
            ],
            [
               'attribute' => 'receivetime',
               'label' => '领取时间',
               'value' => function($model) {
                   return date('Y-m-d H:i:s',$model->receivetime);
               },
            ],
            // 'receivetime:datetime',
            // 'created_at',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => ' {delete}',
                'buttons' => [
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
