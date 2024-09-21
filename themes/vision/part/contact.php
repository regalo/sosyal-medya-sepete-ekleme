<section id="intall" class="wow fadeInDown">	
	<div class="container">
		<div class="intall reserve">
			<img class="introBG lazy" src="<?php echo $loaderPng;?>" data-src="<?php echo $introBack;?>" alt="<?php echo $title_page;?>">
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
<section class="contactPage wow fadeInUp">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="contactArea mb-5">
					<form class="loftForm" id="contactForm">
						<input type="hidden" name="contact-form" value="1">
						<input type="hidden" name="loftAction" value="contactCreate">
						<div class="row gp-3">
							<div class="col-md-12">
								<label class="ns-label"><?php _e("adiniz-soyadiniz");?></label>
								<input type="text" class="ns-control mb-4" required="" name="i_ad_soyad" placeholder="<?php _e("adiniz-soyadiniz");?>">
							</div>
							<div class="col-md-6">
								<label class="ns-label"><?php _e("telefon");?></label>
								<input type="text" class="ns-control mb-4" required="" name="i_telefon" placeholder="<?php _e("telefon");?>">
							</div>
							<div class="col-md-6">
								<label class="ns-label"><?php _e("e-posta-adresiniz");?></label>
								<input type="text" class="ns-control mb-4" required="" name="i_mail" placeholder="<?php _e("e-posta");?>">
							</div>
							<div class="col-md-12">
								<label class="ns-label"><?php _e("konu");?></label>
								<input type="text" class="ns-control mb-4" required="" name="i_konu" placeholder="<?php _e("konu-belirtin-yaziniz");?>">
							</div>
							<div class="col-md-12">
								<label class="ns-label"><?php _e("mesajiniz");?></label>
								<textarea class="ns-control mb-4" required="" name="i_mesaj" placeholder="<?php _e("mesajinizi-yaziniz");?>"></textarea>
							</div>
							<?php if(isset($recaptcha) AND $recaptcha!=false) { ?>
								<div class="recaptcha">
									<div class="g-recaptcha" data-sitekey="<?php echo $recaptcha;?>"></div>
								</div>
								<div id="captcha"></div>
								<script src="https://www.google.com/recaptcha/api.js" async defer></script>
							<?php } ?>
							<div class="col-md-12">
								<button class="btn comSend anibut mt-2"><?php _e("gonder");?> <span><i class="fas fa-paper-plane"></i></span></button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-4">
				<?php include_once "include/sidebar.php";?>
			</div>
		</div>
	</div>
</section>
