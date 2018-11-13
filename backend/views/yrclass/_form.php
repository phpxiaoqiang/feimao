<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Teacher;
use common\models\Post;

use kartik\datetime\DateTimePicker;
use common\models\Category;
use yii\helpers\ArrayHelper;
$counselorData = Category::find()->all();
$allCounselor = ArrayHelper::map($counselorData,'id','name');
$Data = Teacher::find()->all();
$all = ArrayHelper::map($Data,'id','name');

/* @var $this yii\web\View */
/* @var $model common\models\Yrclass */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="yrclass-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <!-- <?//= $form->field($model, 'cid')->textInput() ?> -->
    <?=$form->field($model, 'cid')->dropDownList($allCounselor,['prompt'=>'请选择分类'])->label('课程分类');?>

    <?= $form->field($model, 'class_table')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model, 'teacher_id')->dropDownList($all,['prompt'=>'请选择老师'])->label('相关老师');?>

    <?= $form->field($model, 'is_graduation')->radioList(['1'=>'是','0'=>'否'])->label('是否毕业')  ?>

    <!-- <?//= $form->field($model, 'is_graduation')->textInput() ?> -->
    <?= $form->field($model, 'start_time')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => ''],
        'pluginOptions' => [
            'autoclose' => true,
            'todayHighlight' => true,
            'startDate' => date('Y-m-d H:')
        ]
    ]); ?>
    <?=$form->field($model, 'total_hours')->textInput(['maxlength' => true]) ?>
    <?=$form->field($model, 'hours')->textInput(['maxlength' => true])->label('每节课时')?>
    <?= $form->field($model, 'teacher_money')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success disabl' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    $('.disabl').click(function(){
        alert('数据校验中。。。');
    })
</script>