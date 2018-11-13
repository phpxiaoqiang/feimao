<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Counselor */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '咨询师列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="counselor-view">

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
            ['label'=>'头像','format'=>'raw','value'=>function($model){
                return Html::img($model->avatar,['width' => 100]);
            }],
            'desc:ntext',
//            'subscribe_price',
            [
                'attribute' => 'subscribe_price',
                'format'=>'raw',
                'value'=>function($model){
                    return Html::encode($model->subscribe_price/100);
                }
            ],
            [
                'attribute' => 'subscribe_voice_price',
                'format'=>'raw',
                'value'=>function($model){
                    return Html::encode($model->subscribe_voice_price/100);
                }
            ],
            'subscribe_num',
//            'category_id',
            ['attribute' => 'category_id',  'value' => $model->category->name],
            ['label'=>'状态','value'=>$model->state == 1 ? '正常' : '隐藏'],
        ],
    ]) ?>

</div>
