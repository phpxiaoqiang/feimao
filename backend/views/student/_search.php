<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StudentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'sex') ?>

    <?= $form->field($model, 'age') ?>

    <?= $form->field($model, 'parent_name') ?>

    <?php // echo $form->field($model, 'parent_tel') ?>

    <?php // echo $form->field($model, 'school') ?>

    <?php // echo $form->field($model, 'card_type') ?>

    <?php // echo $form->field($model, 'class') ?>

    <?php // echo $form->field($model, 'subscribe_class') ?>

    <?php // echo $form->field($model, 'subscribe_mark') ?>

    <?php // echo $form->field($model, 'subscribe_time') ?>

    <?php // echo $form->field($model, 'is_binding') ?>

    <?php // echo $form->field($model, 'mark') ?>

    <?php // echo $form->field($model, 'create_at') ?>

    <?php // echo $form->field($model, 'update_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
