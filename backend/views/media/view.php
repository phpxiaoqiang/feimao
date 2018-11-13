<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Media */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '媒体列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="media-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
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
            'title',
            [
                'attribute' => 'pic',
                'label'=>'展示图',
                'format'=>'raw',
                'value'=>function($model){
                    return Html::img($model->pic,['width' => 100]);
                }
            ],
            'playNum',
            [
                'attribute' => 'type',
                'value' => function($model) {
                    return $model->type == 1 ? '音频' : '视频';
                },
            ],
            'sort',
            [
                'attribute' => 'state',
                'value' => function($model) {
                    return $model->state == 1 ? '正常' : '隐藏';
                },
            ],
        ],
    ]) ?>

</div>
