<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Card */

$this->title = '新建卡种';
$this->params['breadcrumbs'][] = ['label' => '卡种管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
