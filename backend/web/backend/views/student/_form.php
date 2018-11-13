<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sex')->textInput() ?>

    <?= $form->field($model, 'age')->textInput() ?>

    <?= $form->field($model, 'parent_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_tel')->textInput() ?>

    <?= $form->field($model, 'school')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'card_type')->textInput() ?>

    <?= $form->field($model, 'class')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subscribe_class')->textInput() ?>

    <?= $form->field($model, 'subscribe_mark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subscribe_time')->textInput() ?>

    <?= $form->field($model, 'is_binding')->textInput() ?>

    <?= $form->field($model, 'mark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'create_at')->textInput() ?>

    <?= $form->field($model, 'update_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
