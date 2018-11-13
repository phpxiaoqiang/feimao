<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Subscribeclass */

$this->title = 'Create Subscribeclass';
$this->params['breadcrumbs'][] = ['label' => 'Subscribeclasses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscribeclass-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
