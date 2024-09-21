<?php 
if ($ayar->action =="yeni-ekle") {
    $platform = !isset($platform) ? new Platform($db): $platform;
    $tit = "YENİ KATEGORİ EKLE";
    if (isset($post["olay"]) AND $post["olay"]=="kategori-ekle") {
        $kategori = !isset($kategori) ? new Kategori($db): $kategori;
        $kategori->item = array("hz_adi" => $post["hz_adi"],"hz_seo_adi" => $post["hz_seo_adi"],"hz_text" => $post["hz_text"],"hz_makale" => $post["hz_makale"],"pt_tax" => $post["pt_tax"],"hz_icon" => $post["hz_icon"],"i_baslik" => $post["i_baslik"],"i_place" => $post["i_place"],"i_uyari" => $post["i_uyari"]);
        if (!isset($alert->header) AND $kategori->insert()) {
            $alert->header = "İşlem Başarılı";
            $alert->content = "Sisteme yeni bir kategori eklediniz";
            $alert->action = $ayar->getpage('kategori',$kategori->hz_id);
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
    $tit = "KATEGORİ DETAYLARINI DÜZENLE";
    $kategori = !isset($kategori) ? new Kategori($db): $kategori;
    $platform = !isset($platform) ? new Platform($db): $platform;
    $kategori->hz_id = $ayar->action;
    if (!$kategori->select()) {
        $git = $ayar->getpage("kategoriler");
        header("Location:$git");
        exit;
    }
    if (isset($post["olay"]) AND $post["olay"]=="kategori-duzenle") {
        foreach ($post as $key => $value) {
            $kategori->$key = $value;
        }
        if ($kategori->update()) {
            $alert->header = "İşlem Başarılı";
            $alert->content = "Kategori detayları başarıyla güncellendi";
            $alert->action = "close";
        }
        include_once "alert.php";
        exit;
    } elseif (isset($post["olay"]) AND $post["olay"]=="kategori-sil") {
        $alert->header = "Kategoriyi Siliyorsun";
        $alert->content = "Silme işlemi geri alınamaz. Silme işlemi bu kategori altında yer alan tüm paketleri de kapsamaktadır.";
        $alert->action = "confirm";
        $alert->olay = "silme-onay";
        $alert->page = "kategori";
        $alert->statu = "info";
        include_once "alert.php";
        exit;
    } elseif (isset($post["olay"]) AND $post["olay"]=="silme-onay") {
        if ($kategori->delete()) {
            $paket = !isset($paket) ? new Paket($db): $paket;
            $paket->hz_tax = $kategori->hz_id;
            foreach ($paket->all(0,100) as $pk) {
                extract($pk);
                $paket->pk_id = $pk_id;
                $paket->delete();
            }
            $alert->header = "Kategori Silindi";
            $alert->content = "Kategori ve bağlı tüm paketler başarıyla kaldırıldı";
            $alert->action = $ayar->getpage('kategoriler');
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
            <a class="butto butto-light butto-xs pull-right butbor" href="<? if(isset($_SERVER['HTTP_REFERER'])) { echo $_SERVER['HTTP_REFERER']; } else { echo $ayar->getpage('kategoriler'); } ?>"><i class="fas fa-chevron-left"></i> Geri</a>
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="col-md-12">
                    <form id="kategori-duzenle" method="POST" action="" onsubmit="fastpost('kategori-duzenle','ajaxout'); return false;">
                        <input type="hidden" name="page" value="kategori">
                        <input type="hidden" id="olay" name="olay" value="kategori-duzenle">
                    <?php if ($ayar->action != "yeni-ekle") { ?>
                        <div class="row form-group">
                            <div class="form-group col-md-2">
                                <label class="form-control-label"><b>Hizmet</b></label>
                                <select class="form-control" name="pt_tax">
                                    <?php 
                                    foreach ($platform->all(0,100) as $pt) {
                                        extract($pt);
                                        if ($kategori->pt_tax != $pt_id) { 
                                            echo '<option value="'.$pt_id.'">'.$pt_name.'</option>';
                                        } else {
                                            echo '<option value="'.$pt_id.'" selected="">'.$pt_name.'</option>';
                                            $uzanti = $pt_primary;
                                        }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label class="form-control-label"><b>Kategori Adı</b></label>
                                <input class="form-control" name="hz_adi" required="" placeholder="Örnek: Beğeni" value="<?php echo $kategori->hz_adi;?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="form-control-label"><b>Seo Başlık</b></label>
                                <input class="form-control" name="hz_seo_adi" required="" placeholder="Örnek: İnstagram Beğeni Satın Al" value="<?php echo $kategori->hz_seo_adi;?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="form-control-label"><b>Link Uzantısı</b></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-append"> 
                                    <?php if(ns_filter('permalink')!="seo") { ?>
                                        <span class="form-control input-group-text ns-append-add mr-1" id="basic-addon2"><?php echo $uzanti;?>/</span>
                                        <?php } ?>
                                    </div>
                                    <input class="form-control ns-append" id="uzanti" name="hz_pri" required="" placeholder="Örnek: instagram-takipci-satin-al" maxlength="50" value="<?php echo $kategori->hz_pri;?>" aria-describedby="basic-addon2">
                                </div>
                                
                            </div>
                            <div class="form-group col-md-2">
                                <label class="form-control-label"><b>Opsiyonel</b></label>
                                <input class="form-control" type="number" name="hz_row" required="" placeholder="1" value="<?php echo $kategori->hz_row;?>">
                            </div>
                            <div class="form-group col-md-12">
                                <label class="form-control-label"><b>Kategori Icon</b></label>
                               <div class="input-group">
                                    <div class="butto butto-light mr-1 smgir">
                                        <i id="iconView_kateicon1" class="<?php echo $kategori->hz_icon;?>" aria-hidden="true"></i>
                                    </div>
                                    <input class="form-control smginx" id="iconInput_kateicon1" name="hz_icon" value="<?php echo $kategori->hz_icon;?>">
                                    <button type="button"
                                    class="butto butbor butto-dark icon-modal"
                                    data-toggle="modal"
                                    data-target="#iconSec"
                                    data-icon="<?php echo $kategori->hz_icon;?>"
                                    data-add="kateicon1">Icon Seç</button>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="form-control-label"><b>Kategori Açıklama</b></label>
                                <textarea class="form-control" name="hz_text" required="" placeholder="Kurumsal yada bireysel Instagram hesaplarınız için güvenli takipçi paketlerine göz atın ve uygun paketi kolayca satın alın."><?php echo $kategori->hz_text;?></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="alert alert-danger" style="width: 100%;"><b>Gönderim Bilgileri</b><br>Aşağıdaki bölüm sipariş formunda işlem yapılacak kullanıcı adı/link input alanıdır, otomatik işlemlerde sorun çıkmaması için müşterileri doğru giriş yapması için yönlendirin.</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label"><b>Input Başlık</b></label>
                                <input class="form-control" name="i_baslik" required="" maxlength="55" value="<?php echo $kategori->i_baslik;?>" placeholder="Kullanıcı Adı Giriniz / Gönderi Linki Giriniz">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label"><b>Input Placeholder</b></label>
                                <input class="form-control" name="i_place" required="" value="<?php echo $kategori->i_place;?>" maxlength="355" placeholder="Örn: Lütfen Başında @ olmadan kullanıcı adınızı girin">
                            </div>
                            <div class="form-group col-md-12">
                                <label class="form-control-label"><b>Uyarılar</b></label>
                                <textarea class="form-control" name="i_uyari" required="" maxlength="300" placeholder="Örn: Gönderim anında başlar linki doğru yazdığınızdan emin olun. Profilinizi gizliden çıkarın vs."><?php echo $kategori->i_uyari;?></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="alert alert-warning" style="width: 100%;"><b>Kategori Makalesi (İsteğe Bağlı)</b><br>Alt bölümde bulunan editöre kategorileri altında yer alacak bir makale girişi yapabilirsiniz. Eğer kategorilerin altında makale olmasını istemiyorsanız editörü boş bırakın</div>
                                <button type="button" class="ortambut butto butto-dark butto-lg mb-2"  data-ortam="editor"><i class="fas fa-images"></i> Ortam Ekle</button>
                                <textarea id="editor"><?php echo $kategori->hz_makale;?></textarea>
                                <textarea class="fade" id="makale" name="hz_makale"><?php echo $kategori->hz_makale;?></textarea>
                            </div>
                        </div>
                        <div class="pull-right">
                            <button onclick="oo_('kategori-sil');" type="submit"  class="butto butto-danger butto-lg butbor"><i class="fas fa-trash"></i> Sil</button> <button onclick="oo_('kategori-duzenle','makale');" type="submit" class="butto butto-success butto-lg butbor"><i class="fas fa-check"></i> Kaydet</button>
                        </div>
                        <div class="clear"></div>
                    <?php } else { ?>
                        <div class="row form-group">
                            <div class="form-group col-md-6">
                                <label class="form-control-label"><b>Hizmet</b></label>
                                <select class="form-control" name="pt_tax">
                                    <?php 
                                    foreach ($platform->all(0,100) as $pt) {
                                        extract($pt);
                                        echo '<option value="'.$pt_id.'">'.$pt_name.'</option>';
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label"><b>Kategori Adı</b></label>
                                <input class="form-control" name="hz_adi" required="" placeholder="Örnek: Takipçi">
                            </div>
                            <div class="form-group col-md-12">
                                <label class="form-control-label"><b>Seo Başlık</b></label>
                                <input class="form-control" name="hz_seo_adi" required="" placeholder="Örnek: Instagram Takipçi Satın Al">
                            </div>
                            <div class="form-group col-md-12">
                                <label class="form-control-label"><b>Kategori Icon</b></label>
                                <div class="input-group">
                                    <div class="butto butto-light mr-1 smgir">
                                        <i id="iconView_kateicon2" class="fas fa-icons" aria-hidden="true"></i>
                                    </div>
                                    <input class="form-control smginx" id="iconInput_kateicon2" name="hz_icon" value="<?php echo $kategori->hz_icon;?>" placeholder="icon Kodu">
                                    <button type="button"
                                    class="butto butbor butto-dark icon-modal"
                                    data-toggle="modal"
                                    data-target="#iconSec"
                                    data-icon="<?php echo $kategori->hz_icon;?>"
                                    data-add="kateicon2">Icon Seç</button>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="form-control-label"><b>Kategori Açıklama</b></label>
                                <textarea class="form-control" name="hz_text" required="" placeholder="Kurumsal yada bireysel Instagram hesaplarınız için güvenli takipçi paketlerine göz atın ve uygun paketi kolayca satın alın."></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="alert alert-danger" style="width: 100%;text-align: center;"><b>Gönderim Bilgileri</b><br>Aşağıdaki bölüm sipariş formunda işlem yapılacak kullanıcı adı/link input alanıdır, otomatik işlemlerde sorun çıkmaması için müşterileri doğru giriş yapması için yönlendirin.</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label"><b>Input Başlık</b></label>
                                <input class="form-control" name="i_baslik" required="" maxlength="55" placeholder="Kullanıcı Adı Giriniz / Gönderi Linki Giriniz">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label"><b>Input Placeholder</b></label>
                                <input class="form-control" name="i_place" required="" maxlength="355" placeholder="Örn: Lütfen Başında @ olmadan kullanıcı adınızı girin">
                            </div>
                            <div class="form-group col-md-12">
                                <label class="form-control-label"><b>Uyarılar</b></label>
                                <textarea class="form-control" name="i_uyari" required="" maxlength="300" placeholder="Örn: Gönderim anında başlar linki doğru yazdığınızdan emin olun. Profilinizi gizliden çıkarın vs."></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="alert alert-warning" style="width: 100%;text-align: center;"><b>Kategori Makalesi (İsteğe Bağlı)</b><br>Alt bölümde bulunan editöre kategorileri altında yer alacak bir makale girişi yapabilirsiniz. Eğer kategorilerin altında makale olmasını istemiyorsanız editörü boş bırakın</div>
                                <button type="button" class="ortambut butto butto-dark butto-lg mb-2"  data-ortam="editor"><i class="fas fa-images"></i> Ortam Ekle</button>
                                <textarea id="editor"></textarea>
                                <textarea class="fade" id="makale" name="hz_makale"></textarea>
                            </div>
                        </div>
                        <button onclick="oo_('kategori-ekle','makale');" type="submit" class="butto butto-success butto-lg pull-right butbor"><i class="fas fa-plus-square"></i> Ekle</button>
                        <div class="clear"></div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#uzanti').keyup(function() {
        var text = this.value.replace(" ","");
        var text = text.replace(/[^a-z-]/g,'');
        this.value= text.trim();
    });
</script>