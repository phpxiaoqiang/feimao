<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Post;
use yii\helpers\ArrayHelper;
use common\models\Card;
use common\models\YrClass;
use common\models\OpenCard;
use kartik\datetime\DateTimePicker;
$data = Yrclass::find()->all();
$set = ArrayHelper::map($data,'id','name');
// $data1 = OpenCard::find()->all();
// $set1 = ArrayHelper::map($data1,'created_at','created_at');

 // dd($set);
 ?>

<div class="card-form">
	<?php $form = ActiveForm::begin([ 
		'action' => ['sel'], 
		'method'=>'post', ])
		?>
    <?=$form->field($class, 'name')->dropDownList($set,['prompt'=>'请选择班级'])->label('班级');?>
    <div class="form-group">
        <!--<label>打卡时间</label><br/>-->
        <?= $form->field($class, 'start_time')->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => '选择打卡时间'],
            'pluginOptions' => [
                'autoclose' => true,
                'todayHighlight' => true,
                'startDate' => date('Y-m-d H')
            ]
        ])->label('打卡时间'); ?>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton('进入打卡', ['class' => 'btn btn-success']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>
    

</div>
<!--<script>
var options = $("#classtime").html();
$("#yrclass-name").bind("change",function(){
    $("#classtime").html(options);
    val = $(this).val()
    $("#classtime").html($("#classtime option[value="+val+"]"))
})
</script>-->
