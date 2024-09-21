<form class="loftForm" id="loftOrderForm" data-statu="false">
	<input type="hidden" name="order_completed" value="1">
	<input type="hidden" name="loftAction" value="orderCreate">
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
						<span class="countservices">
							<i class="fas fa-tag"></i> <?php echo sprintf(_e("adet-odeme-yontemi",true),$paymentCount);?>
						</span>
					</div>
				</div>
			</div>
			<div class="firstcont">
				<div class="step">
					<h2><?php echo $orderTitle;?></h2>
					<p><?php echo $orderDescription;?></p>
					<input type="text" class="ord-control" name="islem_adres" required="" placeholder="<?php echo $orderPlaceholder;?>">
				</div>
				<div class="step">
					<div class="step">
						<h2><?php _e("iletisim-bilgileriniz");?></h2>
						<p><?php _e("sizden-istenen-bilgileri-eksiksiz-giriniz");?></p>
						<div class="row g-3">
							<div class="col-md-12 <?php echo !$corporate ? 'd-none':'';?>">
								<select class="ord-control customerType" name="sp_tur">
									<option value="bireysel" selected><?php _e("bireysel");?></option>
									<option value="kurumsal"><?php _e("kurumsal");?></option>
								</select>
							</div>
							<div class="col-md-12">
								<input type="text" class="ord-control" name="sp_musteri_adi" required="" placeholder="<?php _e("adiniz-soyadiniz");?>">
							</div>
							<div class="col-md-6">
								<input type="text" class="ord-control" name="sp_musteri_mail" required="" placeholder="<?php _e("e-posta-adresi");?>">
							</div>
							<link rel="stylesheet" href="<?php $loft->path("assets/build/css/intlTelInput.min.css")?>">
							<div class="col-md-6">	
								<input type="text" id="phonesel" class="ord-control" name="sp_musteri_telefon" data-country="" required="" placeholder="<?php _e("telefon-numarasi");?>">
								<input type="hidden" id="spMusteriTelefon" name="sp_musteri_telefon" value="">
							</div>
							<script src="<?php $loft->path("assets/build/js/intlTelInput.js")?>"></script>
							<script>
								var input = document.querySelector("#phonesel");
								countryCode = cookieOku("country-code") !="" ? cookieOku("country-code"):'<?php echo mb_strtolower($countryCode);?>';
								window.intlTelInput(input, {
									preferredCountries: [countryCode],
									/*utilsScript: "<?php $loft->path("assets/build/js/utils.js");?>",*/
								});
							</script>
							<div class="col-md-12 <?php echo !$corporate ? 'd-none':'';?>" id="customerCorporate" style="display:none;">
								<div class="row">
									<div class="col-md-6">
										<input type="text" name="sp_musteri_vd" class="ord-control" placeholder="<?php _e("vergi-dairesi");?>">
									</div>
									<div class="col-md-6">
										<input type="text" name="sp_musteri_vn" class="ord-control" placeholder="<?php _e("vergi-numarasi");?>">
									</div>
									<div class="col-md-12 mt-3">
										<textarea class="ord-control" name="sp_musteri_adres" placeholder="<?php _e("fatura-adresi");?>"></textarea>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="chxarea">
									<input id="c1" name="cookieInfo" type="checkbox">
									<label for="c1"><?php _e("bilgileri-kaydet");?> <span>(<?php _e("sonraki-siparisler-icin-otomatik-doldurulur");?>)</span></label>
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
						<li data-cs="pay" class="active"><?php _e("odeme-yontemi");?></li>
						<li data-cs="det"><?php _e("paket-detaylari");?></li>
					</ul>
				</div>
				<div id="pay" class="tab-content show">
					<div class="orPayDetail">
						<div class="amount">
							<div class="coupon">
								<input type="text" class="ns-control" name="sp_musteri_kupon" placeholder="<?php _e("kupon-kodu-varsa");?>">
								<button type="button" class="coupbtn anibut"><?php _e("uygula");?></button>
							</div>
							<ul>
								<li><?php _e("tutar");?>: <span id="amountProduct"><?php echo $amount["product"];?></span></li>
								<li><?php _e("hizmet-bedeli");?>: <span id="amountService"><?php echo $amount["service"];?></span></li>
								<li><?php _e("kupon-indirimi");?>: <span id="amountDiscount"><?php echo $amount["discount"];?></span></li>
								<li><?php _e("toplam-tutar");?>: <span id="amountTotal"><?php echo $amount["total"];?></span></li>
							</ul>
						</div>
						<div class="PaymentMethod">
							<ul>
								<?php foreach ($payments as $key => $value) { ?>
									<li class="<?php echo $value["statu"]>0 ? 'selectPayment ':'d-none';?><?php echo $value["statu"]==2 ? 'selected':'';?>" data-key="<?php echo $value["string"];?>"><i class="<?php echo $value["icon"];?>"></i> <?php echo $value["text"];?></li>
								<?php } ?>
								<input type="hidden" name="sp_odeme" value="<?php echo isset($paymentSelect) ? $paymentSelect["select"]:'';?>">
							</ul>
						</div>
						<?php if(isset($paymentSelect)){ ?>
							<div class="paymentDetail">
								<p><?php echo $paymentSelect["info"];?></p>
							</div>
						<?php } ?>
						<?php if(isset($contract)){ ?>
							<div class="otherDetail">
								<div class="chxarea free">
									<input required="" name="contract" id="c2" type="checkbox">
									<label for="c2"><a href="#" data-bs-toggle="modal" data-bs-target="#termsofuse"><?php _e("kullanim-sartlari");?></a> <?php _e("okudum-ve-onayliyorum");?>.</label>
								</div>
							</div>
						<?php } ?>
						<?php if(isset($recaptcha) AND $recaptcha!=false) { ?>
							<div class="recaptcha">
								<div class="g-recaptcha" data-sitekey="<?php echo $recaptcha;?>"></div>
							</div>
							<div id="captcha"></div>
							<script src="https://www.google.com/recaptcha/api.js" async defer></script>
						<?php } ?>
						<div class="orderAction mt-4">
							<?php if(isset($paymentSelect)){ ?>
								<button type="submit" class="orActionBTN anibut"><?php _e("odemeye-gec");?> <span><i class="fas fa-shopping-cart"></i></span></button>
							<?php } else {  ?>
								<button type="button" class="orActionBTN anibut" disabled="" style="background-color: #d581b4 !important;"><?php _e("odeme-yontemi-yok");?> <span><i class="fas fa-shopping-cart"></i></span></button>
							<?php } ?>
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
						<button type="button" data-type="packetFavori" data-favPacket="<?php echo $pk_id;?>"  class="favPack"><?php _e("favorilere-ekle");?></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript">
	formCookieControl = true;
	$('input[name="sp_musteri_telefon"]').keypress(function(){
		countryCode = $('input[name="sp_musteri_telefon"]').attr("data-country");
		if(countryCode=="90" & $(this).val().length>9){
			return false;
		}
	});
	$('input[name="sp_musteri_telefon"]').keyup(function(){
		countryCode = $('input[name="sp_musteri_telefon"]').attr("data-country");
		if(countryCode=="90" & $(this).val()=="0"){
			$(this).val("");
		}
	});
</script>