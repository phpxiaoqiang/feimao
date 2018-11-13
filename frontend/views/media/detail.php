<?php
$this->title = '音频详情';
$time = strtotime($model['created_at']);
$time = date('Y/m/d',$time);
use yii\helpers\Html;
?>

<?=Html::jsFile('/media/js/video.js')?>
<?=Html::jsFile('/media/js/audio.min.js')?>
    <?php if($model['type'] == 0){?>
        <div class="video" >
            <video class="video video-js" id="my-video" preload="auto"
                   webkit-playsinline="true" playsinline="true" x-webkit-airplay="true"
                   x5-video-player-type="h5"
                   x5-video-player-fullscreen="true" x5-video-ignore-metadata="true" controls poster="../static/img/banner.jpg">
                <source src="<?=$model['link']?>">
                <p class="vjs-no-js">浏览器版本过低<a href="http://videojs.com/html5-video-support/"
                                               target="_blank">supports HTML5
                        video</a></p>
            </video>
        </div>

    <?php }else{?>
        <script>
            /*
                iOS浏览BUG修复
                by @mathias, @cheeaun and @jdalton
            */
            (function(doc){var addEvent='addEventListener',type='gesturestart',qsa='querySelectorAll',scales=[1,1],meta=qsa in doc?doc[qsa]('meta[name=viewport]'):[];function fix(){meta.content='width=device-width,minimum-scale='+scales[0]+',maximum-scale='+scales[1];doc.removeEventListener(type,fix,true);}if((meta=meta[meta.length-1])&&addEvent in doc){fix();scales=[.25,1.6];doc[addEvent](type,fix,true);}}(document));
        </script>
<!--        <div class="audio">-->
<!--            <div class="img"><img src="--><?//=$model['pic']?><!--" alt=""></div>-->
<!--            <audio id="myaudio" src="--><?//=$model['link']?><!--"></audio>-->
<!--        </div>-->
        <div class="htmleaf-content bgcolor-3 audio">
            <div class="img"><img src="<?=$model['pic']?>" alt=""></div>
            <div id="wrapper">
                <audio src="<?=$model['link']?>" preload="auto" controls></audio>
                <script>$( function() { $( 'audio' ).audioPlayer(); } );</script>
            </div>
        </div>
    <?php }?>
    <div class="video-title">
        <?=$model['title']?>
    </div>
    <div class="play-info">
        <div class="play-info-l">
            <span class="icon-play-s"></span>
            <span class="look-num"><?=$model['playNum']?></span>
        </div>
        <div class="time"><?=$time?></div>
    </div>
    <!-- <div class="container">
        <div class="v-audio">
            <p>和男朋友分手之后该如何自处？</p>
        </div>
        <div class="v-audio">
            <p>和男朋友分手之后该如何自处？</p>
        </div>
    </div> -->
<script>
  function btnSum(e){

      $.get('/media/updatenum?id='+e);
  }

</script>
<?php if($model['type'] == 1){?>
<script>
    $(function () {
        var myPlayer = videojs('my-video');
        var whereYouAt = myPlayer.currentTime();
        audiojs.events.ready(function() {
            var as = audiojs.createAll();
        });
    })
</script>
<?php }else{?>
    <script>
        $(function () {
        })
    </script>

<?php }?>
