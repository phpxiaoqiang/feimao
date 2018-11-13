<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ActivityCoupons */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-coupons-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'p_id')->textInput() ?>

    <?= $form->field($model, 'o_id')->textInput() ?>

    <?= $form->field($model, 'expiretime')->textInput() ?>

    <?= $form->field($model, 'money')->textInput() ?>

    <?= $form->field($model, 'state')->textInput() ?>

    <?= $form->field($model, 'receivetime')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
