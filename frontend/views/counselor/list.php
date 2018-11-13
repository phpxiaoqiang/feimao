<?php
use common\models\Comment;
?>
<?php foreach ($model as $item): ?>
    <a href="/counselor/detail?id=<?= $item['id'] ?>">
    <div class="author-item">
        <div class="author-por">
            <div class="author-img">
                <img src="<?= $item['avatar'] ?>" alt="">
            </div>
            <div class="author-right">
                <div class="author-right_1"><span class="name"><?= $item['name'] ?></span><span class="showed"><?= $item['subscribe_num'] ?>已预约</span>
                </div>
                <p class="author-right_text"><?= $item['desc'] ?></p>
                <?php if(count($item['subscribe']) > 0 ) :?>
                    <div class="time">开约时间：<?=date('Y.m.d',strtotime($item['subscribe'][0]['subscribe_startTime']))  ?></div>
                <?php else :?>
                    <div class="time">开约时间：</div>
                <?php endif;?>
                原价：<s>600</s>
                <div class="orderd">
                  现价：  <?= $item['subscribe_price']-$item['subscribe_voice_price'] >0?$item['subscribe_voice_price']/100:$item['subscribe_price']/100 ?>起/60分钟</div>
            </div>
        </div>
        <div class="comment-num">
            <a href="/comment/index?id=<?=$item['id']?>">
                <?=Comment::find()->where(['c_id' => $item['id']])->count(); ?>条评价
            </a>
        </div>
        <div class="tag-list">
            <?php foreach ($item['label'] as $label): ?>
                <span><?= $label['name'] ?></span>
            <?php endforeach; ?>
        </div>
        <div class="order-btn-wrap">
            <a href="/counselor/appointment?id=<?= $item['id'] ?>">立即预约</a>
        </div>
    </div>
    </a>
<?php endforeach; ?>

