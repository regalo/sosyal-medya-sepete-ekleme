<?php
if(!isset($siparis)): 
    $siparis = new Siparis($db); 
endif;
if (isset($post["olay"])) {
    $siparis->search = $post["olay"];
    $list = $siparis->all(0,150);
    $say = 1;
      foreach ($list as $isle) {
        $siparis->durum($isle["sp_durum"]); ?>
    <tr <?php if ($say%2==1) { echo 'class="tb-grey"';}?> id="liste-<?php echo $isle["sp_id"];?>">
        <td><a href="<?php echo  $ayar->getpage('siparisler',$isle["sp_durum"]);?>" class="btn buttosi butto butto-<?php echo $siparis->sbutton;?> btn-statu btn-xs"><?php echo $siparis->stext;?></a></td>
        <td><?php echo $isle["sp_code"];?></td>
        <td><?php echo $siparis->zamanfarki($isle["sp_time"]);?></td>
        <td><?php echo $isle["sp_musteri_adi"];?></td>
        <td><?php echo $isle["sp_paket_adi"];?></td>
        <td><?php echo $isle["sp_musteri_tutar"];?> TL</td>
        <td><?php echo $siparis->yontem($isle["sp_odeme"]);?></td>
        <td><a href="<?php echo $ayar->getpage('siparis', $isle["sp_id"]);?>" class="butto butto-xs badge-primary butbor sip-detayi d-inline-block"><i class="fas fa-layer-group"></i> Detay</a></td>
    </tr>
 <?php }
 exit();
}
if (isset($ayar->action)) {
    $siparis->action = $ayar->action;
} else {
    $siparis->action = NULL;
}
$siparis->tur();
$records_per_page = 20;
if (isset($get["p"])) {
    $page = $get["p"];
} else {
    $page = 1;
}
$from_record_num  = $page*$records_per_page-$records_per_page;
$list = $siparis->all($from_record_num ,$records_per_page);
$total_rows = $siparis->count();
?>
<div class="content" id="alan">
    <div class="animated fadeIn" id="scrolling">
        <?php if ($page_con=="main") { ?>
           <div class="panel-detail-list">
            <div class="pdl-item mcay">
                <div class="card pc-mb0">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-1">
                                <i class="fas fa-turkish-lira-sign"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <?php if(!isset($siparis)): $siparis = new Siparis($db); endif;
                                    $kazanc = in_array("siparisler", $user->permit) ? $siparis->kazanc():0; ?>
                                    <div class="stat-text"><?php echo _p($kazanc);?></div>
                                    <div class="stat-heading">Bu ay</div>
                                </div>
                            </div>
                        </div>
                        <?php if(in_array("siparisler", $user->permit)) { ?>
                        <div class="gain-filter">
                            <i class="far fa-calendar-alt" data-toggle="modal" data-target="#kazanc"></i>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="pdl-item mcay curs" onclick="location.href='<?php echo $ayar->getpage('siparisler','acik');?>'">
                <div class="card pc-mb0">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-2">
                                <i class="fas fa-spinner"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count"><?php echo in_array("siparisler", $user->permit) ? $siparis->count('acik'):'0';?></span> Adet</div>
                                    <div class="stat-heading">Açık Sipariş</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pdl-item mcay curs" onclick="location.href='<?php echo  $ayar->getpage('iletisim');?>'">
                <div class="card pc-mb0">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-3">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count"><?php echo _permit("iletisim") ? $iletisim->count('0'):'0';?></span> Adet</div>
                                    <div class="stat-heading">Mesaj</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pdl-item mcay curs" onclick="location.href='<?php echo $ayar->getpage('odemeler');?>'">
                <div class="card pc-mb0">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-4">
                                <i class="fas fa-university"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count"><?php echo in_array("odemeler", $user->permit) ? $odeme->count('acik'):'0';?></span> Adet</div>
                                    <div class="stat-heading">Ödeme Bildirimi</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="orders">
            <div class="row">
                <div class="clear"></div>
                <div class="col-lg-12">
                    <form class="input-group mb-2 mr-sm-2" id="siparis-search" method="POST" action="" onsubmit="return false;">
                        <input type="hidden" name="page" value="siparisler">
                        <input type="text" class="form-control aramabuut" name="olay" placeholder="Arama Yapın.. (Sipariş Kodu, Ad Soyad)" onkeyup="ordersearch(this)">
                    </form>
                    <div class="card" id="normalalan">
                        <div class="card-header">
                            <div class="bol-5">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  id="realy-head">
                                <strong class="box-title"><?php echo $siparis->tur;?></strong>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  id="search-head" style="display: none;">
                                <strong class="box-title">Arama Sonuçları</strong>
                            </a>
                              <div class="dropdown-menu btn-sec">
                                <a class="dropdown-item" href="<?php echo $ayar->getpage('siparisler');?>">TÜM SİPARİŞLER</a>
                                <a class="dropdown-item d-block" href="<?php echo $ayar->getpage('siparisler', '0');?>">ÖDEME BEKLEYENLER <span class="badge badge-warning pull-right"><?php echo in_array("siparisler", $user->permit) ? $siparis->count("0"):0 ;?></span></a>
                                <a class="dropdown-item d-block" href="<?php echo  $ayar->getpage('siparisler', 1);?>">İŞLEM BEKLEYENLER <span class="badge badge-primary pull-right"><?php echo in_array("siparisler", $user->permit) ? $siparis->count("1"):0 ;?></span></a> 
                                <a class="dropdown-item d-block" href="<?php echo  $ayar->getpage('siparisler', 2);?>">İŞLEM SIRASINDAKİLER <span class="badge badge-secondary pull-right"><?php echo in_array("siparisler", $user->permit) ? $siparis->count("2"):0 ;?></span></a> 
                                <a class="dropdown-item d-block" href="<?php echo  $ayar->getpage('siparisler', 3);?>">KISMİ TAMAMLANANLAR <span class="badge badge-secondary pull-right"><?php echo in_array("siparisler", $user->permit) ? $siparis->count("3"):0 ;?></span></a> 
                                <a class="dropdown-item" href="<?php echo $ayar->getpage('siparisler', 4);?>">TAMAMLANANLAR</a> 
                                <a class="dropdown-item" href="<?php echo $ayar->getpage('siparisler', 5);?>">İPTAL EDİLENLER</a> 
                                <a class="dropdown-item d-block" href="<?php echo  $ayar->getpage('siparisler', 6);?>">TAMAMLANAMAYANLAR <span class="badge badge-danger pull-right"><?php echo in_array("siparisler", $user->permit) ? $siparis->count("6"):0 ;?></span></a> 
                                <a class="dropdown-item" href="<?php echo $ayar->getpage('siparisler', 8);?>">ARŞİVLENEN SİPARİŞLER</a>
                                <a class="dropdown-item" href="<?php echo $ayar->getpage('siparisler', 10);?>">DİĞER SİPARİŞLER</a>
                              </div>
                            </div>
                            <div class="bol-5">
                               <a href="<?php echo  $ayar->getpage('siparisler');?>" class="butto butto-success butto-xs butbor float-right">Tüm Siparişler</a>
                           </div>
                        </div>
                        <div class="table-stats order-tumu order-table ov-h" id="tb-scroll">
                            <table class="table orders-list" id="orders-list">
                                <thead>
                                    <tr>
                                        <th>DURUM</th>
                                        <th>SİPARİŞ KODU</th>
                                        <th>SİPARİŞ ZAMANI</th>
                                        <th>AD SOYAD</th>
                                        <th>HİZMET</th>
                                        <th>TUTAR</th>
                                        <th>ÖDEME</th>
                                        <th>İŞLEM</th>
                                    </tr>
                                </thead>
                                <tbody id="realy">
                                    <?php
                                    $say = 1;
                                    foreach ($list as $isle) {
                                        $siparis->durum($isle["sp_durum"]);
                                        if (in_array("siparisler", $user->permit)) { ?>
                                    <tr <?php if ($say%2==1) { echo 'class="tb-grey"';}?> id="liste-<?php echo $isle["sp_id"];?>">
                                        <td><a href="<?php echo  $ayar->getpage('siparisler',$isle["sp_durum"]);?>" class="btn buttosi butto butto-<?php echo $siparis->sbutton;?> btn-statu btn-xs"><?php echo $siparis->stext;?></a></td>
                                        <td><?php echo $isle["sp_code"];?></td>
                                        <td><?php echo $siparis->zamanfarki($isle["sp_time"]);?></td>
                                        <td><?php echo $isle["sp_musteri_adi"];?></td>
                                        <td><?php echo $isle["sp_paket_adi"];?></td>
                                        <td><?php echo _p($isle["sp_musteri_tutar"]);?></td>
                                        <td><?PHP echo $siparis->yontem($isle["sp_odeme"]);?></td>
                                        <td><a href="<?php echo  $ayar->getpage('siparis', $isle["sp_id"]);?>" class="butto butto-xs badge-primary butbor sip-detayi d-inline-block"><i class="fas fa-layer-group"></i> Detay</a></td>
                                    </tr>
                                   <?php } ?>
                                <?php  $say++;} ?>
                                </tbody>
                                <tbody id="search" style="display: none;">
                                </tbody>
                            </table>
                        </div> 
                        <?php include_once "page_na.php";?>
                    </div>
                    <div class="card" id="aramabolum" style="display: none;">
                    </div>
                </div>
            </div>
        </div>          
    </div>
</div>
<script type="text/javascript">
     setTimeout(function(){ ordersearch('.aramabuut') }, 200);
 </script>
 <div class="modal fade" id="kazanc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title d-inline font-weight-bold" id="exampleModalLabel">Kazanç Detayları</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="gfilts">
            <ul>
                <li>Dün <span><?php echo in_array("siparisler", $user->permit) ? _p($siparis->kazanc('beforeDay')):0;?></span></li>
                <li>Bugün <span><?php echo in_array("siparisler", $user->permit) ? _p($siparis->kazanc('day')):0;?></span></li>
                <li>Bu Ay <span><?php echo in_array("siparisler", $user->permit) ? _p($siparis->kazanc()):0;?></span></li>
                <li>Geçen Ay <span><?php echo in_array("siparisler", $user->permit) ? _p($siparis->kazanc('beforeMonth')):0;?></span></li>
                <li>Son 7 Gün <span><?php echo in_array("siparisler", $user->permit) ? _p($siparis->kazanc('last7Day')):0;?></span></li>
                <li>Son 30 Gün <span><?php echo in_array("siparisler", $user->permit) ? _p($siparis->kazanc('last30Day')):0;?></span></li>
                <li>Tüm Zamanlar <span><?php echo in_array("siparisler", $user->permit) ? _p($siparis->kazanc('allTimes')):0;?></span></li>
            </ul>
        </div>
      <div class="modal-footer">
        <button type="button" class="butto butto-light butbor butto-lg" data-dismiss="modal">Kapat</button>
      </div>
    </div>
  </div>
</div>
 