<?php foreach ($model as $item): ?>
    <div class="author-item">
        <div class="author-por">
            <div class="author-img">
                <img src="<?= $item['user']['headimgurl'] ?>" alt="">
            </div>
            <div class="author-right">
                <div class="author-right_1"><span class="name"><?= $item['username'] ?></span><span
                </div>
                <p class="author-right_text"><?= $item['describe'] ?></p>
                <div class="time">开约时间：<?= $item['subscribe']['subscribe_startTime'] ?></div>
            </div>
        </div>
        <div class="order-btn-wrap">
            <?php if (strtotime($item['subscribe']['subscribe_startTime']) > time())  : ?>
                <div class="o_wait_btn">等待开始</div>
            <?php elseif (strtotime($item['subscribe']['subscribe_startTime']) < time() && time() < strtotime($item['subscribe']['subscribe_endTime'])) : ?>
                <div class="o_wait_btn">
                    <a href="/chat/index?oid=<?= $item['oid'] ?>">进入聊天室</a>
                </div>
            <?php elseif (strtotime($item['subscribe']['subscribe_endTime']) < time()) : ?>
                <div class="o_wait_btn">已结束</div>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>

