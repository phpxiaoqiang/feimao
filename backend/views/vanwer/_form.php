
<?php

use yii\helpers\Html; 
use yii\widgets\ActiveForm; 

/* @var $this yii\web\View */ 
/* @var $model common\models\Vanswer */ 
/* @var $form yii\widgets\ActiveForm */ 
?> 

<div class="vanswer-form"> 
   <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'introduce')->textInput(['maxlength' => true]) ?>
    <?php if (!empty($model->pic)) { ?>
        <div class="form-group field-media-pic required has-error">
            <label class="control-label" for="media-pic">大V展示图</label>
            <input type="file" id="media-pic" name="Vanswer[pic]" aria-required="true" aria-invalid="true">
            <img src="<?= $model->pic; ?>" style="max-width: 200px;display: block; margin: 15px 0;"/>
        </div>
    <?php } else { ?>
        <?= $form->field($model, 'pic')->fileInput()->label('大V展示图') ?>
    <?php } ?>
    <?php if (!empty($model->small_pic)) { ?>
        <div class="form-group field-media-pic required has-error">
            <label class="control-label" for="media-pic">大V头像</label>
            <input type="file" id="media-pic" name="Vanswer[small_pic]" aria-required="true" aria-invalid="true">
            <img src="<?= $model->small_pic; ?>" style="max-width: 200px;display: block; margin: 15px 0;"/>
        </div>
    <?php } else { ?>
        <?= $form->field($model, 'small_pic')->fileInput()->label('大V头像') ?>
    <?php } ?>
    <?= $form->field($model, 'sort')->textInput() ?>
    <?= $form->field($model, 'cou_id')->textInput() ?>
   
    <?= $form->field($model, 'state')->radioList(['1' => '正常', '0' => '隐藏']) ?>


    <div class="form-group"> 
        <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?> 
    </div> 

    <?php ActiveForm::end(); ?> 

</div> 