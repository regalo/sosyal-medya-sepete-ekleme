<?php if (isset($post["olay"]) AND $post["olay"]=="profil_duzenle") {
        $user->k_adi = htmlspecialchars(strip_tags($post["k_adi"]));
        $user->k_kadi = htmlspecialchars(strip_tags($post["k_kadi"]));
        $user->k_mail = htmlspecialchars(strip_tags($post["k_mail"]));
        $user->k_telefon = htmlspecialchars(strip_tags($post["k_telefon"]));
        $user->bildirims = explode(",", $user->k_avatar);
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
        include_once "alert.php";
        exit;
    } elseif (isset($post["olay"]) AND $post["olay"]=="sifre-duzenle") {
        if (md5($post["k_sifre_old"]) != $user->k_sifre) {
            $alert->header = "İşlem Başarısız";
            $alert->content = "Mevcut şifrenizi yanlış girdiniz. İşleme devam etmek için lütfen mevcut şifrenizi doğrulayın";
            $alert->action = "close";
            $alert->statu = "danger";
            include_once "alert.php";
            exit;
        }
        if ($post["k_sifre"]==$post["k_sifre_"]) {
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
    }
?>
<div class="content" id="alan">
    <div class="animated fadeIn" id="scrolling">
        <div class="orders">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Profil Bilgileri</strong>
                        </div>
                        <div class="card-body">
                            <div class="mx-auto d-block">
                                <img class="rounded-circle mx-auto d-block" src="<?= $ayar->panel;?>images/admin.png" height="50px" alt="Card image cap">
                                <h5 class="text-sm-center mt-2 mb-1"><i class="fas fa-user"></i> <?php echo $user->k_adi;?></h5>
                                <div class="location text-sm-center font-weight-bold"><?php echo $user->k_mail;?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Bilgileri Güncelle</strong>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-danger">
                                <p>Buradaki bilgiler yönetici sms ve mail bilgilendirmeleri için kullanılır. Lütfen doğru bilgiler girdiğinizden emin olun.</p>
                            </div>
                            <form id="profil" method="POST" action="" onsubmit="fastpost('profil','ajaxout'); return false;">
                                <input type="hidden" name="page" value="profil">
                                <input type="hidden" id="olay" name="olay" value="profil_duzenle">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-control-label font-weight-bold">İsim</label>
                                        <input class="form-control" placeholder="Ad Soyad/Firma Adı" autocomplete="off" name="k_adi" value="<?php echo $user->k_adi;?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-control-label font-weight-bold">Kullanıcı Adı</label>
                                        <input class="form-control" placeholder="Kullanıcı Adı" autocomplete="off" name="k_kadi" value="<?php echo $user->k_kadi;?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-control-label font-weight-bold">Mail Adresi</label>
                                        <input class="form-control" placeholder="Mail Adresiniz" autocomplete="off" name="k_mail" value="<?php echo $user->k_mail;?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-control-label font-weight-bold">Telefon Numarası</label>
                                        <input class="form-control" placeholder="5555478746" autocomplete="off" name="k_telefon" value="<?php echo $user->k_telefon;?>">
                                    </div>
                                    <div class="form-group col-md-12 text-right">
                                        <button type="submit" class="butto butto-ld butto-success butbor"><i class="fas fa-check"></i> Kaydet</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-header">
                            <strong class="card-title mb-3">ŞİFRE DEĞİŞTİR</strong>
                        </div>
                        <div class="card-body">
                            <div id="sifresi">
                                <form id="profil-ek" method="POST" action="" onsubmit="fastpost('profil-ek','ajaxout'); return false;">
                                    <input type="hidden" name="page" value="profil">
                                    <input type="hidden" id="olay" name="olay" value="sifre-duzenle">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label class="form-control-label font-weight-bold">Mevcut Şifre</label>
                                            <input class="form-control" name="k_sifre_old" required="" minlength="6" placeholder="Yeni Şifrenizi Yazın" autocomplete="off" type="password">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-control-label font-weight-bold">Yeni Şifre</label>
                                            <input class="form-control" name="k_sifre" required="" minlength="6" placeholder="Yeni Şifrenizi Yazın" autocomplete="off" type="password">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-control-label font-weight-bold">Şifre Tekrar</label>
                                            <input class="form-control" name="k_sifre_" required="" minlength="6" placeholder="Şifreyi Tekrarlayın" autocomplete="off" type="password">
                                        </div>
                                        <div class="form-group col-md-12 text-right">
                                            <button type="submit" class="butto butto-ld butto-success butbor"><i class="fas fa-check"></i> Kaydet</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>