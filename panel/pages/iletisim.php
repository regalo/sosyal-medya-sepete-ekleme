<?php
$iletisim = !isset($iletisim) ? new iletisim($db): $iletisim;
if (!empty($ayar->action)) {
	$iletisim->i_id = $ayar->action;
	$iletisim->select();
    $tit = "İletişim Detayları";
    if (isset($post["olay"]) AND ($post["olay"]=="yoksay" OR $post["olay"]=="cevapla")) {
    	foreach ($post as $key => $value) {
            $iletisim->$key = $value;
        }
        if ($iletisim->update()) {
            $alert->header = "İşlem Başarılı";
            $alert->content = "İletişim mesajı okundu olarak işaretlendi";
            $alert->action = "reload";
        }
        if ($post["olay"]=="cevapla") {
        	$iletisim->MailSMSList("cevap");
        	$alert->content = "Cevabınız mail olarak istek yapan müşteriye iletildi ve iletişim mesajı okundu olarak işaretlendi";
            $alert->action = "reload";
        }
        include_once "alert.php";
        exit;
    } elseif (isset($post["olay"]) AND $post["olay"]=="iletisim-sil") {
        $alert->header = "İstek Siliniyor";
        $alert->content = "Bu iletişim isteğini kalıcı olarak silmek istediğinize emin misiniz?";
        $alert->action = "confirm";
        $alert->olay = "silme-onay";
        $alert->statu = "info";
        $alert->page = "iletisim";
        include_once "alert.php";
        exit;
    } elseif (isset($post["olay"]) AND $post["olay"]=="silme-onay") {
        if ($iletisim->delete()) {
            $alert->header = "İstek Silindi";
            $alert->content = "İletişim isteği kalıcı olarak silindi";
            $alert->action = $ayar->getpage('iletisim');
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
	$from_record_num  = $page*$records_per_page-$records_per_page;
    $list = $iletisim->all($from_record_num ,$records_per_page);
    $total_rows = $iletisim->count();
    $tit = "İletişim İstekleri";
}
 ?>
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
                            <?php if(!isset($list)) { ?>
                            <div class="bol-3">
                               <a class="butto butto-xs badge-light  butbor pull-right" <?= 'href="'.$ayar->getpage('iletisim').'"'; ?>><i class="fas fa-chevron-left"></i> Geri</a>
                           </div>
                           <?php } ?>                      
                        </div>
                        <?php if(isset($list)) { ?>
                        <div class="table-stats order-table ov-h" id="tb-scroll">
                            <table class="table orders-list" id="orders-list">
                                <thead>
                                    <tr>
                                        <th>GÖNDEREN</th>
                                        <th>TARİH</th>
                                        <th>KONU</th>
                                        <th>MAİL</th>
                                        <th>DURUM</th>
                                        <th>İŞLEM</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach ($list as $cikti) {
                                    	extract($cikti);
                                    	$iletisim->statu($i_durum); ?>
                                    <tr>
                                        <td><?php echo $i_ad_soyad;?></td>
                                        <td><?php echo $iletisim->zamanfarki($i_time);?></td>
                                        <td><?php echo $i_konu;?></td>
                                        <td><?php echo $i_mail;?></td>
                                        <td><button class="butto butto-<?php echo $iletisim->color;?> butto-xs"><?php echo $iletisim->text?></button></td>
                                        <td><a href="<?php echo $ayar->getpage('iletisim',$i_id);?>" class="butto butto-primary butto-xs butbor layer-but"><i class="fas fa-layer-group"></i> Detay</a></td>
                                    </tr>
                                <?php }?>
                                </tbody>
                            </table>
                        </div>
                        
                        <? include_once "page_na.php";?>
                        <?php } elseif (isset($ayar->action)) { ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                	<form id="iletisim-duzenle" method="POST" action="" onsubmit="fastpost('iletisim-duzenle','ajaxout'); return false;">
					                        <input type="hidden" name="page" value="iletisim">
					                        <input type="hidden" id="olay" name="olay" value="iletisim-duzenle">
                                        <div class="row form-group mrl0">
                                            <div class="form-group col-md-6">
                                                <label class="form-control-label font-weight-bold">Ad</label>
                                            <div class="form-control"><?php echo $iletisim->i_ad_soyad;?></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-control-label font-weight-bold">Mesaj Zamanı</label>
                                                <div class="form-control"><?php echo $iletisim->zamanfarki($iletisim->i_time);?></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-control-label font-weight-bold">Mail Adresi</label>
                                                <div class="form-control"><?php echo $iletisim->i_mail;?></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-control-label font-weight-bold">Telefon Numarası</label>
                                                <div class="form-control"><?php echo $iletisim->i_telefon;?></div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="form-control-label font-weight-bold">Konu</label>
                                                <div class="form-control"><?php echo $iletisim->i_konu;?></div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="form-control-label font-weight-bold">Mesaj İçeriği</label>
                                                <textarea class="form-control" style="height: auto;min-height: 70px;" disabled><?php echo $iletisim->i_mesaj;?></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <?php if ($iletisim->i_durum == 0) { ?>
                                                    <label class="form-control-label font-weight-bold">Cevap Alanı</label>
                                                    <textarea class="form-control" name="i_cevap"></textarea>
                                                    <div class="clear"></div>
                                                    <div class="text-right mt-3" style="width: 100%">
                                                        <button onclick="oo_('cevapla');" type="submit" class="butto butto-success butto-lg butbor"><i class="fas fa-check"></i> Cevabı Gönder</button>
                                                        <button onclick="oo_('yoksay');" type="submit" class="butto butto-danger butto-lg butbor"><i class="fas fa-times"></i> Yoksay</button>
                                                    </div>
                                                <?php } else { ?>
                                                    <label class="form-control-label font-weight-bold">Müşteriye Verilen Cevap</label>
                                                    <textarea class="form-control" disabled=""><?php echo $iletisim->i_cevap;?></textarea>
                                                    <div class="clear"></div>
                                                    <div class="text-right" style="width: 100%">
                                                        <button onclick="oo_('iletisim-sil');" type="submit" class="butto butto-danger butto-lg butbor mt-3"><i class="fas fa-trash"></i> Sil</button>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
