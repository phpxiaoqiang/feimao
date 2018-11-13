<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Subscribeclass */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Subscribeclasses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscribeclass-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'class_name',
            'dance',
            'created_at',
            'updated_at',
            'tel',
            'subscribe_mark',
            'p_name',
            's_name',
            'p_id',
            'cid',
        ],
    ]) ?>

</div>
