<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Emotion */

$this->title = '修改情感包: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '情感包列表', 'url' =>['index', 'id' => $model->a_id]];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="emotion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
