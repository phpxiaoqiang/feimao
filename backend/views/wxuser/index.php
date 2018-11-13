<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\WxuserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wxuser-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'label' => '用户ID',
            ],
            [
                'attribute' => 'nickname',
                'label' => '微信昵称',
            ],
            [
                'attribute' => 'openid',
                'label' => '用户系统秘钥',
            ],
            [
                'attribute' => '用户头像',
                'format'=>'raw',
                'value'=>function($model){
                    return Html::img($model->headimgurl,['width' => 100]);
                }
            ],
            [
                'attribute' => '性别',
                'value' => function($model) {
                    return $model->sex == 1 ? '男' : '女';
                },
            ],
            [
                'attribute' => 'province',
                'label'=>'省份'
            ],
            [
                'attribute' => 'city',
                'label'=>'所在市'
            ],
            // 'city',
            // 'country',
            // 'headimgurl:url',
            // 'created_at',
            // 'updated_at',
            // 'auth_key',
        ],
    ]); ?>
</div>
