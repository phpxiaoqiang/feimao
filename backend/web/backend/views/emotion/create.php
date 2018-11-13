<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Emotion */

$this->title = 'Create Emotion';
$this->params['breadcrumbs'][] = ['label' => 'Emotions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emotion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
