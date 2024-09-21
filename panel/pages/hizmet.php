<?php 
if ($ayar->action =="yeni-ekle") {
    $tit = "YENİ HİZMET EKLE";
    if (isset($post["olay"]) AND $post["olay"]=="hizmet-ekle") {
        $platform = !isset($platform) ? new Platform($db): $platform;
        foreach ($post as $key => $value) {
            if (empty($value)) {
                $alert->header = true;
                break;
            }
        }
        $platform->item = array("pt_name" => $post["pt_name"],"pt_seo" => $post["pt_seo"],"pt_text" => $post["pt_text"],"pt_icon" => $post["pt_icon"]);
        if (!isset($alert->header) AND $platform->insert()) {
            $alert->header = "İşlem Başarılı";
            $alert->content = "Sisteme yeni bir platform eklediniz";
            $alert->action = $ayar->getpage('hizmet',$platform->pt_id);
        } else {
            $alert->header = "İşlem Başarısız";
            $alert->content = "Lütfen tüm alanları eksiksiz doldurduğunuzdan emin olun";
            $alert->action = "close";
            $alert->statu = "danger";
        }
        include_once "alert.php";
        exit;
    }
} else {
    $tit = "HİZMET DETAYLARINI DÜZENLE";
    $platform = !isset($platform) ? new Platform($db): $platform;
    $platform->pt_id = $ayar->action;
    if (!$platform->select()) {
        $git = $ayar->getpage("hizmetler");
        header("Location:$git");
        exit;
    }
    if (isset($post["olay"]) AND $post["olay"]=="hizmet-duzenle") {
        foreach ($post as $key => $value) {
            $platform->$key = $value;
        }
        if ($platform->update()) {
            $alert->header = "İşlem Başarılı";
            $alert->content = "Platform detayları başarıyla güncellendi";
            $alert->action = "close";
        }
        include_once "alert.php";
        exit;
    } elseif (isset($post["olay"]) AND $post["olay"]=="hizmet-sil") {
        $alert->header = "Platformu Siliyorsun";
        $alert->content = "Silme işlemi geri alınamaz. Silme işlemi bu platform altında yer alan tüm kategori ve paketleri de kapsamaktadır.";
        $alert->action = "confirm";
        $alert->olay = "silme-onay";
        $alert->page = "hizmet";
        $alert->statu = "info";
        include_once "alert.php";
        exit;
    } elseif (isset($post["olay"]) AND $post["olay"]=="silme-onay") {
        if ($platform->delete()) {
            $kategori = !isset($kategori) ? new Kategori($db): $kategori;
            $paket = !isset($paket) ? new Paket($db): $paket;
            $kategori->pt_tax = $platform->pt_id;
            foreach ($kategori->all() as $hz) {
                extract($hz);
                $paket->hz_tax = $hz_id;
                foreach ($paket->all() as $pk) {
                    extract($pk);
                    $paket->pk_id = $pk_id;
                    $paket->delete();
                }
                $kategori->hz_id = $hz_id;
                $kategori->delete();
            }
            $alert->header = "Platform Silindi";
            $alert->content = "Platform ve bağlı tüm kategorilerle paketler başarıyla kaldırıldı";
            $alert->action = $ayar->getpage('hizmetler');
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
             <a class="butto butto-light butto-xs butbor pull-right" <?php if(isset($_SERVER['HTTP_REFERER'])) { echo 'onclick="history.back();"'; } else { echo 'href="'.$ayar->getpage('hizmet').'"'; } ?>><i class="fas fa-chevron-left"></i> Geri</a>
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="col-md-12">
                    <form id="hizmet-duzenle" method="POST" action="" onsubmit="fastpost('hizmet-duzenle','ajaxout'); return false;">
                        <input type="hidden" name="page" value="hizmet">
                        <input type="hidden" id="olay" name="olay" value="hizmet-duzenle">
                    <?php  if ($ayar->action!="yeni-ekle") { ?>
                        <div class="row form-group">
                            <div class="form-group col-md-5">
                                <label class="form-control-label"><b>Hizmet Adı</b></label>
                                <input class="form-control" name="pt_name" required="" placeholder="Örnek: Instagram" value="<?php echo $platform->pt_name;?>">
                            </div>
                            <div class="form-group col-md-5">
                                <label class="form-control-label"><b>Hizmet Seo Başlık</b></label>
                                <input class="form-control" name="pt_seo" required="" placeholder="Örnek: Instagram Hizmetleri" value="<?php echo $platform->pt_seo;?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label class="form-control-label"><b>Opsiyonel</b></label>
                                <input class="form-control" name="pt_row" required="" placeholder="Örnek: 1" value="<?php echo $platform->pt_row;?>">
                            </div>
                            <div class="form-group col-md-12">         
                                <label class="form-control-label"><b>Hizmet Icon</b></label>
                                <div class="input-group">
                                    <div class="butto butto-light mr-1 smgir">
                                        <i id="iconView_hizico1" class="<?php echo $platform->pt_icon;?>" aria-hidden="true"></i>
                                    </div>
                                    <input class="form-control smginx" id="iconInput_hizico1" name="pt_icon" value="<?php echo $platform->pt_icon;?>" placeholder="icon Kodu">
                                    <button type="button"
                                    class="butto butbor butto-dark icon-modal"
                                    data-toggle="modal"
                                    data-target="#iconSec"
                                    data-icon="<?php echo $platform->pt_icon;?>"
                                    data-add="hizico1">Icon Seç</button>
                                </div>
                            </div>
                            <div class="form-group col-md-12">        
                                    <label class="form-control-label"><b>Hizmet Açıklama</b></label>
                                    <textarea class="form-control" name="pt_text" required=""><?php echo $platform->pt_text;?></textarea>
                            </div>
                        </div>
                        <span class="pull-right">
                            <button onclick="oo_('hizmet-sil');" type="submit"  class="butto butto-danger butto-lg butbor"><i class="fas fa-trash"></i> Sil</button>
                            <button onclick="oo_('hizmet-duzenle');" type="submit" class="butto butto-success butto-lg butbor"><i class="fas fa-check"></i> Kaydet</button>
                        </span>                    
                    <?php } else { ?>
                        <div class="row form-group">    
                            <div class="form-group col-md-6">
                                <label class="form-control-label"><b>Hizmet Adı</b></label>
                                <input class="form-control" name="pt_name" required="" placeholder="Örnek: Instagram">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label"><b>Hizmet Seo Başlık</b></label>
                                <input class="form-control" name="pt_seo" required="" placeholder="Örnek: Instagram Hizmetleri">
                            </div>
                            <div class="form-group col-md-12">
                                <label class="form-control-label"><b>Hizmet Icon</b></label>
                                <div class="input-group">
                                    <div class="butto butto-light mr-1 smgir">
                                        <i id="iconView_hizico2" class="fas fa-icons" aria-hidden="true"></i>
                                    </div>
                                    <input class="form-control smginx" id="iconInput_hizico2" name="pt_icon" value="<?php echo $platform->pt_icon;?>" placeholder="icon Kodu">
                                    <button type="button"
                                    class="butto butbor butto-dark icon-modal"
                                    data-toggle="modal"
                                    data-target="#iconSec"
                                    data-icon="<?php echo $platform->pt_icon;?>"
                                    data-add="hizico2">Icon Seç</button>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="form-control-label"><b>Hizmet Açıklama</b></label>
                                <textarea class="form-control" name="pt_text" required="" placeholder="Örnek: Instagram'da ihtiyaçlarınıza uygun paketlerle etkileşimi artırmaya ve hesabınızı geliştirmeye hazır mısınız?"></textarea>
                            </div>
                        </div>
                        <button onclick="oo_('hizmet-ekle');" type="submit" class="butto butto-success butto-lg butbor pull-right"><i class="fas fa-plus-square"></i> Ekle</button>
                    <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
