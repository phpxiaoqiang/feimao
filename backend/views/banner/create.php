<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Banner */

$this->title = '添加广告轮播';
$this->params['breadcrumbs'][] = ['label' => '广告轮播', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
