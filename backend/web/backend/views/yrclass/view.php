<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Yrclass */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Yrclasses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yrclass-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'cid',
            'class_table',
            'teacher_id',
            'student_sum',
            'is_graduation',
            'start_time',
            'teacher_money',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
