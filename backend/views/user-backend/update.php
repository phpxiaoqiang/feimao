<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserBackend */

$this->title = '修改用户: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '用户列表s', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-backend-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
