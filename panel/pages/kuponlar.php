<?php
$kupon = !isset($kupon) ? new Kupon($db): $kupon;
$platform = !isset($platform) ? new Platform($db): $platform;
$kategori = !isset($kategori) ? new Kategori($db): $kategori;
$paket = !isset($paket) ? new Paket($db): $paket;
if (isset($post["olay"]) AND $post["olay"]=="platform-sec") {
    $kategori->pt_tax = $post["platform"];
    echo '<option value="0" selected="">Tümü</option>';
    if (!empty($kategori->pt_tax)) {
        foreach ($kategori->all() as $value) {
            extract($value);
            echo '<option value="'.$hz_id.'">'.$hz_adi.'</option>';
        }
    }
    exit;
} elseif (isset($post["olay"]) AND $post["olay"]=="kategori-sec") {
    $paket->hz_tax = $post["kategori"];
    echo '<option value="0" selected="">Tümü</option>';
    if (!empty($paket->hz_tax)) {
        foreach ($paket->all() as $value) {
            extract($value);
            echo '<option value="'.$pk_id.'">'.$pk_adi.'</option>';
        }
    }
    exit;
}
if (!empty($ayar->action) AND $ayar->action=="yeni-ekle") {
    $tit = "Yeni Kupon Ekle";
    if (isset($post["olay"]) AND $post["olay"]=="kupon-ekle") {
        $kupon->item = array("kupon_tax" => $post["platform"].'-'.$post["kategori"].'-'.$post["paket"],"kupon_kodu" => $post["kupon_kodu"],"kupon_oran" => $post["kupon_oran"]);
        if ($kupon->insert()) {
            $alert->header = "İşlem Başarılı";
            $alert->content = "Yeni bir indirim kodu oluşturdunuz.<br><b>Kodunuz:".$post["kupon_kodu"].'<b>';
            $alert->action = $ayar->getpage('kuponlar',$kupon->kupon_id);
        } else {
            $alert->header = "İşlem Başarısız";
            $alert->content = "Lütfen tüm alanları eksiksiz doldurduğunuzdan emin olun";
            $alert->action = "close";
            $alert->statu = "danger";
        }
        include_once "alert.php";
        exit;
    }
} elseif (!empty($ayar->action)) {
    $kupon->kupon_id = $ayar->action;
    $kupon->select();
    $kupon->tur($kupon->kupon_tax);
    if(!empty($kupon->pt_id)): $platform->pt_id = $kupon->pt_id; $platform->select(); endif;
    if(!empty($kupon->hz_id)): $kategori->hz_id = $kupon->hz_id; $kategori->select(); endif;
    if(!empty($kupon->pk_id)): $paket->pk_id = $kupon->pk_id; $paket->select(); endif;
    $tit = "Kupon Detayları";
    if (isset($post["olay"]) AND ($post["olay"]=="kupon-duzenle")) {
        foreach ($post as $key => $value) {
            $kupon->$key = $value;
        }
        $kupon->kupon_tax = $post["platform"].'-'.$post["kategori"].'-'.$post["paket"];
        if ($kupon->update()) {
            $alert->header = "İşlem Başarılı";
            $alert->content = "İndirim kuponu detayları başarıyla kaydedildi";
            $alert->action = "close";
        }
        include_once "alert.php";
        exit;
    } elseif (isset($post["olay"]) AND $post["olay"]=="kupon-sil") {
        $alert->header = "Kupon Siliniyor";
        $alert->content = "Bu indirim kuponunu kalıcı olarak silmek istediğinze emin misiniz?";
        $alert->action = "confirm";
        $alert->olay = "silme-onay";
        $alert->page = "kuponlar";
        $alert->statu = "info";
        include_once "alert.php";
        exit;
    } elseif (isset($post["olay"]) AND $post["olay"]=="silme-onay") {
        if ($kupon->delete()) {
            $alert->header = "Kupon Silindi";
            $alert->content = "İndirim kuponu kalıcı olarak silindi";
            $alert->action = $ayar->getpage('kuponlar');
        }
        include_once "alert.php";
        exit;
    }
} else {
    if (isset($post["olay"]) AND is_numeric($post["olay"])) {
        $kupon->kupon_id = $post["olay"];
        $kupon->select();
        $kupon->kupon_durum = $kupon->kupon_durum == 1 ? 0: 1;
        $kupon->update();
        exit($kupon->kupon_durum);
    } elseif (isset($post["olay"])) {
        exit;
    }
    $records_per_page = 20;
    if (isset($get["p"])) {
        $page = $get["p"];
    } else {
        $page = 1;
    }
    $from_record_num  = $page*$records_per_page-$records_per_page;
    $list = $kupon->all($from_record_num ,$records_per_page);
    $total_rows = $kupon->count();
    $tit = "İndirim Kuponları";
}
 ?>
