
<?php

use yii\helpers\Html; 
use yii\widgets\ActiveForm; 

/* @var $this yii\web\View */ 
/* @var $model common\models\VanwerSearch */ 
/* @var $form yii\widgets\ActiveForm */ 
?> 

<div class="vanswer-search"> 

    <?php $form = ActiveForm::begin([ 
        'action' => ['index'], 
        'method' => 'get', 
    ]); ?> 

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'introduce') ?>

    <?= $form->field($model, 'state') ?>

    <?= $form->field($model, 'sort') ?>

    <?php // echo $form->field($model, 'pic') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group"> 
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?> 
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?> 
    </div> 

    <?php ActiveForm::end(); ?> 

</div> 