<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Vcomment */

$this->title = 'Create Vcomment';
$this->params['breadcrumbs'][] = ['label' => 'Vcomments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vcomment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
