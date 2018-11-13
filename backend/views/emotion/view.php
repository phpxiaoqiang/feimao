<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Emotion */


?>
<ul class="breadcrumb"><li><a href="/">首页</a></li>
<li><a href="/emotion/index?id=<?=$model->a_id?>">情感包列表</a></li>
<li class="active"><?=$model->name;?></li>
</ul>
<div class="emotion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id,'aid'=>$model->a_id], [
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
                return Html::img($model->pic,['width' => 100]);
            }],
          
            ['label'=>'所属大V','value'=>$model->vanswer->name],

            // ['attribute' => 'category_id',  'value' => $model->category->name],
            'sort',
            ['label'=>'状态','value'=>$model->state == 1 ? '正常' : '隐藏'],
            'created_at',
   
        ],
    ]) ?>

</div>
