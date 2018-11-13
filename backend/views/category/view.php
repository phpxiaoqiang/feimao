<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '情感分类', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

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
            [
                'attribute' => 'name',
                'label' => '分类标题',
            ],
            ['label'=>'展示图','format'=>'raw','value'=>function($model){
                return Html::img($model->pic,['width' => 100]);
            }],
            'sort',
            ['label'=>'状态','value'=>$model->state == 1 ? '正常' : '隐藏'],
//            ['label'=>'创建时间','value'=>$model->created_at],
//            ['label'=>'更新时间','value'=>$model->updated_at],
        ],
    ]) ?>

</div>
