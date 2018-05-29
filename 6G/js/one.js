var clientWidth = document.documentElement.clientWidth,
        viewport = null,
        viewportWidth = 'device-width',
        viewportScale = 1;
    if (clientWidth > 320) {
        viewport = document.querySelector('meta[name="viewport"]');
        viewportScale = clientWidth / 320;
        viewportWidth = 320;
        viewport.setAttribute('content', 'width=' + viewportWidth + ', initial-scale=' + viewportScale + ', maximum-scale=' + viewportScale + ', user-scalable=0');
    }
    
    //获得point2顶角的弧度值
    function getAngle(point1, point2, point3) {
        var bb = (point2.y - point1.y) * (point2.y - point1.y) + (point2.x - point1.x) * (point2.x - point1.x);
        var aa = (point3.y - point1.y) * (point3.y - point1.y) + (point3.x - point1.x) * (point3.x - point1.x);
        var cc = (point3.y - point2.y) * (point3.y - point2.y) + (point3.x - point2.x) * (point3.x - point2.x);
        var cosa = (bb + cc - aa) / (2 * Math.sqrt(bb) * Math.sqrt(cc));
        return Math.acos(cosa);
    }


    //判断point3在point1和point2组成的直线的左边还是右边
    // function duration(point1, point2, point3) {
    //     var k = (point2.y - point1.y) / (point2.x - point1.x);
    //     var b = point1.y - k * point1.x;
    //     console.log(k);
    //     if (k > 0 && point3.y < point3.x * k + b) {
    //         return 1;
    //     } else if (k < 0 && point3.y > point3.x * k + b) {
    //         return 1;
    //     } else if(k === 0 && point3.x > point1.x) {
    //         return 1;
    //     }
    //     return -1;
    // }

    //通过面积量的方法来判断顺时针还是逆时针
    //point1传入圆心，point2传入起始点，point3传入终点
    function duration(point1, point2, point3) {
        var sp = (point1.x-point3.x)*(point2.y-point3.y)-(point1.y-point3.y)*(point2.x-point3.x);
        console.log(sp);
        if(sp>0) {
            return 1
        } else if(sp<0) {
            return -1
        } else {
            return 0;
        }
    }

    var line = document.getElementById('line');
    var oX = 0;
    var oY = 0;
    //全局记录
    var rolate = 0;
    //圆心
    var pointCenter = {
            x: 159,
            y: 187
        }
        //初始移动点
    var pointO = false;
    var ro = 0;

    //在手机浏览器（如微信）中打开页面拖动的时候页面会漏底
    //禁掉默认事件，不然影响咱们的更手转动
    $(document).on('touchstart', function(e) {
        e.preventDefault();
    }).on('touchmove', function(e) {
        e.preventDefault();
    });

    line.addEventListener('touchstart', function(e) {
        var touche = e.touches[0];
        oX = touche.clientX;
        oY = touche.clientY;
        pointO = {
            x: oX,
            y: oY
        }
    });

    line.addEventListener('touchmove', function(e) {
        var mx = e.touches[0].clientX;
        var my = e.touches[0].clientY;

        ro = getAngle(pointO, pointCenter, {
            x: mx,
            y: my
        });

        ro = ro * duration(pointCenter, pointO, {
            x: mx,
            y: my
        });

        ro = rolate + ro;
        $('#line').css({
            '-webkit-transform': 'rotate(' + ro + 'rad)',
            'transform': 'rotate(' + ro + 'rad)'
        });
    });

    line.addEventListener('touchend', function() {
        rolate = ro;
    });