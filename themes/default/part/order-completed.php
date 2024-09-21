<section id="introx" class="clearfix xrb <?php echo ns_filter('default-desen');?>">
    <div class="dikort">
        <div class="alans1 fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ortala" style="color: #fff;display: inline-grid;">
                        <div class="dikort modikort">
                            <div class="sipbaslik">
                                <i class="<?= ns_filter('icon');?>"></i>
                                <h1 class="font-weight-bold"><?= ns_filter('title');?></h1>
                                <p><?= ns_filter('description');?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="<?php echo ns_filter('default-class'); ?>-head"></div>
</section>
<main id="main" class="pt-4">
    <div class="container">
        <div id="msform" class="row justify-content-md-center">
    <div class="col-md-8">
        <div class="s-detayz ozpad keskin">
            <ul>
                <li><? _e("Sipariş Durumu");?>: <span class="font-weight-bold float-right opa7 <?php echo $siparis->sbutton;?>"><?php echo ($siparis->aciklama() AND !empty($siparis->aciklama)) ? $siparis->aciklama:_e($siparis->sorder,true);?></span></li>
                <li><? _e("Sipariş Kodu");?>: <span class="font-weight-bold float-right opa7">#<?php echo ns_filter('siparis','sp_code');?></span></li>
                <li class="font-weight-bold opa7"><?php echo ns_filter('siparis','sp_paket_adi');?></li>
                <li class="dropdown font-weight-bold opa7"><a class="pointer d-block"><? _e("Müşteri Bilgileri");?><i class="float-right fas fa-chevron-down mt-1"></i></a>
                    <ul class="">
                        <li class="font-weight-normal"><? _e("Ad Soyad");?>: <span class="d-block"><?php echo $ayar->hideinfo(ns_filter("siparis","sp_musteri_adi"),'name');?></span></li>
                        <li class="font-weight-normal"><? _e("Mail");?>: <span class="d-block"><?php echo $ayar->hideinfo(ns_filter("siparis","sp_musteri_mail"),'mail');?></span></li>
                        <li class="font-weight-normal"><? _e("Telefon");?>: <span class="d-block"><?php echo $ayar->hideinfo(ns_filter("siparis","sp_musteri_telefon"),'telefon');?></span></li>
                    </ul>
                </li>
                <li><? _e("Sipariş Tutarı");?>: <span class="font-weight-bold float-right"><?= _p(ns_filter('siparis','sp_musteri_tutar'));?></span></li>
            </ul>
        </div>
         <? if((ns_filter('siparis','sp_durum')==10 OR ns_filter('siparis','sp_durum')==0) AND $pager=="tamamlanamadipage") { ?>
        <div class="form-group text-center mt-2">
          <a href="<?= ns_filter('siteurl').ns_filter('siparispage').'/'.ns_filter('siparis','sp_musteri_link').'/';?>" class="btn btn-primary"><? _e("ÖDEME ADIMINA GERİ DÖN");?></a>
        </div>
    <? } ?>
    </div>
</div>
</div>
<?php ns_Content(array("type"=>""));?>  
</main>
<style type="text/css">
    .pointer {
        cursor: pointer !important;
    }
    .s-detayz .warning {
    color: #F44336;
}
#msform {
    text-align: center;
    position: relative;
    min-height: 70vh;
}
</style>
<script type="text/javascript">
    $('ul .dropdown a').click(function(){
        if ($(this).next().hasClass('d-none')) {
            $('.dropdown a i').attr('class','float-right fas fa-chevron-right mt-1');
            $(this.children[0]).attr('class','float-right fas fa-chevron-down mt-1');
            $('ul .dropdown ul').addClass('d-none');
            $(this).next().removeClass('d-none');
        } else {
            $(this.children[0]).attr('class','float-right fas fa-chevron-right mt-1');
            $(this).next().addClass('d-none');
        }
    });
</script>