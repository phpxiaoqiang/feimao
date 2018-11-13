<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ActivityCouponsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Activity Coupons';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-coupons-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Activity Coupons', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'p_id',
              ['label'=>'用户昵称',  'attribute' => 'p_id',  'value' => 'Wxuser.nickname' ]
            'o_id',
            'expiretime:datetime',
            'money',
            // 'state',
            // 'receivetime:datetime',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
