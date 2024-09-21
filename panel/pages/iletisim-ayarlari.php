<?php
if (isset($post["olay"]) AND $post["olay"]=="smtp-test") {
    if($post["statu"]=="1")
        require("config/mail/class/smtp/index.php");
        else
            require("config/mail/class/mailler/index.php");
    $mail->item = array(
        "to"=>array(array("mail"=>$post["test-mail"],"name"=>$user->k_adi)),
        "Subject"=>"Test Mail",
        "Content"=>"Test İçerik");
    if ($mail->NivuGo($post)) {
        $alert->content = "Mail ayarlarınız doğru yapılandırılmış ve test başarılı. <br>Ayarları bu şekilde kaydetmek ister misiniz?";
        $post["olay"] = "smtp";
        $nsoft->data = $post;

        $alert->header = "Test Başarılı";
        $alert->action = "nsoft";
    } else {
        $alert->header = "Test Başarısız!";
        $alert->content =  isset($mail->ErrorInfo) ? 'Mail gönderilirken bir hata oluştu: ' . $mail->ErrorInfo:'Mail gönderilirken bir hata oluştu:';
        $alert->content .= "<br>Sistemde sorun yaşamamak için tüm mail bildirimlerini kapalı konumuna getirin";
        $alert->action = "close";
        $alert->statu = "danger";
    }
    include_once "alert.php";
    exit;
} elseif (isset($post["olay"]) AND $post["olay"]=="sms-ayarlari") {
    $sms = new SMS($ayar);
    if ($post["item2"]=="kapali") {
        $ayar->select('smspanel');
        foreach ($post as $key => $value) {
            $ayar->$key = $value;
        }
        $ayar->update();
        $alert->header = "İşlem Başarılı";
        $alert->content =  "SMS ayarlarınız pasif hale getirildi";
        $alert->action = "reload";
    } elseif ($sms->test($post)) {
        $alert->header = $sms->head ? "Test Başarılı!":"Ufak Bir Hata Var!";
        $alert->content = $sms->head ? strtoupper($post["item2"])." ayarlarınız doğru görünüyor. Bilgileri bu şekilde kaydetmek ister misiniz?": "Açıklama: Başlık hatalı görünüyor, kullanılabilir başlıklarınız: <b>".$sms->heads."</b> Bunun bir hata olmadığını düşünüyorsanız bu şekilde kaydedebilirsiniz.";
        $post["olay"] = "smspanel";
        $nsoft->data = $post;
        $alert->action = "nsoft";
    } else {
        $alert->header = "Bir Sorunumuz Var!";
        $alert->content =  "Açıklama: ".$sms->data["status"]["description"];
        $alert->statu = "danger";
        $alert->action = "close";
    }
    include_once "alert.php";
    exit;
    
    $data = array("message"=>"Test Mesaj","to"=>"5394039951");
    if ($sms->send($data)) {
        $alert->header = "SMS Gönderildi";
        $alert->content = "SMS ".$data["to"]." numarasına başarıyla gönderildi";
        $alert->action = "close";
    } else {
        $alert->header = "SMS Göderilemedi";
        $alert->content = "SMS ".$data["to"]." numarasına gönderilemedi ".$sms->data["status"]["description"];
        $alert->action = "close";
        $alert->statu = "danger";
    }
    include_once "alert.php";
    exit;
    
} elseif (isset($post["olay"]) AND ($post["olay"]=="smspanel" OR $post["olay"]=="smtp")) {
$ayar->select($post["olay"]);
foreach ($post as $key => $value) {
    $ayar->$key = $value;
}
$ayar->update();
$alert->header = "İşlem Başarılı";
$alert->content = "İletişim ayarları güncellendi";
$alert->action = "close";
//$data = array("message"=>"Test Mesaj","to"=>"5394039951");
//$sms = new SMS($ayar);
//$sms->send($data);
include_once "alert.php";
exit;
} elseif (isset($post["olay"])) {
$ayar->select($post["olay"]);
if (!empty($ayar->item1)) {
$ayar->statu = $ayar->statu == 1 ? 0:1;
$ayar->update();
}
exit("");
}
?>
<div class="content" id="alan">
    <div class="animated fadeIn" id="scrolling">
        <div class="orders">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-alani">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show butto-lg gri" onclick="$('#sTab').val('smtp');" id="pills-alt-tab" data-toggle="pill" href="#pills-alt" role="tab" aria-controls="pills-alt" aria-selected="true"><i class="fas fa-envelope"></i> Mail Ayarları (Mailler)</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link butto-lg gri" id="pills-ust-tab" onclick="$('#sTab').val('smspanel');" data-toggle="pill" href="#pills-ust" role="tab" aria-controls="pills-ust" aria-selected="true"><i class="fas fa-sms"></i> SMS Ayarları</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade" id="pills-ust" role="tabpanel" aria-labelledby="pills-ust-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong class="card-title">Müşteri Bilgilendirmesi</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="row" style="text-align: center;">
                                                <div class="col-md-3 pull-left text-center">
                                                    <label class="d-block font-weight-bold">Siparişiniz Alındı</label>
                                                    <label class="switch" style="margin-bottom: 0"><input onclick="status('sms_musteri_yeni_siparis')" type="checkbox" <?php echo $ayar->statu('sms_musteri_yeni_siparis') ? "checked":"";?>>
                                                        <span class="btn-ackapa round"></span>
                                                    </label>
                                                </div>
                                                <div class="col-md-3 pull-left text-center">
                                                    <label class="d-block font-weight-bold">Siparişiniz Tamamlandı</label>
                                                    <label class="switch" style="margin-bottom: 0"><input onclick="status('sms_musteri_siparis_tamamlandi')" type="checkbox" <?php echo $ayar->statu('sms_musteri_siparis_tamamlandi') ? "checked":"";?>>
                                                        <span class="btn-ackapa round"></span>
                                                    </label>
                                                </div>
                                                <div class="col-md-3 pull-left text-center">
                                                    <label class="d-block font-weight-bold">İade Edildi Bilgisi</label>
                                                    <label class="switch" style="margin-bottom: 0"><input onclick="status('sms_musteri_siparis_iptal_edildi')" type="checkbox" <?php echo $ayar->statu('sms_musteri_siparis_iptal_edildi') ? "checked":"";?>>
                                                        <span class="btn-ackapa round"></span>
                                                    </label>
                                                </div>
                                                <div class="col-md-3 pull-left text-center">
                                                    <label class="d-block font-weight-bold">Ödeme Hatırlatma</label>
                                                    <label class="switch" style="margin-bottom: 0"><input onclick="status('sms_musteri_odeme_hatirlatma')" type="checkbox" <?php echo $ayar->statu('sms_musteri_odeme_hatirlatma') ? "checked":"";?>>
                                                        <span class="btn-ackapa round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <strong class="card-title">Yönetim Bilgilendirmesi</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="row text-center">
                                                <div class="col-md-3 pull-left text-center">
                                                    <label class="d-block font-weight-bold">Yeni Sipariş</label>
                                                    <label class="switch mb-0"><input type="checkbox" onclick="status('sms_yonetici_yeni_siparis')" <?php echo $ayar->statu('sms_yonetici_yeni_siparis') ? "checked":"";?>>
                                                        <span class="btn-ackapa round"></span>
                                                    </label>
                                                </div>
                                                <div class="col-md-3 pull-left text-center">
                                                    <label class="d-block font-weight-bold">İletişim Formu</label>
                                                    <label class="switch mb-0"><input type="checkbox" onclick="status('sms_yonetici_yeni_iletisim')" <?php echo $ayar->statu('sms_yonetici_yeni_iletisim') ? "checked":"";?>>
                                                        <span class="btn-ackapa round"></span>
                                                    </label>
                                                </div>
                                                <div class="col-md-3 pull-left text-center">
                                                    <label class="d-block font-weight-bold">Ödeme Bildirimi Formu</label>
                                                    <label class="switch mb-0"><input type="checkbox" onclick="status('sms_yonetici_yeni_odeme')" <?php echo $ayar->statu('sms_yonetici_yeni_odeme') ? "checked":"";?>>
                                                        <span class="btn-ackapa round"></span>
                                                    </label>
                                                </div>
                                                <div class="col-md-3 pull-left text-center">
                                                    <label class="d-block font-weight-bold">SMM ve Sipariş Hataları</label>
                                                    <label class="switch mb-0"><input type="checkbox" onclick="status('sms_yonetici_siparis_hata')" <?php echo $ayar->statu('sms_yonetici_siparis_hata') ? "checked":"";?>>
                                                        <span class="btn-ackapa round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <?php $ayar->select('smspanel'); ?>
                                        <div class="card-header">
                                            <strong class="card-title">SMS Api Ayarları</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-alanix">
                                                <ul class="nav nav-pills mb-3 " id="pills-tab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link alti butto-lg<?php echo !ns_filter('smspanel','statu') ? ' show active':'';?>" id="pills-sms-kapali-tab" data-toggle="pill" href="#pills-sms-kapali" role="tab" aria-controls="pills-sms-kapali" aria-selected="false">Kapalı</a>
                                                    </li>
                                                    <li class="nav-item"> 
                                                        <a class="nav-link alti butto-lg<?php echo ns_filter('smspanel')=="masgsm" ? ' show active':'';?>" id="pills-sms-masgsm-tab" data-toggle="pill" href="#pills-sms-masgsm" role="tab" aria-controls="pills-sms-masgsm" aria-selected="true">MASGSM</a>
                                                    </li>
                                                    <li class="nav-item"> 
                                                        <a class="nav-link alti butto-lg<?php echo ns_filter('smspanel')=="netgsm" ? ' show active':'';?>" id="pills-sms-netgsm-tab" data-toggle="pill" href="#pills-sms-netgsm" role="tab" aria-controls="pills-sms-netgsm" aria-selected="true">NETGSM</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-content" id="pills-tabContent">
                                                <div class="tab-pane fade<?php echo !ns_filter('smspanel','statu') ? ' show active':'';?>" id="pills-sms-kapali" role="tabpanel" aria-labelledby="pills-sms-kapali-tab">
                                                    <form id="sms-kapali" method="POST" action="" onsubmit="fastpost('sms-kapali','ajaxout'); return false;">
                                                        <input type="hidden" name="page" value="iletisim-ayarlari">
                                                        <input type="hidden" id="olay" name="olay" value="sms-ayarlari">
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <p>SMS Ayarlarını bu şekilde kaydederseniz tüm sms tercihleriniz geçersiz sayılacaktır</p>
                                                            </div>
                                                            <div class="col-md-12 text-right mt-3">
                                                                <input type="hidden" name="item2" value="kapali">
                                                                <input type="hidden" name="item3" value="">
                                                                <input type="hidden" name="item4" value="">
                                                                <input type="hidden" name="item5" value="">
                                                                <input type="hidden" name="statu" value="0">
                                                                <button type="submit" class="butto butto-success butto-lg butbor pull-right"><i class="fas fa-check"></i> Kaydet</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="tab-pane fade<?php echo ns_filter('smspanel')=="masgsm" ? ' show active':'';?>" id="pills-sms-masgsm" role="tabpanel" aria-labelledby="pills-sms-masgsm-tab">
                                                    <form id="sms-masgsm" method="POST" action="" onsubmit="fastpost('sms-masgsm','ajaxout'); return false;">
                                                        <input type="hidden" name="page" value="iletisim-ayarlari">
                                                        <input type="hidden" id="olay" name="olay" value="sms-ayarlari">
                                                        <div class="row ">
                                                            <div class="form-group col-md-4">
                                                                <label class="form-control-label font-weight-bold">Kullanıcı Adı(Giriş Telefon)</label>
                                                                <input class="form-control" name="item4" required="" value="<?php echo ns_filter('smspanel')=="masgsm" ? ns_filter('smspanel','item4'):'';?>">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label class="form-control-label font-weight-bold">API KEY</label>
                                                                <input class="form-control" name="item3" required="" value="<?php echo ns_filter('smspanel')=="masgsm" ? ns_filter('smspanel','item3'):'';?>">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="form-control-label font-weight-bold">MESAJ BAŞLIK</label>
                                                                <input class="form-control" name="item5" required="" value="<?php echo ns_filter('smspanel')=="masgsm" ? ns_filter('smspanel','item5'):'';?>">
                                                            </div>
                                                            <div class="col-md-7 text-right mt-3">
                                                                <input type="hidden" name="item2" value="masgsm">
                                                                <input type="hidden" name="statu" value="1">
                                                                <button type="submit" class="butto butto-warning butto-lg butbor pull-right"><i class="fas fa-check"></i> Kaydet</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="tab-pane fade<?php echo ns_filter('smspanel')=="netgsm" ? ' show active':'';?>" id="pills-sms-netgsm" role="tabpanel" aria-labelledby="pills-sms-netgsm-tab">
                                                    <form id="sms-netgsm" method="POST" action="" onsubmit="fastpost('sms-netgsm','ajaxout'); return false;">
                                                        <input type="hidden" name="page" value="iletisim-ayarlari">
                                                        <input type="hidden" id="olay" name="olay" value="sms-ayarlari">
                                                        <div class="row">
                                                            <div class="form-group col-md-4">
                                                                <label class="form-control-label font-weight-bold">KULLANICI ADI</label>
                                                                <input class="form-control" name="item3" required="" value="<?php echo ns_filter('smspanel')=="netgsm" ? ns_filter('smspanel','item3'):'';?>">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label class="form-control-label font-weight-bold">ŞİFRE</label>
                                                                <input class="form-control" name="item4" required="" value="<?php echo ns_filter('smspanel')=="netgsm" ? ns_filter('smspanel','item4'):'';?>">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label class="form-control-label font-weight-bold">BAŞLIK</label>
                                                                <input class="form-control" name="item5" required="" value="<?php echo ns_filter('smspanel')=="netgsm" ? ns_filter('smspanel','item5'):'';?>">
                                                            </div>
                                                            <div class="col-md-12 text-right mt-3">
                                                                <input type="hidden" name="item2" value="netgsm">
                                                                <input type="hidden" name="statu" value="1">
                                                                <button type="submit" class="butto butto-warning butto-lg butbor pull-right"><i class="fas fa-check"></i> Kaydet</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade active show" id="pills-alt" role="tabpanel" aria-labelledby="pills-alt-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong class="card-title">Müşteri Bilgilendirmesi</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3 pull-left text-center">
                                                    <label class="d-block font-weight-bold">Siparişiniz Alındı</label>
                                                    <label class="switch mb-0"><input type="checkbox" onclick="status('mail_musteri_yeni_siparis')" <?php echo $ayar->statu('mail_musteri_yeni_siparis') ? "checked":"";?>>
                                                        <span class="btn-ackapa round"></span>
                                                    </label>
                                                </div>
                                                <div class="col-md-3 pull-left text-center">
                                                    <label class="d-block font-weight-bold">Siparişiniz Tamamlandı</label>
                                                    <label class="switch mb-0"><input type="checkbox" onclick="status('mail_musteri_siparis_tamamlandi')" <?php echo $ayar->statu('mail_musteri_siparis_tamamlandi') ? "checked":"";?>>
                                                        <span class="btn-ackapa round"></span>
                                                    </label>
                                                </div>
                                                <div class="col-md-3 pull-left text-center">
                                                    <label class="d-block font-weight-bold">İade Bilgilendirmesi</label>
                                                    <label class="switch mb-0"><input type="checkbox" onclick="status('mail_musteri_siparis_iptal_edildi')" <?php echo $ayar->statu('mail_musteri_siparis_iptal_edildi') ? "checked":"";?>>
                                                        <span class="btn-ackapa round"></span>
                                                    </label>
                                                </div>
                                                <div class="col-md-3 pull-left text-center">
                                                    <label class="d-block font-weight-bold">Ödeme Hatırlatma</label>
                                                    <label class="switch mb-0"><input type="checkbox" onclick="status('mail_musteri_odeme_hatirlatma')" <?php echo $ayar->statu('mail_musteri_odeme_hatirlatma') ? "checked":"";?>>
                                                        <span class="btn-ackapa round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <strong class="card-title">Yönetim Bilgilendirmesi</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3 pull-left text-center">
                                                    <label class="d-block font-weight-bold">Yeni Sipariş</label>
                                                    <label class="switch mb-0"><input type="checkbox" onclick="status('mail_yonetici_yeni_siparis')" <?php echo $ayar->statu('mail_yonetici_yeni_siparis') ? "checked":"";?>>
                                                        <span class="btn-ackapa round"></span>
                                                    </label>
                                                </div>
                                                <div class="col-md-3 pull-left text-center">
                                                    <label class="d-block font-weight-bold">İletişim Formu</label>
                                                    <label class="switch mb-0"><input type="checkbox" onclick="status('mail_yonetici_yeni_iletisim')" <?php echo $ayar->statu('mail_yonetici_yeni_iletisim') ? "checked":"";?>>
                                                        <span class="btn-ackapa round"></span>
                                                    </label>
                                                </div>
                                                <div class="col-md-3 pull-left text-center">
                                                    <label class="d-block font-weight-bold">Ödeme Bildirimi Formu</label>
                                                    <label class="switch mb-0"><input type="checkbox" onclick="status('mail_yonetici_yeni_odeme');" <?php echo $ayar->statu('mail_yonetici_yeni_odeme') ? "checked":"";?>>
                                                        <span class="btn-ackapa round"></span>
                                                    </label>
                                                </div>
                                                <div class="col-md-3 pull-left text-center">
                                                    <label class="d-block font-weight-bold">SMM ve Sipariş Hataları</label>
                                                    <label class="switch mb-0"><input type="checkbox" onclick="status('mail_yonetici_siparis_hata')" <?php echo $ayar->statu('mail_yonetici_siparis_hata') ? "checked":"";?>>
                                                        <span class="btn-ackapa round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <?php $ayar->select('smtp'); ?>
                                        <div class="card-header">
                                            <strong class="card-title">Mail Ayarları</strong>
                                        </div>
                                         <div class="card-body">
                                            <div class="tab-alanix">
                                                <ul class="nav nav-pills mb-3 " id="pills-tab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link alti butto-lg<?php echo ns_filter('smtp')=="kapali" ? ' show active':'';?>" id="pills-smtp-kapali-tab" data-toggle="pill" href="#pills-smtp-kapali" role="tab" aria-controls="pills-smtp-kapali" aria-selected="false">Kapalı</a>
                                                    </li>
                                                    <li class="nav-item"> 
                                                        <a class="nav-link alti butto-lg<?php echo ns_filter('smtp')!="kapali" ? ' show active':'';?>" id="pills-smtp-aktif-tab" data-toggle="pill" href="#pills-smtp-aktif" role="tab" aria-controls="pills-smtp-aktif" aria-selected="true">Aktif<?php echo ns_filter('smtp')=="kapali" ? 'leştir':'';?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-content" id="pills-tabContent">
                                                <div class="tab-pane fade<?php echo ns_filter('smtp')=="kapali" ? ' show active':'';?>" id="pills-smtp-kapali" role="tabpanel" aria-labelledby="pills-smtp-kapali-tab">
                                                    <form id="smtp-kapali" method="POST" action="" onsubmit="fastpost('smtp-kapali','ajaxout'); return false;">
                                                        <input type="hidden" name="page" value="iletisim-ayarlari">
                                                        <input type="hidden" id="olay" name="olay" value="smtp">
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <p>SMTP Ayarlarını bu şekilde kaydederseniz tüm mail tercihleriniz geçersiz sayılacak ve sistem üzerinden hiç bir mail gönderimi yapılamayacaktır.</p>
                                                            </div>
                                                            <div class="col-md-12 text-right mt-3">
                                                                <input type="hidden" name="item2" value="kapali">
                                                                <input type="hidden" name="item3" value="">
                                                                <input type="hidden" name="item4" value="">
                                                                <input type="hidden" name="item5" value="">
                                                                <input type="hidden" name="statu" value="0">
                                                                <button type="submit" class="butto butto-success butto-lg butbor pull-right"><i class="fas fa-check"></i> Kaydet</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    
                                                </div>
                                                <div class="tab-pane fade<?php echo ns_filter('smtp')!="kapali" ? ' show active':'';?>" id="pills-smtp-aktif" role="tabpanel" aria-labelledby="pills-smtp-aktif-tab">
                                                    <form id="smtp-ayar" method="POST" action="" onsubmit="fastpost('smtp-ayar','ajaxout'); return false;">
                                                        <input type="hidden" name="page" value="iletisim-ayarlari">
                                                        <input type="hidden" id="olay-smtp" name="olay" value="smtp-test">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-2">
                                                                <div class="alert alert-danger">
                                                                    <p class="mb-0"><b>DİKKAT!</b><br> Mail ayarlarını lütfen doğru girdiğinizden emin olun. Mevcut gmail hesabınızla yada hosting sağlayıcınızdan aldığınız ornek@siteadi.com uzantılı mail adresinizi smtp için kullanabilirsiniz. Port alanına ssl sertifikası kullanıyorsanız 465 kullanmıyorsanız 587 giriniz. Mail gönderiminde sorun yaşıyorsanız tüm bildirimleri sistem güvenliği için kapatın ve NivuSoft ekibi ile iletişime geçin.</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="form-control-label font-weight-bold">SMTP Host</label>
                                                                <input type="text" name="item3" placeholder="mail.siteadi.com" class="form-control" value="<?php echo ns_filter('smtp')!="kapali" ? ns_filter('smtp','item3'):'';?>">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="form-control-label font-weight-bold">Mail Port</label>
                                                                <input type="text" name="item5" placeholder="Mail Port" class="form-control" value="<?php echo ns_filter('smtp')!="kapali" ? ns_filter('smtp','item5'):'';?>">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-control-label font-weight-bold">Sistem Maili</label>
                                                                <input type="text" name="item2" placeholder="Sistem Maili" class="form-control" value="<?php echo ns_filter('smtp')!="kapali" ? ns_filter('smtp','item2'):'';?>">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-control-label font-weight-bold">Mail Sifre</label>
                                                                <input type="text" name="item4" placeholder="Mail Sifre" class="form-control" value="<?php echo ns_filter('smtp')!="kapali" ? ns_filter('smtp','item4'):'';?>">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="form-control-label font-weight-bold">Yöntem</label>
                                                                <select class="form-control" name="statu">
                                                                    <option value="1" <?php echo ns_filter("smtp","statu") ? 'selected':'';?>>SMTP</option>
                                                                    <option value="0" <?php echo !ns_filter("smtp","statu") ? 'selected':'';?>>PHP Mail</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-12 mt-4 text-right">
                                                                <input type="hidden"  name="test-mail"  value="<?php echo $user->k_mail;?>">
                                                                <button  type="submit"  class="butto butto-warning butto-lg butbor"><i class="fas fa-check"></i> Test Et ve Güncelle</button>
                                                            </div>
                                                        </div>
                                                    </form>
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
        </div>
    </div>
</div>
<form id="durumlar" method="POST" action="">
    <input type="hidden" name="page" value="iletisim-ayarlari">
    <input type="hidden" id="settingOlay" name="olay" value="">
    <input type="hidden" id="sTab" name="settingTab" value="smtp">
</form>
<script type="text/javascript">
function status(id){
$('#settingOlay').val(id);
fastpost('durumlar','ajaxout');
}
</script>