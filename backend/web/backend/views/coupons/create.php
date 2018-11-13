<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ActivityCoupons */

$this->title = 'Create Activity Coupons';
$this->params['breadcrumbs'][] = ['label' => 'Activity Coupons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-coupons-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
