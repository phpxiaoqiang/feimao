<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Teacher */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '老师管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-view">

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
            'pic',
            [
                'attribute' => 'sex',
                'value' => function($model) {
                    return $model->sex == 1 ? '男' : '女';
                },
            ],
            'age',
            'major',
            'class',
//            [
//                'attribute' => 'is_binding',
//                'value' => function($model) {
//                    return $model->is_binding == 1 ? '关注' : '未关注';
//                },
//            ],
//            'is_binding',
            'mark',
//            'is_ob',
            [
                'attribute' => 'is_ob',
                'value' => function($model) {
                    return $model->is_ob == 1 ? '在职' : '不在职';
                },
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
