var url = "";
$(function () {
    $("body").on("touchstart", function (e) {
        e.preventDefault();
        // console.log(e)
        startX = e.originalEvent.changedTouches[0].pageX,
        startY = e.originalEvent.changedTouches[0].pageY;
    });
    $("body").on("touchend", function (e) {
        e.preventDefault();
        moveEndX = e.originalEvent.changedTouches[0].pageX,
        moveEndY = e.originalEvent.changedTouches[0].pageY,
        X = moveEndX - startX,
        Y = moveEndY - startY;
        var curPage = $(".arrow_up").attr('curPage');
        // console.log(Y)
        // if (Math.abs(X) < Math.abs(Y)) {
            if (Y < -40) { //向上滑
                if (curPage == '2') {
                    //	 	  	location.href="three.html";
                    url = "page3.html";
                } else if (curPage == '3') {
                    //	 	  	location.href="four.html";
                    url = "page4.html";
                } else if (curPage == '4') {
                    //	 	  	location.href="five.html";
                    url = "page5.html";
                } else if (curPage == '5') {
                    //	 	  	location.href="six.html";
                    url = "page6.html";
                } else if (curPage == '6') {
                    //	 	  	location.href="seven.html";
                    url = "page7.html";
                }
                toPage()
            } else if (Y > 40) { //向下滑
                if (curPage == '2') {
                    //	 	  	location.href="one.html";
                    url = "page1.html";
                } else if (curPage == '3') {
                    //	 	  	location.href="two.html";
                    url = "page2.html";
                } else if (curPage == '4') {
                    //	 	  	location.href="three.html";
                    url = "page3.html";
                } else if (curPage == '5') {
                    //	 	  	location.href="four.html";
                    url = "page4.html";
                } else if (curPage == '6') {
                    //	 	  	location.href="five.html";
                    url = "page5.html";
                } else if (curPage == '7') {
                    //	 	  	location.href="six.html";
                    url = "page6.html";
                }
                toPage()
            }
    });
});

function toPage() {
    location.href = url;
}