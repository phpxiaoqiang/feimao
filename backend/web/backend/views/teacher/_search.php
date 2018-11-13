<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TeacherSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teacher-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'pic') ?>

    <?= $form->field($model, 'sex') ?>

    <?= $form->field($model, 'age') ?>

    <?php // echo $form->field($model, 'major') ?>

    <?php // echo $form->field($model, 'class') ?>

    <?php // echo $form->field($model, 'is_binding') ?>

    <?php // echo $form->field($model, 'mark') ?>

    <?php // echo $form->field($model, 'is_ob') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
