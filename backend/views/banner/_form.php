<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Banner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('标题')  ?>
    <?= $form->field($model, 'subtitle')->textInput(['maxlength' => true])->label('子标题')  ?>
    <?php if(!empty($model->pic)){?>
        <div class="form-group field-media-pic required has-error">
            <label class="control-label" for="media-pic">展示图</label>
            <input type="file" name="Banner[pic]">
            <img src="<?=$model->pic;?>"style="max-width: 100%;display: block; margin: 15px 0;"/>
        </div>
    <?php }else{?>
        <?= $form->field($model, 'pic')->fileInput()->label('展示图')  ?>
    <?php }?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true])->label('链接')  ?>

    <?= $form->field($model, 'sort')->textInput()->label('排序')  ?>

    <?= $form->field($model, 'state')->radioList(['1'=>'正常','0'=>'隐藏'])->label('状态')  ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
