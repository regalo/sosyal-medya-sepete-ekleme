<?php
$icerik = !isset($icerik) ? new icerik($db): $icerik;
$records_per_page = 20;
if (isset($get["p"])) {
$page = $get["p"];
} else {
$page = 1;
}
$from_record_num  = $page*$records_per_page-$records_per_page;
if (!empty($ayar->action)) {
$_SESSION["icerik"] = $ayar->action;
$icerik->sayfa_tur = $ayar->action;
$tit = ucwords($ayar->action).'lar';
$list = $icerik->all($from_record_num ,$records_per_page);
$total_rows = $icerik->count($ayar->action);
} else {
$list = $icerik->all($from_record_num ,$records_per_page);
$total_rows = $icerik->count();
$tit = "Tüm İçerikler";
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
                            <div class="bol-5">
                                <a href="<?php echo $ayar->action=="sayfa" ? $ayar->getpage('icerik','sayfa'):$ayar->getpage('icerik','blog');?>" class="butto butto-success butto-xs butbor pull-right"><i class="fas fa-plus"></i> <?php echo $ayar->action=="sayfa" ? 'Sayfa':'Blog';?> Ekle</a>
                            </div>
                        </div>
                        <div class="table-stats order-table ov-h" id="tb-scroll">
                            <table class="table orders-list" id="orders-list">
                                <thead>
                                    <tr>
                                        <th>BAŞLIK</th>
                                        <th>AÇIKLAMA</th>
                                        <th>İŞLEM</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($list as $sayfa) {
                                    extract($sayfa);
                                    $icerik->sayfa_id = $sayfa_id;
                                    $icerik->select(); ?>
                                    <tr>
                                        <td><?php echo $icerik->sayfa_baslik;?></td>
                                        <td><?php echo mb_substr($icerik->sayfa_aciklama, 0, 90,"UTF-8");?></td>
                                        <td style="min-width: 165px"><a href="<?php echo $ayar->menulink($ayar->action,$sayfa_id);?>" target="_blank" class="butto butto-xs badge-dark butbor d-inline-block"><i class="fas fa-eye"></i></a>
                                            <a href="<?php echo $ayar->getpage('icerik',$sayfa_id);?>" class="butto butto-xs badge-primary butbor ml-1 d-inline-block"><i class="fas fa-layer-group"></i> Detay</a></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                         <?php include_once "page_na.php";?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>