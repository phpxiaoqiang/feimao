<?php
$this->title = '音频详情';

use yii\helpers\Html;
?>

<?=Html::jsFile('/media/js/audio.min.js')?>
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
    <div class="video-title">
        <?=$model['title']?>
    </div>
    <div class="container">
        <?php foreach($problem as $item):?>
        <a href="/bigv/audio?id=<?=$item['id']?>">
            <div class="v-audio">
                <p><?=$item['title']?></p>
            </div>
        </a>
        <?php endforeach ;?>

    </div>
