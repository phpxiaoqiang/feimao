<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Banner */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '广告轮播', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-view">

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

            ['label'=>'标题','value'=>$model->title],
            ['label'=>'子标题','value'=>$model->subtitle],
            ['label'=>'展示图','format'=>'raw','value'=>function($model){
                return Html::img($model->pic,['width' => 100]);
            }],
            ['label'=>'链接','value'=>$model->link],
            ['label'=>'排序','value'=>$model->sort],
            ['label'=>'状态','value'=>$model->state == 1 ? '正常' : '隐藏'],
//            ['label'=>'创建时间','value'=>$model->created_at],
//            ['label'=>'更新时间','value'=>$model->updated_at],
        ],
    ]) ?>

</div>
