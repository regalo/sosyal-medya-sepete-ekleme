<?php
if (!isset($_SESSION["icerik"])) {
$_SESSION["icerik"] = "blog";
}
if (isset($post["olay"]) AND $post["olay"]=="editor-add") {
        if ($ayar->uploadPhoto('file',$post["olay"])) {
            echo '<p><img alt="" src="'.$ayar->siteurl.$ayar->fileneme.'"/></p>';
        }
        exit;
    }
if ($ayar->action == "blog" OR $ayar->action == "sayfa") {
    $tit = ucwords($ayar->action).' Ekle';
    if (isset($post["olay"]) AND $post["olay"]=="sayfa_icon") {
        if ($ayar->uploadPhoto('file',$post["olay"])) {
            echo '<img width="100%" class="mx-auto d-block" src="'.$ayar->siteurl.$ayar->fileneme.'">';
            echo '<input type="hidden" name="'.$post["olay"].'" value="'.$ayar->fileneme.'">';
        } else {
            echo '<img height="100%" class="mx-auto d-block" src="https://d1kd592qkbtea7.cloudfront.net/assets/missing.png">';
            echo '<input type="hidden" name="'.$post["olay"].'" value="">';
        }
        exit;
    } elseif (isset($post["olay"]) AND $post["olay"]=="icerik-ekle") {
        $icerik = !isset($icerik) ? new Icerik($db): $icerik;
        foreach ($post as $key => $value) {
            if (empty($value)) {
                $alert->header = true;
                break;
            }
        }
        $icerik->item = array("sayfa_baslik" => $post["sayfa_baslik"],"sayfa_primary" => $post["sayfa_primary"], "sayfa_seo_baslik" => $post["sayfa_seo_baslik"],"sayfa_aciklama" => $post["sayfa_aciklama"],"sayfa_icerik" => $_POST["sayfa_icerik"],"sayfa_icon" => $post["sayfa_icon"]);
        if ($ayar->action AND empty($post["sayfa_icon"])) {
            $alert->header = "Görsel Seçmedin";
            $alert->content = "Bir blog içeriği oluşturmak için öne çıkan görsel belirlemelisin";
            $alert->action = "close";
            $alert->statu = "danger";
        } elseif ($icerik->insert()) {
            $alert->header = "İşlem Başarılı";
            $alert->content = "Yeni içerik başarıyla oluşturuldu.";
            $alert->action = $ayar->getpage('icerik',$icerik->sayfa_id);
        }
        include_once "alert.php";
        exit;
    }
} else {
    $icerik = !isset($icerik) ? new icerik($db): $icerik;
    $icerik->sayfa_id = $ayar->action;
    $icerik->select();
    if($icerik->sayfa_icon)
    $icerik->tur = $icerik->sayfa_icon == 'sayfa' ? 'sayfa':'blog';
    $tit = ucwords($icerik->tur).' Düzenle';
    if (isset($post["olay"]) AND $post["olay"]=="sayfa_icon") {
        if ($ayar->uploadPhoto('file',$post["olay"])) {
            echo '<img width="100%" class="mx-auto d-block" src="'.$ayar->siteurl.$ayar->fileneme.'">';
            echo '<input type="hidden" name="'.$post["olay"].'" value="'.$ayar->fileneme.'">';
        } else {
            echo '<img height="100%" class="mx-auto d-block" src="'.$ayar->siteurl.$icerik->$post["olay"].'">';
            echo '<input type="hidden" name="'.$post["olay"].'" value="'.$icerik->$post["olay"].'">';
        }
        exit;
    } elseif (isset($post["olay"]) AND $post["olay"]=="icerik-duzenle") {
        foreach ($post as $key => $value) {
            $icerik->$key = $value;
        }
        $icerik->sayfa_icerik = $_POST["sayfa_icerik"];
        if ($icerik->update()) {
            $alert->header = "İşlem Başarılı";
            $alert->content = "İçerik başarıyla güncellendi";
            $alert->action = "close";
        }
        include_once "alert.php";
        exit;
    } elseif (isset($post["olay"]) AND $post["olay"]=="icerik-sil") {
        $alert->header = "İçeriği Siliyorsun";
        $alert->content = "Bu içeriği silmek istediğine emin misin?";
        $alert->action = "confirm";
        $alert->statu = "info";
        $alert->olay = "icerik-sil-onay";
        $alert->page = "icerik";
        include_once "alert.php";
        exit;
    } elseif (isset($post["olay"]) AND $post["olay"]=="icerik-sil-onay") {
        if ($icerik->delete()) {
            $alert->header = "İçerik Silindi";
            $alert->content = "İçerik kalıcı olarak silindi";
            $alert->action = $ayar->getpage('icerikler',$_SESSION["icerik"]);
        }
        include_once "alert.php";
        exit;
    }
}

