<?php
$this->title = '提问';
?>
<form action="/bigv/comment" method="post">
	<textarea name="area" id="comment_area" class="comment-area" placeholder="说出你的问题" ></textarea>
	<input name="_csrf-frontend" type="hidden" value="<?= Yii::$app->request->csrfToken ?>"/>

	<input name="_id" type="hidden" value="<?=Yii::$app->request->get('id');?>"/>
	<input class="comment-btn" type="submit" value="发表">
</form>
<script>
    $(function() {
        $('#comment_area').on('focus', function(event) {
            $('.comment-btn').css({
                bottom: '330px'
            });
        });
        $('#comment_area').on('blur', function(event) {
            $('.comment-btn').css({
                bottom: '50px'
            });
        });
    })
</script>
