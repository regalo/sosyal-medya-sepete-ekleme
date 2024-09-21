<section class="order-area"  id="payment_form">
	<div class="container">
			<div class="row">
				<div class="col-md-4 m-or2">
					<div class="order-pack-area">
						<div class="order-accordion mb-3" id="packaccordion">
							<div class="card">
								<div class="card-header" id="headingOne" data-toggle="collapse" data-target="#packdetail" aria-expanded="true" aria-controls="packdetail">
									<div class="box-title"><?php echo $siparis->packet["fullname"];?>
										<span><i class="fas fa-chevron-down"></i></span>
									</div>
								</div>
								<div id="packdetail" class="collapse show" aria-labelledby="headingOne" data-parent="#packaccordion" style="">
									<div class="card-body">
										<div class="order-pack-list">
											<ul><?php
											$paket->pk_id = ns_filter('paket','pk_id');
											echo $space->paketOzellik($paket->ozellikler(),'<i class="fas fa-chevron-right" aria-hidden="true"></i> ');?></ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-control f-bilg mb-2">
							<?php _e("Ücret");?>: <span id="price"><?php echo $siparis->packet["price"];?></span>
						</div>
						<div class="form-control f-bilg mb-2">
							<?php _e("Hizmet Bedeli");?>: <span id="service_amount"><?php echo $siparis->packet["service_amount"];?></span>
						</div>
						<div class="form-control f-bilg mb-2">
							<?php _e("Kupon İndirimi");?>: <span id="coupon_discount"><?php echo $siparis->packet["coupon_discount"];?></span>
						</div>
						<div class="form-control f-bilg">
							<?php _e("Toplam");?>: <span id="total_amount"><?php echo $siparis->packet["total_amount"];?></span>
						</div>
					</div>
				</div>
				<div class="col-md-8 m-or1">
					<div class="order-steps">
						<div class="order-steps-tab">
							<ul class="obj-tabcontent">
								<li class="obj-tab " id="now-step1">
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
										<i class="fas fa-paper-plane"></i> <span><?php _e("Ödeme Adımı");?></span>
									</a>
								</li>
							</ul>
						</div>
						<div class="order-steps-content">
							<div class="os-tabs os-tab3 show" id="step4">
								<?php
								if (file_exists(ns_filter('payment_company','file')))
									include_once ns_filter('payment_company','file');
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>
</section>
<style type="text/css">
	.nonshake {
	animation: shake 0.2s cubic-bezier(.11,.07,.19,.10) both;
	transform: translate3d(0, 0, 0);
	backface-visibility: hidden;
	perspective: 1000px;
	}
	.obj-tabindicator {
		opacity: 0;
	}
	.active .obj-tabindicator {
		opacity: 1;
	}
	.active .obj-tablink {
		color: #fff !important;
		z-index: 2;
	}
</style>
<script type="text/javascript">setTimeout(function(){$('html, body').animate({scrollTop: $('#payment_form').offset().top}, 'slow');},1000);</script>