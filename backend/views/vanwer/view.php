<?php

use yii\helpers\Html; 
use yii\widgets\DetailView; 

/* @var $this yii\web\View */ 
/* @var $model common\models\Vanswer */ 

$this->title = $model->name; 
$this->params['breadcrumbs'][] = ['label' => '大V列表', 'url' => ['index']]; 
$this->params['breadcrumbs'][] = $this->title; 
?> 
<div class="vanswer-view"> 

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
            'introduce',
            ['label'=>'状态','value'=>$model->state == 1 ? '正常' : '隐藏'],
            'sort',
            ['label'=>'大V头像','format'=>'raw','value'=>function($model){
                return Html::img($model->pic,['width' => 100]);
            }],
            'created_at',
            'updated_at',
        ], 
    ]) ?> 

</div> 