?>
<div class="content" id="alan">
    <div class="animated fadeIn" id="scrolling">
        <div class="orders">
            <form id="icerik-duzenle" method="POST" action="" onsubmit="fastpost('icerik-duzenle','ajaxout'); return false;">
                <div class="row">
                    <div class="col-md-8 mo2">
                        <div class="card">
                            <div class="card-header">
                                <div class="bol-7">
                                    <strong class="box-title"><?php echo $tit;?></strong>
                                </div>

                                <div class="bol-3">
                                   <a class="butto butto-light butto-xs pull-right butbor" <?php echo 'href="'.$ayar->getpage('icerikler',$_SESSION["icerik"]).'"'; ?>><i class="fas fa-chevron-left"></i> Geri</a>
                               </div>                            
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <?php  if ($ayar->action!="blog" AND $ayar->action!="sayfa") { ?> 
                                        <input type="hidden" id="page" name="page" value="icerik">
                                        <input type="hidden" id="olay" name="olay" value="icerik-duzenle">
                                            <div class="row">
                                                <div class="col-md-<?php echo $icerik->tur=='Sayfa' ? '12': '12';?>">  
                                                    <div class="form-group">
                                                        <label class="form-control-label"><b>İçerik Başlık</b></label>
                                                        <input class="form-control" name="sayfa_baslik" required="" value="<?php echo $icerik->sayfa_baslik;?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-control-label"><b>İçerik Seo Başlık</b></label>
                                                        <input class="form-control" name="sayfa_seo_baslik" required="" value="<?php echo $icerik->sayfa_seo_baslik;?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-control-label">İçerik Açıklama</label>
                                                        <textarea class="form-control" maxlength="160" name="sayfa_aciklama" required="" placeholder="Max 160 Karakterlik bir açıklama giriniz!"><?php echo $icerik->sayfa_aciklama;?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">  
                                                    <div class="clear"></div>
                                                    <label class="form-control-label">
                                                    	<b class="d-block mb-2">İçerik Alanı</b>
                                                    	<button type="button" class="ortambut butto butto-dark butto-lg"  data-ortam="editor"><i class="fas fa-images"></i> Ortam Ekle</button>
                                                    </label>
                                                    <textarea id="editor"><?php echo $icerik->sayfa_icerik;?></textarea>
                                                    <textarea class="fade" id="makale" name="sayfa_icerik"><?php echo $icerik->sayfa_icerik;?></textarea>
                                                </div>
                                                <div class="col-md-12 mt-3 text-right">
                                                    <button onclick="oo_('icerik-sil');" type="submit" class="butto butto-danger butto-lg butbor"><i class="fas fa-trash"></i> Sil</button>
                                                    <button onclick="oo_('icerik-duzenle','makale');" type="submit" class="butto butto-success butto-lg butbor"><i class="fas fa-check"></i> Kaydet</button>
                                                </div>
                                            </div>
                                        <?php } else { ?> 
                                        <input type="hidden" id="page" name="page" value="icerik">
                                        <input type="hidden" id="olay" name="olay" value="icerik-ekle">
                                            <div class="row">
                                                <div class="col-md-<?php echo $ayar->action!='blog' ? '12': '12';?>">  
                                                    <div class="form-group">
                                                        <label class="form-control-label"><b>İçerik Başlık</b></label>
                                                        <input class="form-control" name="sayfa_baslik" required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-control-label"><b>İçerik Seo Başlık</b></label>
                                                        <input class="form-control" name="sayfa_seo_baslik" required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-control-label">İçerik Açıklama</label>
                                                        <textarea class="form-control" maxlength="160" name="sayfa_aciklama" required="" placeholder="Max 160 Karakterlik bir açıklama giriniz!"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <div class="clear"></div>
                                                    <label class="form-control-label">
                                                    	<b class="d-block mb-2">İçerik Alanı</b>
                                                    	<button type="button" class="ortambut butto butto-dark butto-lg"  data-ortam="editor"><i class="fas fa-images"></i> Ortam Ekle</button>
                                                    </label>
                                                    <textarea id="editor"></textarea>
                                                    <textarea class="fade" id="makale" name="sayfa_icerik"></textarea>
                                                </div>
                                                <div class="col-md-12 pull-right mt-3">
                                                    <button onclick="oo_('icerik-ekle','makale');" type="submit" class="butto butto-success butto-lg pull-right butbor"><i class="fas fa-plus-square"></i> Ekle</button>
                                                </div>
                                                <script type="text/javascript">
                                                    function kkk(str){
                                                        CKEDITOR.instances['editor'].setData(str);
                                                    }
                                                </script>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mo1">
                        <?php if ($ayar->action=="blog" OR ($ayar->action!="blog" AND $ayar->action!="sayfa" AND $icerik->sayfa_icon!="sayfa")) { ?>
                           <div class="card">
                                    <div class="card-header">
                                        <div class="bol-7">
                                            <div class="box-title">Öne Çıkan Görsel</div>
                                        </div>
                                        <div class="bol-3">
                                         <div class="ortam-butz">
                                            <button type="button" class="butto butto-danger butto-xs butbor pull-right dsilbut">Kaldır</button>
                                         </div>
                                        </div>
                                    </div>
                                    <div class="card-body" style="margin-bottom: 0">
                                        <div class="onecik-onizle ortambut" data-ortam="sayfa"  <?php echo isset($icerik->sayfa_icon) ? 'data-url="'.ns_filter('siteurl').$icerik->sayfa_icon.'" data-input="'.$icerik->sayfa_icon.'"':'';?>>
                                            <img class="ortam-sec" src="<?php echo ns_filter('siteurl').'panel/images/load-img.png';?>">
                                            <div class="tumb-oniztext">
                                                <?php if (isset($icerik->sayfa_icon)) { ?>
                                                    <img id="sayfa-onizleme" src="<?php echo ns_filter('siteurl').$icerik->sayfa_icon;?>">
                                                    <input type="hidden" id="sayfa-input" name="sayfa_icon" required="" value="<?php echo $icerik->sayfa_icon;?>">
                                               <?php } else { ?>
                                                    <img id="sayfa-onizleme" src="<?php echo ns_filter('siteurl').'panel/images/none.png';?>">
                                                    <input type="hidden" id="sayfa-input" name="sayfa_icon" required="" value="">
                                               <?php } ?>
                                           </div>
                                        </div>
                                    </div>
                                </div>
                        <?php } else {
                            echo '<input type="hidden" name="sayfa_icon" value="sayfa">';
                        } ?>  
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

 