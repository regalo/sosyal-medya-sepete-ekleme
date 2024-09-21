<!doctype html>
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
        <link rel="stylesheet" href="<?php echo $ayar->panel;?>assets/css/style.css?version=2.7">
        <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
        <link rel="stylesheet" href="<?php echo $ayar->panel;?>assets/style.css?version=4.8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link href="<?php echo $ayar->panel;?>assets/js/picker/color-picker.min.css" rel="stylesheet">
    </head>
    <body id="body" class="<?php echo isset($_COOKIE["panel-mod"]) ? $_COOKIE["panel-mod"]:'';?>">
        <aside id="left-panel" class="left-panel">
            <nav class="navbar navbar-expand-sm navbar-default">
                <div id="main-menu" class="main-menu collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="menu-item-has-children dropdown <?php echo dropshow("software");?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-play"></i>Başlangıç <?php badge(1);?></a>
                            <ul class="sub-menu children dropdown-menu <?php echo dropshow("software");?>">
                                <li><i class="menu-icon fa fa-play"></i> <a href="<?php echo $ayar->getpage('yonetim');?>">Başlangıç</a></li>
                                <?php if(_permit("software")) { ?>
                                <li><i class="menu-icon fas fa-cloud-download-alt"></i> <a  class="gecis" href="<?php echo $ayar->getpage('software');?>">Güncellemeler <?php badge(1);?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <?php if(!isset($siparis)): $siparis = new Siparis($db); endif; ?>
                        <?php if(_permit("siparisler,odemeler,iletisim,log-kayitlari")) { ?>
                        <li class="menu-item-has-children dropdown  <?php echo dropshow("veri");?>">
                             <a  href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-chart-pie"></i> Veriler</a>
                            <ul class="sub-menu children dropdown-menu  <?php echo dropshow("veri");?>">
                                <?php if(_permit("siparisler")) { ?>
                                <li><i class="fas fa-hourglass-start"></i><a href="<?php echo $ayar->getpage('siparisler','acik');?>">Siparişler <span class="badge badge-secondary "><?php echo $siparis->count('acik');?></span></a></li>
                                <?php } if(_permit("odemeler")) { ?>
                                <?php if(!isset($odeme)): $odeme = new Odeme($db); endif; ?>
                                <li><i class="menu-icon fas fa-university"></i><a href="<?php echo $ayar->getpage('odemeler');?>">Ödeme Bildirimi <span class="badge badge-danger"><?php echo $odeme->count('0');?></span></a></li>
                                <?php } if(_permit("iletisim")) { ?>
                                <?php if(!isset($iletisim)): $iletisim = new iletisim($db); endif; ?>
                                <li><i class="menu-icon fas fa-envelope"></i><a href="<?php echo $ayar->getpage('iletisim');?>">İletişim İstekleri <span class="badge badge-danger"><?php echo $iletisim->count('0');?></span></a></li>
                               <?php } if(_permit("log-kayitlari")) { ?>
                                <li><i class="menu-icon fas fa-history"></i><a href="<?php echo $ayar->getpage('log-kayitlari');?>">Sistem Logları </a></li>
                               <?php } ?>
                            </ul>
                        </li>
                        <?php } if(_permit("kategoriler,hizmetler,paketler")) { ?>
                        <li class="menu-item-has-children dropdown mt-3 <?php echo dropshow(array("hizmet","kategori","paket"));?>">
                             <a  href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-list-ul"></i> Hizmet Yönetimi</a>
                            <ul class="sub-menu children dropdown-menu <?php echo dropshow(array("hizmet","kategori","paket"));?>">
                                <?php if(_permit("hizmetler")) { ?>
                                <li><i class="fas fa-desktop"></i><a href="<?php echo $ayar->getpage('hizmetler');?>">Platformlar</a></li>
                                <?php } if(_permit("kategoriler")) { ?>
                                <li><i class="fas fa-users"></i><a href="<?php echo $ayar->getpage('kategoriler');?>">Kategoriler</a></li>
                                <?php } if(_permit("paketler")) { ?>
                                <li><i class="far fa-list-alt"></i><a href="<?php echo $ayar->getpage('paketler');?>">Paketler</a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <?php } if(_permit("paneller,kuponlar")) { ?>
                        <li class="menu-item-has-children dropdown <?php echo dropshow(array("paneller","kuponlar"));?>">
                             <a  href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-layer-group"></i> Sistem Yönetimi</a>
                            <ul class="sub-menu children dropdown-menu <?php echo dropshow(array("paneller","kuponlar"));?>">
                                <?php if(_permit("paneller")) { ?>
                                <li><i class="fas fa-share-alt"></i><a href="<?php echo $ayar->getpage('paneller');?>">Api Ayarları</a></li>
                                <?php } if(_permit("kuponlar")) { ?>
                                <li><i class="fas fa-ticket-alt"></i><a href="<?php echo $ayar->getpage('kuponlar');?>">Kupon Ayarları</a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <?php } if(_permit("icerikler")) { ?>
                        <li class="menu-item-has-children dropdown <?php echo dropshow("icerik");?>">
                            <a  href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-edit"></i> İçerikler</a>
                            <ul class="sub-menu children dropdown-menu <?php echo dropshow("icerik");?>">
                               <li><i class="fas fa-sticky-note"></i><a href="<?php echo $ayar->getpage('icerikler','sayfa');?>">Sayfalar</a></li>
                                <li><i class="fas fa-quote-right"></i><a href="<?php echo $ayar->getpage('icerikler','blog');?>">Bloglar</a></li>
                            </ul>
                        </li>
                        <?php } if(_permit("ortam")) { ?>
                        <li>
                            <a href="<?php echo $ayar->getpage('ortam');?>"><i class="fas fa-images"></i>  Ortam Kütüphanesi</a>
                        </li>
                        <?php } if(_permit("theme,themes,menu-builder")) { ?>
                        <li class="mt-3 menu-item-has-children dropdown <?php echo dropshow("theme");?>">
                            <a  href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-brush"></i> Görünüm <?php badge(3);?></a>
                            <ul class="sub-menu children dropdown-menu <?php echo dropshow("theme");?>">
                               <?php if(_permit("themes")) { ?>
                               <li><i class="fas fa-vector-square"></i><a class="gecis" href="<?php echo $ayar->getpage('themes');?>"> Temalar <?php badge(3);?></a></li>
                               <?php } if(_permit("theme")) { ?>
                               <li><i class="fas fa-palette"></i><a href="<?php echo $ayar->getpage('theme');?>"> Tema Ayarları</a></li>
                               <?php } if(_permit("menu-builder")) { ?>
                               <li><i class="fas fa-bars"></i><a href="<?php echo $ayar->getpage('menu-builder');?>"> Menüler</a></li>
                               <?php } ?>
                            </ul>
                        </li>
                        <?php } if(_permit("plugins,plugin")) { ?>
                        <li class="menu-item-has-children dropdown <?php echo dropshow("plugin");?>">
                            <a  href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-box"></i> Eklentiler <?php badge(4);?></a>
                            <ul class="sub-menu children dropdown-menu <?php echo dropshow("plugin");?>">
                                <?php if(_permit("plugins")) { ?>
                               <li><i class="fas fa-chevron-circle-right"></i><a class="gecis"  href="<?php echo $ayar->getpage('plugins');?>"> Eklentiler <?php badge(4);?></a></li>
                               <?php } if(_permit("plugin")) { ?>
                               <?php echo ns_filter('admin_menu');?>
                               <?php } ?>
                            </ul>
                        </li>
                        <?php } if(_permit("kullanicilar")) { ?>
                        <li class="mt-3">
                            <a href="<?php echo $ayar->getpage('kullanicilar');?>"><i class="fas fa-users"></i>  Kullanıcılar</a>
                        </li>
                        <?php } if(_permit("odeme-ayarlari,iletisim-ayarlari")) { ?>
                        <li class="menu-item-has-children dropdown <?php echo dropshow(array("iletisim-ayarlari","odeme-ayarlari"));?>">
                            <a  href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-tools"></i> Araçlar <?php badge(5);?></a>
                            <ul class="sub-menu children dropdown-menu <?php echo dropshow(array("iletisim-ayarlari","odeme-ayarlari"));?>">
                                <?php if(_permit("odeme-ayarlari")) { ?>
                               <li><i class="fas fa-money-bill"></i><a href="<?php echo $ayar->getpage('odeme-ayarlari');?>"> Ödeme Araçları <?php badge(5);?></a> </li>
                               <?php } if(_permit("iletisim-ayarlari")) { ?>
                               <li><i class="fas fa-phone"></i><a href="<?php echo $ayar->getpage('iletisim-ayarlari');?>"> İletişim Araçları</a></li>
                               <?php } ?>
                            </ul>
                        </li>
                        <?php } if(_permit("genel-ayarlar")) { ?>
                        <li>
                            <a href="<?php echo $ayar->getpage('genel-ayarlar');?>"><i class="fas fa-cog"></i>  Ayarlar</a>
                        </li>
                        <li class="mt-3" data-toggle="modal" data-target="#cachemodal">
                        	<a href="#"><i class="fas fa-save"></i> Cache Sistemi</a>
                        </li>
                        <?php } ?>
                    </ul>
                    </div><!-- /.navbar-collapse -->
                </nav>
            </aside>
            <div id="right-panel" class="right-panel">
                <header id="header" class="header">
                    <div class="top-left">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="<?php echo $ayar->getpage('yonetim');?>">
                              <div class="logo-ns">
                                <img class="dmlogo" src="<?php echo $ayar->panel;?>images/nslogo.png" alt="Logo">
                                <img class="lmlogo" src="<?php echo $ayar->panel;?>images/nslogo-w.png" alt="Logo">
                              </div>
                            </a>
                            <a onclick="MenuAc()" id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                            <div class="user-area dropdown float-right">
                                <script type="text/javascript">
                                    <?php if(isset($_COOKIE["panel-mod"]) AND $_COOKIE["panel-mod"]=="dark") { ?>
                                            var moonsun = document.getElementById("moonsun");
                                            moonsun.classList.toggle("kay");
                                    <?php } ?>
                                    function dark(islem) {
                                        if (islem==1) {
                                            action('dark');
                                            $('#moonsun').attr('onclick','dark(0)');
                                        } else {
                                            action('light');
                                            $('#moonsun').attr('onclick','dark(1)');
                                        }
                                        var dark = document.getElementById("body");
                                        dark.classList.toggle("dark");
                                        var moonsun = document.getElementById("moonsun");
                                        moonsun.classList.toggle("kay");
                                    }
                                </script>

                                <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img class="user-avatar rounded-circle" src="<?php echo $ayar->panel;?>images/admin.png" alt="User Avatar">
                                </a>
                                <div class="user-menu dropdown-menu">
                                    <a class="nav-link" href="<?php echo $ayar->getpage('profil');?>"><i class="fa fa -cog"></i><i class="fas fa-user-cog"></i> Profil Ayarları</a>
                                    <a class="nav-link" href="#" onclick="action('logout');"><i class="fa fa-power -off"></i><i class="fas fa-sign-out-alt"></i> Çıkış Yap</a>
                                </div>
                            </div>
                            <div class="header-left">
                                    
                                    <div class="dropdown mogiz">
                                        <div id="moonsun" 
                                    class="darkaydir <?php echo (isset($_COOKIE["panel-mod"]) AND $_COOKIE["panel-mod"]=="dark") ? 'kay':'';?>"
                                    onclick="dark(<?php echo (isset($_COOKIE["panel-mod"]) AND $_COOKIE["panel-mod"]=="dark") ? 0:1;?>)">
                                        <div class="dakaydi">
                                        <i class="fas fa-moon night-mon"></i>
                                        <i class="fas fa-sun night-moff"></i>
                                        </div>
                                    </div>
                                            <a class="btn btn-secondary dropdown-toggle pr-0" target="_blank" href="<?php echo ns_filter('siteurl');?>"><i class="fas fa-home"></i></a>
                                    </div>
                                    <div class="dropdown for-notification">
                                    <?php 
                                    $bildirimler = $nsoft->noti($bildirim);
                                    if (isset($bildirimler["count"]) AND $bildirimler["count"]>0) { ?>
                                        <button id="alert-noti-delete" class="btn btn-secondary dropdown-toggle ns-alert-button" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php } else { ?>
                                    <button class="btn btn-secondary dropdown-toggle ns-alert-button" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php } ?>
                                    <i class="fa fa-bell bell"></i>
                                    <?php if (isset($bildirimler["count"]) AND $bildirimler["count"] > 0) { ?>
                                    <span class="count bg-danger" id="alert-count"><?php echo $bildirimler["count"];?></span>
                                    <?php } ?>
                                    </button>
                                    <div class="dropdown-menu ns-notification-scroll" aria-labelledby="notification" style="padding: 20px">
                                        <?php 
                                        foreach ($bildirimler["list"] as $value) {
                                        extract($value);
                                        if(!isset($lastid))
                                            $lastid = $value["id"]; ?>
                                       <div class="padu-li <?php echo $bildirim < $id ? 'okunmadiclass':'';?>">
                                            <p>
                                            <span class="padu-date"><?php echo $siparis->zamanfarki($date);?></span>
                                            <i class="<?php echo $icon;?>"></i> <?php echo $text;?></p>
                                            <?php echo !empty($url) ? '<a target="_blank" href="'.$url.'" class="butto butto-dark butbor ml-3">Ayrıntılar</a>':'';?>
                                       </div>
                                       <?php } ?>
                                    </div>
                                </div>
                                </div>
                        </div>
                    </div>
                </header>
                <form id="action">
                    <input type="hidden" id="a-name" name="">
                    <input type="hidden" name="BildirimID" value="<?php echo $lastid;?>">
                </form>
                <?php if(_permit("genel-ayarlar")) { ?>
                <div class="modal fade" id="cachemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                	<div class="modal-dialog" role="document">
                		<div class="modal-content">
                			<div class="card mb-0">
                				<div class="card-header">
                					<div class="box-title w-100">Cache Ayarları
                						<div class="float-right">
                							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									          <span aria-hidden="true">&times;</span>
									        </button>
                						</div>	
                					</div>
                				</div>
                				<div class="card-body">
                					<form id="ns_cache" method="POST" action="" onsubmit="fastpost('ns_cache','ajaxout'); return false;">
                                        <input type="hidden" name="page" value="genel-ayarlar">
                                        <input type="hidden" name="olay" value="ns_cache">
                						<div class="form-group">
                							<label class="font-weight-bold">Önbellekleme</label>
                							<select class="form-control" name="statu">
                                                <option value="1" <?php echo ns_filter('ns_cache','statu')=="1" ? 'selected=""':'';?>>Aktif</option>
                                                <option value="0" <?php echo ns_filter('ns_cache','statu')=="0" ? 'selected=""':'';?>>Pasif</option>
                                            </select>
                						</div>
                						<div class="w-100 text-center">
                							<button type="submit" class="butto butto-lg butto-success butbor mt-3"><i class="fas fa-check" aria-hidden="true"></i> Kaydet</button>
                						</div>
                						<div class="clear"></div>
                					</form>
                					<div class="alert alert-light">
                						Cache(önbellekleme) işlemi sitenizde bulunan kısımları belleğe alarak sayfa geçişlerinde hızlı yüklenmesini sağlar. Önbellekleme aktif ise yaptığınız değişiklikler gözükmeyebilir. Değişikliklerin gözükmesi için önbelleği temizlemeniz gerekmektedir.
                					</div>
                					<?php if(ns_filter('ns_cache','statu')) { ?>
                        			<form id="header_cache" method="POST" action="" onsubmit="fastpost('header_cache','ajaxout'); return false;">
                        				<input type="hidden" name="page" value="genel-ayarlar">
                        				<input type="hidden" name="olay" value="cache-clear">
                        				<button class="butto butto-light butto-lg butbor w-100 mt-2 mb-3" target="_blank">Önbelleği Temizle</button>
                        			</form>
                        			<?php } ?>
                				</div>
                			</div>
                		</div>
                	</div>
                </div>
                <?php } ?>