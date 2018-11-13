<?php foreach ($model as $item): ?>
    <a href="/media/detail?id=<?= $item['id'] ?>">
        <div class="media-item">
            <img src="<?=$item['pic']?>" alt="">
            <div class="float-tab">
                <span class="icon-play-s"></span>
                <span class="look-num"><?=$item['playNum']?></span>
            </div>
            <div class="media-item-text state1">
                <h3><?//=$item['title']?></h3>
            </div>
        </div>
    </a>
<?php endforeach; ?>
