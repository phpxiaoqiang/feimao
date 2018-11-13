<?php

$this->title = '预约咨询师';

?>
<style>
    .s_price {
        background: none;
        border: none !important;
        outline: none;
    }
    .submit-modal {
        background: rgba(0, 0, 0, .8);
        color: #fff;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: -1;
        text-align: center;
        display: none;
    }
    .submit-modal.active {
        z-index: 9999;
        display: block;
    }
    .submit-modal span {
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        -webkit-transform: translateY(-50%);
        -moz-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        -o-transform: translateY(-50%);
        transform: translateY(-50%);
    }
</style>
<div class="pb60">
    <div class="xuzhi">
        <div class="container">
            <h3>咨询须知 <span class="en"></span><span class="down-arrow"></span></h3>
            <ul class="xuzhi_item">
                <li>1、本咨询产品需提前12小时预约</li>
                <li>2、预约成功后6小时以内可随时退款</li>
                <li>3、预约成功后6小时以外如需退款请联系客服人员</li>
            </ul>
        </div>
    </div>
    <div class="container mt30">
        <form action="/wxpay/index" method="get" id="myForm" name="myForm">
            <div class="t-title"><?= $data['name'] ?></div>

            <div class="a-info-t">
                <div class="img"><img src="<?= $data['avatar'] ?>" alt=""></div>
                <div class="a-info-r">
                    <h4>咨询方式</h4>
                    <p>每60分钟一次</p>
                </div>
            </div>

            <div class="order-info-2">
                <div class="order-info-item">
                    <input type="radio" name="order-type" id="text" value="1"
                           data-price="<?= $data['subscribe_price'] / 100 ?>" checked>
                    <label for="text">
                        <strong>文字咨询</strong>
                        <span><?= $data['subscribe_price'] / 100 ?> 元/次</span>
                    </label>
                </div>
               <!--  <div class="order-info-item">
                    <input type="radio" name="order-type" id="audio" value="2"
                           data-price="<?//= $data['subscribe_voice_price'] / 100 ?>">
                    <label for="audio">
                        <strong>语音咨询</strong>
                        <span><?//= $data['subscribe_voice_price'] / 100 ?> 元/次</span>
                    </label>
                </div> -->
            </div>

            <div class="order-form">
                <select name="sid" id="" class="order-form-select">
                    <option value="">预约时间（已提前12小时）</option>

                    <?php foreach ($subscribe as $item): ?>
                        <option value="<?= $item['id'] ?>"><?= substr($item['subscribe_startTime'], 2); ?>
                            - <?= substr($item['subscribe_endTime'], 2); ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="order-info-list">
                    <div class="order-form-item">
                        <span class="o-l">金额</span>
                        <span class="o-r"><input type="text" class="s_price" id="price" name="price" readonly> 元</span>
                    </div>
                    <div class="order-form-item open_coupon coupon-arrow-item">
                        <span class="o-l">优惠券</span>
                        <input type="hidden" name="coupon" id="coupon" value="0">
                        <?php if ($coupon): ?>
                            <span class="o-r coupon-select">未选择优惠券</span>
                        <?php else: ?>
                            <span class="o-r coupon-select">无优惠券</span>
                        <?php endif; ?>
                    </div>
                    <div class="order-form-item">
                        <span class="o-l">基本资料（仅专家可见）</span>
                    </div>
                    <div class="order-form-item">
                        <span class="o-l">你的称呼</span>
                        <div class="o-r"><input type="text" name="username" maxlength="32"></div>
                    </div>
                    <div class="order-form-item">
                        <span class="o-l">年龄</span>
                        <!-- <span class="o-r"><input type="number" name="age"></span> -->
                        <span class="o-r"><select name="age" id="age" class="order-form-select"></select></span>
                    </div>
                    <div class="order-form-item">
                        <span class="o-l">性别</span>
                        <div class="sex-radio o-r">
                            <input type="radio" name="sex" id="male" value="1" checked><label for="male">男</label>
                            <input type="radio" name="sex" id="female" value="2"><label for="female">女</label>
                        </div>
                    </div>
                    <div class="order-form-item">
                        <span class="o-l">联系方式</span>
                        <div class="o-r"><input type="number" name="phone" id="phone" maxlength="32"></div>
                    </div>
                </div>
                <div class="form-textarea">
                    <h4>问题描述（仅专家可见）</h4>
                    <div class="text-area">
                        <textarea name="describe" id="comment_text" placeholder="请描述您需要咨询的内容..."></textarea>
                        <div class="num"><span id="text_num">0</span>/50</div>
                    </div>
                </div>
                <div class="agree">
                    <span class="check-icon active"></span><a href="/counselor/agreement">同意《心理咨询预约协议》</a>
                </div>
            </div>
            <input type="hidden" name="cid" value="<?= Yii::$app->request->get('id') ?>">
        </form>
        <button class="finish-btn submit">完成</button>
    </div>
    <div class="coupon-modal">
        <div class="modal-bg"></div>
        <div class="coupon-panel">
            <div class="title">
                <h3>选择优惠券</h3>
                <span class="close_modal close-modal">关闭</span>
            </div>
            <div class="coupon-container">
                <?php if ($coupon): ?>
                    <div class="coupon-modal-item" data-coupon="1"><span>免费咨询优惠券</span><span class="small">（全场）</span>
                    </div>
                    <div class="coupon-modal-item" data-coupon="0"><span>不使用优惠券</span></div>
                <?php else: ?>
                    <div class="coupon-modal-item select"><span>不使用优惠券</span></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="submit-modal">
        <span>正在提交订单....</span>
    </div>
