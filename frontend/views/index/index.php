<?php

/* @var $this yii\web\View */
use yii\widgets\LinkPager;
$this->title = '首页';
?>
<div class="container block">
    <div class="t-title">精品课程</div>
    <div class="courses">
        <?php foreach ($model as $item): ?>
            <a href="/post/detail?id=<?= $item->id ?>">
                <div class="course">
                    <img src="<?= $item->pic ?>" alt="">
                    <div class="course-txt">
                        <h3><?= $item->title; ?></h3>
                        <p> <?= $item->desc; ?></p>
                    </div>
                </div>
            </a>
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
</div>
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
