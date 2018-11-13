<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Media */

$this->title = '修改: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '媒体列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改音视频';
use common\models\Qiniu;
$qiniu = new Qiniu();
$token = $qiniu->uploadToken();
?>
<div class="media-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'token' => $token
    ]) ?>

</div>
