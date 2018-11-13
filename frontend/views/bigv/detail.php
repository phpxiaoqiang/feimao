<?php
$this->title = '大V解答';
use yii\widgets\LinkPager;
?>

<style type="text/css">
    .v-audio {
        height: 30px;
    }
    .v-audio a,
    .v-audio p {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        line-height: 40px;
        padding-left: 10px;
    }
    .v-audio-btn {
        color: #fff;
        background: #000;
        border-radius: 6px;
        width: 49px;
        height: 26px;
        line-height: 26px;
        text-align: center;
        font-size: 13px;
        flex-shrink: 0;
        transition: all 0.3s;
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 999;
    }
</style>
<div class="pb100">
    <div class="container mt30">
        <div class="t-title">
            大V解答
        </div>
        <?php if($bigv['cou_id']){?>
        <a href="/counselor/detail?id=<?=$bigv['cou_id'];?>">
            <div class="v-panel" style="margin-top: 25px">
                <img src="<?=$bigv['small_pic']?>" alt="">
                <div class="v-panel_title">
                    <h3 style="font-weight: bold;"><?=$bigv['name']?></h3>
                    <p><?=$bigv['introduce']?></p>
                </div>
            </div>
        </a>
        <?php }else{ ?>
            <div class="v-panel" style="margin-top: 25px">
                <img src="<?=$bigv['small_pic']?>" alt="">
                <div class="v-panel_title">
                    <h3 style="font-weight: bold;"><?=$bigv['name']?></h3>
                    <p><?=$bigv['introduce']?></p>
                </div>
            </div>
        <?php }?>
        <div style="margin-top: 40px">
            <?php foreach($problem as $item):?>
                <div class="v-audio">
                    <audio src="<?=$item['link']?>"></audio>
                    <a href="/bigv/audio?id=<?=$item['id']?>"><p><?=$item['title']?></p></a>
                    <div class="v-audio-btn">播放<span></span></div>
                </div>
            <?php endforeach;?>
         <!--    <div class="v-audio">
                <audio src="http://ovv0jgblz.bkt.clouddn.com/怎样的姑娘才是飞行员的理想型.mp3"></audio>
                <p>和男朋友分手之后该如何自处？</p>
                <div class="v-audio-btn">播放<span></span></div>
            </div> -->
        </div>
    </div>
    <div class="comment-title mt30">留言板</div>
    <div class="container" id="comment">
        <?php foreach($model as $item):?>
        <div class="comment-container">
            <div class="comment-list">
                <div class="comment-item">
                    <div class="comment-item-top">
                        <div class="img"><img src="<?=$item['headimgurl']?>" alt=""></div>
                        <div class="right">
                            <span class="name" style="font-weight: bold;"><?=$item['nickname']?></span>
                            <span class="time"><?=date('Y/m/d', strtotime($item['created_at']))?></span>
                        </div>
                    </div>
                    <p class="comment-text"><?=$item['content']?></p>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
    <a href="/bigv/comment?id=<?=$_GET['id']?>" class="btn-bottom">提问题</a>
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
                $('#comment').append(msg);
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
<script>
    $(function() {
        $('.v-audio-btn').on('click', function (e) {
            e.stopPropagation()
            if ($(this).hasClass('pause')) {
                $(this).removeClass('pause').siblings('audio')[0].pause()
            } else {
                $(this).addClass('pause').siblings('audio')[0].play()
            }
        })
    })
</script>