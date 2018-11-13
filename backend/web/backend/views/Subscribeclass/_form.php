<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Subscribeclass */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subscribeclass-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'class_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dance')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'tel')->textInput() ?>

    <?= $form->field($model, 'subscribe_mark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'p_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 's_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'p_id')->textInput() ?>

    <?= $form->field($model, 'cid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
