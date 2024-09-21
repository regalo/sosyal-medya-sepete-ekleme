<div class="row">
	<div class="col-md-8">
		<div class="intall order">
			<img class="introBG lazy" src="<?php echo $loaderPng;?>" data-src="<?php echo $introBack;?>" alt="">
			<div class="conts">
				<div class="icobox">
					<i class="<?php echo $icon;?>"></i>
				</div>
				<div class="detabox">
					<h1><?php echo $title_page;?></h1>
					<p><?php echo $description;?></p>
				</div>
			</div>
		</div>
		<?php
		if (file_exists(ns_filter('payment_company','file')))
			include_once ns_filter('payment_company','file');
		?>
	</div>
	<div class="col-md-4">
		<div class="orderTabs">
			<div class="tabOption">
				<ul>
					<li data-cs="pay" class="active"><?php _e("odeme");?></li>
					<li data-cs="det"><?php _e("paket-detaylari");?></li>
				</ul>
			</div>
			<div id="pay" class="tab-content show">
				<div class="orPayDetail">
					<div class="PaymentMethod">
						<ul>
							<?php foreach ($payments as $key => $value) { ?>
							<li class="<?php echo $value["statu"]!=2 ? 'd-none':'selected';?>"><i class="<?php echo $value["icon"];?>"></i> <?php echo $value["text"];?></li>
							<?php } ?>
						</ul>
					</div>
					<div class="amount">
						<ul>
							<li><?php _e("tutar");?>: <span id="amountProduct"><?php echo $amount["product"];?></span></li>
							<li><?php _e("hizmet-bedeli");?>: <span id="amountService"><?php echo $amount["service"];?></span></li>
							<li><?php _e("kupon-indirimi");?>: <span id="amountDiscount"><?php echo $amount["discount"];?></span></li>
							<li><?php _e("toplam-tutar");?>: <span id="amountTotal"><?php echo $amount["total"];?></span></li>
						</ul>
					</div>
				</div>
			</div>
			<div id="det" class="tab-content">
				<div class="orPackDetail">
					<span><?php echo $productName;?></span>
					<ul>
						<?php foreach ($features as $value) {
							echo '<li>'.$value.'</li>';
						}
						?>
					</ul>
					<button data-type="packetFavori" data-favPacket="<?php echo $pk_id;?>"  class="favPack"><?php _e("favorilere-ekle");?></button>
				</div>
			</div>
		</div>
	</div>
</div>