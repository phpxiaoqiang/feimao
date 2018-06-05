// var i=1;
// var angle=0;
$(function(){
//	$("#turnBtn").click(function(){
//		if(i==1){
//			angle+=172;
//		}else{
//			angle+=360;
//		}
//		$(this).css("transform","rotate("+angle+"deg)");
//		i++;
//	});
	
	// $('#turnBtn').bind('touchmove',function(e){
	    //获取滑动屏幕时的X,Y
        // console.log(e.originalEvent.changedTouches[0])
	    // endX = e.originalEvent.changedTouches[0].pageX,
	    // endY = e.originalEvent.changedTouches[0].pageY;
	    //获取滑动距离
	    // distanceX = endX-startX;
	    // distanceY = endY-startY;
	    //判断滑动方向
	//  if(Math.abs(distanceX)>Math.abs(distanceY) && distanceX>0){
	//      alert('往右滑动');
	//  }else if(Math.abs(distanceX)>Math.abs(distanceY) && distanceX<0){
	//      alert('往左滑动');
	//  }else if(Math.abs(distanceX)<Math.abs(distanceY) && distanceY<0){
	//      alert('往上滑动');
	//  }else if(Math.abs(distanceX)<Math.abs(distanceY) && distanceY>0){
	//      alert('往下滑动');
	//  }else{
	//      alert('点击未滑动');
	//  }
		
	// 	if(i==1){
	// 		angle+=172;
	// 	}else{
	// 		angle+=360;
	// 	}
	// 	$(this).css("transform","rotate("+angle+"deg)");
	// 	i++;
	// });


//获得point2顶角的弧度值
function getAngle(point1, point2, point3) {
    var bb = (point2.y - point1.y) * (point2.y - point1.y) + (point2.x - point1.x) * (point2.x - point1.x);
    var aa = (point3.y - point1.y) * (point3.y - point1.y) + (point3.x - point1.x) * (point3.x - point1.x);
    var cc = (point3.y - point2.y) * (point3.y - point2.y) + (point3.x - point2.x) * (point3.x - point2.x);
    var cosa = (bb + cc - aa) / (2 * Math.sqrt(bb) * Math.sqrt(cc));
    return Math.acos(cosa);
}

//通过面积量的方法来判断顺时针还是逆时针
//point1传入圆心，point2传入起始点，point3传入终点
function duration(point1, point2, point3) {
    var sp = (point1.x-point3.x)*(point2.y-point3.y)-(point1.y-point3.y)*(point2.x-point3.x);
    // console.log(sp);
    if(sp>0) {
        return 1
    } else if(sp<0) {
        return -1
    } else {
        return 0;
    }
}

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

var pan = document.getElementById('turnBtn')
$(document).on('touchstart', function(e) {
    e.preventDefault();
}).on('touchmove', function(e) {
    e.preventDefault();
});
pan.addEventListener('touchstart', function (e) {
    var touche = e.touches[0];
    oX = touche.clientX;
    oY = touche.clientY;
    pointO = {
        x: oX,
        y: oY
    }
})
pan.addEventListener('touchmove', function(e) {
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
    $('#turnBtn').css({
        '-webkit-transform': 'rotate(' + ro + 'rad)',
        'transform': 'rotate(' + ro + 'rad)'
    });
});
pan.addEventListener('touchend', function() {
    rolate = ro;
});
});