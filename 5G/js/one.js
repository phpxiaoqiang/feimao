var i=1;
var angle=0;
$(function(){
	$("#turnBtn").click(function(){
		if(i==1){
			angle+=172;
		}else{
			angle+=360;
		}
		$(this).css("transform","rotate("+angle+"deg)");
		i++;
	});
});
