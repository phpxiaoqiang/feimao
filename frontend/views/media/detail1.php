<?php
    $this->title='视频详情';
?>
<div class="media-detail pb100">
     <div style="position: relative;">
        <video class="video-item" preload="auto"
               webkit-playsinline="true" playsinline="true" x-webkit-airplay="true"
               x5-video-player-type="h5"
               x5-video-player-fullscreen="true" x5-video-ignore-metadata="true" controls style="width: 100%; height: auto;">
            <source src="http://v.cdn.bb.bbwc.cn/bloomberg/2016/11/25/20161125161809984/20161125161809984_index.mp4">
            <p class="vjs-no-js">浏览器版本过低<a href="http://videojs.com/html5-video-support/"
                                           target="_blank">supports HTML5
                video</a></p>
        </video>
        <div class="btn-control video-btn">
            <img src="http://cdn.yixi.tv/almond/video_cover_1505820949.jpeg" alt="">
            <div class="player-btn-wrap">
                <i class="player-btn j_player-btn"></i>
            </div>
        </div>
    </div>
<!--    <div style="position: relative;">-->
<!--        <img src="http://cdn.yixi.tv/almond/video_cover_1505820949.jpeg" alt="" class="audio-img">-->
<!--        <i class="player-btn j_audio-btn"></i>-->
<!--        <audio class="video-item audio" id="audio" controls preload src="/media/2zhaolei.mp3"></audio>-->
<!--    </div>-->
    <div class="container">
        <p class="video-p">
            视频简介视频简介视频简介视频简介视频简介视频简介视频简介视频简介视频简介视频简介视频简介视频简介视频简介视频简介视频简介视频简介
        </p>
        <div class="video-info">
            <div class="video-play-num">
                <i class="icon icon-play-num"></i>
                33
            </div>
            <span>2017-02-02</span>
        </div>
    </div>
    <div class="media-list media-page-list">
        <div class="container">
            <div class="red-title">
                <span>为您推荐</span>
            </div>
            <a href="/post/detail">
                <div class="media-item">
                    <div class="media-item-l video">
                        <img src="http://p1.music.126.net/kTswAWhN_nyUawxZh3ybdg==/18557557253712977.jpg?param=180y180" alt="">
                    </div>
                    <div class="media-item-r">
                        <h4>青春，一个被嚼烂却又永远能被大家接受的话题，因为你的心中总会有某一个人惊艳了你的青春，又在时光里渐行渐远，让人爱不起来也恨不下去，那是回忆</h4>
                        <div class="play-num"><i class="icon icon-play-num"></i><span>132</span></div>
                    </div>
                </div>
            </a>
            <a href="/post/detail">
                <div class="media-item">
                    <div class="media-item-l audio">
                        <img src="/media/img/media.eedf5c04.png" alt="">
                    </div>
                    <div class="media-item-r">
                        <h4>杨丞琳9月7号在微博说，偷偷摸摸录了一首新歌，送给我们。</h4>
                        <div class="play-num"><i class="icon icon-play-num"></i>322</div>
                    </div>
                </div>
            </a>
            <a href="/post/detail">
                <div class="media-item">
                    <div class="media-item-l video">
                        <img src="http://p1.music.126.net/pFqTWUTO2HydGZ3giV0h7Q==/1402976852730427.jpg?param=140y140" alt="">
                    </div>
                    <div class="media-item-r">
                        <h4>有一天我吃完泡面发现洗洁精用光了，我随手用剃须泡洗碗时，会觉得可能要是有一个女朋友就好了。</h4>
                        <div class="play-num"><i class="icon icon-play-num"></i>32</div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<script>
    
  $(function () {
    
    $('.video-btn').on('click', function () {
      var player = $(this).siblings('video');;
      player.get(0).play();
      $(this).hide();
    });
    
    $('.j_audio-btn').on('click', function() {
        $('#audio').get(0).play();
        $(this).hide();
    })

    $('.btn-close').on('click', function () {
      $(this).parent().fadeOut();
    })

    $('.look-all').on('click', function(event) {
          $('.share-video-p').toggleClass('active');
          $(this).toggleClass('active');
    });
  })
</script>