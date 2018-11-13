<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Teacher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teacher-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 't_id')->textInput(['maxlength' => true]) ?>
    <?php if(!empty($model->pic)){?>
    <div class="form-group field-media-pic required has-error">
        <label class="control-label" for="media-pic">头像</label>
        <input type="file" name="Teacher[pic]">
        <img src="<?=$model->pic;?>"style="max-width: 100%;display: block; margin: 15px 0;"/>
    </div>
    <?php }else{?>
    <?= $form->field($model, 'pic')->fileInput()->label('头像')  ?>
    <?php }?>
    <?= $form->field($model, 'sex')->radioList(['1'=>'男','0'=>'女'])->label('性别')  ?>
    <?= $form->field($model, 'is_ob')->radioList(['1'=>'在职','0'=>'离职'])->label('是否在职')  ?>
    <?= $form->field($model, 'age')->textInput() ?>

    <?= $form->field($model, 'major')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mark')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success disabl' : 'btn btn-primary'],['data-loading-text' => '正在提交数据, 不让你点，哼']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    $('.disabl').click(function(){
        alert('数据校验中。。。');
    })
</script>