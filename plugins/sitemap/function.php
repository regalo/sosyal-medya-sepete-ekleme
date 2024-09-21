<?php
if (isset($db)) {
add_action('plugin','sitemap','HTML_SitemapCreate');
add_action('admin_menu','plugin', 'Sitemap Ayarları','sitemap');
$primary = "sitemap";
function HTML_SitemapCreate() {
    global $ayar,$nsoft;
    $ayar->sitemap = file_exists("sitemap.xml");
    if ($_POST) {
        global $post;
        global $alert;
        $nsoft->detail('plugin',"sitemap");
        if(isset($post["olay"]) AND $post["olay"]=="SitemapSetting"){
            if($post["sitemap"] AND !$ayar->sitemap)
                SitemapGenerate("now");
                else if(!$post["sitemap"] AND $ayar->sitemap)
                    unlink("sitemap.xml");
            $ayar->select('SitemapSetting');
            foreach ($post as $key => $value) {
                $ayar->$key = $value;
            }
            $ayar->update();
            $alert->header = "İşlem Başarılı";
            $alert->content = "Sitemap ayarlarınız başarıyla kaydedildi.";
            $alert->action = "reload";
            include_once "panel/pages/alert.php";
            exit;
        } if(isset($post["olay"]) AND $post["olay"]=="SitemapUpdate"){
            SitemapGenerate("now");
            $alert->header = "Sitemap Güncellendi";
            $alert->content = "İsteğiniz üzerine sitemap dosyanız güncellendi.";
            $alert->action = "close";
            include_once "panel/pages/alert.php";
            exit;
        }
    }  ?>
        <div class="card">
            <div class="card-header">
                <form id="SitemapUpdate" method="POST" action="" onsubmit="fastpost('SitemapUpdate','ajaxout'); return false;">
                    <input type="hidden" name="page" value="plugin">
                    <input type="hidden" name="olay" value="SitemapUpdate">
                    <strong class="box-title">Sitemap Eklenti Ayarları</strong>
                    <?php if($ayar->sitemap) { ?>
                        <a target="_blank" href="<?php echo ns_filter('siteurl').'sitemap.xml';?>" title="Sitemap Görüntüle" class="butto butto-primary butto-xs butbor pull-right ml-2"><i class="fas fa-external-link-alt"></i></a>
                        <button type="submit" class="butto butto-secondary butto-xs butbor pull-right">GÜNCELLE</button>
                    <?php } ?>
                </form>
            </div>
            <div class="card-body">
                 <form id="SitemapSetting" method="POST" action="" onsubmit="fastpost('SitemapSetting','ajaxout'); return false;">
                    <input type="hidden" name="page" value="plugin">
                    <input type="hidden" id="olay" name="olay" value="SitemapSetting">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-control-label font-weight-bold">Sitemap Durumu</label>
                            <select class="form-control" name="sitemap">
                                <option value="1" <?php echo $ayar->sitemap ? 'selected=""':'';?>>Aktif</option>
                                <option value="0" <?php echo !$ayar->sitemap ? 'selected=""':'';?>>Pasif</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-control-label font-weight-bold">Sitemap Güncelleme Döngüsü</label>
                            <select class="form-control" name="statu">
                                <option value="60" <?php echo ns_filter('SitemapSetting','statu')=="60" ? 'selected':'';?>>Saate Bir</option>
                                <option value="1440" <?php echo ns_filter('SitemapSetting','statu')=="1440" ? 'selected':'';?>>Günde Bir</option>
                                <option value="4320" <?php echo ns_filter('SitemapSetting','statu')=="4320" ? 'selected':'';?>>Üç Günde Bir</option>
                                <option value="21600" <?php echo ns_filter('SitemapSetting','statu')=="21600" ? 'selected':'';?>>Onbeş Günde Bir</option>
                                <option value="43200" <?php echo ns_filter('SitemapSetting','statu')=="43200" ? 'selected':'';?>>Ayda Bir</option>
                            </select>
                        </div>
                        <div class="col-md-12 text-right mt-3">
                            <button type="submit" class="butto butto-success butto-lg butbor pull-right"><i class="fas fa-check"></i> Kaydet</button>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="alert alert-light">
                                <p>Platformlar, kategoriler ve içerikler site haritasına otomatik olarak eklenir. Ayarlar / Seo ve Sayfa Ayarları bölümünde sipariş sayfası ayarlarında indexlemeye izin verirseniz paket linkleride sitemapa eklenecektir. Ayrıca iletisim ve blog list linkleri içinde yine aynı bölümdeki ayarlardan indexlemeye izin ver demeniz gerekmektedir.</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
<? } 
function SitemapGenerate($type = "rutin") {
    if ($type=="rutin" AND file_exists("sitemap.xml")) {
        if(date("Y-m-d H:i:s") < date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s',filectime("sitemap.xml")) . "+".ns_filter('SitemapSetting','statu')." minute")))
            return false;
    }
    if ($type=="rutin" AND !file_exists("sitemap.xml"))
        return false;
    global $ayar,$db;
    $platform = new Platform($db);
        $kategori = new Kategori($db);
                $paket = new Paket($db);
    $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
    $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    $sitemaplist[] = ns_filter('siteurl');
    if (!ns_filter('blogpage','statu'))
        $sitemaplist[] = ns_filter('siteurl').$ayar->blogpage.'/';
    if (!ns_filter('iletisimpage','statu'))
        $sitemaplist[] = ns_filter('siteurl').$ayar->iletisimpage.'/';
    
    foreach ($platform->all(0,100) as $value) {
        $sitemaplist[] = ns_filter('siteurl').$value["pt_primary"].'/';
        $kategori->pt_tax = $value["pt_id"];
        foreach ($kategori->all(0,1000) as $hz) {
            if (ns_filter('permalink')=="default")
                $sitemaplist[] = ns_filter('siteurl').$value["pt_primary"].'/'.$hz["hz_pri"].'/';
                else
                    $sitemaplist[] = ns_filter('siteurl').$hz["hz_pri"].'/';
            if (!ns_filter('siparispage','statu')) {
                $paket->hz_id = $hz["hz_id"];
                foreach ($paket->all(0,5000) as $pk) {
                    $sitemaplist[] = ns_filter('siteurl').ns_filter('siparispage').'/'.$pk["pk_pri"].'/';
                }
            }
        }
    }
    $icerik = new Icerik($db);
    foreach ($icerik->all(0,50000) as $value) {
        $icerik->sayfa_id = $value["sayfa_id"];
        $icerik->select();
        if ($icerik->sayfa_icon=="sayfa")
            $sitemaplist[] = ns_filter('siteurl').$icerik->sayfa_primary.'/';
            else
                $sitemaplist[] = ns_filter('siteurl').'blog/'.$icerik->sayfa_primary.'/';
                
    }
    foreach (array_unique($sitemaplist, SORT_REGULAR) as $value) {
    $sitemap .= '<url>
                  <loc>'.$value.'</loc>
                  <lastmod>'.date("Y-m-d").'</lastmod>
                </url>';
    }
    $sitemap .= '</urlset>';
    $save = fopen('sitemap.xml', 'w') or die("Unable to open file!");
    fwrite($save, $sitemap);
    fclose($save);
    return true;
    
}
add_filter('cronjob', 'SitemapGenerate');
}