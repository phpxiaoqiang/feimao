<?php
$this->title = '咨询师列表';
use common\models\Comment;
use yii\widgets\LinkPager;
?>
<style>
    .author-item .tag-list span {
        display: inline-block;
        color: #878787;
        font-size: 13px;
        border: 1px solid silver;
        border-radius: 2px;
        padding: 4px 8px;
        margin: 3px 0px 3px 0;
        -moz-box-sizing: border-box;
        box-sizing: border-box
    }
</style>
<div class="container mt30">
    <div class="t-title">
        <?= $name->name; ?><span>－</span>咨询师</div>
    <?php foreach ($model as $item): ?>
        <a href="/counselor/detail?id=<?= $item['id'] ?>">
        <div class="author-item">
            <span class="border-left"></span>
            <span class="border-right"></span>
            <div class="author-por">
                <div class="author-img">
                    <img src="<?= $item['avatar'] ?>" alt="">
                </div>
                <div class="author-right">
                    <div class="author-right_1"><span class="name"><?= $item['name'] ?></span><span class="showed"><?= $item['subscribe_num'] ?>已预约</span>
                    </div>
                    <p class="author-right_text"><?= $item['desc'] ?></p>
                    <?php if(count($item['subscribe']) > 0 ) :?>
                        <div class="time">开约时间：<?=date('Y.m.d',strtotime($item['subscribe'][0]['subscribe_startTime']))  ?></div>
                    <?php else :?>
                        <div class="time">开约时间：</div>
                    <?php endif;?>
                    原价：<s>600</s>
                    <div class="orderd">现价：<?= $item['subscribe_price']-$item['subscribe_voice_price'] >0?$item['subscribe_voice_price']/100:$item['subscribe_price']/100 ?>起/60分钟</div>
                </div>
            </div>
            <div class="comment-num">
                <a href="/comment/index?id=<?=$item['id']?>">
                    <?=Comment::find()->where(['c_id' => $item['id']])->count(); ?>条评价
                </a>
            </div>
            <div class="tag-list">
                <?php foreach ($item['label'] as $label): ?>
                    <span><?= $label['name'] ?></span>
                <?php endforeach; ?>
            </div>
            <div class="order-btn-wrap">
                <a href="/counselor/appointment?id=<?= $item['id'] ?>">立即预约</a>
<!--                <a href="/counselor/detail?id=--><?//= $item['id'] ?><!--">立即预约</a>-->
            </div>
        </div>
        </a>
    <?php endforeach; ?>
</div>
<div class="loading" style="display: none;"><img src="/media/img/Reload.gif" alt=""></div>
<button id="next" class="next-btn" style="display: none">点击加载下一页</button>
<p class="loading-finish">已全部加载</p>
<?= LinkPager::widget([
    'pagination' => $pages,
    'nextPageLabel' => false,
    'prevPageLabel' => false,
    'hideOnSinglePage' => false,
]);
?>
<style>
    .pagination{
        display: none;
    }
    .loading {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
    }
    .loading img {
        position: absolute;
        left: 50%;
        top: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        -o-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }
    .next-btn {
        display: block;
        margin: 0 auto 20px;
        border: 0;
        font-size: 14px;
        width: 200px;
        height: 40px;
        color: #fff;
        background: rgb(8, 11, 20);
    }
    .loading-finish {
        text-align: center;
        font-size: 14px;
        color: #999;
        margin: 20px auto;
        display: none;
        padding-bottom: 20px;
    }
</style>
<script>
    $(function () {
        var total = $('.pagination li').length;
        var currentPageIndex = 0;
        // $(document).on('click', '.pagination a', function (e) {
        //     e.preventDefault();
        //     var url = $(this).attr('href');
        //     $.get(url, function (msg) {
        //         $('.container').append(msg);
        //     });
        // });

        if(total <= 1){
            $('#next').hide();
            $('.loading-finish').show();
            if (total === 0) {
                $('.loading-finish').text('已全部加载')
            }
        }

        $(window).scroll(function() {
            if (($(window).scrollTop() + $(window).height() > $(document).height() - 1)) {
                console.log(currentPageIndex)
                if(currentPageIndex + 1 < total){
                    $('#next').click()
                }
            }
        });

        $('#next').on('click',function () {
            $('.loading').show();
            var _this = $(this);
            currentPageIndex++;
            var url = $($('.pagination a')[currentPageIndex]).attr('href');
            $.get(url, function (msg) {
                $('.container').append(msg);
                $('.loading').hide();
                if(currentPageIndex+1 === total){
                    // _this.hide()
                    $('.loading-finish').show();
                    $('.loading').hide();
                }
            });
        })
    })
</script>
