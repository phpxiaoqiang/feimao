<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SubscribeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subscribe-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'counselor_id') ?>

    <?= $form->field($model, 'subscribe_startTime') ?>

    <?= $form->field($model, 'subscribe_endTime') ?>

    <?= $form->field($model, 'is_buy') ?>

    <?php // echo $form->field($model, 'sort') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
