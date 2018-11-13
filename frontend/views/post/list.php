<?php foreach ($model as $item): ?>
    <a href="/post/detail?id=<?= $item['id'] ?>">
        <div class="page-item">
            <img src="<?= $item['pic'] ?>" alt="">
            <div class="page-item-text">
                <h3><?//= $item['title'] ?></h3>
                <p><?//= $item['desc'] ?></p>
            </div>
        </div>
    </a>
<?php endforeach; ?>

