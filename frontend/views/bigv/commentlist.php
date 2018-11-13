 <?php foreach($model as $item):?>
        <div class="comment-container">
            <div class="comment-list">
                <div class="comment-item">
                    <div class="comment-item-top">
                        <div class="img"><img src="<?=$item['headimgurl']?>" alt=""></div>
                        <div class="right">
                            <span class="name"><?=$item['nickname']?></span>
                            <span class="time"><?=date('Y/m/d', strtotime($item['created_at']))?></span>
                        </div>
                    </div>
                    <p class="comment-text"><?=$item['content']?></p>
                </div>
            </div>
        </div>
             <?php endforeach;?>