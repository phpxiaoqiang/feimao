<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Post;
use common\models\Category;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */

    $counselorData = Category::find()->all();
    $allCounselor = ArrayHelper::map($counselorData,'id','name');
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?php if(!empty($model->pic)){?>
        <div class="form-group field-media-pic required has-error">
            <label class="control-label" for="media-pic">展示图</label>
            <input type="file" name="Post[pic]">
            <img src="<?=$model->pic;?>"style="max-width: 100%;display: block; margin: 15px 0;"/>
        </div>
    <?php }else{?>
        <?= $form->field($model, 'pic')->fileInput()->label('展示图')  ?>
    <?php }?>
    <?= $form->field($model, 'desc')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'content')->widget(\yii\redactor\widgets\Redactor::className())->label('文章内容')?>


    <?=$form->field($model, 'counselor_id')->dropDownList($allCounselor,['prompt'=>'请选择分类'])->label('课程分类');?>

    <?= $form->field($model, 'sort')->textInput()->label('排序'); ?>
    <?= $form->field($model, 'state')->radioList(['1'=>'是','0'=>'否'])->label('是否上架')  ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '提交' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
