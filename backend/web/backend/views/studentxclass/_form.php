<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Studentxclass */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="studentxclass-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 's_id')->textInput() ?>

    <?= $form->field($model, 'c_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'total_hours')->textInput() ?>

    <?= $form->field($model, 'hours')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'p_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 's_tel')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
