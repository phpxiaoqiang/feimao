var path = $('#path');

Draggable.create("#indicator", {
    type: "rotation",
    throwProps: true,
    maxRotation: 360,
    onDrag: function() {
        var i = this.rotation;
        var angle = 620*(1-i/360);
        path.css('stroke-dashoffset', angle);
//  console.log(620*(1-i/360));
        if((angle<330&&angle>323)||(angle>943&&angle<951)){
            setTimeout('toPageTwo()',500);
        }
    },
});

function toPageTwo(){
    location.href='two.html';
}
