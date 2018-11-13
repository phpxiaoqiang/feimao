
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Subscribe;
/* @var $this yii\web\View */
/* @var $searchModel common\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '订单展示';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'title',
            'oid',
            'phone',
//            'uid',
            ['label'=>'咨询师名称',  'attribute' => 'counselor_name',  'value' => 'counselor.name' ],//<=====加入这句

            'username',
            [
                'label'=>'预约方式',
                'attribute' => 'type',
                'value' => function($model) {
                   return $model->type == 2 ? '语音' : '文字';
               },
            ],
            // 'updated_at',
            // [
            //     'label'=>'订单购买时间', 
            //     'attribute'=>'updated_at',
            //     'value'=>'updated_at'
            // ]
            // 'age',
            // 'sex',
            // 'cid',
             //'price',
            [
                'attribute' => 'price',
                'format'=>'raw',
                'value'=>function($model){
                    return Html::encode($model->price/100);
                }
            ],
            // 'sid',
            // 'type',
            // 'describe:ntext',
//             'status',
            [
                'attribute' => 'status',
                'value' => function($model) {
                            $state = [
                                '0' => '已取消',
                                '1' => '已支付',
                                '2' => '已取消',
                                '3'=>  '已退款'
                            ];
                            return $state[$model->status];
               
                },
            ],
            [
                'attribute'=>'开始时间',
                'value'=>function($model){
                   $start =  Subscribe::find()->where(['id' =>$model->sid])->one(); 
                    return $start['subscribe_startTime'];
                },
            ],
            // [
            //     'attribute'=>'updated_at',

            // ],
            'created_at',
            [
               'attribute' => 'coupon',
               'value' => function($model) {
                   return $model->coupon == 1 ? '使用' : '无';
               },
           ],
            // 'pay_at',
            
            // 'updated_at',
          
        ],
    ]); ?>
</div>
