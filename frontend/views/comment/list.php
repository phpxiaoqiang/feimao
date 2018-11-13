<?php foreach ($model as $item): ?>
    <? if ($item['content']) : ?>
        <div class="comment-item">
            <div class="comment-item-top">
                <div class="img"><img src="<?= $item['headimgurl'] ?>" alt=""></div>
                <div class="right">
                    <span class="name"><?= $item['nickname'] ?></span>
                    <span class="time"><?php $time = strtotime($item['created_at']);
                        echo date('Y/m/d', $time) ?></span>
                </div>
            </div>
            <p class="comment-text"><?= htmlspecialchars($item['content']) ?></p>
        </div>
    <?php endif; ?>
<?php endforeach; ?>