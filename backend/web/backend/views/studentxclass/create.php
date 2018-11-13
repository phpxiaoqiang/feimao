<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Studentxclass */

$this->title = 'Create Studentxclass';
$this->params['breadcrumbs'][] = ['label' => 'Studentxclasses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="studentxclass-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
