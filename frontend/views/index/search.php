
<div class="container block">
    <div class="t-title">预约：</div>
    <div class="block">
        <div class="reserve-input">
            <label for="">家长姓名:</label>
            <input type="text" id="p_name">
        </div>
        <div class="reserve-input">
            <label for="">手&nbsp;&nbsp;机&nbsp;号:</label>
            <input type="number" id="tel">
        </div>
        <div class="reserve-input">
            <label for="">孩子姓名:</label>
            <input type="text" id="baby_name" />
        </div>
        <div class="reserve-input">
            <label for="">孩子年龄:</label>
            <input type="number" id="age">
        </div>
    </div>
    <div class="form-textarea">
        <h4 style="color:#999;">备注</h4>
        <div class="text-area">
            <textarea name="" id="comment_text" placeholder="请描述您需要咨询的内容..."></textarea>
            <div class="num"><span id="text_num">0</span>/50</div>
        </div>
    </div>
    <button class="finish-btn" id="btn">提交预约</button>
</div>

<script>
    $(function () {
        $("#btn").click(function(){

            var p_name = $("#p_name").val();
            if(p_name==''){
                alert('请填写你的名称');
                return false;
            }
            var tel =$("#tel").val();
            var myreg=/^[1][3,4,5,7,8][0-9]{9}$/;
            if (!myreg.test(tel)) {
                alert('手机号码不正确');
                return false;
            }
            // if (!(/^1[3|4|5|7|8][0-9]\d{4,8}$/.test(tel))) {
            //     alert("不是完整的11位手机号或者正确的手机号前七位");
            //     return false;
            // }
            var baby_name = $("#baby_name").val();
            if(baby_name ==''){
                alert('请填写宝贝名称');
                return false;
            }
            var age = $("#age").val();
            if(age ==''){
                alert('请填写宝贝年龄');
                return false;
            }
            var id = <?=$_GET['id']?>;
            var comment_text = $("#comment_text").val();
            $.get('/index/addapp',{p_name:p_name,tel:tel,baby_name:baby_name,age:age,comment_text:comment_text,id:id},function(data){
              if(data=='1'){
                alert('预约成功，专职老师稍后会联系您~~');
                window.location.href = '/';
              }else{
                  alert('网络开小差，预约失败，请稍后再试~~');

              }
            });
        });
        $('#comment_text').on('propertychange input', function() {
            var $this = $(this),
                _val = $this.val(),
                count = ""
            if (_val.length > 50) {
                $this.val(_val.substring(0, 50))
            }
            count = 50 - $this.val().length;
            $("#text_num").text(count);
        })
    })
</script>