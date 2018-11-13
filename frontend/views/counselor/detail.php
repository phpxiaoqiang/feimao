<?php
    $this->title = '咨询师详情';
?>
<div class="pb60">
    <div class="container mt30">
        <div class="t-title"><?= $data['name'] ?></div>
        <div class="author-page">
            <img src="<?=$data['photo']?>" alt="">
            <p><?= $data['desc'] ?></p>
        </div>
        <div class="order-time">
            <?php if(count($data['subscribe']) > 0 ) :?>
                <div class="time-line"><span>预约时间：<?= $data['subscribe'][0]['subscribe_startTime'] ?></span></div>
            <?php else :?>
                <div class="time-line"><span>预约时间：</span></div>
            <?php endif;?>
            <p><?= $data['subscribe_num'] ?>人已预约</p>
        </div>
    </div>

    <div class="container mt30">
        <h2 class="c-title"><span>TA的文章</span> <a href="/post/index?id=<?=$data['id']?>">more</a></h2>
        <div class="page-list">
            <?php foreach ($post as $item): ?>
                <div class="page-item">
                    <a href="/post/detail?id=<?= $item['id'] ?>">
                    <img src="<?= $item['pic'] ?>" alt="">
                    <div class="page-item-text">
                        <h3><?//= $item['title'] ?></h3>
                        <p><?//= $item['desc'] ?></p>
                    </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <a href="/counselor/appointment?id=<?= $data['id'] ?>" class="btn-order-red">立即预约</a>


