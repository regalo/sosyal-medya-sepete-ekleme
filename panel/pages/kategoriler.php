<?
$kategori = !isset($kategori) ? new Kategori($db): $kategori;
$platform = !isset($platform) ? new Platform($db): $platform;
$paket = !isset($paket) ? new Paket($db): $paket;
$records_per_page = 20;
if (isset($get["p"])) {
    $page = $get["p"];
} else {
    $page = 1;
}
$from_record_num  = $page*$records_per_page-$records_per_page;
if (!empty($ayar->action)) {
    $platform->pt_id = $ayar->action;
    $platform->select();
    $tit = $platform->pt_name.' Kategorileri';
    $kategori->pt_tax = $ayar->action;
    $list = $kategori->all($from_record_num ,$records_per_page);
    $total_rows = $kategori->count($ayar->action);
} else {
    $list = $kategori->all($from_record_num ,$records_per_page);
    $total_rows = $kategori->count();
    $tit = "Tüm Kategoriler";
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
                                <a class="dropdown-item" href="<?= $ayar->getpage('kategoriler');?>">Tüm Kategoriler</a>
                                <?php 
                                foreach ($platform->all(0,100) as $pt) {
                                    extract($pt); ?>
                                    <a class="dropdown-item" href="<?= $ayar->getpage('kategoriler',$pt_id);?>" ><?php echo $pt_name;?></a>
                                    <?php } ?>
                                </div>
                            </div>
                                <div class="bol-5">
                                <?php if (!empty($ayar->action)) { ?>
                                <a href="<?= $ayar->getpage('kategoriler');?>" class="butto butto-dark butto-xs butbor mgizle float-right ml-2">Tüm Kategoriler</a>
                                <?php } ?>
                               <a href="<?= $ayar->getpage('kategori','yeni-ekle');?>" class="butto butto-success butto-xs butbor float-right"><i class="fas fa-plus"></i> Yeni Ekle</a>
                           </div>
                        </div>
                        <div class="table-stats order-table ov-h" id="tb-scroll">
                            <table class="table orders-list" id="orders-list">
                                <thead>
                                    <tr>
                                        <th class="text-left" width="50">ICON</th>
                                        <th class="text-left" width="100">HİZMET</th>
                                        <th class="text-left" width="180">KATEGORİ ADI</th>
                                        <th class="text-left">AÇIKLAMA</th>
                                        <th class="text-right" width="60">PAKETLER</th>
                                        <th class="text-right" width="160">İŞLEM</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($list as $kt) {
                                    extract($kt);
                                    if(!isset($platform->$pt_tax)) {
                                        $platform->pt_id = $pt_tax;
                                        $platform->$pt_tax = $platform->select();
                                    } ?>
                                    <tr>
                                        <td class="text-left" width="50"><span class="hizicon"><i class="<?php echo $hz_icon;?>"></i></span></td>
                                        <td class="text-left" width="100"><?php echo $platform->pt_name;?></td>
                                        <td class="text-left" width="180"><?php echo $hz_adi;?></td>
                                        <td class="text-left"><?php echo $hz_text;?></td>
                                        <td class="text-right" width="70"><?php $paket->hz_tax = $hz_id; echo $paket->count();?></td>
                                        <td class="text-right" width="160"><a href="<?= $ayar->menulink('kategori',$hz_id);?>" target="_blank" class="butto butto-xs badge-dark butbor"><i class="fas fa-eye"></i></a> <a href="<?= $ayar->getpage('kategori',$hz_id);?>" class="butto butto-xs badge-primary butbor"><i class="fas fa-layer-group"></i> Detay</a></td>
                                    </tr>
                                <?php }?>
                                </tbody>
                            </table>
                        </div>
                        <? include_once "page_na.php";?>
                    </div>
                </div>
            </div>
        </div>          
    </div>
</div>
