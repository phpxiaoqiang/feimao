<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StudentxclassSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Studentxclasses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="studentxclass-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Studentxclass', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            's_id',
            'c_id',
            'created_at',
            'updated_at',
            // 'total_hours',
            // 'hours',
            // 'name',
            // 'p_name',
            // 's_tel',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
