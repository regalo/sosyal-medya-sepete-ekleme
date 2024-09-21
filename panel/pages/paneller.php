<?php
$api = !isset($api) ? new Api($db): $api;
if (isset($ayar->action) AND $ayar->action=="yeni-ekle") {
    if (isset($post["olay"]) AND $post["olay"]=="panel-ekle") {
        foreach ($post as $key => $value) {
            if (empty($value)) {
                $alert->header = true;
                break;
            }
        }
        $api->item = array("smm_isim" => $post["smm_isim"],"smm_api" => $post["smm_api"],"smm_link" => $post["smm_link"]);
        if (!isset($alert->header) AND $api->insert()) {
            $control = $api->balance();
            if (isset($control["balance"])) {
                $api->select();
                $api->smm_islem = $control["balance"];
                $api->update();
                $alert->header = "Yeni Bayi Eklendi";
                $alert->content = "Yeni bir smm bayisi eklediniz. Bayi bağlantısı başarılı";
                $alert->action = $ayar->getpage('paneller',$api->smm_id);
            } else {
                $api->delete();
                $alert->header = "Bayi Ekleme Başarısız";
                $alert->content = "API bağlantısı sağlanamadığı için bayi eklenemedi. Lütfen bilgileri kontrol edin ve tekrar deneyin.".json_encode($control);
                $alert->action = "close";
                $alert->statu = "danger";
            }
        } else {
            $alert->header = "İşlem Başarısız";
            $alert->content = "Lütfen tüm alanları eksiksiz doldurduğunuzdan emin olun";
            $alert->action = "close";
            $alert->statu = "danger";
        }
        include_once "alert.php";
        exit;
    }
} elseif(isset($ayar->action)){
    $api->smm_id = $ayar->action;
    $api->select();
    if (isset($post["olay"]) AND $post["olay"]=="panel-duzenle") {
        foreach ($post as $key => $value) {
            $api->$key = $value;
        }
        if(isset($_SESSION["services-".$api->smm_id]))
            unset($_SESSION["services-".$api->smm_id]);
        $api->smm_api = $post["smm_api"];
        $control = $api->balance();
        if (isset($control["balance"])) {
            $api->smm_islem = $control["balance"];
            $api->smm_durum = 1;
            $api->update();
            $alert->header = "İşlem Başarılı";
            $alert->content = "Bayi detayları başarıyla güncellendi";
            $alert->action = "otorefresh";
        } else {
            $alert->header = "İşlem Başarız";
            $alert->content = "Girdiğiniz bilgilerle API bağlantısı sağlanamadığı için bayi eklenemedi. Lütfen bilgileri kontrol edin ve tekrar deneyin.".json_encode($control).$api->smm_api;
            $alert->action = "close";
            $alert->statu = "danger";
        }
        include_once "alert.php";
        exit;
    } elseif (isset($post["olay"]) AND $post["olay"]=="panel-sil") {
        $alert->header = "Bayiyi Siliyorsun";
        $alert->content = "Silme işlemi bu bayi bilgileri ile oluşturulmuş otomatik paketleri ve ilgili bayiye bağlı siparişleri manuel olarak güncelleyecek. İşlemi onaylıyor musunuz?";
        $alert->action = "confirm";
        $alert->olay = "silme-onay";
        $alert->statu = "info";
        $alert->page = "paneller";
        include_once "alert.php";
        exit;
    } elseif (isset($post["olay"]) AND $post["olay"]=="silme-onay") {
        if ($api->delete()) {
            $siparis = !isset($siparis) ? new Siparis($db): $siparis;
            $paket = !isset($paket) ? new Paket($db): $paket;
            foreach ($paket->api($api->smm_id) as $pk) {
                extract($pk);
                $paket->pk_id = $pk_id;
                $paket->select();
                echo $paket->pk_adi;
                $paket->pk_tur = "manuel";
                $paket->pk_oto_servis_id = "";
                $paket->update();
            }
            foreach ($siparis->api($api->smm_id) as $sp) {
                extract($sp);
                $siparis->sp_id = $sp_code;
                $siparis->select();
                $siparis->panel_code = 0;
                $siparis->islem_turu = "manuel";
                $siparis->updateislem();
            }
            $alert->header = "Bayi Silindi";
            $alert->content = "Bayi silindi ve bağlı tüm siparişlerle paketler başarıyla güncellendi";
            $alert->action = $ayar->getpage('paneller');
        }
        include_once "alert.php";
        exit;
    }
} else {
    if (isset($post["olay"]) AND $post["olay"]=="panel-refresh") {
        $api->smm_id = $post["smm_id"];
        if(isset($_SESSION["services-".$api->smm_id]))
            unset($_SESSION["services-".$api->smm_id]);
        $api->select();
        $control = $api->balance();
        if (isset($control["balance"])) {
            $api->smm_islem = $control["balance"];
            $api->smm_durum = 1;
            $api->update();
            $alert->header = "İşlem Başarılı";
            $alert->content = $api->smm_isim." bilgileri güncellendi";
            $alert->action = "reload";
        } else {
            $alert->header = "İşlem Başarız";
            $alert->content = "Bayi bilgileri güncelleme başarısız oldu. Biraz süre sonra tekrar deneyin.";
            $alert->action = "close";
            $alert->statu = "danger";
        }
        include_once "alert.php";
        exit;
    }
    $records_per_page = 20;
    if (isset($get["p"])) {
        $page = $get["p"];
    } else {
        $page = 1;
    }
    $from_record_num  = $page*$records_per_page-$records_per_page;
    $list = $api->all($from_record_num ,$records_per_page);
    $total_rows = $api->count();
} ?>
<div class="content" id="alan">
    <div class="animated fadeIn" id="scrolling">
        <div class="orders">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <? if(!isset($ayar->action)) { ?>
                        <div class="card-header">
                            <div class="bol-5">
                                <strong class="box-title">SMM PANELLER</strong>
                            </div>
                            <div class="bol-5">
                               <a class="butto butto-success butto-xs butbor float-right" href="<?= $ayar->getpage('paneller','yeni-ekle');?>"><i class="fas fa-plus"></i> Yeni Ekle</a>
                           </div>
                        </div>
                        <div class="table-stats order-table ov-h" id="tb-scroll">
                            <table class="table orders-list" id="orders-list">
                                <thead>
                                    <tr>
                                        <th class="text-left" width="183">DURUM</th>
                                        <th class="text-left">PANEL ADI</th>
                                        <th class="text-right" width="100">BAKİYE</th>
                                        <th class="text-right" width="220">İŞLEM</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($list as $cikti) {
                                        extract($cikti);
                                        $api->smm_id = $smm_id;
                                        $api->select();
                                        $api->keystatu();
                                     ?>
                                    <tr>
                                    <td class="text-left" width="183"><button class="butto buttosi butto-<?= $api->color;?>"><?= $api->text;?></button></td>
                                    <td class="text-left"><?php echo $api->smm_isim;?> <?php echo strlen($api->smm_api)< 35 ? '<span class="update-alert" title="Apiyi Güncelleyin"><i class="fas fa-exclamation-circle"></i></span>':'';?></td>
                                    <td class="text-right" width="100"><?php echo $api->format($api->smm_islem);?> TL</td>
                                    <td class="text-right" width="220">
                                        <a href="<?= $ayar->getpage('paneller',$api->smm_id);?>" class="butto butto-xs badge-primary butbor"><i class="fas fa-layer-group"></i> Detay</a>
                                        <button type="button" onclick="$('#smm_id').val(<?= $api->smm_id;?>); fastpost('panel-refresh','ajaxout')" class="butto butto-xs badge-success butbor ml-1" style="cursor: pointer;"><i class="fas fa-redo"></i> Yenile</a></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <form id="panel-refresh" method="POST" action="">
                            <input type="hidden" name="page" value="paneller">
                            <input type="hidden" name="olay" value="panel-refresh">
                            <input type="hidden" id="smm_id" name="smm_id" value="">
                        </form>
                        <? } elseif(isset($ayar->action) AND $ayar->action=="yeni-ekle") { ?>
                        <div class="card-header">
                            <div class="bol-7">
                                <strong>YENİ SMM PANEL</strong>
                            </div>
                            <div class="bol-3">
                               <a class="butto butto-xs badge-light butbor pull-right" <? if(isset($_SERVER['HTTP_REFERER'])) { echo 'onclick="history.back();"'; } else { echo 'href="'.$ayar->getpage('paneller').'"'; } ?>><i class="fas fa-chevron-left"></i> Geri</a>
                           </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="col-md-12 hizmetler">
                                    <form id="panel-ekle" method="POST" action="" onsubmit="fastpost('panel-ekle','ajaxout'); return false;">
                                        <input type="hidden" name="page" value="paneller">
                                        <input type="hidden" id="olay" name="olay" value="panel-ekle">
                                        <div class="row form-group mrl0">
                                            <div class="form-group col-md-12">
                                                <label class="form-control-label"><b>SMM Panel Adı</b></label>
                                                <input class="form-control" type="text" name="smm_isim" required="" placeholder="Örnek: SMMNivu">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="form-control-label"><b>SMM Api Link</b></label>
                                                <input class="form-control" type="text" name="smm_link" required="" placeholder="Örnek: https://nivuu.com/api/v2">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="form-control-label"><b>SMM Api Key</b></label>
                                                <input class="form-control" type="text" name="smm_api" required="" placeholder="Örnek: bd7047b70f9608cc211f31f2es1d9824d">
                                            </div>
                                            <div class="form-group col-md-12 text-right mt-3">
                                                <button onclick="oo_('panel-ekle');" type="submit" class="butto butto-success butto-lg butbor"><i class="fas fa-check"></i> Ekle</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <? } elseif (isset($ayar->action)) { ?>
                        <div class="card-header">
                            <div class="bol-7">
                                <strong>PANEL DÜZENLE</strong>
                            </div>
                            <div class="bol-3">
                               <a class="butto butto-xs badge-light butbor pull-right" <? if(isset($_SERVER['HTTP_REFERER'])) { echo 'onclick="history.back();"'; } else { echo 'href="'.$ayar->getpage('siparisler').'"'; } ?>><i class="fas fa-chevron-left"></i> Geri</a>
                           </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="col-md-12 hizmetler">
                                    <form id="panel-duzenle" method="POST" action="" onsubmit="fastpost('panel-duzenle','ajaxout'); return false;">
                                        <input type="hidden" name="page" value="paneller">
                                        <input type="hidden" id="olay" name="olay" value="panel-duzenle">
                                        <div class="row form-group mrl0">
                                            <div class="form-group col-md-12">
                                                <label class="form-control-label"><b>SMM Panel Adı</b></label>
                                                <input class="form-control" type="text" name="smm_isim" required="" value="<?php echo $api->smm_isim;?>">
                                            </div>  
                                            <div class="form-group col-md-12">   
                                                <label class="form-control-label"><b>SMM Api Link</b></label>
                                                <input class="form-control" type="text" name="smm_link" required="" value="<?php echo $api->smm_link;?>">
                                            </div>  
                                            <div class="form-group col-md-12">    
                                                <label class="form-control-label"><b>SMM Api Key</b></label>
                                                <?php if(strlen($api->smm_api)< 35){ ?>
                                                    <div class="alert alert-danger">
                                                        Yeni sürüm ile birlikte gelen <b>apiKey</b> şifreleme özelliğini bu bayide aktif etmek için kaydedin
                                                    </div>
                                                     <input class="form-control" type="text" name="smm_api" required="" placeholder="Api Key" value="<?php echo $api->smm_api;?>">
                                                <?php } else { ?>
                                                    <input class="form-control" type="text" name="smm_api" required="" placeholder="Güvenlik için apinizi yeniden girmeniz gerekiyor." value="">
                                                <?php } ?>
                                            </div>
                                            <div class="form-group col-md-12 text-right mt-3">
                                                <button onclick="oo_('panel-sil');" type="submit" class="butto butto-danger butto-lg butbor"><i class="fas fa-trash"></i> SİL</button>
                                                <button onclick="oo_('panel-duzenle');" type="submit" class="butto butto-success butto-lg islem butbor"><i class="fas fa-check"></i> Kaydet</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <? } ?> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>