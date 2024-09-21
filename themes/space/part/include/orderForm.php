<section class="order-area" id="orderContent">
	<div class="container">
		<form method="POST" name="OrderForm" action="">
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
								<li class="obj-tab active" id="now-step1">
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
								<li class="obj-tab" id="now-step4">
									<div class="obj-tabindicator"></div>
									<a class="obj-tablink" href="#">
										<i class="fas fa-paper-plane"></i> <span><?php _e("Ödeme Adımı");?></span>
									</a>
								</li>
							</ul>
						</div>
						<div class="order-steps-content">
							<div class="os-tabs os-tab1 show" id="step1">
								<h4><?php echo $siparis->packet["kategori_info_head"];?></h4>
								<p><?php echo $siparis->packet["kategori_info"];?></p>
								<div class="form-group">
									<input type="text" class="form-control" name="islem_adres" placeholder="<?php echo $siparis->packet["kategori_placeholder"];?>">
								</div>
								<button type="button" class="btn os-next-btn mt-3" data-input="islem_adres" data-tab="step2"><?php _e("Devam Et");?></button>
							</div>
							<div class="os-tabs os-tab2" id="step2">
								<h4><?php _e("Kişisel Bilgiler");?></h4>
								<p><?php _e("Lütfen aşağıdakileri doğru şekilde doldurunuz");?></p>
								<div class="form-row">
									<div class="col-md-12">
										<div class="form-group">
											<input type="text" class="form-control" name="sp_musteri_adi" placeholder="<?php _e("Adınız Soyadınız");?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" name="sp_musteri_mail" placeholder="<?php _e("E-Posta");?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" name="sp_musteri_telefon" maxlength="13" placeholder="<?php _e("Telefon Numarası");?>">
										</div>
									</div>
									<div class="col-md-12 <?php echo !ns_filter('order_setting','statu') ? 'd-none':'';?>">
										<div class="form-group">
											<select class="form-control keskin" name="sp_tur">
												<option value="bireysel"><? _e("Bireysel");?></option>
												<option value="kurumsal"><? _e("Kurumsal");?></option>
											</select>
										</div>
									</div>
									<div class="col-md-12 d-none" id="sp_tur">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<textarea class="form-control" id="sp_musteri_adres" name="sp_musteri_adres" placeholder="<?php _e("Adres");?>"></textarea>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<input type="text" class="form-control" name="sp_musteri_vd" placeholder="<?php _e("Vergi Dairesi");?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<input type="number" class="form-control" name="sp_musteri_vn" placeholder="<?php _e("Vergi Numarası");?>">
												</div>
											</div>
										</div>
									</div>
								</div>
								<button type="button" class="btn os-pri-btn mt-3" data-tab="step1"><?php _e("Geri");?></button>
								<button type="button" class="btn os-next-btn mt-3"  data-input="sp_musteri_adi|sp_musteri_mail|sp_musteri_telefon|sp_musteri_adres|sp_musteri_vd|sp_musteri_vn" data-tab="step3"><?php _e("Devam Et");?></button>
							</div>
							<div class="os-tabs os-tab3" id="step3">
								<h4><?php _e("Ödeme Bilgileri");?></h4>
								<p><?php _e("Lütfen aşağıya varsa kupon kodunuzu girin ve sonrasında ödeme yöntemi seçimi yapıp işleme devam edin");?></p>
								<div class="form-group">
									<div class="coupon-code-input">
										<input type="text" class="form-control" name="sp_musteri_kupon" placeholder="<?php _e("Kupon Kodu");?>">
										<button type="button" class="btn btn-coupon control-coupon"><?php _e('Uygula');?></button>
									</div>
								</div>
								<div class="payment-choice">
									<div class="payments-list">
										<?php
										if (is_array($payment_medhods)) {
										foreach ($payment_medhods as $value) {
										extract($value);
										if ((!isset($post["sp_odeme"]) AND $statu==2) OR isset($post["sp_odeme"]) AND $post["sp_odeme"]==$id) {
											$payment_method = $id;
											$payment_info = $hizmet_bedeli["item4"];
										}
										?>
										<div
											class="pay-item <?php echo $statu==2 ? 'selected':'';?> <?php echo $setting["statu"] ? '':'d-none';?>"
											data-medhod="<?php echo $id;?>"
											data-statu="<?php echo $setting["statu"] ? 'true':'false';?>"
											>
											<div class="pay-icon">
												<i class="<?php echo _py($id)["icon"];?>"></i>
											</div>
											<div class="pay-text"><?php echo _py($id)["name"];?></div>
											<div class="pay-check">
												<div class="pay-check-box">
													<div class="pay-checked">
														<i class="fas fa-check"></i>
													</div>
												</div>
											</div>
										</div>
										<? } } ?>
										<input type="hidden" name="sp_odeme" required="" value="<?php echo isset($payment_method) ? $payment_method:'';?>">
									</div>
									<div class="form-control h-auto p-3" id="payment_info">
										<?php echo !$siparis->packet["payment_info"] ? 'Ödeme yapabileceğiniz hiç bir ödeme yöntemi girilmemiş. Lütfen bizimle iletişime geçiniz.':$siparis->packet["payment_info"];?>
									</div>
									<?php if(ns_filter('order_setting','item4')>0){ ?>
									<div class="usinfor mt-4 ml-1 pt-2 pb-2">
										<input class="inp-cbx" id="check_contract" name="sozlesme" type="checkbox" required="" style="display: none"/>
										<label class="cbx" for="check_contract"><span>
											<svg width="14px" height="12px" viewbox="0 0 12 10">
												<polyline points="1.5 6 4.5 9 10.5 1"></polyline>
											</svg></span><span><a class="sales_contract" href="javascript:void(0);"><?php _e("Kullanım Şartlarını Okudum ve Kabul Ediyorum");?></a></span>
										</label>
									</div>
								    <?php } else { ?>
								    	<input type="hidden" id="check_contract" name="sozlesme" type="checkbox" checked="true" />
								    <?php } ?>
								</div>

								<?php 
								if (ns_filter('recaptcha','item4'))
								{
					                echo '<div class="recaptcha"><div class="g-recaptcha" data-sitekey="'.ns_filter('recaptcha').'"></div></div><div id="captcha"></div>';
					                echo '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
					            }
					            ?>
								<input type="hidden" name="action" value="response">
								<input type="hidden" name="order_completed" value="payment">
								<button type="button" class="btn os-pri-btn mt-3" data-tab="step2"><?php _e('Geri');?></button>
								<button type="submit" class="btn os-next-btn mt-3" data-input="payment|sozlesme<?php echo ns_filter('recaptcha','item4') ? '|recaptcha':'';?>" data-tab="step4"><?php _e('Devam Et');?></button>
							</div>
							<div class="os-tabs os-tab4" id="step4">
								<div class="order-created">
									<i class="fas fa-spinner"></i>
									<span><?php _e('Siparişiniz Oluşturuluyor');?>.</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</section>
<script type="text/javascript">var kaldirButtonText = "<?php _e('Kaldır');?>";</script>
<div class="modal fade bd-example-modal-lg" id="sozlesme" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="contract_head">Kullanım Sözleşmesi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="contract_content">
      </div>
      <div class="modal-footer modal-botto">
        <button type="button" class="btn modal-butto butbor" data-dismiss="modal">Kapat</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$('.sales_contract').click(function(){
	data = {"action":"response","sales_contract":"1"};
	orderPost(data);
	});
</script>