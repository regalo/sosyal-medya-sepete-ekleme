<? if(isset($post["coupon_code"]) AND isset($post["sp_odeme"]) AND !isset($post["order_completed"])) {
include_once "order_coupon.php";
exit;
}
?>
<section id="introx" class="clearfix xrb <?php echo ns_filter('default-desen');?> ns-ortala">
  <div class="container alans1 fadeInUp">
    <div class="text-center text-white">
      <div class="sipbaslik">
        <i class="<?php echo ns_filter('icon');?>"></i>
        <h1 class="font-weight-bold"><?php echo ns_filter('title');?></h1>
        <p><?php echo ns_filter('description');?></p>
        <?php if (isset($siparis_before) AND $git = ns_filter('header_url')) {
        header("Location:$git");
        exit;
        }
        ?>
      </div>
    </div>
  </div>
  <div class="<?php echo ns_filter('default-class');?>-head"></div>
</section>
<main id="main" style="padding: 50px 0px">
  <div class="col-md-8 offset-md-2" id="order_section_list">
    <div id="msform">
      <ul id="progressbar">
         <?php
        $step = (ns_filter('paket','pk_durum') AND isset($post["sp_code"])) ? 1:0;
        ?>
        <li class="active" data-wizart="1"><? _e("İşlem Detayları");?></li>
        <li data-wizart="2" <?php echo $step ? 'class="active"':'';?>><?php _e("Kişisel Bilgiler");?></li>
        <li data-wizart="3" <?php echo $step ? 'class="active"':'';?>><?php _e("Ödeme Bilgileri");?></li>
        <li data-wizart="4" <?php echo $step ? 'class="active"':'';?>><? _e("Ödeme Adımı");?></li>
      </ul>
      <?php if(!ns_filter('paket','pk_durum')) { ?>
       <fieldset class="keskin" data-section="1">
         <h4 class="section-heading"><? _e("Paket Siparişe Kapalı");?></h4>
        <p><? _e("Bu paket için şuan sipariş alamıyoruz. Lütfen size uygun diğer paketlerimizi inceleyin.");?></p>
        <div class="actions pt-1">
        <ul role="menu" id="wizard-buttons">
             <li class="step-button pointer" ><a href="<?php echo ns_filter('siteurl');?>" class="btn btn-order bo-ileri"><? _e("Geri");?></a></li>
        </ul>
    </div></fieldset>
    <?php } elseif (!isset($siparis_before) AND !isset($post["sp_code"])) { ?>
    <form  method="POST" name="OrderForm" action="" onsubmit="return Wizardkontrol();">
      <fieldset class="keskin" data-section="1">
        <h2 class="fs-title"><?php echo ns_filter("kategori","i_baslik");?></h2>
        <h3 class="fs-subtitle"><?php echo ns_filter("kategori","i_uyari");?></h3>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
                <input type="text" required="" name="islem_adres" value="" class="step-1 form-control keskin" placeholder="<?php echo ns_filter("kategori","i_place");?>">
              </div>
          </div>
        </div>
        <button type="submit" name="next" class="next action-button keskin step-go" data-step="2" data-now="1" data-action="next"><?php _e("Devam Et");?></button>
      </fieldset>
      <fieldset class="keskin" style="margin-bottom: 50px;" data-section="2">
        <h2 class="fs-title"><?php _e("Kişisel Bilgiler");?></h2>
        <h3 class="fs-subtitle"><?php _e("Lütfen aşağıdakileri doğru şekilde doldurunuz");?></h3>
        <div class="row" id="order_input_list">
          <div class="col-md-12">
               <div class="form-group">
                <input type="text" name="sp_musteri_adi" id="CostumerName" class="step-2 form-control keskin" value="" placeholder="<? _e("Adınız Soyadınız");?>">
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                <input type="text" name="sp_musteri_telefon" id="phoneNumber" maxlength="11" value="" class="step-2 form-control keskin" placeholder="<? _e("Telefon Numarası");?>">
               </div>
           </div>
           <div class="col-md-6">
               <div class="form-group">
                <input type="email" name="sp_musteri_mail" id="emailAddress" value="" class="step-2 form-control keskin" placeholder="<? _e("E-Posta");?>">
               </div>
            </div>
            <div class="col-md-12 <?php echo !ns_filter('order_setting','statu') ? 'd-none':'';?>">
               <div class="form-group">
                  <select class="step-2 form-control keskin" name="sp_tur" id="order_type">
                      <option value="bireysel"><? _e("Bireysel");?></option>
                      <option value="kurumsal"><? _e("Kurumsal");?></option>
                  </select>
               </div>
            </div>
            <div class="col-md-6 d-none" data-type="kurumsal">
               <div class="form-group"> <input type="text" name="sp_musteri_vd" class="step-2 order_inputer form-control keskin" placeholder="<? _e("Vergi Dairesi");?>"> </div>
            </div>
            <div class="col-md-6 d-none" data-type="kurumsal">
               <div class="form-group"> <input type="text" name="sp_musteri_vn" class="step-2 order_inputer form-control keskin" placeholder="<? _e("Vergi Numarası");?>"> </div>
            </div>
            <div class="col-md-12 d-none" data-type="kurumsal">
               <div class="form-group"> <textarea type="text" name="sp_musteri_adres" class="step-2 order_inputer form-control keskin" placeholder="<? _e("Adres");?>"></textarea> </div>
            </div>
        </div>
        <button type="submit" class="next action-button keskin step-go mob-back" data-step="1" data-now="2" data-action="back"><?php _e("Geri");?></button>
        <button type="submit" class="next action-button keskin step-go" data-step="3" data-now="2" data-action="next"><?php _e("Devam Et");?></button>
      </fieldset>
      <fieldset class="keskin" style="margin-bottom: 50px;" data-section="3">
        <h2 class="fs-title"><? _e("Ödeme Bilgileri");?></h2>
        <h3 class="fs-subtitle"><? _e("Lütfen aşağıya varsa kupon kodunuzu girin ve sonrasında ödeme yöntemi seçimi yapıp işleme devam edin");?>.</h3>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <input type="text" name="sp_musteri_kupon" id="sp_musteri_kupon" class="form-control keskin" placeholder="<?php _e("Kupon Kodu");?>">
              <button type="button" class="coupon_code_click btn btn-kpn-uyg keskin xrb" data-statu="false"><?php _e("UYGULA");?></button>
            </div>
          </div>
          <div class="col-md-12">
            <div class="default-odeme">
            <?php 
          $payment_medhods = $ayar->OdemeFirma();
          if (is_array($payment_medhods)) {
            foreach ($payment_medhods as $value) {
              extract($value);
              if ((!isset($post["sp_odeme"]) AND $statu==2) OR isset($post["sp_odeme"]) AND $post["sp_odeme"]==$id) {
                $payment_method = $id;
                $payment_info = $hizmet_bedeli["item4"];
              } ?>
              <div class="dyontem-item keskin <?php echo $statu==2 ? 'selected':'';?>" data-medhod="<?php echo $id;?>" data-statu="<?php echo $setting["statu"] ? 'true':'false';?>">
                    <i class="<?php echo _py($id)["icon"];?>"></i>
                    <span class="<?php echo $setting["statu"] ? '':'payment-none';?>"><?php echo _py($id)["name"];?></span>
                 </div>
              <? } } ?>
            <input type="hidden" name="sp_odeme" id="payment_method" required="" value="<?php echo isset($payment_method) ? $payment_method:'';?>">
            </div>

           <div class="form-control h-auto mt-3 mb-3 <?php echo (!isset($payment_info) OR empty($payment_info)) ? 'd-none':'';?>" id="payment_info">
           <?php echo isset($payment_info) ? $payment_info:'';?>
         </div>
          </div>
          <div class="col-md-12 mt-2">
          <div class="form-row">
            <div class="col-md-6">
              <div class="sipfiso keskin"><? _e("Ürün Ücreti");?>: <span id="nivu_pk_fee"><?php echo _p(ns_filter('paket','pk_fiyat'));?></span></div>
              <div class="sipfiso keskin"><? _e("Hizmet Bedeli");?>: <span id="nivu_service_fee"><?php echo _p(ns_filter('hizmet_tutari'));?></span></div>
            </div>
            <div class="col-md-6">
              <div class="sipfiso keskin"><? _e("Kupon İndirimi");?>: <span id="nivu_discount"><?php echo _p(ns_filter('kupon_indirim'));?></span></div>
              <div class="sipfiso keskin"><? _e("Ödenmesi Gereken Tutar");?>: <span id="nivu_amount"><?php echo _p(ns_filter('toplam_tutar'));?></span></div>
            </div>
          </div>
        </div>
    </div>
         <?php if(ns_filter('order_setting','item4')>0 AND $icerik->sayfa_id = ns_filter('order_setting','item4') AND $icerik->select()) { ?>
        <div class="kulsoz">
          <label>
            <input type="checkbox" name="sozlesme" class="step-3" value="kullanimsart" style="width: auto;margin-right: 5px;"><span data-toggle="modal" data-target="#kullanicisozlesmesi"><?php _e("Kullanım Şartlarını Okudum ve Kabul Ediyorum");?>.</span>
          </label>
        </div>
        <div class="modal fade" id="kullanicisozlesmesi" style="background: rgba(0, 0, 0, 0.8); display: none;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document" style="max-width: 100%">
              <div class="container">
                  <div class="modal-content keskin">
                    <div class="modal-body">
                        <div class="container">
                            <div class="sorgusss row">
                                <div class="col-md-12 text-center">
                                  <h2 class="font-weight-bold"><?php echo $icerik->sayfa_baslik;?></h2>
                                  <p><?php echo $icerik->sayfa_icerik;?></p>
                                </div>
                            </div>
                            <div class="kapabut text-center">
                              <i class="fas fa-times-circle" data-dismiss="modal" style="border: none;cursor: pointer;font-size: 25px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <?php } ?>
        <?php 
        if (ns_filter('recaptcha','item4')) {
          echo '<div class="recaptcha"><div class="g-recaptcha" data-sitekey="'.ns_filter('recaptcha').'"></div></div><div id="captcha"></div>';
          echo '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
        } 
        ?>
        <button type="submit" class="next action-button keskin step-go mob-back" data-step="2" data-now="3" data-action="back"><?php _e("Geri");?></button>
        <input type="hidden" name="action" value="response">
        <input type="hidden" name="order_completed" value="payment">
        <?php if(isset($payment_method)) { ?>
            <button onclick="return get_action(this)" type="submit" class="next action-button keskin step-go" data-step="4" data-now="3" data-action="next"><?php _e("ÖDEMEYE GEÇ");?></button>
        <?php } else { ?>
             <button onclick="titresim('.default-odeme');" type="button" class="next action-button keskin"><?php _e("ÖDEMEYE GEÇ");?></button>
        <?php } ?>
      </fieldset>
    </form>
      <?php } else { ?>
      <fieldset class="keskin shadow-none p-0 mb-5 bank-kart" data-section="3">
       <?php 
       $payment = true;
       include_once "order_coupon.php";
       ?>
    </fieldset>
     <?php } ?>
 </div>
  </div>
<?php ns_Content(array("type"=>""));?>  
</main>

<style type="text/css">
.payment-none {
   text-decoration: line-through;
}
</style>