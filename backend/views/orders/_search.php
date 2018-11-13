
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\OrdersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'oid') ?>

    <?= $form->field($model, 'uid') ?>

    <?= $form->field($model, 'username') ?>

    <?php // echo $form->field($model, 'age') ?>

    <?php // echo $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'cid') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'sid') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'describe') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'pay_at') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>