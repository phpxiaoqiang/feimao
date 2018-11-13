<style>
.page-disabled { pointer-events: none; }
.chat-item .audio-bar .round {
      width: 10px;
      height: 10px;
      border-radius: 100%;
      background: orangered;
      position: absolute;
      top: 5px;
}
.chat-item .audio-bar.audio-bar-left .round {
      right: 5px;
}
.chat-item .audio-bar.audio-bar-right .round {
      left: 5px;
}
.overlay {  
    position: fixed;  
    top: 0;  
    left: 0;  
    z-index: 0;  
    width: 100%;  
    height: 100%;
}
.modal-mask {
position: fixed;
z-index: 9998;
top: 0;
left: 0;
width: 100%;
height: 100%;
transition: opacity .3s ease;
display: none;
}
.modal-mask.active {
display: table;
}

.modal-wrapper {
display: table-cell;
vertical-align: middle;
}

.modal-container {
width: 150px;
/*margin: 0px auto;*/
position: fixed;
top: 50%;
left: 50%;
margin-top: -49px;
margin-left: -95px;
padding: 20px;
background-color: rgba(0,0,0,.7);
border-radius: 10px;
box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
transition: all .3s ease;
font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
margin-top: 0;
color: #42b983;
}
.modal-body {
margin: 20px 0;
text-align: center;
color: #fff;
}

.modal-body .loading {
width: 30px;
}

.modal-default-button {
float: right;
}

.modal-enter {
opacity: 0;
}
.modal-leave-active {
opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
-webkit-transform: scale(1.1);
transform: scale(1.1);
}
</style>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<!--<script src="https://cdn.bootcss.com/date-fns/123/date_fns.min.js"></script>-->
<script type="text/javascript" src="/js/leftTime.min.js"></script>
<?php
require_once(dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'common' . DIRECTORY_SEPARATOR . 'libraries' . DIRECTORY_SEPARATOR . 'JSSDK' . DIRECTORY_SEPARATOR . 'JSSDK.php');
$jssdk = new JSSDK("wxbcbce1d3760dfbca", "b7b73b24ed8b7e698dde9a111270a23e");
$signPackage = $jssdk->getSignPackage();
$this->title = "CHIC原醉";
?>

<script type="text/javascript" src="/js/swfobject.js"></script>
<script type="text/javascript" src="/js/web_socket.js"></script>

<script type="text/javascript">
    wx.config({
        debug: false,
        appId: '<?php echo $signPackage["appId"];?>',
        timestamp: <?php echo $signPackage["timestamp"];?>,
        nonceStr: '<?php echo $signPackage["nonceStr"];?>',
        signature: '<?php echo $signPackage["signature"];?>',
        jsApiList: [
            /*'checkJsApi',
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareWeibo',
            'onMenuShareQZone',
            'hideMenuItems',
            'showMenuItems',
            'hideAllNonBaseMenuItem',
            'showAllNonBaseMenuItem',*/
            'closeWindow',
            'translateVoice',
            'startRecord',
            'stopRecord',
            'onVoiceRecordEnd',
            'playVoice',
            'onVoicePlayEnd',
            'pauseVoice',
            'stopVoice',
            'uploadVoice',
            'downloadVoice'
            /*'chooseImage',
            'previewImage',
            'uploadImage',
            'downloadImage',
            'getNetworkType',
            'openLocation',
            'getLocation',
            'hideOptionMenu',
            'showOptionMenu',
            'scanQRCode',
            'chooseWXPay',
            'openProductSpecificView',
            'addCard',
            'chooseCard',
            'openCard'*/
        ]
    });

