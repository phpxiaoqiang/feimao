<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Counselor */

$this->title = '添加咨询师';
$this->params['breadcrumbs'][] = ['label' => '咨询师列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="counselor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
