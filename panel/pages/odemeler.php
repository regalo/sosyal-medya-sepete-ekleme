<?php
$odeme = !isset($odeme) ? new Odeme($db): $odeme;
if (isset($ayar->action)) {
    $odeme->o_code = $ayar->action;
    $odeme->select();
    $ayar->ayar_1 = $odeme->o_banka;
    $banka = $ayar->id();
    $tit = "Bildirim İncele";
    if (isset($post["olay"]) AND $post["olay"]=="bildirim-sil") {
        $alert->header = "Bildirimi Siliyorsun";
        $alert->content = "Bu ödeme bildirimini kalıcı olarak silmek istediğine emin misin?";
        $alert->action = "confirm";
        $alert->olay = "silme-onay";
        $alert->statu = "info";
        $alert->page = "odemeler";
        include_once "alert.php";
        exit;
    } elseif (isset($post["olay"]) AND $post["olay"]=="silme-onay") {
        if ($odeme->delete()) {
            $alert->header = "Bildirim Silindi";
            $alert->content = "Ödeme bildirimi başarıyla kaldırıldı.";
            $alert->action = $ayar->getpage('odemeler');
        }
        include_once "alert.php";
        exit;
    } elseif (isset($post["olay"]) AND $post["olay"]=="bildirim-onayla") {
        $odeme->o_durum = 1;
        if ($odeme->update()) {
            $alert->header = "Bildirimi Onaylıyorsun";
            $alert->content = "Ödeme bildirimini onayladığında ilgili sipariş işlem bekliyor olarak güncellenecek ve sipariş ödemesinin tamamlandığı bilgisi müşteriye iletilecek onaylıyor musun?";
            $alert->action = "confirm";
            $alert->statu = "info";
            $alert->olay = "bildirim-onayla-onay";
            $alert->page = "odemeler";
            include_once "alert.php";
            exit;
        }
        include_once "alert.php";
        exit;
    } elseif (isset($post["olay"]) AND $post["olay"]=="bildirim-onayla-onay") {
        $odeme->o_durum = 1;
        if ($odeme->update()) {
            $siparis = isset($siparis) ? $siparis: new Siparis($db);
            $siparis->sp_code = $odeme->o_code;
            $siparis->select();
            if ($siparis->sp_durum==0 OR $siparis->sp_durum==10) {
                $siparis->sp_durum = 1;
                $siparis->MailSMSList('yeni-siparis');
                $siparis->update();
            }
            $alert->header = "Ödemeyi Onayladın";
            $alert->content = "Şimdi manuel olarak siparişi kontrol etmeli ve işlem yapmalısın";
            $alert->action = $ayar->getpage("siparis",$siparis->sp_id);
        }
        include_once "alert.php";
        exit;
    }
} else {
    $records_per_page = 20;
    if (isset($get["p"])) {
        $page = $get["p"];
    } else {
        $page = 1;
    }
    $tit = "Ödeme Bildirimleri";
    $from_record_num  = $page*$records_per_page-$records_per_page;
    $list = $odeme->all($from_record_num ,$records_per_page);
    $total_rows = $odeme->count();
} ?>
<div class="content" id="alan">
    <div class="animated fadeIn" id="scrolling">
        <div class="orders">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="bol-7">
                                <strong class="box-title"><?php echo $tit;?></strong>
                            </div>
                            <div class="bol-3">
                                <? if (isset($ayar->action) AND $siparis->sp_code = $odeme->o_code AND $siparis->select()) { 
                                    ?>
                                    <a class="butto butto-primary butto-xs butbor pull-right" target="_blanc" href="<?= $ayar->getpage('siparis',$siparis->sp_id);?>"><i class="fas fa-chevron-right"></i> Siparişe Görüntüle</a>
                                <? }
                                ?>
                            </div>
                        </div>
                        <? if (isset($ayar->action)) { ?>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="col-md-12 hizmetler">
                                    <form id="odeme-bildirimi" method="POST" action="" onsubmit="fastpost('odeme-bildirimi','ajaxout'); return false;">
                                        <input type="hidden" name="page" value="odemeler">
                                        <input type="hidden" id="olay" name="olay" value="odeme-bildirimi">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="form-control-label"><b>Sipariş Kodu</b></label>
                                                <div class="form-control"><?php echo $odeme->o_code;?></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-control-label"><b>Ödeme Zamanı</b></label>
                                                <div class="form-control"><?php echo $odeme->o_time;?></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-control-label"><b>Banka Seçimi</b></label>
                                                <div class="form-control"><?php echo $banka["item2"];?></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-control-label"><b>Tutar</b></label>
                                                <div class="form-control"><?php echo $odeme->o_tutar;?> TL</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-control-label"><b>Gönderen Adı</b></label>
                                                <div class="form-control"><?php echo $odeme->o_ad_soyad;?></div>
                                            </div>
                                           <div class="form-group col-md-12">
                                                <label class="form-control-label"><b>Müşteri Notu</b></label>
                                                <div class="form-control" style="width: 100%;"><?php echo $odeme->o_aciklama;?></div>
                                            </div>
                                            <div class="form-group col-md-12 text-right">
                                                <button onclick="oo_('bildirim-sil');" type="submit" class="butto butto-xs badge-danger butbor"><i class="fas fa-trash"></i> Sil</button>
                                                <? if ($odeme->o_durum == 0) { ?>
                                                <button onclick="oo_('bildirim-onayla');" type="submit" class="butto butto-xs badge-success butbor"><i class="fas fa-check"></i> Ödemeyi Onayla</button>
                                                <? } ?>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                        </div>
                        <? } else { ?>
                        <div class="table-stats order-table ov-h" id="tb-scroll">
                            <table class="table orders-list" id="orders-list">
                                <thead>
                                    <tr>
                                        <th>DURUM</th>
                                        <th>AD SOYAD</th>
                                        <th>SİPARİŞ KODU</th>
                                        <th>BANKA SEÇİMİ</th>
                                        <th>TUTAR</th>
                                        <th>İŞLEM</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach ($list as $cikti) {
                                        extract($cikti);
                                        $ayar->ayar_1 = $o_banka;
                                        $banka = $ayar->id();
                                        $odeme->statu($o_durum); ?>
                                    <tr>
                                        <td><button class="butto butto-<?php echo $odeme->color;?> butto-xs butbor"><?php echo $odeme->text;?></button></td>
                                        <td><?php echo $o_ad_soyad;?></td>
                                        <td><?php echo $o_code;?></td>
                                        <td><?php echo $banka["item2"];?></td>
                                        <td><?php echo $o_tutar;?></td>
                                        <td><a href="<?= $ayar->getpage('odemeler',$o_code);?>" class="butto butto-xs badge-primary butbor layer-but"><i class="fas fa-layer-group"></i> Detay</a></td>
                                    </tr>
                                <?php }?>
                                </tbody>
                            </table>
                        </div>
                        <? include_once "page_na.php";?>
                    <? } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>