</script>
<script type="text/javascript">
    timerun = 0;
    <?php
    $time = time();
    $room_list = [
        0 => $teacher_id,
        1 => $student_id,
        2 => $starttime,
        3 => $endtime
    ];
    ?>
    var timer = <?php echo($endtime - time());?>;

    ROOM_ID = "<?php echo base64_encode(implode(':', $room_list))?>";
    USER_ICON = "<?php echo $uicon?>";
    USER_ID = "<?php echo $uid?>";
    USER_TYPE = '<?php echo $utype?>';
    USER_SEND = "<?php echo $usend?>"
    WEB_SOCKET_SWF_LOCATION = "/swf/WebSocketMain.swf";
    WEB_SOCKET_DEBUG = true;

    var ws;

    function connect() {
        //ws = new WebSocket("ws://"+document.domain+":7272");
        ws = new WebSocket("ws://101.132.35.77:7272");
        ws.onopen = onopen;
        ws.onmessage = onmessage;
        ws.onclose = function () {
            connect();
        };
        ws.onerror = function () {
        };
    }

    function onopen() {
        var login_data = '{"type":"login","user_type":"' + USER_TYPE + '","user_id":"' + USER_ID + '","icon":"' + USER_ICON + '","room_id":"' + ROOM_ID + '"}';
        ws.send(login_data);
    }

    function onmessage(e) {
        var data = eval("(" + e.data + ")");
        switch (data['type']) {
            case 'ping':
                ws.send('{"type":"pong"}');
                break;
                ;
            case 'login':
                break;
            case 'say':
                clearInterval(timerun);
                timer = data['count_time'];
                timerun = setInterval(function () {
                    if (timer > 0) {
                        $('.countdown_1').html(secondToDate(--timer));
                    } else {
                        clearInterval(timerun);
                    }
                }, 1000);
                retMsg(data['type'], data['user_id'], data['icon'], data['content']);
                break;
            case 'audio':
                clearInterval(timerun);
                timer = data['count_time'];
                timerun = setInterval(function () {
                    if (timer > 0) {
                        $('.countdown_1').html(secondToDate(--timer));
                    } else {
                        clearInterval(timerun);
                    }
                }, 1000);
                retMsg(data['type'], data['user_id'], data['icon'], data['content']);
                break;
            case 'logout':
                clearInterval(timerun);
                timer = data['count_time'];
                timerun = setInterval(function () {
                    if (timer > 0) {
                        $('.countdown_1').html(secondToDate(--timer));
                    } else {
                        clearInterval(timerun);
                    }
                }, 1000);
                if (data['user_id'] == USER_ID) {
                    ws.onclose = function () {};
                    ws.close();
                    if (<?php echo $student_id?> == USER_ID) {
                        alert("你的咨询时间已结束,请对相关咨询师做出评价！");
                        window.location = '/comment/comment?id=<?php echo $cid?>&sid=<?php echo $sid?>';
                    } else {
                        alert("你" + data['content']);
                        window.location = '/';
                    }
                } else {
                    // alert("ta" + data['content']);
                }
                break;
        }
    }

    function retMsg(type, user_id, icon, content) {
        if (user_id == USER_ID)
            p = '.myself';
        else
            p = '.themself'

        if (type == 'say') {
            p += '-chat-text';
        } else {
            p += '-chat-audio';
        }
        if (type == 'audio') {
            audio_json = JSON.parse(content);
            var html = $(p).html().replace('{{icon}}', icon).replace('{{content}}', audio_json.play_id).replace('{{time}}', audio_json.time);
        } else {
            var html = $(p).html().replace('{{icon}}', icon).replace('{{content}}', content);
        }
        var db = localStorage.getItem(ROOM_ID);
        if (db != null) {
            db = JSON.parse(db);
            if (db.length >= 5) {
                db.shift();
            }
            db.push(html);
        } else {
            db = new Array();
            db.push(html);
        }
        setTimeout(function () {
            var h = $(document).height() - $(window).height();
            $(document).scrollTop(h);
        }, 300);
        localStorage.setItem(ROOM_ID, JSON.stringify(db));
        $(".chat").append(html);
    }

    function send(content) {
        if (content.length == 0)
            return;
        var sendMsg = {
            'type': USER_SEND,
            'user_id': USER_ID,
            'icon': USER_ICON,
            'user_type': USER_TYPE,
            'content': content,
        };
        ws.send(JSON.stringify(sendMsg));
    }
</script>
<script type="text/template" class="myself-chat-text">
    <div class="chat-right chat-item">
        <img src="{{icon}}" alt="" class="chat-img">
        <div class="chat-text">{{content}}</div>
    </div>
</script>
<script type="text/template" class="myself-chat-audio">
    <div class="chat-right chat-item">
        <img src="{{icon}}" alt="" class="chat-img">
        <div class="audio-bar audio-bar-right" onclick="play('{{content}}');$(this).find('.round').remove()"><span class="time">{{time}}''</span><span class="round"></span></div>
    </div>
</script>

<script type="text/template" class="themself-chat-text">
    <div class="chat-left chat-item">
        <img src="{{icon}}" alt="" class="chat-img">
        <div class="chat-text">{{content}}</div>
    </div>
</script>
<script type="text/template" class="themself-chat-audio">
    <div class="chat-left chat-item">
        <img src="{{icon}}" alt="" class="chat-img">
        <div class="audio-bar audio-bar-left" onclick="play('{{content}}');$(this).find('.round').remove()"><span class="time">{{time}}''</span><span class="round"></span></div>
    </div>
