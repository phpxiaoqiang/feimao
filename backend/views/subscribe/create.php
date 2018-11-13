<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Subscribe */

$this->title = '添加时间表';
$this->params['breadcrumbs'][] = ['label' => '时间表', 'url' => ['index?id='.$model->counselor_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscribe-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
