<?php
if (isset($ayar->action) AND $ayar->action=="yeni-ekle") {
    if (isset($post["olay"]) AND $post["olay"]=="kullanici-ekle") {
        foreach ($post as $key => $value) {
            if (is_array($value)) {
               $user->$key = $value;
            } else {
                $user->$key = htmlspecialchars(strip_tags($value));
            }
            
        }
        if ($user->kontrol()) {
            if ($post["k_sifre"]==$post["k_sifre_"]) {
                if ($user->insert()) {
                    $alert->header = "İşlem Başarılı";
                    $alert->content = "Yeni kullanıcı başarıyla oluşturuldu.";
                    $alert->action = $ayar->getpage("kullanicilar",$user->k_id);
                    include_once "alert.php";
                    exit;
                }

                $alert->header = "İşlem Başarısız";
                $alert->content = "İşlem sırasında bir hata oluştu.Lütfen tüm alanları eksiksiz doldurun.";
                $alert->action = "close";
                $alert->statu = "danger";
                include_once "alert.php";
                exit;
            }
            $alert->header = "İşlem Başarısız";
            $alert->content = "Girdiğiniz şifreler uyuşmuyor lütfen şifreleri kontrol edin.";
            $alert->action = "close";
            $alert->statu = "danger";
            include_once "alert.php";
            exit;
        }
        $alert->header = "İşlem Başarısız";
        $alert->content = "Girdiğiniz bilgilerle bir kullanıcı zaten mevcut";
        $alert->action = "close";
        $alert->statu = "danger";
        include_once "alert.php";
        exit;
    }
} elseif(isset($ayar->action)){
    $user->action = $ayar->action;
    $edit = $user->select();
    extract($edit);
    if (strlen($k_avatar)!=3)
        $k_avatar = "0,0";
    if (isset($post["olay"]) AND $post["olay"]=="kullanici-duzenle") {
        if ($ayar->action == $user->k_id AND $post["k_statu"]!=$user->k_statu) {
            $alert->header = "Hatalı İstek!";
            $alert->content = "Kendi üyelik statunu değiştirmek sistem işleyişi için pek mantıklı değil. Bunu ancak kullanıcıları düzenleme yetkisi olan farklı bir kullanıcı yapabilir.";
            $alert->action = "close";
            $alert->statu = "danger";
            include_once "alert.php";
            exit;
        }
        foreach ($post as $key => $value) {
            if (is_array($value)) {
               $user->$key = $value;
            } else {
                $user->$key = htmlspecialchars(strip_tags($value));
            }
            
        }
        $user->k_id = $ayar->action;
        if ($user->kontrol("update")) {
            if ($user->update()) {
                $alert->header = "İşlem Başarılı";
                $alert->content = "Kullanıcı bilgileri güncellendi.";
                $alert->action = "close";
                include_once "alert.php";
                exit;
            }
            $alert->header = "İşlem Başarısız";
            $alert->content = "İşlem sırasında bir hata oluştu.Lütfen tüm alanları eksiksiz doldurun.";
            $alert->action = "close";
            $alert->statu = "danger";
            include_once "alert.php";
            exit;
        }
        $alert->header = "İşlem Başarısız";
        $alert->content = "Girdiğiniz bilgiler farklı bir kullanıcı ile çakışıyor";
        $alert->action = "close";
        $alert->statu = "danger";
        include_once "alert.php";
        exit;
    } elseif (isset($post["olay"]) AND $post["olay"]=="sifre-duzenle") {
        if ($post["k_sifre"]==$post["k_sifre_"]) {
            $user->k_id = $ayar->action;
            $user->k_sifre = $post["k_sifre"];
            if ($user->changePasword()) {
                $alert->header = "İşlem Başarılı";
                $alert->content = "Kullanıcı şifresi değiştirildi. Yeni Şifre: <b>".$post["k_sifre"].'</br>';
                $alert->action = "reload";
                include_once "alert.php";
                exit;
            }
            $alert->header = "İşlem Başarısız";
            $alert->content = "İşlem sırasında bir hata oluştu.Lütfen tüm alanları eksiksiz doldurun.";
            $alert->action = "close";
            $alert->statu = "danger";
            include_once "alert.php";
            exit;
        }
        $alert->header = "İşlem Başarısız";
        $alert->content = "Girdiğiniz şifreler uyuşmuyor lütfen şifreleri kontrol edin.";
        $alert->action = "close";
        $alert->statu = "danger";
        include_once "alert.php";
        exit;
    } elseif (isset($post["olay"]) AND $post["olay"]=="kullanici-sil") {
        if ($ayar->action==$user->k_id) {
            $alert->header = "Hatalı İstek!";
            $alert->content = "Kendi üyeliğini silmek sistem işleyişi için pek mantıklı değil. Lütfen üyeliğini silmek yerine bilgilerini güncellemeyi dene";
            $alert->action = "close";
            $alert->statu = "danger";
            include_once "alert.php";
            exit;
        }
        $alert->header = "Kullanıcıyı Sil?";
        $alert->content = "Bu işlem geri alınamaz onaylıyor musunuz?";
        $alert->action = "confirm";
        $alert->olay = "kullanici-sil-onay";
        $alert->page = "kullanicilar";
        $alert->statu = "info";
        include_once "alert.php";
        exit;
    } elseif (isset($post["olay"]) AND $post["olay"]=="kullanici-sil-onay") {
        $user->k_id = $ayar->action;
        $user->delete();
        $alert->header = "Kullanıcı Silindi";
        $alert->content = "Kullanıcı silme işlemi başarıyla gerçekleşti";
        $alert->action = $ayar->getpage('kullanicilar');
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
    $list = $user->all($from_record_num ,$records_per_page);
    $total_rows = $user->count();
} ?>
<div class="content" id="alan">
    <div class="animated fadeIn" id="scrolling">
        <div class="orders">
            <div class="row">
                <? if(!isset($ayar->action)) { ?>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                        	<div class="bol-5">
                                <strong class="box-title">Kullanıcılar</strong>
                            </div>
                            <div class="bol-5">
                               <a class="butto butto-success butto-xs butbor float-right" href="<?= $ayar->getpage('kullanicilar','yeni-ekle');?>"><i class="fas fa-plus"></i> Yeni Ekle</a>
                           </div>
                        </div>
                        <div class="table-stats order-table ov-h" id="tb-scroll">
                            <table class="table orders-list" id="orders-list">
                                <thead>
                                    <tr>
                                        <th>STATU</th>
                                        <th>ADI SOYADI</th>
                                        <th>KULLANICI ADI</th>
                                        <th>İŞLEM</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($list as $cikti) {
                                        extract($cikti);
                                        $user->statu($k_statu);
                                     ?>
                                    <tr>
                                    <td><button class="butto buttosi butto-<?= $user->color;?>"><?= $user->title;?></button></td>
                                    <td><?php echo $k_adi;?></td>
                                    <td><?php echo $k_kadi;?></td>
                                    <td>
                                        <a href="<?= $ayar->getpage('kullanicilar',$k_id);?>" class="butto butto-xs badge-primary butbor"><i class="fas fa-layer-group"></i> Detay</a></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <form id="panel-refresh" method="POST" action="">
                            <input type="hidden" name="page" value="paneller">
                            <input type="hidden" name="olay" value="panel-refresh">
                            <input type="hidden" id="smm_id" name="smm_id" value="">
                        </form>
                    </div>
                </div>
                <? } elseif(isset($ayar->action) AND $ayar->action=="yeni-ekle") { ?>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                        	<div class="bol-7">
                                <strong>KULLANICI OLUŞTUR</strong>
                            </div>
                            <div class="bol-3">
                               <a class="butto butto-xs badge-light butbor pull-right" <?= 'href="'.$ayar->getpage('kullanicilar').'"';?>><i class="fas fa-chevron-left"></i> Geri</a>
                           </div>
                        </div>
                        <div class="card-body">
                        	<div class="form-group">
                        		<div class="col-md-12 hizmetler">
                        			<form id="kullanici_ekle" method="POST" action="" autocomplete="off" onsubmit="fastpost('kullanici_ekle','ajaxout'); return false;">
                                        <input type="hidden" name="page" value="kullanicilar">
                                        <input type="hidden" id="olay" name="olay" value="kullanici-ekle">
                        				<div class="row form-group mrl0">
                        					<div class="form-group col-md-6">
                        						<label class="form-control-label font-weight-bold">Ad ve Soyad</label>
                        						<input class="form-control" type="text" name="k_adi" required="" placeholder="Örnek: Harun Demir">
                        					</div>
                        					<div class="form-group col-md-6">
                        						<label class="form-control-label font-weight-bold">Kullanıcı Adı</label>
                        						<input class="form-control" type="text" autocomplete="off" name="k_kadi" required="" placeholder="Örnek: crazyboy">
                        					</div>
                                            <div class="form-group col-md-6">
                                                <label class="form-control-label font-weight-bold">Şifre</label>
                                                <input class="form-control" type="password" autocomplete="off" name="k_sifre" required="">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-control-label font-weight-bold">Şifreyi Tekrar Edin</label>
                                                <input class="form-control" type="password" name="k_sifre_" required="">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-control-label font-weight-bold">Mail Adresi</label>
                                                <input class="form-control" type="email" name="k_mail" required="" placeholder="Örnek: crazyboy@siteadi.com">
                                            </div>
                        					<div class="form-group col-md-6">
                                                <label class="form-control-label font-weight-bold">Telefon Numarası</label>
                                                <input class="form-control" type="text" name="k_telefon" maxlength="11" required="" placeholder="Örnek: 05600000">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="form-control-label font-weight-bold">Üye Statüsü</label>
                                                <select class="form-control" name="k_statu">
                                                    <option value="0">Engelle</option>
                                                    <option value="5">İzleyici</option>
                                                    <option value="2">Editör</option>
                                                    <option value="3">Moderator</option>
                                                    <option value="4">Teknik Servis</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="form-control-label font-weight-bold">Mail Bildirimleri</label>
                                                <select class="form-control" name="bildirims[]">
                                                    <option value="0">Pasif</option>
                                                    <option value="1">Aktif</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="form-control-label font-weight-bold">Sms Bildirimleri</label>
                                                <select class="form-control" name="bildirims[]">
                                                    <option value="0">Pasif</option>
                                                    <option value="1">Aktif</option>
                                                </select>
                                            </div>
                        					<div class="form-group col-md-12 text-right mt-3">
                        						<button type="submit" class="butto butto-success butto-lg butbor"><i class="fas fa-check"></i> Ekle</button>
                        					</div>
                        				</div>
                        			</form>
                        		</div>
                        	</div>
                        </div>
                    </div>
                </div>
                        <? } elseif (isset($ayar->action)) { ?>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="bol-7">
                                <strong>KULLANICI BİLGİLERİNİ DÜZENLE</strong>
                            </div>
                            <div class="bol-3">
                               <a class="butto butto-xs badge-light butbor pull-right" <?= 'href="'.$ayar->getpage('kullanicilar').'"';?>><i class="fas fa-chevron-left"></i> Geri</a>
                           </div>
                        </div>
                        <div class="card-body">
                                <div class="col-md-12 hizmetler">
                                    <form id="kullanici_ekle" method="POST" action="" autocomplete="off" onsubmit="fastpost('kullanici_ekle','ajaxout'); return false;">
                                        <input type="hidden" name="page" value="kullanicilar">
                                        <input type="hidden" id="olay" name="olay" value="kullanici-duzenle">
                                        <div class="row form-group mrl0">
                                            <div class="form-group col-md-6">
                                                <label class="form-control-label font-weight-bold">Ad ve Soyad</label>
                                                <input class="form-control" type="text" name="k_adi" required="" value="<?= $k_adi?>" placeholder="Örnek: Harun Demir">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-control-label font-weight-bold">Kullanıcı Adı</label>
                                                <input class="form-control" type="text" autocomplete="off" name="k_kadi" value="<?= $k_kadi;?>" required="" placeholder="Örnek: crazyboy">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-control-label font-weight-bold">Mail Adresi</label>
                                                <input class="form-control" type="email" name="k_mail" required="" value="<?= $k_mail;?>" placeholder="Örnek: crazyboy@siteadi.com">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-control-label font-weight-bold">Telefon Numarası</label>
                                                <input class="form-control" type="text" name="k_telefon" required="" maxlength="11" value="<?= $k_telefon;?>" placeholder="Örnek: 05600000">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-control-label font-weight-bold">Üye Statüsü</label>
                                                <select class="form-control" <?php echo $k_id == $user->k_id ? 'readonly=""':'';?> name="k_statu">
                                                    <option value="0" <?php echo $k_statu == "0" ? 'selected=""':'';?>>Engelle</option>
                                                    <option value="1" <?php echo $k_statu == "1" ? 'selected=""':'';?>>Yönetici</option>
                                                    <option value="5" <?php echo $k_statu == "5" ? 'selected=""':'';?>>İzleyici</option>
                                                    <option value="2" <?php echo $k_statu == "2" ? 'selected=""':'';?>>Editör</option>
                                                    <option value="3" <?php echo $k_statu == "3" ? 'selected=""':'';?>>Moderator</option>
                                                    <option value="4" <?php echo $k_statu == "4" ? 'selected=""':'';?>>Teknik Servis</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="form-control-label font-weight-bold">Mail Bildirimleri</label>
                                                <select class="form-control" name="bildirims[]">
                                                    <option value="0" <?php echo explode(",", $k_avatar)[0]  == "0" ? 'selected=""':'';?>>Pasif</option>
                                                    <option value="1" <?php echo explode(",", $k_avatar)[0]  == "1" ? 'selected=""':'';?>>Aktif</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="form-control-label font-weight-bold">Sms Bildirimleri</label>
                                                <select class="form-control" name="bildirims[]">
                                                    <option value="0" <?php echo explode(",", $k_avatar)[1]  == "0" ? 'selected=""':'';?>>Pasif</option>
                                                    <option value="1" <?php echo explode(",", $k_avatar)[1]  == "1" ? 'selected=""':'';?>>Aktif</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12 text-right mt-3">
                                                <button type="submit" class="butto butto-success butto-lg butbor"><i class="fas fa-check"></i> Değişiklikleri Kaydet</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                             <form id="kullanici_sil" class="card-header"  method="POST" action="" autocomplete="off" onsubmit="fastpost('kullanici_sil','ajaxout'); return false;">

                                    <input type="hidden" name="page" value="kullanicilar">
                                    <input type="hidden" id="olay" name="olay" value="kullanici-sil">
                                <div class="bol-7">
                                    <strong>KULLANICI ŞİFRE BELİRLEME</strong>
                                </div>
                                    <div class="bol-3 text-right">
                                   <button class="butto butto-danger butto-sm butbor">Kullanıcıyı Sil</button>
                               </div>
                        </form>
                            <div class="card-body">
                            <form id="sifre_degistir" method="POST" action="" autocomplete="off" onsubmit="fastpost('sifre_degistir','ajaxout'); return false;">
                                <input type="hidden" name="page" value="kullanicilar">
                                <input type="hidden" id="olay" name="olay" value="sifre-duzenle">
                                <div class="row form-group mrl0">
                                    <div class="form-group col-md-12">
                                        <label class="form-control-label font-weight-bold">Şifre</label>
                                        <input class="form-control" type="password" name="k_sifre" required="">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="form-control-label font-weight-bold">Şifreyi Tekrarla</label>
                                        <input class="form-control" type="password" autocomplete="off" name="k_sifre_">
                                    </div>
                                    <div class="form-group col-md-12 text-right mt-3">
                                        <button type="submit" class="butto butto-success butto-lg butbor"><i class="fas fa-check"></i> Şifreyi Değiştir</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <? } ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">setTimeout(function(){document.getElementById("kullanici_ekle").reset();},1000);</script>