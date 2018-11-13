<?php

use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Subscribe */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subscribe-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subscribe_startTime')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => ''],
        'pluginOptions' => [
            'autoclose' => true,
            'todayHighlight' => true,
            'startDate' => date('Y-m-d')
        ]
    ]); ?>

    <?//= $form->field($model, 'subscribe_endTime')->widget(DateTimePicker::classname(), [
        //'options' => ['placeholder' => ''],
        //'pluginOptions' => [
          //  'autoclose' => true,
            //'todayHighlight' => true,
            //'startDate' => date('Y-m-d')
        //]
    //]); ?>

    <?php if ($model->is_buy == '') $model->is_buy = '1'; ?>
    <?= $form->field($model, 'is_buy')->radioList(['1' => '是', '0' => '否'])->label('是否可预约') ?>

    <?= $form->field($model, 'sort')->textInput(['value' => '0']) ?>

    <?php if ($model->state == '') $model->state = '1'; ?>
    <?= $form->field($model, 'state')->radioList(['1' => '正常', '0' => '隐藏'])->label('状态') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
