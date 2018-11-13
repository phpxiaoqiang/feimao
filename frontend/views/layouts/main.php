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
    <link rel="stylesheet" type="text/css" href="/media/css/appoin.css">
    <link rel="stylesheet" type="text/css" href="/media/css/style-index.css"/>
    <script src="/media/js/jquery-3.1.1.min.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body class="pt54">
<div class="top-menu">
    <span class="top-logo"> 美山子</span>
    <div class="top-menu-right">
        <div class="bread-menu-btn"><i></i><i></i><i></i></div>
    </div>
    <div class="bread-menu-panel pt54">
        <a href="/">首页</a>
        <a href="/mine/index">我的</a>
    </div>
</div>
<?php $this->beginBody() ?>

<?= $content ?>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script src="/media/js/jquery-3.1.1.min.js"></script>
<script>
    $(function () {
        $('.bread-menu-btn').on('click', function () {
            $(this).toggleClass('active');
            $('.top-menu').toggleClass('active');
            $('.bread-menu-panel').toggleClass('active');
        });
    })
</script>