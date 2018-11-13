<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <title><?= Html::encode($this->title) ?></title>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="apple-mobile-web-app-capable" content="no" />
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" type="text/css" href="/css/video.css"/>
    <link rel="stylesheet" type="text/css" href="/media/css/style-index.css?v=0.8888" />
    <link rel="stylesheet" type="text/css" href="/media/css/appoin.css" />
    <script src="/media/js/jquery-3.1.1.min.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
  
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
    <style type="text/css">
        .btn_submit {
            display: block;
            margin: 50px auto;
            background: #fff;
            color: #666;
            text-align: center;
            width: 84%;
            padding: 10px 0;
            border: 0;
            font-size: 18px;
            letter-spacing: 5px;
            font-weight: 500;
        }
        .tip_txt {
            padding: 0 8%;
            font-size: 12px;
            line-height: 1.4;
        }
     .loading img {
        position: absolute;
        left: 50%;
        top: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        -o-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        width: 50px;
    }
    </style>
    <script>
        var _hmt = _hmt || [];
        (function() {
          var hm = document.createElement("script");
          hm.src = "https://hm.baidu.com/hm.js?6c2490105bf62b5a6cf628fa1c1ab762";
          var s = document.getElementsByTagName("script")[0]; 
          s.parentNode.insertBefore(hm, s);
        })();
</script>
</head>
<body style="padding-bottom: 50px; height: initial">
<?php $this->beginBody() ?>

<?= $content ?>

    <script>
        $(function () {
            $('.search-btn').on('click', function() {
                $('.bread-menu-btn').toggleClass('active');
                $('.top-menu').toggleClass('active');
                $('.bread-menu-panel').toggleClass('active');
                $('.nav-link').hide();
                $('.main_search_wrap').show();
            });

            $('.bread-menu-btn').on('click', function () {
                $('.bread-menu-btn').toggleClass('active');
                $('.top-menu').toggleClass('active');
                $('.bread-menu-panel').toggleClass('active');
                $('.main_search_wrap').hide();
                $('.nav-link').show();
            });
        })
    </script>

<?php $this->endBody() ?>
</body>
<script>
    $.ajax({
        url: '/wxshare/jssdk',
        dataType: 'json',
        async: false,
        type: 'GET',
        data: {'url': encodeURI(location.href)},
        success: function (res) {
            if (res.code == 200) {
                wx.config({
                    //debug: true,
                    appId: res.data.appId,
                    timestamp: res.data.timestamp,
                    nonceStr: res.data.nonceStr,
                    signature: res.data.signature,
                    jsApiList: [
                        'onMenuShareAppMessage',
                        'onMenuShareTimeline'
                    ]
                });
                // 分享
                wx.ready(function () {
                    var shareData = {
                        title: 'Chic年度福利【免费咨询】',
                        desc: 'Chic原醉-限量领取400份',
                        link: "http://chicyuanzui.com/coupons/index",
                        imgUrl: 'http://ovv0jgblz.bkt.clouddn.com/wx_share_icon.jpeg'
                    }
                    wx.onMenuShareAppMessage(shareData);
                    wx.onMenuShareTimeline(shareData);
                });
                wx.error(function (res) {
                    console.log(res);
                });
            }
        },
        error: function (jqXHR, textStatus, error) {

        }
    })
</script>
</html>
<?php $this->endPage() ?>
