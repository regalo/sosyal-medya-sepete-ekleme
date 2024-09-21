<?php
if (!empty($ayar->action)) {
    $siparis = !isset($siparis) ? new Siparis($db): $siparis;
    $siparis->sp_id = $ayar->action;
    $siparis->select();
    if (isset($post["olay"]) AND $post["olay"]=="siparis-guncelle") {
       if ($post["sp_durum"]=="sil") {
           $alert->header = "Sipariş Siliyorsun";
           $alert->content = "Bu siparişi silmek istediğinize emin misiniz? İşlem geri alınamaz.";
           $alert->action = "confirm";
           $alert->olay = "siparis-sil-onay";
           $alert->page = "siparis";
           $alert->statu = "info";
       } else {
       	   if (($siparis->sp_durum==0 OR $siparis->sp_durum==10) AND ($post["sp_durum"]==1 OR $post["sp_durum"]==2) AND $siparis->MailSMSList('yeni-siparis')) {
       	   	$odeme = !isset($odeme) ? new Odeme($db): $odeme;
	        	$odeme->o_code = $siparis->sp_code;
	        	if ($odeme->select() AND $odeme->o_durum = 1 AND $odeme->update());
       	   };
       	   if($siparis->sp_durum != 5 AND $post["sp_durum"]==5 AND $siparis->MailSMSList('iade-edildi'));
       	   if($siparis->sp_durum != 4 AND $post["sp_durum"]==4 AND $siparis->MailSMSList('tamamlandi'));
           $siparis->sp_durum = $post["sp_durum"];
           $siparis->islem_adres = $post["islem_adres"];
           $siparis->bayi_durum = $post["sp_durum"];
           $siparis->islem_smm = '0';
           $siparis->islem_turu = 'manuel';
           $siparis->updateislem();
           $siparis->update();
           $alert->header = "Sipariş Güncellendi";
           $alert->content = "Sipariş bilgileri başarıyla güncellendi";
           $alert->action = "reload";
       }
       include_once "alert.php";
       exit;
    } elseif (isset($post["olay"]) AND $post["olay"]=="siparis-sil-onay") {
       $siparis->delete();
       $alert->header = "Sipariş Silindi";
       $alert->content = "Talebiniz üzerine sipariş sistemden kalıcı olarak silindi.";
       $alert->action = $ayar->getpage('siparisler');
       include_once "alert.php";
       exit;
    }  elseif (isset($post["olay"]) AND $post["olay"]=="apiye-gonder") {
        # siparis apiye gonder
       $api = !isset($api) ? new Api($db): $api;
       $siparis->islem_smm = $post["smm_id"].'-'.$post["service_id"];
       $api->smm_id = $post["smm_id"];
       if ($api->select()) {
           $order = $api->order(array('service' => $post["service_id"], 'link' => $post["islem_adres"], 'quantity' => $post["islem_miktar"]));
           $siparis->islem_adres = $post["islem_adres"];
            $siparis->islem_miktar = $post["islem_miktar"];
            $siparis->islem_smm = $api->smm_id.'-'.$post["service_id"];
            if (($siparis->sp_durum==0 OR $siparis->sp_durum==10) AND $siparis->MailSMSList('yeni-siparis')); 
            if (isset($order->order)) {
                $siparis->panel_code = $order->order;
                $siparis->sp_durum = 2;
                $alert->header = "Sipariş İşleme Alındı";
                $alert->content = "Siparişiniz istediğiniz üzerine <b>".$api->smm_isim."</b> paneline <b>".$siparis->panel_code."</b> kodu ile başarıyla gönderildi.";
                $alert->action = "reload";
            } elseif(isset($order->error)) {
                $api->translater($order->error);
                $siparis->sp_durum = 1;
                $alert->header = "Sipariş İşleme Alınamadı";
                $alert->statu = "danger";
                $alert->content = $api->error;
                $alert->action = "close";
            }
            $siparis->updateislem();
            $siparis->update();
       } else {
            $alert->header = "Sipariş İşleme Alınamadı";
            $alert->statu = "danger";
            $alert->content = "Seçtiğiniz panel sipariş göndermek için uygun değil. Lütfen kontrol edin.";
            $alert->action = "close";
       }
       include_once "alert.php";
       exit;
    } elseif (isset($post["olay"]) AND $post["olay"]=="api-sorgu") {
        $api = !isset($api) ? new Api($db): $api;
        $api->smm_id = $post["smm_id"];
        $api->select();
        $sonuc = $api->status($post["panel_code"]);
        if (isset($sonuc["charge"])) {
            $siparis->donustur($sonuc["status"]);
            $siparis->sp_tutar = $sonuc["charge"];
            $siparis->sp_start = $sonuc["start_count"];
            $siparis->sp_kalan = $sonuc["remains"];
            if($siparis->sp_durum==4 AND $siparis->MailSMSList('tamamlandi'));
            $siparis->update();
            $siparis->updateislem();
            $alert->header = $siparis->bayititle;
            $alert->content = $siparis->bayitext;
            $alert->action = "reload";
        } else {
            $alert->header = "Durum Güncellenemedi";
            $alert->content = "Bayiye yapılan sorguya başarılı sonuç alınamadı.";
            $alert->action = "close";
            $alert->statu = "danger";
        }
        include_once "alert.php";
        exit;
    } elseif (isset($post["olay"]) AND $post["olay"]=="siparis-aciklamasi") {
        if ($siparis->aciklama()) {
            $siparis->aciklama = $post["aciklama"];
            $siparis->updateaciklama();
            $alert->header = "Açıklama Güncellendi";
            $alert->content = "Mevcut sipariş açıklaması güncellendi.";
            $alert->action = "close";
        } else {
            $siparis->aciklama = $post["aciklama"];
            $siparis->insertaciklama();
            $alert->header = "Açıklama Oluşturuldu";
            $alert->content = "Sipariş için müşteriye görünecek bir açıklama girdiniz.";
            $alert->action = "close";
        }
        include_once "alert.php";
        exit;
    }
}
?>
<div class="content" id="alan">
    <div class="card mb-4">
        <div class="card-header border-bottom-0">
            <strong class="box-title">Sipariş Detayları</strong>
            <a class="butto butto-light butto-xs butbor pull-right mr-2" href="<?= $ayar->getpage('siparisler');?>"><i class="fas fa-chevron-left"></i> Geri</a> 
        </div>
    </div>
    <div class="tab-alani">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="sitab nav-item">
                <a class="nav-link active show gri butto-lg" id="islem-ekle" onclick="IslemTuru('islem')" data-toggle="pill" href="#islem" role="tab" aria-controls="islem" aria-selected="true">İşlem<span class="mobgiz1"> Bilgisi</span></a>
            </li>
            <li class="sitab nav-item">
                <a class="nav-link gri butto-lg" id="islem-ekle" onclick="IslemTuru('detay')" data-toggle="pill" href="#detay" role="tab" aria-controls="detay" aria-selected="true">Sipariş<span class="mobgiz1"> Detayları</span></a>
            </li>
            <li class="sitab nav-item">
                <a class="nav-link gri butto-lg" id="islem-ekle" onclick="IslemTuru('aciklama')" data-toggle="pill" href="#aciklama" role="tab" aria-controls="aciklama" aria-selected="true">Sorgu<span class="mobgiz1"> Açıklaması</span></a>
            </li>
        </ul>
    </div>
    <div class="card" id="scrolling">
        <div class="orders">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-pane fade active show" id="islem" role="tabpanel" aria-labelledby="islem">
                        <div class="modal-body ozniv row">
                            <div class="col-md-12 col-sm-12">
                                <div class="alert text-left alert-<?php echo $siparis->sbutton;?> dislem" role="alert">
                                    <h4><b><?php echo $siparis->stext;?></b></h4>
                                    <p class="mb-0"><?php echo $siparis->sadmin;?></p>
                                </div>
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="sitab sitabz nav-item">
                                    <a class="nav-link <?= empty($siparis->panel_code) ? 'active show':'';?> success" data-toggle="pill" href="#manuel">
                                        Manuel  İşlem
                                    </a>
                                </li>
                                <li class="sitab sitabz nav-item">
                                    <a class="nav-link <?= !empty($siparis->panel_code) ? 'active show':'';?> success" data-toggle="pill" href="#apiile">
                                        Api ile İşlem
                                    </a>
                                </li>
                                </ul>
                               <div id="manuel" class="tab-pane fade in <?= empty($siparis->panel_code) ? 'active show':'';?>">
                                <form id="siparis-guncelle" method="POST" action="" onsubmit="fastpost('siparis-guncelle','ajaxout'); return false;">
                                <input type="hidden" name="page" value="siparis">
                                <input type="hidden" name="olay" value="siparis-guncelle">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="form-control-label"><b>İşlem Linki/Kullanıcı Adı</b></label>
                                            <div class="input-group col-md-12" style="padding: 0;">
                                                <input name="islem_adres" id="kopyala4" required="" value="<?php echo $siparis->islem_adres;?>" class="form-control">
                                                <div class="input-group-prepend">
                                                    <button class="butto butto-dark ml-2 butbor" type="button" onclick="copyto('kopyala4',this)"><i class="fas fa-copy"></i> Kopyala</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-control-label"><b>Paket</b></label>
                                            <div class="form-control"><?php echo $siparis->sp_paket_adi;?></div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-control-label"><b>Adet</b></label>
                                            <div class="form-control"><?php echo $siparis->islem_miktar;?></div>
                                            <input type="hidden" name="adet" value="<?php echo $siparis->islem_miktar;?>">
                                        </div>
                                        
                                        <div class="form-group col-md-4">
                                            <label class="form-control-label"><b>Durum</b></label>
                                            <select required="" name="sp_durum" class="form-control">
                                                <option value="" disabled="" selected>DURUM GÜNCELLE</option>
                                                <? if($siparis->sp_durum==4) { ?>
                                                	<option value="4" selected="">TAMAMLANDI</option>
	                                                <option value="8">ARŞİVLENDİ</option>    
                                                <? } elseif($siparis->sp_durum==8) { ?>
                                                	<option value="8" selected="">ARŞİVLENDİ</option>   
                                                <? } elseif($siparis->sp_durum==0 OR $siparis->sp_durum==10) { ?>
                                                	<option value="0" selected="">ÖDEME BEKLİYOR</option>
                                                	<?  $odeme = !isset($odeme) ? new Odeme($db): $odeme;
                                                	$odeme->o_code = $siparis->sp_code;
                                                	if ($odeme->select()) { ?>
                                                	<option value="1">ÖDEMEYİ ONAYLA (Onay Bilgilendirmesi Yapılır)</option>
                                                	<? } else { ?>
                                                	<option value="1">İŞLEM BEKLİYOR (Onay Bilgilendirmesi Yapılır)</option>
	                                                <option value="2">İŞLEM SIRASINDA (Onay Bilgilendirmesi Yapılır)</option>
	                                                <? }
	                                               } elseif($siparis->sp_durum==5) { ?>
                                                	<option value="5" selected="">İPTAL EDİLDİ</option>
                                                	<option value="1">TEKRAR İŞLEME AL</option>
                                                <? } elseif ($siparis->sp_durum==1 OR $siparis->sp_durum==2) { ?>
                                                	<option value="1" <?= $siparis->sp_durum==1 ? 'selected':'';?>>İŞLEM BEKLİYOR</option>
	                                                <option value="2" <?= $siparis->sp_durum==2 ? 'selected':'';?>>İŞLEM SIRASINDA</option>
                                                	<option value="4">TAMAMLANDI</option>
                                                	<option value="5">İPTAL EDİLDİ (Müşteri Bilgilendirilir)</option>
                                                <? } else { ?>
                                                	<option value="1" <? if($siparis->sp_durum==1): echo 'selected'; endif;?>>İŞLEM BEKLİYOR</option>
	                                                <option value="2" <? if($siparis->sp_durum==2): echo 'selected'; endif;?>>İŞLEM SIRASINDA</option>
                                                	<option value="4">TAMAMLANDI (Tamamlandı Bilgilendirmesi Yapılır)</option>
	                                                <option value="3" <? if($siparis->sp_durum==3): echo 'selected'; endif;?>>KISMİ TAMAMLANDI</option>
	                                                <option value="5" <? if($siparis->sp_durum==5): echo 'selected'; endif;?>>İPTAL EDİLDİ (Müşteri Bilgilendirilir)</option>
	                                                <option value="6" <? if($siparis->sp_durum==6): echo 'selected'; endif;?>>TAMAMLANAMADI</option>
                                                <? } ?>
                                                <option value="sil">SİPARİŞİ SİL</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="form-control-label" style="display: inline-block;width: 100%;"><b></b></label>
                                            <button type="submit" class="butto butto-success butto-lg pull-right butbor"><i class="fas fa-check"></i> Siparişi Güncelle</button>
                                        </div>
                                    </div>
                                </form>
                                </div>
                               <div id="apiile" class="tab-pane fade in <?= !empty($siparis->panel_code) ? 'active show':'';?>">
                                 <? if(!empty($siparis->panel_code)) {
                                    $api = !isset($api) ? new Api($db): $api;
                                    $api->smm_id = explode("-", $siparis->islem_smm)[0];
                                    $api->select();
                                   ?>
                                <form id="api-sorgu" method="POST" action="" onsubmit="fastpost('api-sorgu','ajaxout'); return false;">
                                <input type="hidden" name="page" value="siparis">
                                <input type="hidden" name="olay" value="api-sorgu">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <div class="table-stats order-table ov-h table-cscroll">
                                                <table class="table orders-list">
                                                    <thead>
                                                        <tr>
                                                            <th>BAYİKOD</th>
                                                            <th>BAYİ</th>
                                                            <th>TUTAR</th>
                                                            <th>BAŞLANGIÇ</th>
                                                            <th>KALAN</th>
                                                            <th>SON KONTROL</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr> <td><?php echo $siparis->panel_code;?></td>
                                                            <td><?php echo $api->smm_isim;?></td>
                                                            <td><?php echo $siparis->sp_tutar;?></td>
                                                            <td><?php echo $siparis->sp_start;?></td>
                                                            <td><?php echo $siparis->sp_kalan;?></td>
                                                            <td><?php echo $siparis->zamanfarki($siparis->bayi_kontrol);?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <? if($siparis->sp_durum==2):?>
	                                        <div class="form-group col-md-12">
	                                            <input type="hidden" name="smm_id" value="<?= $api->smm_id;?>">
	                                            <input type="hidden" name="panel_code" value="<?= $siparis->panel_code;?>">
	                                            <button type="submit" class="butto butto-success butto-lg pull-right butbor"><i class="fas fa-redo"></i> Verileri Yenile</button>
	                                        </div>
                                        <?  endif; ?>
                                    </div>
                                </form>
                                <? } 
                                if(empty($siparis->panel_code) OR (!empty($siparis->panel_code) AND ($siparis->sp_durum==6 OR $siparis->sp_durum==3))) {
                                $api = !isset($api) ? new Api($db): $api;
                                if (!empty($siparis->panel_code)) { ?>
                                <div class="alert text-left alert-warning dislem" role="alert">
                                    <h4 class="font-weight-bold">Yeniden İşlem Başlat</h4>
                                    <p class="mb-0">Bayi İşlemi Başarısız Olmuş Gibi Görünüyor farklı bayi ve servis seçerek yeniden işlem başlatabilirsiniz</p>
                                </div>
                                <? } ?>
                                <form id="api-gonder" method="POST" action=""  onsubmit="fastpost('api-gonder','ajaxout'); return false;">
                                <input type="hidden" id="page" name="page" value="siparis">
                                <input type="hidden" id="olay" name="olay" value="apiye-gonder">
                                    <div class="row form-group">
                                        <div class="form-group col-md-12">
                                            <label class="form-control-label"><b>İşlem Linki/Kullanıcı Adı</b></label>
                                            <div class="input-group col-md-12" style="padding: 0;">
                                                <input name="islem_adres" id="kopyala3" required="" value="<?php echo $siparis->islem_adres;?>" class="form-control">
                                                <div class="input-group-prepend">
                                                    <button class="butto butto-dark ml-2 butbor" type="button" onclick="copyto('kopyala3',this)"><i class="fas fa-copy"></i> Kopyala</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-7">
                                            <label class="form-control-label"><b>Paket</b></label>
                                            <input type="text" class="form-control" disabled value="<?php echo $siparis->sp_paket_adi;?>">
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label class="form-control-label"><b>Adet</b></label>
                                            <input class="form-control"  id="islemadet" name="islem_miktar" value="<?php echo $siparis->islem_miktar;?>">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                    	<div class="input-group col-md-12" id="bayisecimi">
		                                    <div class="input-group-prepend mobi-prepends">
		                                        <button class="butto butto-dark butto-lg butbor mr-2 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">BAYİ SEÇ</button>
		                                        <div class="dropdown-menu curs">
		                                            <?php foreach ($api->all() as $cikti) {
		                                                extract($cikti);
                                                        ?>
		                                                <span class="dropdown-item" onclick="smmbayi_(this);" data-panel="<?php echo $smm_id;?>" data-page="0"><?php echo $ayar->description($smm_isim,15);?></span>
		                                           <?php } ?>
		                                        </div>
		                                    </div>
		                                    <? if(!empty($siparis->islem_smm)) { ?>
		                                    <input type="hidden" name="smm_id" id="_smmbayi" data-panel="<?= explode('-', $siparis->islem_smm)[0];?>" data-page="0">
		                                    <select name="service_id" id="_serviceid" class="form-control">
		                                        <option value="<?php echo explode('-', $siparis->islem_smm)[1];?>" selected="">Seçili Servis Güncelleniyor</option>
		                                    </select>
		                                    <script type="text/javascript">setTimeout(function(){ $('#_smmbayi').click(); }, 1000); </script>
		                                    <? } else { ?>
		                                        <select name="service_id"  id="_serviceid" class="form-control">
		                                            <option value="" disabled="" selected>SERVİS SEÇ</option>
		                                        </select>
		                                        <input type="hidden" id="_smmbayi" name="smm_id" value="">
		                                    <? } ?>
		                                </div>
                                        <div class="col-md-12 mt-4">
                                            <div class="alert text-left alert-danger dislem" role="alert">
                                                <h4><b>Servis Seçimi <? if (isset($api->error)) { echo $api->error; } ?></b></h4>
                                                <p class="mb-0">Seçtiğiniz bayiye ait tüm servisler siparişte yer alan gönderim miktarı ile toplam tutar ve bayi bakiyesi karşılaştırılarak listelenir. Bu sebeple bayiye ait tüm servisleri seçemiyor olabilirsiniz.</p>
                                            </div>
                                        </div>
                                        <div class="clear2"></div>
                                        <div class="form-group col-md-12 text-right">
                                            <button type="submit" onclick="oo_('apiye-gonder','siparis');" class="butto butto-success butto-lg butbor"><i class="fas fa-check"></i> İşlemi Başlat</button>
                                        </div>
                                    </div>
                                </form>
                                <? } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="detay" role="tabpanel" aria-labelledby="detay">
                        <div class="modal-body ozniv">
                            <div class="col-md-12 col-sm-12 pt-2 pb-2">
                                    <div class="row">   
                                        <div class="form-group col-md-4">
                                            <label class="form-control-label"><b>Sipariş Kodu</b></label>
                                            <input class="form-control" disabled value="<?php echo $siparis->sp_code;?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-control-label"><b>Sipariş Zamanı</b></label>
                                            <input class="form-control" disabled value="<?php echo $siparis->zamanfarki();?>">
                                        </div>
                                        <div class="form-group col-md-4">       
                                            <label class="form-control-label"><b>Sipariş Tutarı</b></label>
                                            <input class="form-control" disabled value="<?php echo _p($siparis->sp_musteri_tutar);?>">
                                        </div>
                                        <div class="form-group col-md-4">        
                                            <label class="form-control-label"><b>Ad Soyad</b></label>
                                            <input class="form-control" disabled value="<?php echo $siparis->sp_musteri_adi;?>">
                                        </div>
                                        <div class="form-group col-md-4">        
                                            <label class="form-control-label"><b>Telefon</b></label>
                                            <input class="form-control" disabled value="<?php echo $siparis->sp_musteri_telefon;?>">
                                        </div>
                                        <div class="form-group col-md-4">        
                                            <label class="form-control-label"><b>Mail Adresi</b></label>
                                            <input class="form-control" disabled value="<?php echo $siparis->sp_musteri_mail;?>">
                                        </div>
                                        <div class="form-group col-md-4">       
                                            <label class="form-control-label"><b>Ödeme Yöntemi</b></label>
                                            <input class="form-control" disabled value="<?php echo $siparis->yontem($siparis->sp_odeme);?>">
                                        </div>
                                        <div class="form-group col-md-4">        
                                            <label class="form-control-label"><b>Vergi No</b></label>
                                            <input class="form-control" disabled value="<?php echo $siparis->sp_musteri_vn;?>">
                                        </div>
                                        <div class="form-group col-md-4">        
                                            <label class="form-control-label"><b>Vergi Dairesi</b></label>
                                            <input class="form-control" disabled value="<?php echo $siparis->sp_musteri_vd;?>">
                                        </div>
                                        <div class="form-group col-md-12">        
                                            <label class="form-control-label"><b>Adres</b></label>
                                            <textarea class="form-control dauto" disabled><?php echo $siparis->sp_musteri_adres;?></textarea>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="aciklama" role="tabpanel" aria-labelledby="aciklama">
                        <form id="siparis-aciklama" method="POST" action="" onsubmit="fastpost('siparis-aciklama','ajaxout'); return false;">
                            <input type="hidden" name="page" value="siparis">
                            <input type="hidden" name="olay" value="siparis-aciklamasi">
                            <div class="modal-body ozniv row">
                                <div class="col-md-12">
                                    <div class="mb-0 pt-2 pb-2" role="alert">
                                        <div class="form-group col-md-12">
                                            <label class="form-control-label"><b>Sorgu Açıklaması Giriniz (İsteğe Bağlı)</b></label>
                                            <p>Sipariş sorgusunda müşteriyi detaylı bilgilendirebilmeniz için ekstra açıklama alanıdır.</p>
                                            <textarea name="aciklama" class="form-control" placeholder="Örn: Teknik nedenlerden dolayı siparişiniz beklemeye alınmıştır."><? if($siparis->aciklama()): echo $siparis->aciklama; endif;?></textarea>
                                        </div>
                                        <div class="col-md-12 text-right">
                                            <button type="submit" class="butto butto-success butto-lg butbor"><i class="fas fa-check"></i> Açıklamayı Kaydet</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .clear2 {
    display: inline-block;
    width: 100%;
    height: 15px;
}
.dauto {
    height: auto;
    min-height: 38px;
}
select option[disabled] {
    display: none;
}
</style>