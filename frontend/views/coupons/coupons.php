<?php

/**
 * @Author: jiangyang
 * @Date:   2018-01-15 18:36:58
 * @Last Modified by:   jiangyang
 * @Last Modified time: 2018-01-15 21:32:38
 */
$this->title = '优惠券';
use yii\widgets\LinkPager;
?>
<div class="container">
	<?php if(!empty($isState)):?>
	<a href="/">
	    <div class="get-coupon red open-modal">
	        <span>点击使用</span>
	        <div class="in"><span>免费咨询优惠券</span></div>
	    </div>
	</a>
    <?php else: ?>
    <div class="none-coupon" style="margin-top:10%">
        <span>暂无优惠券</span>
    </div>
<?php endif ;?>
</div>
