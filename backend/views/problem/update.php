<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Problem */

$this->title = 'Update Problem: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '情感问题', 'url' => ['index','id'=>$model->c_id]];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="problem-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