</div>
<style>
    .form-textarea .text-area .num {
        position: absolute;
        bottom: 10px;
        right: 10px;
        font-size: 14px;
        color: #b1b1b1;
        font-weight: 300;
        height: 16px;
        line-height: 16px
    }
</style>
<script>
    $(function () {
        var coupon = <?= $coupon ? '1' : '0'; ?>;
        function handlePrice() {
            var price = $('input:radio[name="order-type"]:checked').attr('data-price');
            $('.s_price').val(price)
        }

        $('input:radio[name="order-type"]').on('change', function () {
            handlePrice();
            if(coupon && $('#coupon').val() == 1){
                $('.coupon-select').addClass('active').text('共优惠'+$('#price').val()+'元')
            }
        })

        handlePrice();

        $('.agree').on('click', function () {
            $(this).children('.check-icon').toggleClass('active')
        });

        $('.finish-btn').on('click', function () {
            $('.form-modal').fadeIn();
        });
        $('.btn-close').on('click', function () {
            $('.form-modal').fadeOut();
        });

        var ages = $('#age').children('option')
        for (var i = 1; i <= 100; i++) {
            $('#age').append('<option>' + i + '</option>')
        }

        $('.submit').on('click', function () {
            if (!$('input:radio[name="order-type"]').val()) {
                alert('请选择咨询方式')
                return false;
            }
            if (!$('select[name="sid"]').val()) {
                alert('请选择预约时间')
                return false;
            }

            if (!$('input[name="username"]').val()) {
                alert('请填写您的称呼')
                return false;
            }

            if (!$('input[name="phone"]').val()) {
                alert('请填写您的联系方式')
                return false;
            }

//            if (!$('select[name="age"]').val()) {
//                alert('请填写您的年龄')
//                return false;
//            }

            if (!$('input:radio[name="sex"]').val()) {
                alert('请选择您的性别')
                return false;
            }

            if (!$('textarea[name="describe"]').val()) {
                alert('请输入您要咨询的问题')
                return false;
            }

            // $('input[name="age"]').change(function() {
            //     var age = $(this).val()
            //     if(age < 1 || age > 100) {
            //         alert('请输入正确的年龄')
            //         return false
            //     }
            // })
            var sMobile = document.myForm.phone.value
            if (!(/^1[3|4|5|7|8][0-9]\d{4,8}$/.test(sMobile))) {
                alert("不是完整的11位手机号或者正确的手机号前七位");
                return false;
            }

            $(this).attr({'disabled': 'disabled'})
            $('.submit-modal').addClass('active')
            $('#myForm').submit();
        })

        $('#comment_text').on('propertychange input', function () {
            var $this = $(this),
                _val = $this.val(),
                count = ""
            if (_val.length > 50) {
                $this.val(_val.substring(0, 50))
            }
            count = 50 - $this.val().length;
            $("#text_num").text(count);
        })

        $('.xuzhi').on('click', function () {
            $('.xuzhi_item').slideToggle()
            $('.down-arrow').toggleClass('active');
        })

        $('.open_coupon').on('click', function () {
            $('.coupon-modal').addClass('active')
        })
        $('.close_modal').on('click', function () {
            $('.coupon-modal').removeClass('active')
        })
        $('.coupon-modal-item').on('click', function () {
//            console.log($(this).data('coupon'))
            $('#coupon').val($(this).data('coupon'))
            $('.coupon-modal').removeClass('active')
            if($(this).data('coupon')){
                $('.coupon-select').addClass('active').text('共优惠'+$('#price').val()+'元')
            }else{
                if(coupon){
                    $('.coupon-select').removeClass('active').text('未选择优惠券')
                }else{
                    $('.coupon-select').removeClass('active').text('无优惠券')
                }
            }


            $(this).addClass('select').siblings('.coupon-modal-item').removeClass('select');
        })
    })
</script>