</script>
<div class="overlay"></div>
<div class="container">
    <div class="chat">
    </div>
    <?php if ($room_list[2] - time() >= 0) { ?>
        <div class="countdown">距咨询开始时间&nbsp;&nbsp; <span class="countdown_2">00:00</span></div>
        <script>
            var start_time = <?=$room_list[2];?>;
            var start_time1 =<?=$room_list[2] - time();?>;

            if(start_time1 > 0){
                $.leftTime(start_time1,function(d){
                    if(d.status){
                        $.leftTime(start_time1, function (d) {
                            var str = '';
                            if (d.d > '00') {
                                str = d.d + '天' + d.h + '时' + d.m + '分' + d.s + '秒'
                            } else if (d.h > '00') {
                                str = d.h + '时' + d.m + '分' + d.s + '秒'
                            } else if (d.m > '00') {
                                str = d.m + '分' + d.s + '秒'
                            } else if (d.s > '00') {
                                str = d.s + '秒'
                            }
                            $('.countdown_2').html(str);
                        });
                    }else{
                        window.location.reload();
                    }
                });
            }
        </script>
    <?php }else{ ?>
        <span class="countdown_1 countdown">00:00</span>
    <?php } ?>

    <div class="chat-bottom">

        <?php if ($usend == 'say') { ?>
            <div class="chat-input">
                <input type="textarea" id="chat_input" placeholder="输入您想咨询的内容的...">
                <button>发送</button>
            </div>
            <div style="height: 20px;"></div>
        <?php } ?>

        <?php if ($usend == 'audio') { ?>
            <div class="btn-audio voiceBox" style=" -webkit-user-select: none; user-select: none; ">按住说话</div>
        <?php } ?>
    </div>
    <div class="audio-animate" style="display: none;">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="modal-mask">
        <div class="modal-wrapper">
            <div class="modal-container">
                <div class="modal-body">
                    <p>loading...</p >
                </div>
                <img src="http://ovv0jgblz.bkt.clouddn.com/1517849262" style="width: 16px; height:16px;display:block; margin: 0 auto;" onclick="closeall()"></img>
            </div>
        </div>
    </div>
</div>

