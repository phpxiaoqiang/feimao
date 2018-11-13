<?php

/**
 * @Author: jiangyang
 * @Date:   2018-01-15 18:36:58
 * @Last Modified by:   jiangyang
 * @Last Modified time: 2018-01-23 18:52:58
 */
$this->title = '优惠券';
use yii\widgets\LinkPager;
?>
<?php if(empty($isTrue)):?>
<div class="container">
    <div class="coupons">
        <a href=""><img src="/media/img/chicyuanzui2.png" alt="" class="coupon-img"></a>
    </div>
    <div class="bar-wrap" style="margin-top: 70px"><div class="bar inbar" style="margin-bottom: 0">活动优惠券</div></div>
    <div class="get-coupon red open-modal">
        <span>点击领取</span>
        <div class="in"><span>免费咨询优惠券</span></div>
    </div>
</div>
<?php else: ?>
<div class="container">
    <div class="coupons">
        <a href=""><img src="/media/img/chicyuanzui2.png" alt="" class="coupon-img"></a>
    </div>
    <div class="bar-wrap" style="margin-top: 70px"><div class="bar inbar" style="margin-bottom: 0">活动优惠券</div></div>
    <!-- <a href=""> -->
        <div class="get-coupon black">
            <span>已领取</span>
            <div class="in"><span>免费咨询优惠券</span></div>
        </div>
    <!-- </a> -->
</div>
<?php endif ?>
<div class="form-modal">
    <div class="modal-box">
        <span class="btn-close"></span>
        <div class="t-title">领取优惠券</div>
        <div class="form-info">
            <p class="coupon-tip">已成功领取优惠券</p>
        </div>
        <a href="/"><button class="btn-black">去首页(<span id="time">6</span>秒)</button></a>
    </div>
</div>
<?php if(!empty($isTrue)):?>
<a href="/" style="display: block; margin: 0 20px;text-align: center;padding: 10px; border: 1px solid #E9E9E9; border-radius: 2px;position: fixed; bottom: 14px; left: 0; right: 0;color: #000000; font-size: 16px">立即使用</a>
<?php endif ?>
<script>

    var timeDown;
    $('.open-modal').on('click', function() {
        var id = <?=Yii::$app->user->id;?>;
        // var id=35;
        $.post("/coupons/receive",{id:id},function(result){
            if (result =='1'){
                $('.form-modal').fadeIn();
                var time_total = $('#time').text();
                timeDown = setInterval(function() {
                    time_total--
                    $('#time').html(time_total);
                    if(time_total <= 0) {
                        window.location.href = '/'
                        clearInterval(timeDown)
                    }
                }, 1000)    
            }else if(result =='2'){
                alert('优惠券以领取完毕');
            }else if(result =='4'){
                alert('您已拥有优惠券');
            }else{
                alert('活动时间已过期');
            }
            
      });
    
    });
    $('.btn-close').on('click', function() {
      $('.form-modal').fadeOut();
    });
</script>
