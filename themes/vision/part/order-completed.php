<section id="intall" class="wow fadeInDown mb-5">
	<div class="container">
		<div class="intall reserve">
			<img class="introBG" src="<?php echo $introBack;?>" alt="">
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
	</div>
</section>
<section class="orderArea mt-0 wow fadeInUp">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="firstcont">
					<div class="step">
						<div class="step">
							<div class="row g-3">
								<div class="col-md-6">
									<div class="ord-control text">
										<span><?php _e("siparis-kodu");?></span>
										#<?php echo $sp_code;?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="ord-control text">
										<span><?php _e("siparis-tarihi");?></span>
										<?php echo $sp_time;?>
									</div>
								</div>
								<div class="col-md-12">
									<div class="ord-control text">
										<span><?php _e("urun");?></span>
										<?php echo $sp_paket_adi;?>
									</div>
								</div>
								<div class="col-md-12">
									<div class="ord-control text">
										<span><?php _e("siparis-durumu");?></span>
										<?php echo $statuText;?>
									</div>
								</div>
								<div class="col-md-12">
									<div class="ord-control text">
										<span><?php _e("ad-soyad");?></span>
										<?php echo $sp_musteri_adi;?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="ord-control text">
										<span><?php _e("e-posta");?></span>
										<?php echo $sp_musteri_mail;?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="ord-control text">
										<span><?php _e("telefon");?></span>
										<?php echo $sp_musteri_telefon;?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="orderTabs">	
					<div class="tabOption">
						<ul>
							<li data-cs="pay" class="active"><?php _e("bilgiler");?></li>
							<li data-cs="det"><?php _e("paket-detaylari");?></li>
						</ul>
					</div>
					<div id="pay" class="tab-content show">
						<div class="orPayDetail">
							<div class="amount statu">
								<ul>
									<li>
										<span><?php _e("durum");?>:</span>
										<?php echo $statuHead;?>
									</li>
									<li>
										<span><?php _e("islem-adresi");?>:</span>
										<?php echo $islemAdresi;?>
									</li>
									<li>
										<span><?php _e("odeme-yontemi");?>:</span>
										<?php echo $odemeYontemi;?>
									</li>
									<li>
										<span><?php _e("odenen-tutar");?>:</span>
										<?php echo $sp_musteri_tutar;?>
									</li>
								</ul>
							</div>
							<?php if($spText!=false){ ?>
							<div class="paymentDetail">
								<p><?php echo $spText;?></p>
							</div>
						    <?php } ?>
						</div>
					</div>
					<div id="det" class="tab-content">
						<div class="orPackDetail">
							<span><?php echo $sp_paket_adi;?></span>
							<?php if(isset($features)) { ?>
							<ul>
								<?php foreach ($features as $value) {
									echo '<li>'.$value.'</li>';
								}
								?>
							</ul>
							<button data-type="packetFavori" data-favPacket="<?php echo $pk_id;?>"  class="favPack"><?php _e("favorilere-ekle");?></button>
						    <?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	setTimeout(function(){
		cookieOrdersNew("<?php echo $sp_musteri_link;?>");
	},500);
</script>