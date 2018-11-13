<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\YrclassSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Yrclasses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yrclass-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Yrclass', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'cid',
            'class_table',
            'teacher_id',
            // 'student_sum',
            // 'is_graduation',
            // 'start_time',
            // 'teacher_money',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
