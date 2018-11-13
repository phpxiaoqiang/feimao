<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '文章列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

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
            'title',
            ['attribute' => 'pic','format'=>'raw','value'=>function($model){
                return Html::img($model->pic,['width' => 100]);
            }],
            'content:ntext',
       //     'desc',
//            ['attribute' => 'counselor_id',  'value' => $model->counselor->name],
            'sort',
            [
                'attribute' => 'state',
                'value' => function($model) {
                    return $model->state == 1 ? '正常' : '隐藏';
                },
            ],
//            'created_at',
//            'updated_at',
        ],
    ]) ?>

</div>
