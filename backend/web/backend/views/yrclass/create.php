<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Yrclass */

$this->title = 'Create Yrclass';
$this->params['breadcrumbs'][] = ['label' => 'Yrclasses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yrclass-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