<script>
    recordTimer = 0;
    audio_time = 0;
    recordCountTimer = 0; // 录音定时
    voice = {
        localId: ''
    };

    function secondToDate(result) {
        var m = Math.floor((result / 60));
        var s = Math.floor((result % 60));
        if (m < 10) {
            m = '0'+''+m
        }
        if (s < 10) {
            s = '0'+''+s
        }
        return m + ":" + s;
    }

    $('body').ready(function () {
        if (localStorage.length > 0) {
            var chat_db = localStorage.getItem(ROOM_ID);
            if (chat_db != null) {
                chat_db = JSON.parse(chat_db);
                $.each(chat_db, function (i) {
                    if (isExistVoiceDB(Object.prototype.toString.call(chat_db[i].match(/play\(\'[0-9A-Za-z\-\_]{1,}/ig)) == '[object Array]'?chat_db[i].match(/play\(\'[0-9A-Za-z\-\_]{1,}/ig)[0].substring(6):'')) {
                        $(".chat").append(chat_db[i].replace(/\<span\sclass\=\"round\"\>\<\/span\>/,''));
                    } else {
                        $(".chat").append(chat_db[i]);
                    }
                });
            } else {
                localStorage.clear();
            }
        }
        timerun = setInterval(function () {
            if (timer > 0) {
                $('.countdown_1').html(secondToDate(--timer));
            } else {
                clearInterval(timerun);
            }
        }, 1000);
        connect();
    });
/*
    text
*/
<?php if ($usend == 'say') {?>
    $(function () {

        $('.chat-input').find('button').click(function () {
            send($('#chat_input').val());
            $('.chat-input').blur();
            $('#chat_input').val('');
        });

        var isIPHONE = navigator.userAgent.toUpperCase().indexOf('IPHONE') != -1;

        function objBlur(id, time) {
            if (typeof id != 'string') throw new Error('objBlur()参数错误');
            var obj = document.getElementById(id),
                time = time || 300,
                docTouchend = function (event) {
                    if (event.target != obj) {
                        setTimeout(function () {
                            obj.blur();
                            document.removeEventListener('touchend', docTouchend, false)
                        }, time);
                    }
                }
            if (obj) {
                obj.addEventListener('focus', function () {
                    document.addEventListener('touchend', docTouchend, false)
                }, false);
            } else {
                throw new Error('objBlur()没有找到元素')
            }
        }

        if (isIPHONE) {
            var input = new objBlur('chat_input');
            input = null
        }
        $('#chat_input').on('focus', function () {
            var _this = $(this);
            $(document).keydown(function (e) {
                if (e.keyCode == 13) {
                    _this.blur()
                    send($('#chat_input').val());
                    $('#chat_input').val('');
                    setTimeout(function () {
                        var h = $(document).height() - $(window).height();
                        $(document).scrollTop(h);
                    }, 300);
                    //$('body').click();
                }
            });
            $('.chat-bottom').css({bottom: '20px'});
            $('.countdown').css({bottom: '80px'});
        });
        $('#chat_input').on('blur', function () {
            $('.chat-bottom').css({bottom: '0'});
            $('.countdown').css({bottom: '60px'});
        });
    })
<?php } ?>
/*
    audio
*/
<?php if ($usend == 'audio') {?>
    IS_RECORD = true;
    IS_PLAY = true;
    IS_TOUCHSTART = false;
    END = 0;

    function closeall() {
        clearInterval(recordCountTimer);
        stopVoiceRecord(audio_time);
        wx.stopRecord({
            success: function () {},
            fail: function () {}
        });
        $('.modal-mask').find('p').html("请一秒后，开始录音！");
        setTimeout(function(){
            $('.modal-mask').removeClass('active');
        }, 2000)
        recordCountTimer = 0;
        audio_time = 0;
        END = 0;
        START = 0;
    }

    function setVoiceDB (sid,lid) {
        console.log(typeof sid)
        let db = window.localStorage.getItem('voice_db');
        db = JSON.parse(db);
        db.push({ 's':sid, 'l':lid });
        db = JSON.stringify(db);
        window.localStorage.setItem('voice_db',db);
    }

    function isExistVoiceDB (sid) {
        let db = window.localStorage.getItem('voice_db');
        if (db?false:true) {
            db = [];
            window.localStorage.setItem('voice_db',JSON.stringify(db));
            return false;
        } else {
            db = JSON.parse(db);
        }
        for (let i in db) {
            if ( db[i].s == sid ) {
                console.log('exist')
                return true;
            }
        }
        console.log('no exist')
        return false;
    }

    function getVoiceDB (sid) {
        let db = window.localStorage.getItem('voice_db');
        db = JSON.parse(db);
        for (let i in db) {
            if ( db[i].s == sid ) {
                return db[i].l;
            }
        }
        return '';
    }

    function play(localId) {
        if ( !IS_PLAY) {
            $('.modal-mask').addClass('active')
            setTimeout(function(){
                $('.modal-mask').removeClass('active')
            }, 2000)
            return false;
        }
        if ( isExistVoiceDB(localId)) {
            let l = getVoiceDB(localId)
            wx.playVoice({
                localId: l
            });
            return ;
        }else{
            wx.downloadVoice({
                serverId: localId, // 需要下载的音频的服务器端ID，由uploadVoice接口获得
                isShowProgressTips: 1, // 默认为1，显示进度提示
                success: function (res) {
                    IS_PLAY = true;
                    setVoiceDB(localId, res.localId)
                    wx.playVoice({
                        localId: res.localId
                    });
                }
            });
        }
    }

    function startVoiceRecord(){
        if ( !IS_RECORD) {// || audio_time < 2) {
            clearTimeout(touch_error);
            wx.stopRecord({
                success: function () {},
                fail: function () {}
            });
            $('.modal-mask').find('p').html("请一秒后，开始录音！");
            setTimeout(function(){
                $('.modal-mask').removeClass('active');
            }, 2000)
            return false;
        }
        IS_RECORD = false;
        console.log('startRecord'+IS_RECORD)
        wx.startRecord({
            success: function () {
                $('.modal-mask').addClass('active')
                IS_TOUCHSTART = true;
                $('.voiceBox').trigger("touchstart");
                localStorage.rainAllowRecord = 'true';
                // $('.audio-animate').css('display', 'block');
            },
            cancel: function () {
                alert("拒绝授权录音");
                // $('.audio-animate').css('display', 'none');
            },
            fail: function () {
                voice.localId = res.localId;
                stopVoiceRecord(audio_time);
                clearInterval(recordCountTimer);
                clearTimeout(recordTimer);
                recordCountTimer = 0;
                audio_time = 0;
                END = 0;
                START = 0;
                IS_RECORD = true;
                $('.overlay').css("display","none");
            }
        });
        wx.onVoiceRecordEnd({
            complete: function (res) {
                IS_RECORD = true;
                voice.localId = res.localId;
                stopVoiceRecord(audio_time);
                clearInterval(recordCountTimer);
                clearTimeout(recordTimer);
                recordCountTimer = 0;
                audio_time = 0;
                END = 0;
                START = 0;
                IS_RECORD = true;
                $('.overlay').css("display","none");
            } 
        });
    }

    function stopVoiceRecord(at){
        wx.stopRecord({
            success: function (res) {
               recordCountTimer = 0;
               audio_time = 0;
               END = 0;
               START = 0;
                $('.modal-mask').removeClass('active')
                console.log("stop voice")
                voice.localId = res.localId;
                uploadVoice(at);
                // $('.audio-animate').css('display', 'none');
                $('.overlay').css("display","none");
            },
            fail: function (res) {
                recordCountTimer = 0;
                audio_time = 0;
                END = 0;
                START = 0;
                $('.modal-mask').find('p').html("录音失败，请尝试重新进入页面");
                setTimeout(function(){
                    $('.modal-mask').removeClass('active');
                }, 2000)
                // $('.audio-animate').css('display', 'none');
                $('.overlay').css("display","none");
            }
        });
    }

    wx.ready(function () {
        wx.error(function (res) {
                alert(JSON.stringify(res));
            });
        $('.overlay').css("display","none");
        $('.voiceBox').on('touchstart', function (event) {
            console.log('touchstart')
            event.preventDefault();
            if (IS_TOUCHSTART) {
                IS_TOUCHSTART = false;
                return false;
            }
            START = new Date().getTime() + 300;
            $('.overlay').css("display","block");
            $('.modal-mask').addClass('active').find('p').html("录音必须长按至一秒以上！");
            recordTimer = setTimeout(function () {
                $('.modal-mask').find('p').html("正在录音中！请不要松手("+audio_time+"s)");
                recordCountTimer = setInterval(function () {
                    END = new Date().getTime();
                    console.log('START'+START)
                    audio_time = Math.ceil((END - START) / 1000);
                    $('.modal-mask').find('p').html("正在录音中！请不要松手("+audio_time+"s)");
                    if (audio_time >= 59) {
                        clearInterval(recordCountTimer);
                        stopVoiceRecord(audio_time);
                        recordCountTimer = 0;
                        audio_time = 0;
                        END = 0;
                        START = 0;
                    }
                },1000);
                startVoiceRecord();
            }, 1000);
        });
        $('.voiceBox').on('touchend', function (event) {

            event.preventDefault();

            if ((END - START) <= 999) {
                $('.modal-mask').removeClass('active')
                clearInterval(recordCountTimer);
                clearTimeout(recordTimer);
                recordCountTimer = 0;
                audio_time = 0;
                $('.modal-mask').addClass('active')
                $('.modal-mask').find('p').html("等待录音关闭....");
                wx.stopRecord({
                    success: function () {
                        $('.modal-mask').removeClass('active')
                    },
                    fail: function () {
                        $('.modal-mask').removeClass('active')
                    }
                });
                // IS_RECORD = true;
                END = 0;
                START = 0;
                $('.overlay').css("display","none");
                $('.audio-animate').css('display', 'none');
            } else if ((END - START > 999)){
                if (audio_time < 59) {
                    clearInterval(recordCountTimer);
                    console.log('touchend'+audio_time)
                    clearTimeout(recordTimer);
                    if ((END - START) < 2000) {
                        $('.modal-mask').find('p').html("录音正在结束中！请等待录音结束");
                    }
                    stopVoiceRecord(audio_time);
                }
            }

        });
    });

    function uploadVoice(time) {
        console.log('upload'+time)
        //调用微信的上传录音接口把本地录音先上传到微信的服务器
        //不过，微信只保留3天，而我们需要长期保存，我们需要把资源从微信服务器下载到自己的服务器
        wx.uploadVoice({
            localId: voice.localId, // 需要上传的音频的本地ID，由stopRecord接口获得
            isShowProgressTips: 1, // 默认为1，显示进度提示
            success: function (res) {
                IS_RECORD = true;
                send(JSON.stringify({'play_id': res.serverId, 'time': time}));
            },
            fail: function () {
                $('.modal-mask').find('p').html("录音上传失败，请尝试重新进入页面");
                $('.modal-mask').addClass('active');
                setTimeout(function(){
                    $('.modal-mask').removeClass('active');
                }, 2000)
            }
        });
    }
<?php } ?>
</script>
