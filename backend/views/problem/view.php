<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Problem */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '情感列表', 'url' => ['index','id'=>$model->c_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="problem-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '你确定要删除这条数据吗?',
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
            'link',

            [
                'attribute'=>'播放音频', 'format'=>'raw', 'value'=>function($model){
                    return '<div>
                                <audio controls="">
                                    <source src="'.$model->link.'" type="audio/mp3">
                                    </audio>
                            </div>';
            }],  
            
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
