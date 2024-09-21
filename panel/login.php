<? 
if (!isset($ayar->panel)) {
    session_start();
    header("Location:404");
    exit;
} ?><!doctype html>
<html class="no-js" lang="tr-TR">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Yönetim Paneli</title>
        <meta name="description" content="NivuSoft Yönetim Paneli">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="<?php echo $ayar->panel;?>images/favicon.png">
        <link rel="shortcut icon" href="<?php echo $ayar->panel;?>images/favicon.png">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
        <link rel="stylesheet" href="<?php echo $ayar->panel;?>assets/css/cs-skin-elastic.css">
        <link rel="stylesheet" href="<?php echo $ayar->panel;?>assets/css/style.css?version=<?php echo rand(1,5000);?>">
        <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
        <link rel="stylesheet" href="<?php echo $ayar->panel;?>assets/style.css?version=<?php echo rand(1,5000);?>">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link href="<?php echo $ayar->panel;?>assets/js/picker/color-picker.min.css" rel="stylesheet">
    </head>
    <body style="background: #fff;">
        <div class="content panel-login">
            <div class="p-alan1">
             <div class="palan-ort">
                <?php
                     $soz[1] = '"Hayat, her ne kadar zor görünse de, yapabileceğiniz ve başarabileceğiniz bir şey her zaman vardır." <span class="ssahi">STEPHEN HAWKING</span>';
                     $soz[2] = '"Bir şey yeterince önemli olduğunda, İhtimaller sizin lehinize olmasa bile o işi yaparsınız." <span class="ssahi">ELON MUSK</span>';
                     $soz[3] = '"Başarmak zordur, kolaya kaçarsan sonuç basitleşir. Unutma, yokuş aşağı inmek kolaydır ama<br>manzara tepeden seyredilir." <span class="ssahi">Dan Brown</span>';
                     $soz[4] = '"Fiziksel dünyada bir müşteriyi mutsuz ederseniz, bunu 6 kişi ile paylaşır. Dijital dünyada bir müşteriyi mutsuz ederseniz bunu 6.000 kişi ile paylaşır." <span class="ssahi">Jeff Bezos</span>';
                     $soz[5] = '"İz bırakanlarla senin aranda basit bir fark var; Onlar ömür boyu gayret ediyor, sen ömür boyu hayret ediyorsun." <span class="ssahi">MEHMET AKİF ERSOY</span>';
                     $salla = rand(1,5);
                     echo $soz[$salla];
                ?>
             </div>
            </div>
            <?php if(isset($get["q"]) AND $get["q"]=="sifre-yenile") { ?>
            <div class="p-alan2">
                <div class="login-form vericeri">
                    <span>Şifre Yenileme İsteği</span>
                    <div class="alert  m-b-30 <?= isset($button) ? $button:'alert-primary';?>">
                        <?= isset($p_text) ? $p_text:'Şifrenizi yenilemek için sistemde kayıtlı mail adresinizi girin, mailinize bir yenileme linki gönderilecek';?>
                    </div>
                    <form id="sifre-yenile" method="POST" action=""  onsubmit="fastpost('sifre-yenile','ajaxout'); return false;">
                        <input type="hidden" id="olay" name="olay" value="sifre-yenile">
                        <div class="form-group">
                            <input type="text" name="item" required="" class="form-control formsey" placeholder="<?php echo (isset($error) AND $error) ? 'Mail Hatalı':'Kayıtlı mail yada kullanıcı adı';?>">
                        </div>
                        <div class="checkbox">
                        </div>
                        <? if (ns_filter('recaptcha','statu')) {
                            echo '<div class="recaptcha"><div class="g-recaptcha" data-sitekey="'.ns_filter('recaptcha').'"></div></div><div id="captcha"></div>';
                            echo '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
                          } ?>
                        <button  type="submit" onclick="return get_action(this);"  class="btn btn-flat giris-but">GÖNDER</button>
                    </form>
                    <a href="?q=giris-yap" class="sifre-unuttum">Giriş Yap</a>
                </div>
            </div>
            <?php } elseif(isset($get["q"]) AND $get["q"]=="password-refresh") { ?>
            <div class="p-alan2">
                <div class="login-form vericeri">
                    <span>Şifre Sıfırlama</span>
                    <div class="alert  m-b-30 <?= isset($button) ? $button:'alert-primary';?>">
                        <?= isset($p_text) ? $p_text:'Şifrenizi sıfırlamak için yeni bir şifre belirleyin ve yeni şifreyi doğrulayın';?>
                    </div>
                    <form id="sifre-yenile" method="POST" action=""  onsubmit="fastpost('sifre-yenile','ajaxout'); return false;">
                        <input type="hidden" id="olay" name="olay" value="sifre-sifirlama">
                        <div class="form-group">
                            <input type="password" name="k_sifre" required="" minlength="6" class="form-control formsey" placeholder="Yeni Şifreniz">
                        </div>
                        <div class="form-group">
                            <input type="password" name="k_sifre_" required="" minlength="6" class="form-control formsey" placeholder="Yeni Şifreyi Tekrarlayın">
                        </div>
                        <button  type="submit"  class="btn btn-flat giris-but">GÖNDER</button>
                    </form>
                    <a href="?q=giris-yap" class="sifre-unuttum">Giriş Yap</a>
                </div>
            </div>
            <?php } else { ?>
            <div class="p-alan2">
                <div class="login-form vericeri">
                    <span>Giriş Yap</span>
                    <form id="login" method="POST" action=""  onsubmit="fastpost('login','ajaxout'); return false;">
                        <input type="hidden" id="olay" name="olay" value="login">
                        <div class="form-group">
                            <input type="text" name="username" required="" class="form-control formsey" placeholder="Kullanıcı Adı">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" required="" class="form-control formsey" placeholder="Şifre">
                        </div>
                        <div class="checkbox">
                            <? if (ns_filter('recaptcha','statu')) {
                            echo '<div class="recaptcha"><div class="g-recaptcha" data-sitekey="'.ns_filter('recaptcha').'"></div></div><div id="captcha"></div>';
                            echo '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
                          } ?>
                        </div>
                        <button  type="submit" onclick="return get_action(this);" class="btn btn-flat m-b-30 m-t-30 giris-but">Giriş Yap</button>
                    </form>
                    <a href="?q=sifre-yenile" class="sifre-unuttum">Şifremi Unuttum?</a>
                </div>
            </div>
            <? }?>
        </div>
        <script type="text/javascript">
             function get_action(element) {
                var v = grecaptcha.getResponse();
                if(v.length == 0){
                    $('.recaptcha').addClass("nonshake");
                    setTimeout(function(){
                        $('.recaptcha').removeClass("nonshake");},500);
                    return false;
                } else {
                    return true; 
                }
            }
        </script>
        <?php include "footer.php";?>