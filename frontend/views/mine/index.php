<?php
$this->title = '个人中心';
?>
<div class="container mt30">
    <div class="t-title">我的主页</div>

    <div class="mine-box">
        <div class="img"><img src="<?= Yii::$app->user->identity->headimgurl ?>" alt=""></div>
        <h3>用户昵称：<?= Yii::$app->user->identity->nickname ?></h3>
        <h3>用户ID: <?=Yii::$app->user->id;?></h3>

    </div>

    <!-- <a href="/order/index">
        <div class="mine-link">
            <span style="color: #333;">我的订单</span>
        </div>
    </a>

    <a href="/mine/subscribe">
        <div class="mine-link">
            <span style="color: #333;">我的预约</span>
        </div>
    </a> -->
    <?php if($is_teacher){?>
        <a href="/order/index?id=teacher">
            <div class="mine-order-item-s">
                <span>我的课程</span>
            </div>
        </a>
    <?php }else{?>

        <a href="/order/index?id=student">
            <div class="mine-order-item-s">
                <span>宝贝课程</span>
            </div>
        </a>
    <?php }?>
<!--    <a href="/mine/subscribe">-->
<!--        <div class="mine-order-item-s">-->
<!--            <span>我的预约</span>-->
<!--        </div>-->
<!--    </a>-->
<!--    <a href="/coupons/coupons">-->
<!--        <div class="mine-order-item-s">-->
<!--            <span>我的优惠券</span>-->
<!--        </div>-->
<!--    </a>-->

    <a href="tel:13717718050" style="display: block; margin: 0 20px;text-align: center;padding: 10px; border: 1px solid #E9E9E9; border-radius: 2px;position: fixed; bottom: 14px; left: 0; right: 0;color: #484848; font-size: 16px">拨打客服热线</a>
    
</div>
