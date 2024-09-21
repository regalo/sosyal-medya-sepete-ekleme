<?php
if (isset($ayar->action) AND is_numeric($ayar->action)) {
$ayar->ayar_1 = $ayar->action;
$ayar->id();
$info = explode('NivuBol', $ayar->item3);
}
if (isset($post["olay"]) AND $post["olay"]=="banka-ekle") {
$ayar->item = array("item1" => "havalebank","item2" => $post["item2"],"item3" => $post["info"][0].'NivuBol'.$post["info"][1].'NivuBol'.$post["info"][2].'NivuBol'.$post["info3"],"item4" => $post["item4"],"item5" => $post["item5"]);
$ayar->insert();
$alert->header = "Banka Eklendi";
$alert->content = "Yeni bir banka hesabı başarıyla eklendi";
$alert->action = $ayar->getpage('odeme-ayarlari',$ayar->ayar_1);
include_once "alert.php";
exit;
} elseif (isset($post["olay"]) AND $post["olay"]=="banka-duzenle") {
foreach ($post as $key => $value) {
$ayar->$key = $value;
}
$ayar->item3 = $post["info"][0].'NivuBol'.$post["info"][1].'NivuBol'.$post["info"][2].'NivuBol'.$post["info"][3];
$ayar->update();
$alert->header = "Banka Güncellendi";
$alert->content = "Banka hesap bilgileri başarıyla güncellendi";
$alert->action = "close";
include_once "alert.php";
exit;
} elseif (isset($post["olay"]) AND $post["olay"]=="banka-sil") {
$alert->header = "Silme İşlemi";
$alert->content = "Bu banka hesabını silmek istediğinize emin misiniz?";
$alert->action = "confirm";
$alert->olay = "silme-onay";
$alert->statu = "info";
$alert->page = "odeme-ayarlari";
include_once "alert.php";
exit;
} elseif (isset($post["olay"]) AND $post["olay"]=="silme-onay") {
if ($ayar->delete()) {
$alert->header = "Hesap Silindi";
$alert->content = "Banka hesabı bilgileri başarıyla kaldırıldı";
$alert->action = $ayar->getpage('odeme-ayarlari');
}
include_once "alert.php";
exit;
} elseif (isset($post["olay"]) AND strstr($post["olay"], "hizmet-bedeli")) {
$ayar->select($post["olay"]);
foreach ($post as $key => $value) {
$ayar->$key = $value;
}
$ayar->update();
$alert->header = "İşlem Başarılı";
$alert->content = "Hizmet Bedeli ayarları güncellendi";
$alert->action = "close";
include_once "alert.php";
exit;
} elseif (isset($post["olay"]) AND ($post["olay"]=="onlinepay" OR $post["olay"]=="mobilepay" OR $post["olay"]=="havalepay" OR $post["olay"]=="order_setting")) {
$ayar->select($post["olay"]);
foreach ($post as $key => $value) {
$ayar->$key = $value;
}
$ayar->update();
$alert->header = "İşlem Başarılı";
$alert->content = "Ödeme ayarları güncellendi";
$alert->action = "close";
include_once "alert.php";
exit;
}
?>
<div class="content" id="alan">
    <div class="animated fadeIn" id="scrolling">
        <div class="orders">
            <?php if (isset($ayar->action)) { ?>
            <div class="card">
                <div class="card-header">
                    <strong class="box-title"><?php echo $ayar->action=="banka-ekle" ? "Banka Hesabı Ekle":"Banka Hesabı Düzenle";?></strong>
                    <a href="<?php echo $ayar->getpage('odeme-ayarlari');?>" class="butto butto-light bottu-xs pull-right butbor"><i class="fas fa-chevron-left"></i> Geri</a>
                </div>
                <div class="card-body">
                    <form id="hizmet-bedeli" method="POST" action="" onsubmit="fastpost('hizmet-bedeli','ajaxout'); return false;">
                        <input type="hidden" name="page" value="odeme-ayarlari">
                        <input type="hidden" id="olay" name="olay" value="<?php echo $ayar->action=="banka-ekle" ? "banka-ekle":"banka-duzenle";?>">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold">Banka Adı</label>
                                    <input class="form-control" type="text" name="item2" required="" placeholder="Örnek: QNB Finansbank" value="<?php echo isset($info) ? $ayar->item2:"";?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label"><b>Hesap No</b></label>
                                    <input class="form-control" type="text" name="info[2]"  placeholder="123423" value="<?php echo isset($info) ? $info[2]:"";?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label"><b>IBAN</b></label>
                                    <input class="form-control" type="text" name="info[0]" placeholder="Örnek: QNB Finansbank" value="<?php echo isset($info) ?  $info[0]:"";?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label"><b>Alıcı Adı</b></label>
                                    <input class="form-control" type="text" name="item4"  placeholder="Örnek: NivuSoft İnternet Hizmetleri" value="<?php echo isset($info) ? $ayar->item4:"";?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label"><b>Şube Kodu</b></label>
                                    <input class="form-control" type="text" name="info[1]"  placeholder="1234" value="<?php echo isset($info) ? $info[1]:"";?>">
                                </div>
                                <input type="hidden" name="info[3]">
                            </div>
                            <div class="col-md-3">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <div class="box-title">Banka Logosu</div>
                                    </div>
                                    <div class="card-body" style="margin-bottom: 0">
                                        <div class="onecik-onizle ortambut" data-ortam="item5" <?php echo $ayar->action=="banka-ekle" ? '':'data-url="'.ns_filter('siteurl').$ayar->item5.'" data-input="'.$ayar->item5.'"';?>>
                                            <img class="ortam-sec" src="<?php echo ns_filter('siteurl').'panel/images/ortam-sec.png';?>">
                                            <div class="tumb-oniztext">
                                                <?php if ($ayar->action=="banka-ekle") { ?>
                                                    <img id="item5-onizleme" src="<?php echo ns_filter('siteurl').'panel/images/none.png';?>">
                                                    <input type="hidden" id="item5-input" name="item5" required="" value="">
                                               <?php } else { ?>
                                                    <img id="item5-onizleme" src="<?php echo ns_filter('siteurl').$ayar->item5;?>">
                                                    <input type="hidden" id="item5-input" name="item5" required="" value="<?php echo $ayar->item5;?>">
                                               <?php } ?>
                                           </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <?php if(isset($ayar->action) AND is_numeric($ayar->action)) { ?>
                                <button type="submit" onclick="oo_('banka-sil');" class="butto butto-danger butto-lg butbor"><i class="fas fa-trash"></i> Sil</button>
                                <?php }?>
                                <button onclick="oo_('<?php echo $ayar->action=="banka-ekle" ? "banka-ekle":"banka-duzenle";?>')" class="butto butto-success butto-lg butbor"><i class='fas fa-check'></i> <?php echo $ayar->action=="banka-ekle" ? "Ekle":"Değişiklikleri Kaydet";?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php } else { 
                $ayar->odemeyontemleri = $ayar->PaymentMethods(); ?>
            <div class="tab-alani">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link sari butto-lg active show" id="pills-odememodul-tab" data-toggle="pill" href="#pills-odememodul" role="tab" aria-controls="pills-odememodul" aria-selected="true">Modül Yönetimi <?php badge(5);?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link sari butto-lg" id="pills-onli-ode-tab" data-toggle="pill" href="#pills-onli-ode" role="tab" aria-controls="pills-onli-ode" aria-selected="false">Online Ödeme</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link sari butto-lg" id="pills-mobil-ode-tab" data-toggle="pill" href="#pills-mobil-ode" role="tab" aria-controls="pills-mobil-ode" aria-selected="true">Mobil Ödeme</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link sari butto-lg" id="pills-havale-ode-tab" data-toggle="pill" href="#pills-havale-ode" role="tab" aria-controls="pills-havale-ode" aria-selected="true">Havale/EFT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link sari butto-lg" id="pills-tercihi-tab" data-toggle="pill" href="#pills-tercihi" role="tab" aria-controls="pills-tercihi" aria-selected="true">Ödeme Tercihleri</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="pills-tabContent">

                <div class="tab-pane fade active show" id="pills-odememodul" role="tabpanel" aria-labelledby="pills-odememodul-tab">
                        <div class="modul-list">
                        <?php $payments = $nsoft->all("modul","payment");
                        $lang = array();
                        foreach ($nsoft->lists as $value) {
                            $payment[$value["primary"]] = $value;
                        }
                        foreach ($nsoft->real as $value) {
                            if(!isset($payment[$value["primary"]]))
                            $payment[$value["primary"]] = $value;
                        }
                        ?>
                        <?php 
                        foreach ($payment as $value) { ?>
                            <div class="moduseci">
                                <div class="modul-img">
                                    <img style="min-height: auto" src="<?= $value["screenshot"];?>">
                                </div>
                                <div class="moduls-title">
                                    <span class="font-weight-bold mr-1"><?php echo $value["name"];?></span>
                                    <div class="eksurum">( v<?php echo $value["version"];?>  )</div>
                                    <p><?php echo isset($value["update"]["description"]) ? $value["update"]["description"]:$value["description"];?></p>
                                </div>
                                <div class="text-center mod-btnz">
                                    <?php if (isset($value["update"])) { ?>
                                    <script type="text/javascript">
                                        var <?= $value["primary"].'_update';?> = <?= json_encode($value["update"]);?>;
                                    </script>
                                    <? if($value["statu"]==2) { ?>
                                        <button type="button" onclick="nsoft(<?= $value["primary"].'_update';?>)" class="butto butto-primary butbor d-inline"><i class="fas fa-cloud-download-alt"></i> Yükle</button>
                                    <? } elseif($value["statu"]==1) {
                                    $upstatu = true; ?>
                                    <button type="button" onclick="nsoft(<?= $value["primary"].'_update';?>)" class="butto butto-warning butbor d-inline"><i class="fas fa-sync-alt"></i> Güncelle</button>
                                <? } } elseif($value["statu"]==1) {
                                        echo '<button type="button" class="butto butto-success butbor d-inline"><i class="fas fa-check-double"></i> Güncel</button>';
                                    } elseif($value["statu"]==0) { ?>
                                        <button class="butto butto-light butbor d-inline"><?= $value["price"];?></button>
                                        <script type="text/javascript">
                                            var <?= $value["primary"].'_buy';?> = <?= json_encode($value["buy"]);?>;
                                        </script>
                                        <button type="button" onclick="nsoft(<?= $value["primary"].'_buy';?>)" class="butto butto-primary butbor d-inline"> Satın Al</button>
                                    <? } ?>
                                </div>
                        </div>
                        <?php } 
                        if(!isset($upstatu) AND _up('modul',0)); ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-onli-ode" role="tabpanel" aria-labelledby="pills-onli-ode-tab">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title">Online Ödeme Ayarları</strong>
                                    <?php $method = "onlinepay"; ?>
                                </div>
                                <div class="card-body">
                                   <div class="tab-alanix">
                                        <ul class="nav nav-pills mb-3 " id="pills-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link alti butto-lg <?php echo ns_filter($method,"item2")=="kapali" ? 'active show':'';?>" id="pills-kapali-online-tab" data-toggle="pill" href="#pills-kapali-online" role="tab" aria-controls="pills-kapali-online" aria-selected="false">Kapali</a>
                                            </li>
                                            <?php
                                            foreach ($ayar->odemeyontemleri[$method] as $value) { ?>
                                                <li class="nav-item">
                                                    <a class="nav-link alti butto-lg <?php echo ns_filter($method,"item2")==$value["code"] ? 'active show':'';?>" id="pills-<?php echo $value["folder"].'-'.$method;?>-tab" data-toggle="pill" href="#pills-<?php echo $value["folder"].'-'.$method;?>" role="tab" aria-controls="pills-<?php echo $value["folder"].'-'.$method;?>" aria-selected="false"><?php echo $value["name"];?></a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                   </div>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade <?php if(ns_filter($method)=="kapali") { echo "active show";}?>" id="pills-kapali-online" role="tabpanel" aria-labelledby="pills-kapali-online-tab">
                                            <form id="kapali-online" method="POST" action="" onsubmit="fastpost('kapali-online','ajaxout'); return false;">
                                                <input type="hidden" name="page" value="odeme-ayarlari">
                                                <input type="hidden" id="olay" name="olay" value="onlinepay">
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <p>ONLINE ödeme ayarlarını bu şekilde kaydederseniz kapalı olarak güncellenecektir.</p>
                                                    </div>
                                                    <div class="col-md-12 text-right mt-3">
                                                        <input type="hidden" name="item2" value="kapali">
                                                        <input type="hidden" name="item3" value="">
                                                        <input type="hidden" name="item4" value="">
                                                        <input type="hidden" name="item5" value="">
                                                        <input type="hidden" name="statu" value="0">
                                                        <button  type="submit" class="butto butto-success butto-lg butbor pull-right"><i class="fas fa-check"></i> Kaydet</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <?php
                                        foreach ($ayar->odemeyontemleri[$method] as $value) { 
                                            require "config/payment/".$value["folder"]."/setting.php";
                                        } ?>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <div class="box-title">Online Ödeme Tercihleri</div>
                                </div>
                                <div class="card-body">
                                    <form id="online-hizmet-bedeli" method="POST" action="" onsubmit="fastpost('online-hizmet-bedeli','ajaxout'); return false;">
                                        <input type="hidden" name="page" value="odeme-ayarlari">
                                        <input type="hidden" id="olay" name="olay" value="online-hizmet-bedeli">
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="row">
                                                <?php $ayar->select('online-hizmet-bedeli','create'); ?>
                                                <div class="form-group col-md-12">
                                                    <label class="font-weight-bold">Komisyon Bedeli</label>
                                                    <select class="form-control" name="statu">
                                                        <option value="1" <?php echo $ayar->statu==1 ? "selected": "";?>>Açık</option>
                                                        <option value="0" <?php echo $ayar->statu==0 ? "selected": "";?>>Kapalı</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="font-weight-bold">Komisyon Türü</label>
                                                    <select class="form-control" name="item2">
                                                        <option value="yuzde" <?php echo $ayar->item2=="yuzde" ? "selected": "";?>>Yüzde Olarak (%)</option>
                                                        <option value="sabit" <?php echo $ayar->item2=="sabit" ? "selected": "";?>>Sabit Fiyat</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="font-weight-bold">Komisyon Oranı/Miktarı</label>
                                                    <input class="form-control" type="text" name="item3" value="<?php echo $ayar->item3;?>" placeholder="Oran/Miktar">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="font-weight-bold">Online Ödeme Açıklaması</label>
                                                    <textarea class="form-control" name="item4"><?php echo $ayar->item4;?></textarea>
                                                </div>
                                                <div class="col-md-12 text-right mt-3">
                                                    <button type="submit" class="butto butto-success butto-lg pull-right butbor"><i class="fas fa-check"></i> Kaydet</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-mobil-ode" role="tabpanel" aria-labelledby="pills-mobil-ode-tab">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title">Mobil Ödeme Ayarları</strong>
                                    <?php $method = "mobilepay"; ?>
                                </div>
                                <div class="card-body">
                                   <div class="tab-alanix">
                                        <ul class="nav nav-pills mb-3 " id="pills-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link alti butto-lg <?php echo ns_filter("mobilepay","item2")=="kapali" ? 'active show':'';?>" id="pills-kapali-mobil-tab" data-toggle="pill" href="#pills-kapali-mobil" role="tab" aria-controls="pills-kapali-mobil" aria-selected="false">Kapali</a>
                                            </li>
                                            <?php
                                            foreach ($ayar->odemeyontemleri[$method] as $value) { ?>
                                                <li class="nav-item">
                                                    <a class="nav-link alti butto-lg <?php echo ns_filter("mobilepay","item2")==$value["code"] ? 'active show':'';?>" id="pills-<?php echo $value["folder"].'-'.$method;?>-tab" data-toggle="pill" href="#pills-<?php echo $value["folder"].'-'.$method;?>" role="tab" aria-controls="pills-<?php echo $value["folder"].'-'.$method;?>" aria-selected="false"><?php echo $value["name"];?></a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                   </div>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade <?php if(ns_filter($method)=="kapali") { echo "active show";}?>" id="pills-kapali-mobil" role="tabpanel" aria-labelledby="pills-kapali-mobil-tab">
                                            <form id="kapali-mobil" method="POST" action="" onsubmit="fastpost('kapali-mobil','ajaxout'); return false;">
                                                <input type="hidden" name="page" value="odeme-ayarlari">
                                                <input type="hidden" id="olay" name="olay" value="<?php echo $method;?>">
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <p>MODİL ödeme ayarlarını bu şekilde kaydederseniz kapalı olarak güncellenecektir.</p>
                                                    </div>
                                                    <div class="col-md-12 text-right mt-3">
                                                        <input type="hidden" name="item2" value="kapali">
                                                        <input type="hidden" name="item3" value="">
                                                        <input type="hidden" name="item4" value="">
                                                        <input type="hidden" name="item5" value="">
                                                        <input type="hidden" name="statu" value="0">
                                                        <button  type="submit" class="butto butto-success butto-lg butbor pull-right"><i class="fas fa-check"></i> Kaydet</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <?php
                                        foreach ($ayar->odemeyontemleri[$method] as $value) {
                                            require "config/payment/".$value["folder"]."/setting.php";
                                        } ?>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <div class="box-title">Mobil Ödeme Tercihleri</div>
                                </div>
                                <div class="card-body">
                                    <form id="mobil-hizmet-bedeli" method="POST" action="" onsubmit="fastpost('mobil-hizmet-bedeli','ajaxout'); return false;">
                                        <input type="hidden" name="page" value="odeme-ayarlari">
                                        <input type="hidden" id="olay" name="olay" value="mobil-hizmet-bedeli">
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="row">
                                                <?php $ayar->select('mobil-hizmet-bedeli','create'); ?>
                                                <div class="form-group col-md-12">
                                                    <label class="font-weight-bold">Komisyon Bedeli</label>
                                                    <select class="form-control" name="statu">
                                                        <option value="1" <?php echo $ayar->statu==1 ? "selected": "";?>>Açık</option>
                                                        <option value="0" <?php echo $ayar->statu==0 ? "selected": "";?>>Kapalı</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="font-weight-bold">Komisyon Türü</label>
                                                    <select class="form-control" name="item2">
                                                        <option value="yuzde" <?php echo $ayar->item2=="yuzde" ? "selected": "";?>>Yüzde Olarak (%)</option>
                                                        <option value="sabit" <?php echo $ayar->item2=="sabit" ? "selected": "";?>>Sabit Fiyat</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="font-weight-bold">Komisyon Oranı/Miktarı</label>
                                                    <input class="form-control" type="text" name="item3" value="<?php echo $ayar->item3;?>" placeholder="Oran/Miktar">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="font-weight-bold">Mobil Ödeme Açıklaması</label>
                                                    <textarea class="form-control" name="item4"><?php echo $ayar->item4;?></textarea>
                                                </div>
                                                <div class="col-md-12 text-right mt-3">
                                                    <button type="submit" class="butto butto-success butto-lg pull-right butbor"><i class="fas fa-check"></i> Kaydet</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-havale-ode" role="tabpanel" aria-labelledby="pills-havale-ode-tab">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title">Havale/EFT Ödeme Ayarları</strong>
                                    <?php $method = "havalepay"; ?>
                                </div>
                                <div class="card-body">
                                   <div class="tab-alanix">
                                        <ul class="nav nav-pills mb-3 " id="pills-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link alti butto-lg <?php echo ns_filter($method,"item2")=="kapali" ? 'active show':'';?>" id="pills-kapali-havale-tab" data-toggle="pill" href="#pills-kapali-havale" role="tab" aria-controls="pills-kapali-havale" aria-selected="false">Kapali</a>
                                            </li>
                                            <?php
                                            foreach ($ayar->odemeyontemleri[$method] as $value) { ?>
                                                <li class="nav-item">
                                                    <a class="nav-link alti butto-lg <?php echo ns_filter($method,"item2")==$value["code"] ? 'active show':'';?>" id="pills-<?php echo $value["folder"].'-'.$method;?>-tab" data-toggle="pill" href="#pills-<?php echo $value["folder"].'-'.$method;?>" role="tab" aria-controls="pills-<?php echo $value["folder"].'-'.$method;?>" aria-selected="false"><?php echo $value["name"];?></a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                   </div>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade <?php if(ns_filter($method)=="kapali") { echo "active show";}?>" id="pills-kapali-havale" role="tabpanel" aria-labelledby="pills-kapali-havale-tab">
                                            <form id="kapali-havale" method="POST" action="" onsubmit="fastpost('kapali-havale','ajaxout'); return false;">
                                                <input type="hidden" name="page" value="odeme-ayarlari">
                                                <input type="hidden" id="olay" name="olay" value="<?php echo $method;?>">
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <p>Havale-EFT ödeme ayarlarını bu şekilde kaydederseniz kapalı olarak güncellenecektir.</p>
                                                    </div>
                                                    <div class="col-md-12 text-right mt-3">
                                                        <input type="hidden" name="item2" value="kapali">
                                                        <input type="hidden" name="item3" value="">
                                                        <input type="hidden" name="item4" value="">
                                                        <input type="hidden" name="item5" value="">
                                                        <input type="hidden" name="statu" value="0">
                                                        <button  type="submit" class="butto butto-success butto-lg butbor pull-right"><i class="fas fa-check"></i> Kaydet</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <?php
                                        foreach ($ayar->odemeyontemleri[$method] as $value) {
                                            require "config/payment/".$value["folder"]."/setting.php";
                                        } ?>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <div class="box-title">Havale/EFT Tercihleri</div>
                                </div>
                                <div class="card-body">
                                    <form id="havale-hizmet-bedeli" method="POST" action="" onsubmit="fastpost('havale-hizmet-bedeli','ajaxout'); return false;">
                                        <input type="hidden" name="page" value="odeme-ayarlari">
                                        <input type="hidden" id="olay" name="olay" value="havale-hizmet-bedeli">
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="row">
                                                <?php $ayar->select('havale-hizmet-bedeli','create'); ?>
                                                <div class="form-group col-md-12">
                                                    <label class="font-weight-bold">Komisyon Bedeli</label>
                                                    <select class="form-control" name="statu">
                                                        <option value="1" <?php echo $ayar->statu==1 ? "selected": "";?>>Açık</option>
                                                        <option value="0" <?php echo $ayar->statu==0 ? "selected": "";?>>Kapalı</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="font-weight-bold">Komisyon Türü</label>
                                                    <select class="form-control" name="item2">
                                                        <option value="yuzde" <?php echo $ayar->item2=="yuzde" ? "selected": "";?>>Yüzde Olarak (%)</option>
                                                        <option value="sabit" <?php echo $ayar->item2=="sabit" ? "selected": "";?>>Sabit Fiyat</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="font-weight-bold">Komisyon Oranı/Miktarı</label>
                                                    <input class="form-control" type="text" name="item3" value="<?php echo $ayar->item3;?>" placeholder="Oran/Miktar">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="font-weight-bold">Havale/EFT Açıklaması</label>
                                                    <textarea class="form-control" name="item4"><?php echo $ayar->item4;?></textarea>
                                                </div>
                                                <div class="col-md-12 text-right mt-3">
                                                    <button type="submit" class="butto butto-success butto-lg pull-right butbor"><i class="fas fa-check"></i> Kaydet</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-tercihi" role="tabpanel" aria-labelledby="pills-tercihi-tab">
                        <div class="card">
                         <div class="card-body">
                             <form id="order_setting" method="POST" action="" onsubmit="fastpost('order_setting','ajaxout'); return false;">
                        <input type="hidden" name="page" value="odeme-ayarlari">
                        <input type="hidden" id="olay" name="olay" value="order_setting">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label font-weight-bold">Bireysel/Kurumsal Tercihi</label>
                                        <select class="form-control" name="statu">
                                            <option value="1" <?php echo ns_filter("order_setting","statu") ? 'selected':'';?>>Tercihi Göster</option>
                                            <option value="0" <?php echo !ns_filter("order_setting","statu") ? 'selected':'';?>>Tercihi Gizle</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="form-control-label font-weight-bold">Müşteri Sözleşmesi Sayfası</label>
                                    <select class="form-control" name="item4">
                                        <option value="0" <?php echo "0"==ns_filter("order_setting","item4") ? "selected" : "";?>>Sözleşme Onayı Gösterme</option>
                                        <?php
                                        $icerik = !isset($icerik) ? new Icerik($db): $icerik;
                                        $icerik->sayfa_tur = 'sayfa';
                                        foreach ($icerik->all(0,50) as $cikti) {
                                        extract($cikti); ?>
                                        <option value="<?php echo $sayfa_id;?>" <?php echo ($sayfa_id==ns_filter("order_setting","item4")) ? "selected" : "";?>><?php echo $sayfa_baslik;?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="alert alert-danger mt-3">
                                        <p class="mb-0">Müşteri sözleşmesine içerik seçebilmek için; içerikler bölümünden sayfa türünde içerik oluşturmanız gerekmektedir.</p>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right mt-3">
                                    <button type="submit" class="butto butto-success butto-lg pull-right butbor"><i class="fas fa-check"></i> Kaydet</button>
                                </div>
                            </div>
                        </div>
                    </form>
                         </div>
                     </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>