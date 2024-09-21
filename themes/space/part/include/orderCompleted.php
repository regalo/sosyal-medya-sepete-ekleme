<section class="order-area">
	<div class="container">
			<div class="row">
				<div class="col-md-4 m-or2">
					<div class="order-pack-area">
						<div class="form-control f-bilg mb-2">
							<?php _e("Sipariş Kodu");?>: <span>#<?php echo ns_filter('siparis','sp_code');?></span>
						</div>
						<div class="form-control f-bilg mb-2">
							<?php _e("Ürün");?>: <span id="service_amount"><?php echo ns_filter('siparis','sp_paket_adi');?></span>
						</div>
						<div class="form-control f-bilg mb-2">
							<?php _e("Sipariş Tutarı");?>: <span><?php echo _p(ns_filter('siparis','sp_musteri_tutar'));?></span>
						</div>
					</div>
				</div>
				<div class="col-md-8 m-or1">
					<div class="order-steps">
						<div class="order-steps-tab">
							<ul class="obj-tabcontent">
								<li class="obj-tab" id="now-step1">
									<div class="obj-tabindicator"></div>
									<a class="obj-tablink" href="#">
										<i class="fas fa-link"></i> <span><?php _e("İşlem Detayı");?></span>
									</a>
								</li>
								<li onclick="return false;" class="obj-tab" id="now-step2">
									<div class="obj-tabindicator"></div>
									<a class="obj-tablink">
										<i class="fas fa-address-card"></i> <span><?php _e("Kişisel Bilgiler");?></span>
									</a>
								</li>
								<li class="obj-tab" id="now-step3">
									<div class="obj-tabindicator"></div>
									<a class="obj-tablink">
										<i class="fas fa-credit-card"></i> <span><?php _e("Ödeme Bilgileri");?></span>
									</a>
								</li>
								<li class="obj-tab active" id="now-step4">
									<div class="obj-tabindicator"></div>
									<a class="obj-tablink" href="#">
										<i class="fas fa-paper-plane"></i> <span><?php _e("Sipariş Durumu");?></span>
									</a>
								</li>
							</ul>
						</div>
						<div class="order-steps-content">
							<div class="os-tabs os-tab3 show" id="step4">
								<div class="order-pack-area order-end">
									<div class="form-row">
										<div class="col-md-12">
											<div class="form-group">
												<div class="form-control f-bilg mb-2">
													<?php _e("Sipariş Durumu");?>: <span><?php echo ($siparis->aciklama() AND !empty($siparis->aciklama)) ? $siparis->aciklama:_e($siparis->sorder,true);?></span>
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<div class="form-control f-bilg mb-2">
													<?php _e("Ad Soyad");?>: <span><?php echo $ayar->hideinfo(ns_filter("siparis","sp_musteri_adi"),'name');?></span>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<div class="form-control f-bilg mb-2">
													<?php _e("Telefon");?>: <span id="service_amount"><?php echo $ayar->hideinfo(ns_filter("siparis","sp_musteri_telefon"),'telefon');?></span>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<div class="form-control f-bilg mb-2">
													<?php _e("Mail");?>: <span><?php echo $ayar->hideinfo(ns_filter("siparis","sp_musteri_mail"),'mail');?></span>
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<div class="form-control f-bilg mb-2">
													<?php _e("Sipariş Tarihi");?>: <span><?php echo ns_filter("siparis","sp_time");?></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
				</div>
			</div>
	</div>
</section>