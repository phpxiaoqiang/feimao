<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Problem */

$this->title = '创建情感问题';
$this->params['breadcrumbs'][] = ['label' => '情感问题', 'url' => ['index','id'=>$_GET['id']]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="problem-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
