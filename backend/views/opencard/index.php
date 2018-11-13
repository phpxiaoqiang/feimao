<?php
use yii\helpers\Html;
use yii\grid\GridView;

use common\models\Yrclass;
if($_GET['start'] && $_GET['end']){
    $start = $_GET['start'];
    $end = $_GET['end'];
}else{
    $tody = strtotime(date("Y-m-d"),time());
//var_dump($tody);die;
    $this->title = '打卡管理';
    $start = date('Y-m-d H:i:s',$tody);
    $end = date('Y-m-d H:i:s',time());
}

 ?>
<style>
    .demo-input {
        padding-left: 10px;
        height: 38px;
        min-width: 262px;
        line-height: 38px;
        border: 1px solid #e6e6e6;
        background-color: #fff;
        border-radius: 2px;
    }

    #preview {
        height: 38px;
        padding: 0 20px;
        line-height: 38px;
        border: 1px solid #e6e6e6;
        background-color: #fff;
        border-radius: 2px;
    }

    .del_time {
        height: 38px;
        padding: 0 20px;
        line-height: 38px;
        border: 1px solid #e6e6e6;
        background-color: #fff;
        border-radius: 2px;
    }

    #save {
        height: 38px;
        padding: 0 20px;
        line-height: 38px;
        background-color: #009688;
        color: #fff;
        border: none;
        display: none;
    }
</style>
 <div>
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
         <?= Html::a('添加打卡//删除打卡', ['add'], ['class' => 'btn btn-success']) ?>
<!--         <div class="input-append date" id="datetimepicker" data-date="12-02-2012" data-date-format="dd-mm-yyyy">-->
<!--             <input class="span2" size="16" type="text" value="12-02-2012">-->
<!--             <span class="add-on"><i class="icon-th"></i></span>-->
<!--         </div>-->

     <?//= Html::a('导出Excel', ['excel'], ['class' => 'btn btn-info']) ?>
<!--     <a class="btn btn-info" href="/opencard/excel">导出Excel</a>-->
    </p>
<!--     <div class="subscribe-create">-->
<!--         <form action="/opencard/excel" method="get">-->
         打卡开始时间：<input type="text" class="demo-input" id="test1" name="start" value="<?=$start;?>">
         打卡结束时间：<input type="text" class="demo-input" id="end_time"  name="end" value="<?=$end;?>">
<!--             <input type="submit" class="btn btn-info" value="导出EXCEL">-->
<!--         </form>-->
<!--     </div>-->

        <input type="button" class="btn btn-info" value="查询当前数据" onclick="nowDate();">
        <input type="button" class="btn btn-info" value="导出EXCEL" onclick="nowexcel();">

     <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            // 'id',
            ['label'=>'编号','value' => 'id'],
            [
                'attribute' => '身份',
                'value' => function($model) {
                    return $model->identity == 1 ? '老师' : '学生';
                },
            ],
            ['label'=>'姓名','value' =>  'name'],
            ['label'=>'班级','value' =>  function($model){
                   return Yrclass::find()->where(['id'=>$model->c_id])->one()['name'];
            }],
            ['label'=>'打卡时间','value' => 'push_time'],
            ['label'=>'打卡人','value' => 'punch'],
            ['label'=>'本次消费课时','value' => 'class_time'],
            ['label'=>'创建时间','value' => 'created_at'],
            ['label'=>'更新时间','value' => 'updated_at'],
        ],
    ]);?>
    
 </div>
<script>

    laydate.render({
        elem: '#test1'
        ,type: 'datetime'
        // ,range: '到'
        // ,format: 'yyyy年M月d日H时m分s秒'
    });
    laydate.render({
        elem: '#end_time'
        ,type: 'datetime'
        // ,range: '到'
        // ,format: 'yyyy年M月d日H时m分s秒'
    });

    function nowexcel(){
        var start = $('#test1').val();
        var end = $('#end_time').val();
        window.location.href = '/opencard/excel?dates=new&start='+start+'&end='+end;
    }
    function nowDate(){
        var start = $('#test1').val();
        var end = $('#end_time').val();
        window.location.href = '/opencard/index?start='+start+'&end='+end;
    }
</script>