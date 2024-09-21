<section class="intro-head" style="background: url(<?php echo $space->imagePath(ns_filter('spaceIntroBack'));?>);">
	<div class="container">
		<div class="ihead-well">
			<div class="well-one">
				<i class="<?php echo ns_filter('icon');?> durdur"></i>
			</div>
			<div class="well-two">
				<h1><?php echo ns_filter('title');?></h1>
				<p><?php echo ns_filter('description');?></p>
			</div>
		</div>
	</div>
</section>
<section class="contact-area">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="contact-form">
					<form class="recaptchaControl" id="msform" method="POST" action="">
					<div class="form-row">
						<div class="text-center w-100 mt-3">
							<?php
							if (isset($succes))
							{
								echo '<script>setTimeout(function(){window.location = window.location.href;},10000);</script>';
								echo '<div class="alert alert-success" id="alert-islem-adresi">'._e('İletişim isteğin bize başarıyla ulaştı',true).'.</div>';
							} ?>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label class="font-weight-bold"><?php _e("Adınız Soyadınız");?></label>
								<input type="text" class="form-control" required="" name="i_ad_soyad" <?php if(isset($error)) { echo 'value="'.$post["i_ad_soyad"].'"';} ?> placeholder="<?php _e("Adınız Soyadınız");?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="font-weight-bold"><?php _e("E-Posta");?></label>
								<input type="email" class="form-control" required="" name="i_mail" <?php if(isset($error)) { echo 'value="'.$post["i_mail"].'"';} ?> placeholder="<?php _e("E-Posta Adresiniz");?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="font-weight-bold"><?php _e("Telefon");?></label>
								<input type="text" class="form-control" required="" name="i_telefon" <?php if(isset($error)) { echo 'value="'.$post["i_telefon"].'"';} ?> placeholder="<?php _e("Telefon Numaranız");?>">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label class="font-weight-bold"><?php _e("Konu");?></label>
								<input type="text" class="form-control" required="" name="i_konu" <?php if(isset($error)) { echo 'value="'.$post["i_konu"].'"';} ?> placeholder="<?php _e("İletişim Sebebi");?>">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label class="font-weight-bold"><?php _e("Mesajınız");?></label>
								<textarea class="form-control" required="" name="i_mesaj" placeholder="<? _e("Lütfen mesajınızı yazınız");?>"><?php if(isset($error)) { echo $post["i_mesaj"];} ?></textarea>
							</div>
						</div>
						<div class="text-center w-100 mt-3">
							<?php 
								if (ns_filter('recaptcha','item5'))
								{
									echo '<div class="recaptcha"><div class="g-recaptcha" data-sitekey="'.ns_filter('recaptcha').'"></div></div><div id="captcha"></div>';
									echo '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
								}
								if(isset($error))
								{
								echo '<div class="alert alert-danger" id="alert-islem-adresi">'._e("Tüm alanları eksiksiz doldurmalısın",true).'.</div>';
								}
							 ?>
							<input type="hidden" name="contact-form" value="">
							<button class="btn contact-send-btn" onclick="return get_action(this)"><?php _e("Gönder");?></button>
						</div>
					</div>
				</form>
				</div>
			</div>
			<?php 
			$contact = true;
			include_once "include/sideBarContact.php";?>
		</div>
	</div>
</section>
<?php $space->footBox("contact");?>