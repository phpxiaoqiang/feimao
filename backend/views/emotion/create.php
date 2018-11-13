<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Emotion */

$this->title = '新增情感包';
$this->params['breadcrumbs'][] = ['label' => '情感包列表', 'url' => ['index','id' => $_GET['id']]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emotion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
