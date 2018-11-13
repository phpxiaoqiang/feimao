<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Post;
use common\models\Card;
use common\models\Studentxclass;
use common\models\Yrclass;
/* @var $this yii\web\View */
/* @var $model common\models\Student */
//function postitle($sub_class){
//        $post = Post::model()->where(['id'=>$sub_class])->one();
//        return $post->title;
// }
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '学生管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
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
            'name',
            [
                'attribute' => 'sex',
                'value' => function($model) {
                    return $model->sex == 1 ? '男' : '女';
                },
            ],
            'age',
            'parent_name',
            'parent_tel',
            'school',
//            'card_type',
            [
                'attribute' => 'card_type',
                'value' => function($model) {
                    if(!empty($model->card_type)){
                        $card = Card::find()->where(['id' => $model->card_type])->one();
                        return '类型:' . $card->name . '  课时：' . $card->hours . '  金额：' . $card->money.' 元';
                    }else{
                        return '无卡类型';
                    }

//                    return $model->sex == 1 ? '男' : '女';
                },
            ],
            'class'=>[
                'label'=>"班级",
                'value'=>function($model){
                    $id = $model->id;
                    $classes = Studentxclass::find()->where(['s_id'=>$id])->asArray()->all();
                    $str = '';
                    foreach($classes as $name){
                        $b = Yrclass::find()->where(['id'=>$name["c_id"]])->one();
                        if( !empty($b) ){
                            $str = $str.$b["name"].'/';
                        }
                    }
                    return $str;
                }
            ],
//            [
//                    'attribute'=>'subscribe_class',
//                    'value'=> postitle($model->subscribe_class)
//            ],

//            [
//                'attribute' => 'subscribe_class',
//                'value' => function($model) {
//                    $state = [
//                        '1' => '幼儿舞蹈启蒙',
//                        '3' => '少儿中国舞',
//                        '4' => '民族，民间舞',
//                        '5'=>  'JAZZ,HIPOP',
//                        '6'=>'拉丁舞',
//                        '7'=>'芭蕾舞'
//                    ];
//                    return $state[$model->subscribe_class];
//
//                },
//            ],
//            'subscribe_class',

//            'is_binding',
//            [
//                'attribute' => 'is_binding',
//                'value' => function($model) {
//                    return $model->sex == 1 ? '关注' : '未关注';
//                },
//            ],
            'mark',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
