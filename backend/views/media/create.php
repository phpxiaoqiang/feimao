<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Media */

$this->title = '添加音视频';
$this->params['breadcrumbs'][] = ['label' => '媒体列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
use common\models\Qiniu;
$qiniu = new Qiniu();
$token = $qiniu->uploadToken();
?>
<div class="media-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'token' => $token
    ]) ?>

</div>
