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
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- css -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="materialize/css/materialize.min.css" media="screen,projection" />
    <link href="/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/css/fancybox/jquery.fancybox.css" rel="stylesheet">
    <link href="/css/flexslider.css" rel="stylesheet" />
    <link href="/css/style.css" rel="stylesheet" />

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body>

    <?php $this->beginBody() ?>

    <?= $content ?>


    <?php $this->endBody() ?>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="widget">
                        <h5 class="widgetheading">Our Contact</h5>
                        <address>
                            <strong>Bootstrap company Inc</strong><br>
                            JC Main Road, Near Silnile tower<br>
                            Pin-21542 NewYork US.</address>
                        <p>
                            <i class="icon-phone"></i> (123) 456-789 - 1255-12584 <br>
                            <i class="icon-envelope-alt"></i> email@domainname.com
                        </p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget">
                        <h5 class="widgetheading">Quick Links</h5>
                        <ul class="link-list">
                            <li><a class="waves-effect waves-dark" href="#">Latest Events</a></li>
                            <li><a class="waves-effect waves-dark" href="#">Terms and conditions</a></li>
                            <li><a class="waves-effect waves-dark" href="#">Privacy policy</a></li>
                            <li><a class="waves-effect waves-dark" href="#">Career</a></li>
                            <li><a class="waves-effect waves-dark" href="#">Contact us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget">
                        <h5 class="widgetheading">Latest posts</h5>
                        <ul class="link-list">
                            <li><a class="waves-effect waves-dark" href="#">Lorem ipsum dolor met consectetur adipisicing. Aorem psum dolor met consectetur adipisicing sit amet, consectetur adipisicing elit, of them jean shorts sed magna aliqua. Lorem ipsum dolor met.</a></li>
                            <li><a class="waves-effect waves-dark" href="#">Pellentesque et pulvinar enim. Quisque at tempor ligula</a></li>
                            <li><a class="waves-effect waves-dark" href="#">Natus error sit voluptatem accusantium doloremque</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget">
                        <h5 class="widgetheading">Recent News</h5>
                        <ul class="link-list">
                            <li><a class="waves-effect waves-dark" href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></li>
                            <li><a class="waves-effect waves-dark" href="#">Pellentesque et pulvinar enim. Quisque at tempor ligula</a></li>
                            <li><a class="waves-effect waves-dark" href="#">Natus error sit voluptatem accusantium doloremque</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id="sub-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="copyright">
                            <p>
                                <a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=11000002000001" target="_blank" >
                                    © 2018. All rights reserved.京ICP备18006106号</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!--                    <ul class="social-network">-->
                        <!--                        <li><a class="waves-effect waves-dark" href="#" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a></li>-->
                        <!--                        <li><a class="waves-effect waves-dark" href="#" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a></li>-->
                        <!--                        <li><a class="waves-effect waves-dark" href="#" data-placement="top" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>-->
                        <!--                        <li><a class="waves-effect waves-dark" href="#" data-placement="top" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>-->
                        <!--                        <li><a class="waves-effect waves-dark" href="#" data-placement="top" title="Google plus"><i class="fa fa-google-plus"></i></a></li>-->
                        <!--                    </ul>-->
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<a href="#" class="scrollup waves-effect waves-dark"><i class="fa fa-angle-up active"></i></a>
<!-- javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="materialize/js/materialize.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.fancybox.pack.js"></script>
<script src="js/jquery.fancybox-media.js"></script>
<script src="js/jquery.flexslider.js"></script>
<script src="js/animate.js"></script>
<!-- Vendor Scripts -->
<script src="js/modernizr.custom.js"></script>
<script src="js/jquery.isotope.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/animate.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
<?php $this->endPage() ?>
