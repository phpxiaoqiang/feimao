<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Teacher;
/* @var $this yii\web\View */
/* @var $model common\models\Yrclass */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '班级管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yrclass-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '你确定要删除吗?',
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
             [
                'attribute' => 'teacher_id',
                'value' => function($model) {
                  $teacher= Teacher::find()->where(['id'=>$model->teacher_id])->one();
                  return $teacher->name;
               },
            ],
            'student_sum',
            'total_hours',
            'hours',

            [
               'attribute' => 'is_graduation',
                'value' => function($model) {
                    return $model->is_graduation == 1 ? '毕业' : '未毕业';
                },
            ],
            'start_time',
            'teacher_money',
            'created_at',
            'updated_at',

        ],
    ]) ?>

</div>
