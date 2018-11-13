<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = '添加预约课程';
$this->params['breadcrumbs'][] = ['label' => '添加课程', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
