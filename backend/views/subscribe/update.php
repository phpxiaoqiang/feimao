<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Subscribe */

$name = \common\models\Counselor::findOne($model->counselor_id)->name;

$this->title = '修改时间表: ' . $name;
$this->params['breadcrumbs'][] = ['label' => '时间表', 'url' => ['index', 'id' => $model->counselor_id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="subscribe-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
