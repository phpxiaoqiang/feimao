
<?php

use yii\helpers\Html; 

/* @var $this yii\web\View */ 
/* @var $model common\models\Vanswer */ 

$this->title = '修改大V: ' . $model->name; 
$this->params['breadcrumbs'][] = ['label' => '大V列表', 'url' => ['index']]; 
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]]; 
$this->params['breadcrumbs'][] = 'Update'; 
?> 
<div class="vanswer-update"> 

    <h1><?= Html::encode($this->title) ?></h1> 

    <?= $this->render('_form', [ 
        'model' => $model, 
    ]) ?> 

</div> 