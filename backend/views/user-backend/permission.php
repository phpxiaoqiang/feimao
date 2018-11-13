<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '添加权限';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-permission">
    <div class="row">
        <?php $form = ActiveForm::begin(['id'=>'form-permission','action'=>[Yii::$app->request->url],'method'=>'post']);?>
        <?= $form->field($model,'item_name')->checkboxList($data)?>
        <div class="form-group">
             <?= Html::submitButton('添加',['class'=>'btn btn-primary','name'=>'permission-button'])?>
        </div>
        <?php ActiveForm::end()?>
    </div>
</div>
