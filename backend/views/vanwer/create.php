<?php

use yii\helpers\Html; 


/* @var $this yii\web\View */ 
/* @var $model common\models\Vanswer */ 

$this->title = '新增大V'; 
$this->params['breadcrumbs'][] = ['label' => '大V列表', 'url' => ['index']]; 
$this->params['breadcrumbs'][] = $this->title; 
?> 
<div class="vanswer-create"> 

    <h1><?= Html::encode($this->title) ?></h1> 

    <?= $this->render('_form', [ 
        'model' => $model, 
    ]) ?> 

</div> 