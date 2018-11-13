<?php
//ini_set("error_reporting","E_ALL & ~E_NOTICE");
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Label;
$data = Label::find()->where(['c_id' => $model->id])->asArray()->all();

/* @var $this yii\web\View */
/* @var $model common\models\Counselor */
/* @var $form yii\widgets\ActiveForm */

    $category = \common\models\Category::find()->all();
    $allCategory = ArrayHelper::map($category,'id','name');
//    var_dump($allCategory);
//    die;
?>

<div class="counselor-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?php if(!empty($model->avatar)){?>
        <div class="form-group field-media-pic">
            <label class="control-label" for="media-pic">头像</label>
            <input type="file" name="Counselor[avatar]">
            <img src="<?=$model->avatar;?>"style="max-width: 100%;display: block; margin: 15px 0;"/>
        </div>
    <?php }else{?>
        <?= $form->field($model, 'avatar')->fileInput()  ?>
    <?php }?>
    <?php if(!empty($model->photo)){?>
        <div class="form-group field-media-pic">
            <label class="control-label" for="media-pic">详情写真图</label>
            <input type="file" name="Counselor[photo]">
            <img src="<?=$model->photo;?>"style="max-width: 100%;display: block; margin: 15px 0;"/>
        </div>
    <?php }else{?>
        <?= $form->field($model, 'photo')->fileInput()  ?>
    <?php }?>
    <div class="form-group field-counselor-desc has-success">
        <label class="control-label" for="counselor-desc">咨询师标签</label>
        <input type="text" id="counselor-desc" class="form-control" name="Counselor[label]" placeholder="请用英文逗号分割，例如:情感,两性" maxlength="500" aria-invalid="false">

        <div class="help-block"></div>
    </div>
    <?php if(!empty($data)){?>
    <div class="form-group field-counselor-desc has-success">
        <label class="control-label" for="counselor-desc">已有标签</label>
        <table  class="table table-hover">
            <?php for ($i=0;$i<count($data);$i++){?>
              <tr class="<?=$data[$i]["id"];?>">
                  <td ><?=$data[$i]["name"];?></td>
                  <td onclick="del(<?=$data[$i]["id"];?>);">  <button type="button" class="btn btn-default">删除</button></td>
              </tr>
            <?php }?>
        </table>

        <div class="help-block"></div>
    </div>
    <?php }?>
    <?= $form->field($model, 'desc')->textInput(['maxlength' => true]) ?>

    <div class="form-group field-counselor-subscribe_price required required">
        <label class="control-label" for="counselor-subscribe_price">文字金额(元)</label>
        <input type="text" id="counselor-subscribe_price" class="form-control" name="Counselor[subscribe_price]" value="<?=$model->subscribe_price/100?>" aria-required="true" aria-invalid="false">

        <div class="help-block"></div>
    </div>
    <div class="form-group field-counselor-subscribe_voice_price required">
        <label class="control-label" for="counselor-subscribe_voice_price">语音金额(元)</label>
        <input type="text" id="counselor-subscribe_voice_price" class="form-control" name="Counselor[subscribe_voice_price]" value="<?=$model->subscribe_voice_price/100?>" aria-required="true">

        <div class="help-block"></div>
    </div>
    <?= $form->field($model, 'category_id')->dropDownList($allCategory,['prompt'=>'请选择分类']) ?>

    <?= $form->field($model, 'state')->radioList(['1'=>'正常','0'=>'隐藏'])->label('状态')  ?>
    <?= $form->field($model, 'sort')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'uid')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    function del(id){
        $.get('/counselor/detlabel',{id:id},function(data){
            $("."+id).hide();
        });
    }
</script>