<?php
use common\models\Subscribeclass;
use common\models\Post;
use common\models\Teacher;
$id = $_GET['id'];

$post = Post::find()->where(['id'=>$id])->one();
$pid = Yii::$app->user->id;
//$pid = 35;
$is_exist= Teacher::find()->where(['t_id'=>$pid])->exists();
$model = Subscribeclass::find()->where(['p_id'=>$pid,'dance'=>$post->counselor_id])->exists();
//var_dump($post);die;


?>
<div class="container mt30">
    <h3 class="t-title"><?= $post['title'] ?></h3>

<!--    <img src="/media/img/dog.19708c25.jpg" alt="">-->
<!--    <p>-->
<!--        咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师介咨询师简介咨询师简介咨询师简介咨询师简介咨询师......-->
<!--    </p>-->
<!--    <img src="/media/img/dog.19708c25.jpg" alt="">-->
<!--    <p>-->
<!--        咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师介咨询师简介咨询师简介咨询师简介咨询师简介咨询师......-->
<!--    </p>-->
<!--    <img src="/media/img/dog.19708c25.jpg" alt="">-->
<!--    <p>-->
<!--        咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师简介咨询师介咨询师简介咨询师简介咨询师简介咨询师简介咨询师......-->
<!--    </p>-->
    <div class="page-content pb60">
        <?= $post['content'] ?>
    </div>
    <?php if(!$is_exist){?>
    <?php if(!$model){?>
    <a href="/index/bespeak?id=<?=$_GET['id']?>" class="btn-order-red">立即预约</a>
    <?php }else{?>
        <a href="/" class="btn-order-red">已预约此舞种，老师马上联系您</a>
    <?php }?>
    <?php }?>
</div>