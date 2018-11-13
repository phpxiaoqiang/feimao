<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Studentxclass */

$this->title = 'Update Studentxclass: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Studentxclasses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="studentxclass-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
