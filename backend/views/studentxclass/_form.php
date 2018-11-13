<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use common\models\Student;
use yii\helpers\ArrayHelper;
use common\models\Card;

$counselorData = Student::find()->all();
$allCounselor = ArrayHelper::map($counselorData,'id','name');

/* @var $this yii\web\View */
/* @var $model common\models\Studentxclass */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="studentxclass-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 's_id')->dropDownList($allCounselor,['prompt'=>'请选择学生'])->label('学生姓名');?>

    <?= $form->field($model, 'total_hours')->textInput() ?>

    <?= $form->field($model, 'hours')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
