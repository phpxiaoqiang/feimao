<div class="container mt30">
    <div class="t-title">评价</div>
        <div class="order-box comment-box author-item">
            <span class="border-left"></span>
            <span class="border-right"></span>
            <div class="order-box-flex">
                <div class="img"><img src="<?=$res->avatar?>" alt=""></div>
                <div class="order-box-r">
                    <h4><?=$res->name?></h4>
                    <p style="display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 2;overflow: hidden;"><?=$res->desc?></p>
                </div>
            </div>
            <div class="star-wrap">
                <span>评价满意度</span>
                <div class="star-list">
                    <span class="star"></span>
                    <span class="star "></span>
                    <span class="star"></span>
                    <span class="star"></span>
                    <span class="star"></span>
                </div>
            </div>
        </div>
        <div class="comment-tag clearfloat">
            <?php foreach ($labelComment as $item): ?>
            <span class="tag-item" data-id ="<?=$item['id']?>"><?=$item['name']?></span>
            <?php endforeach; ?>
<!--            <span class="tag-item">声音温柔</span>-->
<!--            <span class="tag-item">善于倾听</span>-->
<!--            <span class="tag-item">非常专业</span>-->
<!--            <span class="tag-item">态度很好</span>-->
<!--            <span class="tag-item">很有收获</span>-->
<!--            <span class="tag-item">回复不及时</span>-->
<!--            <span class="tag-item">回复很快</span>-->
<!--            <span class="tag-item">专业度低</span>-->
<!--            <span class="tag-item">态度差</span>-->

        </div>
</div>

<div class="bd1_form"></div>

<div class="container">
    <div class="form-textarea">
        <h4>咨询评价</h4>
        <div class="text-area">
            <textarea name="" id="comment_text" placeholder="请描述您需要评价的内容..."></textarea>
            <div class="num"><span id="text_num">0</span>/100</div>
        </div>
    </div>
    <button class="finish-btn">发布</button>
</div>

<script>
    $(function () {
        var tagArr = [];
         $('.tag-item').on('click', function () {
             var _this = $(this);
             console.log(_this.attr('data-id'));
             var thisId = _this.attr('data-id');
             if(_this.hasClass('active')) {
                 _this.removeClass('active');
                 for(var i=0; i < tagArr.length; i++) {
                     if(tagArr[i] === thisId) {
                         tagArr.splice(i, 1);
                         break;
                     }
                 }
             } else {
                 _this.addClass('active');
                 if(tagArr.indexOf(thisId) === -1 ) {
                     tagArr.push(thisId)
                 }
                 else {
                     return false
                 }
             }
             console.log(tagArr)
         });

//         var starLen = $('.star-list').children('.star');
         $('.star').on('click', function () {
             var _index = $(this).index();
             var _this = $(this);
             for(var i = 0; i <= _index; i++) {
                 if ($(this).hasClass('active')) {
                     _this.removeClass('active');
                     _this.nextAll('.star').removeClass('active');
                 } else {
                    $('.star').eq(i).addClass('active');
                 }
             }
         });

         $('.finish-btn').on('click', function () {
             var starLen = $('.star.active').length;
             var content = $('#comment_text').val();
             // if (content.length === 0 ) {
             //     alert('请填写评论内容');
             //     return
             // }

             $.ajax({
                 url: '/comment/receive',
                 method: 'post',
                 data: {
                     star: starLen,
                     tag: tagArr,
                     content: content,
                     cid:<?=$_GET['id']?>,
                     sid:<?=$_GET['sid']?>,
                 },
                 success: function (res) {
                     alert('评论成功,为您跳到首页');
                     window.location.href = "/"
                 }
             })
         })
         $('#comment_text').on('propertychange input', function() {
             var $this = $(this),  
                 _val = $this.val(),  
                 count = ""
             if (_val.length > 100) {
                 $this.val(_val.substring(0, 100))
             }  
             count = 100 - $this.val().length;  
             $("#text_num").text(count);  
         })
    })

</script>
