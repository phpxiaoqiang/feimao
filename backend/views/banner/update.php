<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Banner */

$this->title = '修改广告: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '广告轮播', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改广告';
?>
<div class="banner-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
