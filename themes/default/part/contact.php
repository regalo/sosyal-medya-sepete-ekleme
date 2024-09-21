<section id="introx" class="clearfix xrb keskin <?php echo ns_filter('default-desen'); ?> ns-ortala">
  <div class="alans1 fadeInUp">
    <div class="text-center text-white">
      <div class="sipbaslik">
        <i class="<?= ns_filter('icon');?>"></i>
        <h1 class="font-weight-bold"><?= ns_filter('title');?></h1>
        <p><?= ns_filter('description');?></p>
      </div>
    </div>
  </div>
  <div class="<?php echo ns_filter('default-class');?>-head"></div>
</section>
<main id="main">
  <div class="container">
    <div class="row mt-5 mb-5">
      <div class="col-md-8 <?php if(empty(ns_filter("default-c_detail")) OR ns_filter("default-c_detail","statu")=="0") { echo 'offset-md-2'; } ?>">
        <form id="msform" class="contact-cform" method="POST" action="">
          <fieldset class="keskin">
            <div class="row iform">
              <div class="col-md-12">
                <label class="font-weight-bold"><?php _e("Adınız Soyadınız");?></label>
                <input type="text" class="keskin" required="" name="i_ad_soyad" <?php if(isset($error)) { echo 'value="'.$post["i_ad_soyad"].'"';} ?> placeholder="<? _e("Adınız Soyadınız");?>"/>
              </div>
              <div class="col-md-6">
                <label class="font-weight-bold"><?php _e("E-Posta");?></label>
                <input type="email" class="keskin" required="" name="i_mail" <?php if(isset($error)) { echo 'value="'.$post["i_mail"].'"';} ?> placeholder="<? _e("E-Posta Adresiniz");?>"/>
              </div>
              <div class="col-md-6">
                <label class="font-weight-bold"><?php _e("Telefon");?></label>
                <input type="text" class="keskin" name="i_telefon" <?php if(isset($error)) { echo 'value="'.$post["i_telefon"].'"';} ?> placeholder="<? _e("Telefon Numaranız");?>"/>
              </div>
              <div class="col-md-12">
                <label class="font-weight-bold"><?php _e("Konu");?></label>
                <input type="text" class="keskin" required="" name="i_konu" <?php if(isset($error)) { echo 'value="'.$post["i_konu"].'"';} ?> placeholder="<? _e("İletişim Sebebi");?>"/>
              </div>
              <div class="col-md-12">
                <label class="font-weight-bold"><?php _e("Mesajınız");?></label>
                <textarea class="form-control keskin" required="" name="i_mesaj" placeholder="<? _e("Lütfen mesajınızı yazınız");?>"><?php if(isset($error)) { echo $post["i_mesaj"];} ?></textarea>
              </div>
            </div>
            <? if (isset($succes)) {
              echo '<script>setTimeout(function(){window.location = window.location.href;},5000);</script>';
              echo '<div class="alert alert-success" id="alert-islem-adresi">'._e('İletişim isteğin bize başarıyla ulaştı',true).'.</div>';
            } else {
              if (ns_filter('recaptcha','item5')) {
                echo '<div class="recaptcha"><div class="g-recaptcha" data-sitekey="'.ns_filter('recaptcha').'"></div></div><div id="captcha"></div>';
                echo '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
              } 
              if(isset($error)) {
                echo '<div class="alert alert-danger" id="alert-islem-adresi">'._e("Tüm alanları eksiksiz doldurmalısın",true).'.</div>';
              }  ?>
              <input type="hidden" name="contact-form" value="">
              <button type="submit" onclick="return get_action(this)" class="action-button keskin"><?php _e("GÖNDER");?></button> 
            <? } ?>
          </fieldset>
        </form>
      </div>
      <div class="col-md-4">
        <?php if(!empty(ns_filter("default-c_detail")) AND ns_filter("default-c_detail","statu")) { ?>
        <div class="contact-sidebar">
          <div class="cside-title">
            <i class="far fa-id-card"></i>
            <h3><span><?php _e("İletişim");?></span> <?php _e("Bilgilerimiz");?></h3>
          </div>
          <div class="cside-content">
            <h4><?php echo ns_filter("default-c_detail","item2");?></h4>
            <ul>
              <li><i class="fas fa-phone"></i> <?php echo ns_filter("default-c_detail","item3");?></li>
              <li><i class="fas fa-envelope"></i> <?php echo ns_filter("default-c_detail","item4");?></li>
              <li><i class="fas fa-map"></i> <?php echo ns_filter("default-c_detail","item5");?></li>
            </ul>
          </div>
        </div>
       <?php } ?>
      </div>
    </div>
  </div>
  <?php ns_Content(array("type"=>""));?>  
</main>