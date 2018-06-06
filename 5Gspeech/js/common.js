var url="";
var index=getQueryString('index')?getQueryString('index'):0;
var curPage=$(".arrow_up").attr('curPage');
$(function(){
	$(".page").fadeIn();
	if(index&&curPage==5){
		$("#allSpeaker .speaker").eq(index).fadeIn('slow').siblings().fadeOut('slow');
	}
	$("body").on("touchstart", function(e) {
	 e.preventDefault();
	 startX = e.originalEvent.changedTouches[0].pageX,
	 startY = e.originalEvent.changedTouches[0].pageY;
	});
	$("body").on("touchend", function(e) {
	 e.preventDefault();
	 moveEndX = e.originalEvent.changedTouches[0].pageX,
	 moveEndY = e.originalEvent.changedTouches[0].pageY,
	 X = moveEndX - startX,
	 Y = moveEndY - startY;
	 if(Math.abs(X)<Math.abs(Y)){
	 	if ( Y < 0 ) { //向上滑
	 	  if(curPage=='2'){
//	 	  	location.href="three.html";
			url="three.html";
			setTimeout('toPage()',500);
			return;
	 	  }else if(curPage=='3'){
//	 	  	location.href="four.html";
			url="four.html";
			setTimeout('toPage()',500);
			return;
	 	  }else if(curPage=='4'){
//	 	  	location.href="five.html";
			url="five.html";
			setTimeout('toPage()',500);
			return;
	 	  }else if(curPage=='5'){
	 	  	if(index!=6){
	 	  		$("#allSpeaker .speaker").eq(index+1).fadeIn('slow').siblings().fadeOut('slow');
	 	  		index++;
	 	  	}else{
	 	  		location.href="six.html";
				url="six.html";
				setTimeout('toPage()',500);
	 	  	}
			return;
	 	  }else if(curPage=='6'){
//	 	  	location.href="seven.html";
			url="seven.html";
			setTimeout('toPage()',500);
			return;
	 	  }
		}else if(Y > 0){ //向下滑
		  if(curPage=='2'){
//	 	  	location.href="one.html";
	 	  	url="one.html";
	 	  	setTimeout('toPage()',500);
			return;
	 	  }else if(curPage=='3'){
//	 	  	location.href="two.html";
			url="two.html";
			setTimeout('toPage()',500);
			return;
	 	  }else if(curPage=='4'){
//	 	  	location.href="three.html";
			url="three.html";
			setTimeout('toPage()',500);
			return;
	 	  }else if(curPage=='5'){
	 	  	if(index!=1){
	 	  		$("#allSpeaker .speaker").eq(index-1).fadeIn('slow').siblings().fadeOut('slow');
	 	  		index--;
	 	  	}else{
//	 	  	    location.href="four.html";
				url="four.html";
				setTimeout('toPage()',500);
			}
			return;
	 	  }else if(curPage=='6'){
//	 	  	location.href="five.html";
			url="five.html?index=6";
			index=6;
			setTimeout('toPage()',500);
//			$("#allSpeaker .speaker").eq(index).fadeIn('slow').siblings().fadeOut('slow');
			return;
	 	  }else if(curPage=='7'){
//	 	  	location.href="six.html";
			url="six.html";
			setTimeout('toPage()',500);
			return;
	 	  }
		}
	  }
	  
	});
});

function toPage(){
	location.href=url;
}
function getQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    var r = window.location.search.substr(1).match(reg);
    if ( r != null ){
       return unescape(r[2]);
    }else{
       return null;
    } 
}
//var startX;
//var startY;
//function handleTouchEvent(event) {
//  switch (event.type){
//      case "touchstart":
//          startX = event.touches[0].pageX;
//          startY = event.touches[0].pageY;
//          break;
//      case "touchend":
//          var spanX = event.changedTouches[0].pageX - startX;
//          var spanY = event.changedTouches[0].pageY - startY;
//
//          if(Math.abs(spanX) > Math.abs(spanY)){      //认定为水平方向滑动
//              if(spanX > 30){         //向右
//                  myRight();
//              } else if(spanX < -30){ //向左
//                  myLeft();
//              }
//          } else {        //认定为垂直方向滑动
//              if(spanY > 30){         //向下
//                  myDown();
//              } else if (spanY < -30) {//向上
//                  myUp();
//              }
//          }
//
//          break;
//      case "touchmove":
//          //阻止默认行为
//          event.preventDefault();
//          break;
//  }
//}
