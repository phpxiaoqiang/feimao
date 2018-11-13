<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SubscribeclassSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '预约';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscribeclass-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>

        <?= Html::a('导出Excel', ['excel'], ['class' => 'btn btn-info']) ?>

    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'class_name',
            //  'updated_at',
            'tel',
            // 'subscribe_mark',
            'p_name',
              ['attribute' => 'dance',  'value' => 'category.name'],

//            'dance',
            'created_at',

            // 's_name',
            // 'p_id',
            // 'cid',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