<div class="content" id="alan">
    <div class="animated fadeIn" id="scrolling">
        <div class="orders">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="bol-5">
                                <strong class="box-title"><?php echo $tit;?></strong>
                            </div>
                            <?php if (isset($ayar->action)) { ?>
                            <div class="bol-5">
                               <a class="butto butto-xs butto-light butbor pull-right" href="<?= $ayar->getpage('kuponlar');?>"><i class="fas fa-chevron-left"></i> Geri</a>
                           </div>
                           <?php } else { ?>
                            <a class="butto butto-success butto-xs butbor pull-right" href="<?= $ayar->getpage('kuponlar','yeni-ekle');?>"><i class="fas fa-plus"></i> Yeni Ekle</a>
                           <?php } ?>                        
                        </div>
                            <? if (isset($list)) { ?>
                            <div class="table-stats order-table ov-h" id="tb-scroll">
                                <table class="table orders-list" id="orders-list">
                                    <thead>
                                        <tr>
                                            <th>KUPON KODU</th>
                                            <th>HİZMET</th>
                                            <th>KATEGORİ</th>
                                            <th>PAKET</th>
                                            <th>İNDİRİM ORANI</th>
                                            <th>KULLANIM SAYISI</th>
                                            <th>İŞLEM</th>
                                            <th>PASİF/AKTİF</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($list as $kp) {
                                            extract($kp);
                                            $kupon->tur($kupon_tax);
                                            if(!empty($kupon->pt_id)): $platform->pt_id = $kupon->pt_id; $platform->select(); else: $platform->pt_name = NULL; endif;
                                            if(!empty($kupon->hz_id)): $kategori->hz_id = $kupon->hz_id; $kategori->select(); else: $kategori->hz_adi = NULL; endif;
                                            if(!empty($kupon->pk_id)): $paket->pk_id = $kupon->pk_id; $paket->select(); else: $paket->pk_adi = NULL; endif; ?>
                                        <tr>
                                            <td><?php echo $kupon_kodu;?></td>
                                            <td><?= isset($platform->pt_name) ? $platform->pt_name: "Tümü";?></td>
                                            <td><?= isset($kategori->hz_adi) ? $kategori->hz_adi: "Tümü";?></td>
                                            <td><?= isset($paket->pk_adi) ? $paket->pk_adi: "Tümü";?></td>
                                            <td>%<?php echo $kupon_oran;?></td>
                                            <td><?php echo $siparis->CuoponCount($kupon_kodu);?></td>
                                            <td><a href="<?= $ayar->getpage("kuponlar",$kupon_id);?>" class="butto butto-xs badge-primary butbor ml-1"><i class="fas fa-layer-group"></i> Detay</a></td>
                                            <td><label id="durum-<?php echo $kupon_id;?>" class="switch" style="margin-bottom: 0"><input onclick="$('#olay').val(<?php echo $kupon_id;?>); fastpost('kupon-durum');" type="checkbox" <?= !empty($kupon_durum) ? "checked": "";?>><span class="btn-ackapa round"></span></label></td>
                                        </tr>
                                    <? } ?>
                                    </tbody>
                                </table>
                            </div>
                            <form id="kupon-durum" method="POST" action="">
                            <input type="hidden" name="page" value="kuponlar">
                            <input type="hidden" id="olay" name="olay" value="">
                        </form>
                            <?php } elseif(isset($ayar->action) AND $ayar->action == "yeni-ekle") { ?>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <form id="kupon" method="POST" action="" onsubmit="fastpost('kupon','ajaxout'); return false;">
                                        <input type="hidden" name="page" value="kuponlar">
                                        <input type="hidden" id="olay" name="olay" value="kupon-ekle">
                                        <div class="row form-group">  
                                            <div class="form-group col-md-4">
                                                <label class="form-control-label font-weight-bold">Hizmetler</label>
                                                <select onchange="selector('platform');" name="platform" class="form-control">
                                                    <option value="0">Tümü</option>
                                                    <?php
                                                    foreach ($platform->all() as $value) {
                                                        extract($value);
                                                        echo '<option value="'.$pt_id.'">'.$pt_name.'</option>';
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="form-control-label font-weight-bold">Kategoriler</label>
                                                <select onchange="selector('kategori');" name="kategori" id="kategori-sec" class="form-control">
                                                    <option value="0" selected="">Tümü</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="form-control-label font-weight-bold">Paketler</label>
                                                <select  id="paket-sec" name="paket" class="form-control">
                                                    <option value="0">Tümü</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="form-group col-md-4">
                                                <label class="form-control-label"><b>Kupon Kodu</b></label>
                                                <div class="input-group inpad">
                                                <input type="text" maxlength="11" required="" name="kupon_kodu" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="form-control-label"><b>İndirim Oranı</b></label>
                                                <div class="input-group inpad">
                                                    <input id="icon2" type="number" name="kupon_oran" required="" class="form-control" style="text-align: right;">
                                                    <button class="input-group-addon butto butto-light butbor ml-1 smsil pt-1">%</button>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button onclick="oo_('kupon-ekle');" type="submit" class="butto butto-success butto-lg pull-right butbor"><i class="fas fa-plus-square"></i> Kuponu Ekle</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php } elseif (isset($ayar->action)) { ?>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <form id="kupon" method="POST" action="" onsubmit="fastpost('kupon','ajaxout'); return false;">
                                        <input type="hidden" name="page" value="kuponlar">
                                        <input type="hidden" id="olay" name="olay" value="kupon-duzenle">
                                        <div class="row form-group">  
                                            <div class="form-group col-md-4">
                                                <label class="form-control-label font-weight-bold">Hizmetler</label>
                                                <select onchange="selector('platform');" name="platform" class="form-control">
                                                    <option value="0">Tümü</option>
                                                    <?php
                                                    foreach ($platform->all() as $value) {
                                                        extract($value); ?>
                                                        <option value="<?= $pt_id;?>"<?= $kupon->pt_id==$pt_id ? "selected":"";?>><?= $pt_name;?></option>';
                                                    <? } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="form-control-label font-weight-bold">Kategoriler</label>
                                                <select onchange="selector('kategori');" name="kategori" id="kategori-sec" class="form-control">
                                                    <option value="0">Tümü</option>
                                                    <?php
                                                    if (!empty($kupon->pt_id)) {
                                                        $kategori->pt_tax = $kupon->pt_id;
                                                        foreach ($kategori->all() as $value) {
                                                            extract($value); ?>
                                                            <option value="<?= $hz_id;?>"<?= $kupon->hz_id==$hz_id ? "selected":"";?>><?= $hz_adi;?></option>';
                                                     <? }
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="form-control-label font-weight-bold">Paketler</label>
                                                <select  id="paket-sec" name="paket" class="form-control">
                                                    <option value="0">Tümü</option>
                                                    <?php
                                                    if (!empty($kupon->hz_id)) {
                                                        $paket->hz_tax = $kupon->hz_id;
                                                        foreach ($paket->all() as $value) {
                                                            extract($value); ?>
                                                            <option value="<?= $pk_id;?>"<?= $kupon->pk_id==$pk_id ? "selected":"";?>><?= $pk_adi;?></option>';
                                                     <? }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label class="form-control-label font-weight-bold">Kupon Kodu</label>
                                                <div class="input-group inpad">
                                                    <input type="text" maxlength="11" required="" name="kupon_kodu" class="form-control" value="<?php echo $kupon->kupon_kodu;?>">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="form-control-label font-weight-bold">İndirim Oranı</label>
                                                <div class="input-group inpad">
                                                    <input id="icon2" type="number" name="kupon_oran" required="" class="form-control" value="<?php echo $kupon->kupon_oran;?>" style="text-align: right;">
                                                    <div class="input-group-addon butto butto-light butbor ml-1 smsil pt-2">%</div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-right">
                                                <button onclick="oo_('kupon-sil');" type="submit"  class="butto butto-danger butto-lg butbor islem"><i class="fas fa-trash"></i> Sil</button>
                                                <button onclick="oo_('kupon-duzenle');" type="submit" class="butto butto-success butto-lg butbor islem"><i class="fas fa-check"></i> Kaydet</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function selector(item){
        if (item=="platform") {
            oo_('platform-sec');
            fastpost('kupon','kategori-sec');
            $('#paket-sec').html('<option value="0">Tümü</option>');
            return true;
        }
        oo_('kategori-sec');
        fastpost('kupon','paket-sec');

    }
</script>