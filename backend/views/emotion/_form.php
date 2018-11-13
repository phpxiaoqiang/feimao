<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Emotion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="emotion-form">
  <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'pic')->textInput(['maxlength' => true]) ?>
    <?php if(!empty($model->pic)){?>
        <div class="form-group field-media-pic">
            <label class="control-label" for="media-pic">情感包图片</label>
            <input type="file" name="Emotion[pic]">
            <img src="<?=$model->pic;?>"style="max-width: 100%;display: block; margin: 15px 0;"/>
        </div>
    <?php }else{?>
        <?= $form->field($model, 'pic')->fileInput()  ?>
    <?php }?>
    <?= $form->field($model, 'sort')->textInput() ?>
    <?= $form->field($model, 'state')->radioList(['1'=>'正常','0'=>'隐藏'])->label('状态')  ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
