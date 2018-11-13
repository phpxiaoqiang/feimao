   <?php foreach($model as $item): ?>
    <div class="swiper-slide v-card" style="margin: 20px auto">
        <a href="/bigv/detail?id=<?=$item['id']?>">
            <div class="v-title">
                <h3><?=$item['name']?></h3>
                <p><?=$item['introduce']?></p>
            </div>
            <img src="<?=$item['pic']?>" alt="">
        </a>
    </div>
    <?php endforeach; ?>