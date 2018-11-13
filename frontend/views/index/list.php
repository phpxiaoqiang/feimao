
        <?php foreach ($model as $item): ?>
            <a href="/post/detail?id=<?= $item->id ?>">
                <div class="course">
                    <img src="<?= $item->pic ?>" alt="">
                    <div class="course-txt">
                        <h3><?= $item->title; ?></h3>
                        <p> <?= $item->desc; ?></p>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>