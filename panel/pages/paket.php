<?php
$api = !isset($api) ? new Api($db): $api;
if ($ayar->action =="yeni-ekle") {
    $platform = !isset($platform) ? new Platform($db): $platform;
    $kategori = !isset($kategori) ? new Kategori($db): $kategori;
    $tit = "YENİ PAKET EKLE";
    if (isset($post["olay"]) AND $post["olay"]=="paket-ekle") {
        $paket = !isset($paket) ? new Paket($db): $paket;
        $post["smm_id"] = isset($post["smm_id"]) ? $post["smm_id"]:'0';
        $post["service_id"] = isset($post["service_id"]) ? $post["service_id"]:'0';
        $paket->item = array("ozellik" => $post["ozellik"],"pk_tur" => $post["pk_tur"], "pk_oto_servis_id" => $post["smm_id"].'-'.$post["service_id"],"pk_adi" => $post["pk_adi"],"pk_adet" => $post["pk_adet"],"pk_fiyat" => $post["pk_fiyat"],"hz_tax" => $post["hz_tax"]);
        if ($paket->insert()) {
            $alert->header = "İşlem Başarılı";
            $alert->content = "Sisteme yeni bir paket eklediniz";
            $alert->action = $ayar->getpage('paket',$paket->pk_id);
        } else {
            $alert->header = "İşlem Başarısız";
            $alert->content = "Lütfen tüm alanları eksiksiz doldurduğunuzdan emin olun".json_encode($post);
            $alert->action = "close";
            $alert->statu = "danger";
        }
        include_once "alert.php";
        exit;
    }
} else {
    $tit = "PAKET DÜZENLE";
    $kategori = !isset($kategori) ? new Kategori($db): $kategori;
    $platform = !isset($platform) ? new Platform($db): $platform;
    $paket = !isset($paket) ? new Paket($db): $paket;
    $paket->pk_id = $ayar->action;
    if (!$paket->select()) {
        $git = $ayar->getpage("paketler");
        header("Location:$git");
        exit;
    }
    if (isset($post["olay"]) AND $post["olay"]=="paket-duzenle") {
        foreach ($post as $key => $value) {
            $paket->$key = $value;
        }
        $post["smm_id"] = isset($post["smm_id"]) ? $post["smm_id"]:'0';
        $post["service_id"] = isset($post["service_id"]) ? $post["service_id"]:'0';
        $paket->pk_oto_servis_id = $post["smm_id"].'-'.$post["service_id"];
        if ($paket->update()) {
            $alert->header = "İşlem Başarılı";
            $alert->content = "Paket detayları başarıyla güncellendi";
            $alert->action = "close";
        }
        include_once "alert.php";
        exit;
    } elseif (isset($post["olay"]) AND $post["olay"]=="paket-cogalt") {
        $alert->header = "Paketi Kopyalıyorsun";
        $alert->content = "Bu paketi kopyalayıp aynı kategorideki paketleri kolaylıkla düzenleyebilirsin. Onaylıyor musun?";
        $alert->action = "confirm";
        $alert->olay = "cogalt-onay";
        $alert->statu = "info";
        $alert->page = "paket";
        include_once "alert.php";
        exit;
    } elseif (isset($post["olay"]) AND $post["olay"]=="cogalt-onay") {
        if ($paket->copy()) {
            $alert->header = "İşlem Başarılı";
            $alert->content = "Paket kopyalandı ve aynı bilgilerle yeni bir paket oluşturuldu. Yeni paketi düzenlemek için devam et.";
            $alert->action = $ayar->getpage('paket',$paket->pk_id);
        }
        include_once "alert.php";
        exit;
    } elseif (isset($post["olay"]) AND $post["olay"]=="paket-sil") {
        $alert->header = "Paketi Siliyorsun";
        $alert->content = "Silme işlemi geri alınamaz.";
        $alert->action = "confirm";
        $alert->olay = "silme-onay";
        $alert->page = "paket";
        $alert->statu = "info";
        include_once "alert.php";
        exit;
    } elseif (isset($post["olay"]) AND $post["olay"]=="silme-onay") {
        if ($paket->delete()) {
            $alert->header = "Paket Silindi";
            $alert->content = "Paket kalıcı olarak silindi";
            $alert->action = $ayar->getpage('paketler');
        }
        include_once "alert.php";
        exit;
    }
}
?>
<div class="content" id="alan">
    <div class="card mb-4">
        <div class="card-header">
            <strong class="box-title"><?php echo $tit;?></strong>
             <a class="butto butto-light butto-xs pull-right butbor" <? if(isset($_SERVER['HTTP_REFERER'])) { echo 'onclick="history.back();"'; } else { echo 'href="'.$ayar->getpage('paketler').'"'; } ?>><i class="fas fa-chevron-left"></i> Geri</a>
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="col-md-12 hizmetler" style="margin-top: 0">
                    <form id="api-gonder" method="POST" action="" onsubmit="fastpost('api-gonder','ajaxout'); return false;">
                        <input type="hidden" id="page" name="page" value="paket">
                        <input type="hidden" id="olay" name="olay" value="paket-duzenle">
                        <?php if ($ayar->action!="yeni-ekle") { ?>
                        <div class="row form-group">
                            <div class="form-group col-md-6">
                                <label class="form-control-label"><b>Kategori</b></label>
                                <select class="form-control" name="hz_tax">
                                    <?php 
                                    foreach ($kategori->all(0,200) as $hz) {
                                        extract($hz);
                                        if(!isset($platform->$pt_tax)) {
                                            $platform->pt_id = $pt_tax;
                                            $platform->$pt_tax = $platform->select();
                                        }
                                        if ($hz_id==$paket->hz_tax) {
                                            echo '<option value="'.$hz_id.'" selected="">'.$platform->pt_name.' '.$hz_adi.'</option>';
                                        } else {
                                            echo '<option value="'.$hz_id.'">'.$platform->pt_name.' '.$hz_adi.'</option>';
                                        }
                                     } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label"><b>Paket Adı</b></label>
                                <input class="form-control" name="pk_adi" required="" value="<?php echo $paket->pk_adi;?>" placeholder="Örnek: 10000 Takipçi">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label"><b>Gönderim Adeti</b></label>
                                <input class="form-control" type="number" id="islemadet" name="pk_adet" required="" placeholder="Örnek: 1000" value="<?php echo $paket->pk_adet;?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label"><b>Paket Fiyatı</b></label>
                                <input class="form-control" name="pk_fiyat" required="" value="<?php echo $paket->pk_fiyat;?>" placeholder="Örnek: 9.90">
                            </div>
                        </div>
                        <label class="form-control-label"><b>Paket Özellikleri</b></label>
                        <div style="text-align:center;">
                            <?php
                            $say = 0;
                            foreach ($paket->ozellikler() as $oz) {
                                extract($oz);
                            $say++; ?>
                            <div class="input-group inpad1">
                                <input name="ozellik[]" placeholder="Örnek: Tamamı Aktif Kullanıcılar" value="<?php echo $oz_text;?>" class="form-control smgin">
                                <div onclick="$(this).parent().remove();" class="input-group-addon butto butto-danger butto-lg butbor smsil ml-1" >
                                    <i class="fas fa-trash"></i>
                                </div>
                            </div>
                            <?php } ?>
                            <button id="ozellik-ekle" type="button" class="butto butto-dark butto-lg butbor"><i class="fas fa-plus-square"></i> Özellik Ekle</button>
                        </div>
                        <div class="clear"></div>
                        <div class="alert alert-light mt-3">
                            <h4 class="alert-heading"><b>GÖNDERİM ŞEKLİ</b></h4>
                            <div class="clear"></div>
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="islem-turu nav-link <?php if ($paket->pk_tur=="manuel") {echo "active show";};?> butto-lg sari" id="manuel-ekle" data-tur="manuel" data-toggle="pill" href="#manuel" role="tab" aria-controls="manuel" aria-selected="true">MANUEL</a>
                                </li>
                                <li class="nav-item">
                                    <a class="islem-turu nav-link <?php if ($paket->pk_tur=="otomatik") {echo "active show";};?> butto-lg sari" id="servistanimla-ekle" data-tur="otomatik" data-toggle="pill" href="#servistanimla" role="tab" aria-controls="servistanimla" aria-selected="false">OTO SERVİS</a>
                                </li>
                            </ul>
                            <div class="tab-pane fade <?php if ($paket->pk_tur=="manuel") {echo "active show";};?>" id="manuel" role="tabpanel" aria-labelledby="manuel">
                                <p>Pakete gelen siparişler manuel gönderim olarak işaretlenecek ve siparişleri manuel olarak tamamlamanız gerekecek.</p>
                                <div class="clear"></div>
                            </div>
                            <div class="tab-pane fade <?php if ($paket->pk_tur=="otomatik") {echo "active show";};?>" id="servistanimla" role="tabpanel" aria-labelledby="servistanimla">
                                <p>Bu paket için api servisi tanımlayabilirsiniz. Sisteme eklediğiniz smm panellerindeki tüm servisleri inceleyin ve uygun servisi bu paket için tanımlayın.</p>
                                <div class="input-group" id="bayisecimi">
                                    <div class="input-group-prepend mobi-prepends">
                                        <button class="butto butto-dark butto-lg butbor mr-2 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">BAYİ SEÇ</button>
                                        <div class="dropdown-menu curs">
                                            <? foreach ($api->all() as $cikti) {
                                                extract($cikti);
                                                echo '<span class="dropdown-item" onclick="smmbayi_(this)" data-panel="'.$smm_id.'" data-page="1">'.$ayar->description($smm_isim,10).'</span>';
                                            } ?>
                                        </div>
                                    </div>
                                    <? if($paket->pk_tur =="otomatik" AND !empty($paket->pk_oto_servis_id)) {?>
                                    <input type="hidden" name="smm_id" id="_smmbayi" data-panel="<?= explode('-', $paket->pk_oto_servis_id)[0];?>" data-page="1">
                                    <select name="service_id" id="_serviceid" class="form-control">
                                        <option value="<?= explode('-', $paket->pk_oto_servis_id)[1];?>" selected="">Seçili Servis Güncelleniyor</option>
                                    </select>
                                    <button type="button" class="butto butto-success butto-lg butbor" onclick="$('#_smmbayi').click();"><i class="fas fa-sync-alt"></i></button>
                                    <script type="text/javascript">setTimeout(function() {  $('#_smmbayi').click(); },1000); </script>
                                    <? } else { ?>
                                        <select name="service_id"  id="_serviceid" class="form-control">
                                            <option value="" disabled="" selected>SERVİS SEÇ</option>
                                        </select>
                                        <input type="hidden" id="_smmbayi" name="smm_id" value="">
                                    <? } ?>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <input type="hidden" id="gonderimturu" name="pk_tur" value="<?php echo $paket->pk_tur;?>">
                        </div>
                        <span class="pull-right mt-3">
                            <button onclick="oo_('paket-sil');" type="submit" class="butto butto-danger butto-lg butbor"><i class="fas fa-copy"></i> SİL</button>
                            <button onclick="oo_('paket-cogalt');" type="submit" class="butto butto-primary butto-lg butbor"><i class="fas fa-copy"></i> ÇOĞALT</button>
                            <button onclick="oo_('paket-duzenle');" type="submit" class="butto butto-success butto-lg butbor"><i class="fas fa-check"></i> KAYDET</button>
                        </span>
                    <?php } else { ?>
                        <div class="row form-group">
                            <div class="form-group col-md-6">
                                <label class="form-control-label"><b>Kategori</b></label>
                                <select class="form-control" name="hz_tax">
                                    <?php 
                                    foreach ($kategori->all(0,200) as $hz) {
                                        extract($hz);
                                        if(!isset($platform->$pt_tax)) {
                                            $platform->pt_id = $pt_tax;
                                            $platform->$pt_tax = $platform->select();
                                        } 
                                        echo '<option value="'.$hz_id.'">'.$platform->pt_name.' '.$hz_adi.'</option>';
                                     } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label"><b>Paket Adı</b></label>
                                <input class="form-control" name="pk_adi" required="" placeholder="Örnek: 10000 Takipçi">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label"><b>Gönderim Adeti</b></label>
                                <input class="form-control" type="number"  id="islemadet" min="1" name="pk_adet" required="" placeholder="Örnek: 100">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label"><b>Paket Fiyatı</b></label>
                                <input class="form-control" name="pk_fiyat" required="" placeholder="Örnek: 9.90">
                            </div>
                        </div>
                        <label class="form-control-label"><b>Paket Özellikleri</b></label>
                        <div class="form-group">
                            <div style="text-align:center;">
                                <div class="input-group inpad1">
                                    <input name="ozellik[]" placeholder="Örnek: Tamamı Aktif Kullanıcılar" class="form-control smgin">
                                    <div onclick="$(this).parent().remove();" class="input-group-addon butto butto-danger butto-lg butbor smsil ml-1" >
                                        <i class="fas fa-trash"></i>
                                    </div>
                                </div>
                                <button id="ozellik-ekle" type="button" class="butto butto-dark butto-lg butbor"><i class="fas fa-plus-square"></i> Özellik Ekle</button>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="alert alert-light mt-3">
                            <h4 class="alert-heading"><b>GÖNDERİM ŞEKLİ</b></h4>
                            <div class="clear"></div>
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                 <li class="nav-item">
                                    <a class="islem-turu nav-link active show butto-lg sari" id="manuel-ekle" data-tur="manuel" data-toggle="pill" href="#manuel" role="tab" aria-controls="manuel" aria-selected="true">MANUEL</a>
                                </li>
                                <li class="nav-item">
                                    <a class="islem-turu nav-link butto-lg sari" id="servistanimla-ekle" data-tur="otomatik" data-toggle="pill" href="#servistanimla" role="tab" aria-controls="servistanimla" aria-selected="false">OTO SERVİS</a>
                                </li>                              
                            </ul>
                            <div class="tab-pane fade active show" id="manuel" role="tabpanel" aria-labelledby="manuel">
                                <p>Pakete gelen siparişler manuel gönderim olarak işaretlenecek ve siparişleri manuel olarak tamamlamanız gerekecek.</p>
                                <div class="clear"></div>
                            </div>
                            <div class="tab-pane fade" id="servistanimla" role="tabpanel" aria-labelledby="servistanimla">
                                <p>Bu paket için api servisi tanımlayabilirsiniz. Sisteme eklediğiniz smm panellerindeki tüm servisleri inceleyin ve uygun servisi bu paket için tanımlayın.</p>
                                <div class="input-group" id="bayisecimi">
                                    <div class="input-group-prepend">
                                        <button class="butto butto-dark butto-lg butbor mr-2 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">BAYİ SEÇ</button>
                                        <div class="dropdown-menu curs">
                                            <? foreach ($api->all() as $cikti) {
                                                extract($cikti);
                                                echo '<span class="dropdown-item" onclick="smmbayi_(this)" data-panel="'.$smm_id.'" data-page="1">'.$smm_isim.'</span>';
                                            } ?>
                                        </div>
                                    </div>
                                    <select name="service_id"  id="_serviceid" class="form-control">
                                        <option value="" disabled="" selected>SERVİS SEÇ</option>
                                    </select>
                                    <input type="hidden" id="_smmbayi" name="smm_id" value="">
                                </div>
                                <div class="clear"></div>
                            </div>
                            <input type="hidden" id="gonderimturu" name="pk_tur" value="manuel">
                        </div>
                        <button onclick="oo_('paket-ekle');" type="submit" class="butto butto-success butto-lg pull-right butbor mt-sil"><i class="fas fa-check"></i> Paketi Ekle</button>
                    <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="ozellik-sablon" style="display: none;">
    <div class="input-group inpad1">
        <input name="ozellik[]" placeholder="Örnek: Tamamı Aktif Kullanıcılar" class="form-control smgin">
        <div onclick="$(this).parent().remove();" class="input-group-addon butto butto-danger butto-lg butbor smsil ml-1" >
            <i class="fas fa-trash"></i>
        </div>
    </div>
</div>
<script type="text/javascript">
   $(document).ready(function(){
        $("#ozellik-ekle").click(function(){
            $($("#ozellik-sablon").html()).insertBefore(this);
            $("#ozellik-sil").click(function(){});
        });
        $('.islem-turu').click(function(){
            $("#gonderimturu").val($(this).data('tur'));
            if ($(this).data('tur')=="manuel") {
                $('#_serviceid').attr('required', false);
                $('#_smmbayi').attr('required', false);
            } else {
                $('#_serviceid').attr('required', true);
                $('#_smmbayi').attr('required', true);
            }
        })
    });
</script>
<style type="text/css">
                    .col-6.arada {
    width: 48%;
    padding: 0;
    float: left;
    margin-right: 1%;
}
                </style>