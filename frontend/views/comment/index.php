<?php
 $this->title = '评价('.$dataCount.')';
use yii\helpers\Html;
use frontend\models\Wxuser;
use yii\widgets\LinkPager;
use common\models\CounselorCommentlabel;
?>
<div class="container mt30">
    <div class="t-title">评价</div>
    <a href="/counselor/detail?id=<?=$_GET['id']?>">
        <div class="order-box author-item comment-box">
            <span class="border-left"></span>
            <span class="border-right"></span>
            <div class="author-por">
                <div class="author-img"><img src="<?=$res->avatar?>" alt=""></div>
                <div class="author-right">
                    <div class="author-right_1">
                        <span class="name"><?=$res->name?></span>
                    </div>
                    <p class="author-right_text"><?=$res->desc?></p>
                </div>
            </div>
            <div class="star-wrap">
                <span>评价满意度</span>
                <div class="star-list">
                    <?php for ($i=0;$i<$score;$i++){?>
                    <span class="star active"></span>
                    <?php }
                        $rema =5-$score;
                    for ($i=0;$i<$rema;$i++){
                    ?>
                        <span class="star "></span>
                    <?php }?>
                </div>
            </div>
        </div>
    </a>
    <div class="comment-tag clearfloat">
        <? if (!empty($labelComment)){?>
        <?php foreach ($labelComment as $item): ?>
            <span class="tag-item active">
                <?=$item['name']?>
                <span class="heart"><?=$item['cou']?></span>
            </span>
        <?php endforeach; ?>
        <? }?>
<!--        <span class="tag-item">客观理智</span>-->
<!--        <span class="tag-item">声音温柔</span>-->
<!--        <span class="tag-item active">善于倾听 <span class="heart">23</span> </span>-->
<!--        <span class="tag-item">非常专业</span>-->
<!--        <span class="tag-item">态度很好</span>-->
<!--        <span class="tag-item">很有收获</span>-->
<!--        <span class="tag-item">回复不及时</span>-->
<!--        <span class="tag-item">回复很快</span>-->
<!--        <span class="tag-item">专业度低</span>-->
<!--        <span class="tag-item">态度差</span>-->

    </div>
</div>
<div class="tab-switch">
    <em class="tab <?=!empty($_GET['new'])?'':'active'?>" onclick="window.location.href='/comment/index?id=<?=$_GET['id']?>'">全部</em>
    <em class="tab  <?=!empty($_GET['new'])?'active':''?>" onclick="window.location.href='/comment/index?id=<?=$_GET['id']?>&new=yes'">最新</em>
</div>
<div class="comment-container">
    <div class="comment-list container" id="container_id">
        <?php foreach ($model as $item): ?>
            <?if($item['content']) :?>
                <div class="comment-item">
                    <div class="comment-item-top">
                        <div class="img"><img src="<?=$item['headimgurl']?>" alt=""></div>
                        <div class="right">
                            <span class="name" style="font-weight: bold;"><?=$item['nickname']?></span>
                            <span class="time"><?php $time = strtotime($item['created_at']); echo date('Y/m/d',$time)?></span>
                        </div>
                    </div>
                    <p class="comment-text">
                        <?=htmlspecialchars($item['content'])?>
                    </p>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

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
                $('#container_id').append(msg);
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
