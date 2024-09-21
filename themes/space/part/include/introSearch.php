<div class="os-area">
	<h1><?php echo $intro["headLine"];?></h1>
	<p><?php echo $intro["description"];?></p>
	<form id="order_search" method="POST">
	<div class="os-search-area">
			<input type="hidden" name="action" value="response">
            <input type="hidden" name="include" value="orderSearch">
			<input type="text" class="form-control" name="islem_kodu" required="" minlength="6" placeholder="<?php _e("Sipariş Numarası Giriniz");?>">
			<button type="submit" class="btn int-search-button int-search-button" data-href="<?php echo $ayar->menulink("iletisim");?>">
				<i class="fas fa-search"></i> <span><?php _e("Sorgula");?></span>
			</button>
	</div>
	</form>
</div>