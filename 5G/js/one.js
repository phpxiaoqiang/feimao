var i=1;
var angle=0;
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
	
	$('#turnBtn').bind('touchmove',function(e){
	    //获取滑动屏幕时的X,Y
	    endX = e.originalEvent.changedTouches[0].pageX,
	    endY = e.originalEvent.changedTouches[0].pageY;
	    //获取滑动距离
	    distanceX = endX-startX;
	    distanceY = endY-startY;
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
		
		if(i==1){
			angle+=172;
		}else{
			angle+=360;
		}
		$(this).css("transform","rotate("+angle+"deg)");
		i++;
	});
});
