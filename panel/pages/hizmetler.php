<?php
$platform = !isset($platform) ? new Platform($db): $platform;
$kategori = !isset($kategori) ? new Kategori($db): $kategori;
$records_per_page = 20;
if (isset($get["p"])) {
    $page = $get["p"];
} else {
    $page = 1;
}
$from_record_num  = $page*$records_per_page-$records_per_page;
$list = $platform->all($from_record_num ,$records_per_page);
$total_rows = $platform->count(); ?>
<div class="content" id="alan">
    <div class="animated fadeIn" id="scrolling">
        <div class="orders">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="box-title">HİZMETLER</strong>
                               <a href="<?php echo $ayar->getpage('hizmet','yeni-ekle');?>" class="butto butto-success butto-xs butbor float-right"><i class="fas fa-plus"></i> Ekle</a>
                        </div>
                        <div class="table-stats order-table ov-h" id="tb-scroll">
                            <table class="table orders-list" id="orders-list">
                                <thead>
                                    <tr>
                                        <th class="text-left" width="50">ICON</th>
                                        <th class="text-left" width="120">PLATFORM ADI</th>
                                        <th>AÇIKLAMA</th>
                                        <th class="text-right" width="80">KATEGORİLER</th>
                                        <th class="text-right" width="120">İŞLEM</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach ($list as $hz) {
                                    extract($hz);  ?>
                                    <tr>
                                        <td class="text-left" width="50"><span class="hizicon"><i class="<?php echo $pt_icon;?>"></i></span></td>
                                        <td class="text-left" width="120"><?php echo $pt_name;?></td>
                                        <td style="width: 450px"><?php echo $pt_text;?></td>
                                        <td class="text-right" width="80"><?php echo $kategori->count($pt_id);?></td>
                                        <td class="text-right" width="120"><a href="<?php echo $ayar->menulink('platform',$pt_id);?>" target="_blank" class="butto butto-xs badge-dark butbor"><i class="fas fa-eye"></i></a> <a href="<?php echo $ayar->getpage('hizmet', $pt_id);?>" class="butto butto-xs badge-primary butbor"><i class="fas fa-layer-group"></i> Detay</a> </td>
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