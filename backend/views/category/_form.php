    <?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">


    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('名称')  ?>
    <?= $form->field($model, 'subname')->textInput(['maxlength' => true])->label('子标题')  ?>
    <?php if(!empty($model->pic)){?>
        <div class="form-group field-category-pic">
            <label class="control-label" for="media-pic">分类图标</label>
            <input type="file" id="media-pic" name="Category[pic]" aria-required="true" aria-invalid="true">
            <img src="<?=$model->pic;?>" style="max-width: 100%;display: block; margin: 15px 0;"/>
        </div>
    <?php }else{?>
        <?= $form->field($model, 'pic')->fileInput()->label('分类图标')  ?>
    <?php }?>
    <?= $form->field($model, 'sort')->textInput()->label('排序') ?>

    <?= $form->field($model, 'state')->radioList(['1'=>'正常','0'=>'隐藏'])->label('状态') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
