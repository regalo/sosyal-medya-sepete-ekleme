<?php
$paket = !isset($paket) ? new Paket($db): $paket;
$api = new Api($db);
if (isset($post["olay"]) AND is_numeric($post["olay"])) {
    $paket->pk_id = $post["olay"];
    $paket->select();
    $paket->pk_durum = $paket->pk_durum == 1 ? 0: 1;
    $paket->primary = $paket->pk_pri;
    $paket->update();
    exit();
} elseif (isset($post["olay"])) {
    exit();
}
$kategori = !isset($kategori) ? new Kategori($db): $kategori;
$platform = !isset($platform) ? new Platform($db): $platform;
$records_per_page = 20;
if (isset($get["p"])) {
    $page = $get["p"];
} else {
    $page = 1;
}
$from_record_num  = $page*$records_per_page-$records_per_page;
if (!empty($ayar->action)) {
    $kategori->hz_id = $ayar->action;
    $kategori->select();
    $platform->pt_id = $kategori->pt_tax;
    $platform->select();
    $tit = $platform->pt_name.' '.$kategori->hz_adi.' Paketleri';
    $paket->hz_tax = $kategori->hz_id;
    $list = $paket->all($from_record_num ,$records_per_page);
    $total_rows = $paket->count($ayar->action);
} else {
    $list = $paket->all($from_record_num ,$records_per_page);
    $total_rows = $paket->count();
    $tit = "Tüm Paketler";
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
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <strong class="box-title"><?php echo $tit;?></strong>
                                </a>
                                <div class="dropdown-menu btn-sec">
                                    <a class="dropdown-item" href="<?= $ayar->getpage('paketler');?>">Tüm Paketler</a>
                                    <?php 
                                    foreach ($kategori->all(0,200) as $hz) {
                                    extract($hz);
                                    if(!isset($platform->$pt_tax)) {
                                        $platform->pt_id = $pt_tax;
                                        $platform->$pt_tax = $platform->select();
                                    } ?>
                                        <a class="dropdown-item" href="<?= $ayar->getpage('paketler',$hz_id);?>"><?php echo $platform->pt_name.' '.$hz_adi;?></a>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="bol-5">
                                <?php if (isset($get["action"])) { ?>
                                    <a href="<?= getpage('paketler');?>" class="butto butto-dark butto-xs butbor float-right ml-2">Tüm Paketler</a>
                                <?php } ?>
                                    <a href="<?= $ayar->getpage('paket','yeni-ekle');?>" class="butto butto-success butto-xs butbor float-right"><i class="fas fa-plus"></i> Yeni Ekle</a>
                            </div>
                        </div>
                        <div class="table-stats order-table ov-h" id="tb-scroll">
                            <table class="table orders-list" id="orders-list">
                                <thead>
                                    <tr>
                                        <th class="text-left">SERVİS</th>
                                        <th class="text-left">PAKET ADI</th>
                                        <th>ADET</th>
                                        <th>FİYAT</th>
                                        <th>APİ BAĞLANTISI</th>
                                        <th>SİPARİŞ</th>
                                        <th class="text-right" width="120">PASİF/AKTİF</th>
                                        <th class="text-right" width="180">İŞLEM</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $say = 0;
                                    foreach ($list as $pk) {
                                        extract($pk);
                                        $kategori->hz_id = $hz_tax;
                                        $kategori->select();
                                        $platform->pt_id = $kategori->pt_tax;
                                        $platform->select();
                                        if ($pk_durum == 1) { $drm = ' checked=""'; } else { $drm = "";} ?>
                                    <tr>
                                        <td class="text-left"><?php echo $platform->pt_name.' '.$kategori->hz_adi;?></td>
                                        <td class="text-left"><?php echo $pk_adi;?></td>
                                        <td><?php echo $pk_adet;?></td>
                                        <td><?php echo $pk_fiyat;?></td>
                                        <td><?php echo ($pk_tur=="otomatik" AND $api->smm_id = explode("-", $pk_oto_servis_id)[0] AND $api->select()) ? $ayar->description($api->smm_isim,10).' | '.explode("-", $pk_oto_servis_id)[1]:'MANUEL';?></td>
                                        <td><?php echo $siparis->paketsiparis($pk_id);?></td>
                                        <td class="text-right"><label class="switch" style="margin-bottom: 0"><input onclick="$('#olay').val(<?php echo $pk_id;?>); fastpost('paket-durum','ajaxpost');"  type="checkbox"<?php echo $drm;?>><span class="btn-ackapa round"></span></label></td>
                                        <td class="text-right"><a href="<?= $ayar->menulink('paket',$pk_pri);?>" target="_blank" class="butto butto-xs badge-dark butbor"><i class="fas fa-eye"></i></a> <a href="<?php echo $ayar->getpage('paket',$pk_id);?>" class="butto butto-xs badge-primary butbor"><i class="fas fa-layer-group"></i> Detay</a></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <form id="paket-durum" method="POST" action="">
                            <input type="hidden" name="page" value="paketler">
                            <input type="hidden" id="olay" name="olay" value="">
                        </form>
                        <? include_once "page_na.php";?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>