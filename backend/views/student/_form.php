<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use common\models\Post;
use yii\helpers\ArrayHelper;
use common\models\Card;
use common\models\YrClass;

$counselorData = Post::find()->all();
$allCounselor = ArrayHelper::map($counselorData,'id','title');


$data = Card::find()->all();
$set = ArrayHelper::map($data,'id','name');

//var_dump($model->card_type);die;
if (!empty($model->card_type)){
    $card = Card::find()->where(['id'=>$model->card_type])->one();
    $hours =  $card->hours.'金额:'.$card->money.'元';
}else{
    $hours ='';
}

// $yrClass = YrClass::find()->all();
// $setclass = ArrayHelper::map($yrClass,'id','name');


/* @var $this yii\web\View */
/* @var $model common\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-form">


    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sex')->radioList(['1'=>'男','0'=>'女'])->label('性别')  ?>

    <?= $form->field($model, 'age')->textInput() ?>

    <?= $form->field($model, 'parent_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_tel')->textInput() ?>

    <?= $form->field($model, 'school')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'p_id')->textInput() ?>

    <!-- <?//= $form->field($model, 'card_type')->textInput() ?> -->

    <!-- <?//=$form->field($model, 'subscribe_class')->dropDownList($allCounselor,['prompt'=>'请选择预约课程'])->label('预约课程');?> -->
    <?=$form->field($model, 'card_type')->dropDownList($set,['prompt'=>'请选择卡类型'])->label('卡类型');?>

    <span><h4>课时:<span id="class"><?=$hours?></span></h4></span>
 

    <!-- <?//= $form->field($model, 'subscribe_class')->textInput() ?> -->

     <!-- <?//= $form->field($model, 'subscribe_mark')->textInput(['maxlength' => true]) ?> -->

    <!-- <?//= $form->field($model, 'subscribe_time')->textInput() ?> -->
   <!--   <?//= $form->field($model, 'subscribe_time')->widget(DateTimePicker::classname(), [ 
//        'options' => ['placeholder' => ''],
//        'pluginOptions' => [
//            'autoclose' => true,
//            'todayHighlight' => true,
//            'startDate' => date('Y-m-d H:')
//        ]
//    ]); ?> -->
    <!-- <?//= $form->field($model, 'is_binding')->textInput() ?> -->
    <!-- <?//= $form->field($model, 'is_binding')->radioList(['1'=>'男','0'=>'女'])->label('是否')  ?> -->

    <?= $form->field($model, 'mark')->textInput(['maxlength' => true]) ?>

    <!-- <?//= $form->field($model, 'create_at')->textInput() ?> -->

    <!-- <?//= $form->field($model, 'update_at')->textInput() ?> -->

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
<script>
    $(function(){
        $("#student-card_type").change(function(){
           var type = $("#student-card_type").val();//方法一：获取select标签选中的option中的value的值。
            $.get("/studentxclass/cardstauts",{type:type},function(data){
                $("#class").html(data);
                // alert("Data: " + data + "nStatus: " + status);
            });

        });

 
        //将复选框的值传入隐藏域
        // $('form').submit(function() {
        //     var a = '';
        //     $("input[type=checkbox]:checked").each(function() {
        //         a += $(this).val();
        //     });
        //     $('input[type=hidden]').val(a);
        // });

    })
</script>