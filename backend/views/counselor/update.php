<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Counselor */

$this->title = '修改咨询师: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '咨询师列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="counselor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
