<div class="modal-body">
    <div class="container">
        <div class="sorgusss row">
            <div class="col-md-8 offset-md-2 pl-0 pr-0">
                <div class="kapabut text-center">
                    <i class="fas fa-times-circle" id="_statuclose" data-dismiss="modal" style="border: none;cursor: pointer;font-size: 25px;"></i>
                </div>
                <div class="sorgualan text-center">
                    <form id="order_search" method="POST" onsubmit="orderstatu(this); return false;">
                        <input type="hidden" name="action" value="response">
                        <input type="hidden" name="include" value="order_search">
                        <h2 class="font-weight-bold"><?php _e("Sipariş Sorgulama");?></h2>
                        <p class="mb-3"><?php _e("Siparişiniz hakkında bilgi edinmek için lütfen aşağıda bulunan alana sipariş numaranızı girin");?>.</p>
                        <input type="text" required="" class="keskin" name="sp_code" <?= isset($post["sp_code"]) ? 'value="'.$post["sp_code"].'"':'';?> placeholder="<?php _e("Sipariş Numarası Giriniz");?>">
                        <button type="submit" id="order_search_btn" class="btn sorgubut xrb keskin"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <? if (isset($post["include"])) {
                    if (isset($siparis->sp_id)) {
                        echo '<script> document.location.href="'.ns_filter('siteurl').$ayar->siparispage.'/'.md5($post["sp_code"]).'/"'.';</script>';
                } else { ?>
                        <div class="sorgusonuc text-center">
                            <h2>#<?php echo $post["sp_code"];?></h2>
                            <h3 class="font-weight-bold"><?php _e("SİPARİŞ BULUNAMADI");?></h3>
                        </div>
                    <? } } ?>
            </div>
        </div>
    </div>
</div>
<? isset($post["include"]) ? exit:'';?>