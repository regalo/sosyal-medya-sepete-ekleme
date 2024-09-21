<div class="tab-pane fade <?php if(ns_filter($method)=="payguru") { echo "active show";}?>" id="pills-<?php echo $value["folder"].'-'.$method;?>" role="tabpanel" aria-labelledby="pills-<?php echo $value["folder"].'-'.$method;?>-tab">
    <form id="<?php echo $value["folder"].'-'.$method;?>" method="POST" action="" onsubmit="fastpost('<?php echo $value["folder"].'-'.$method;?>','ajaxout'); return false;">
        <input type="hidden" name="page" value="odeme-ayarlari">
        <input type="hidden" id="olay" name="olay" value="<?php echo $method;?>">
        <div class="row">
            <div class="form-group col-md-4">
                <label class="form-control-label font-weight-bold">Mercant ID</label>
                <input class="form-control" name="item3" required="" value="<?php if(ns_filter($method,"item2")=="payguru") { echo ns_filter($method,"item3");}?>">
            </div>
            <div class="form-group col-md-4">
                <label class="form-control-label font-weight-bold">Service ID</label>
                <input class="form-control" name="item4" required="" value="<?php if(ns_filter($method,"item2")=="payguru") { echo ns_filter($method,"item4");}?>">
            </div>
            <div class="form-group col-md-4">
                <label class="form-control-label">KEY</label>
                <input class="form-control" name="item5" required="" value="<?php if(ns_filter($method,"item2")=="payguru") { echo ns_filter($method,"item5");}?>">
            </div>
            <div class="form-group col-md-12">
                <label class="form-control-label font-weight-bold">Geri Bildirim Adresi <i class="fas fa-info-circle c-help" title="Geri Bildirim Adresi: ödeme sonrası, firmanın yönlendireceği url'dir. Geri Bildirim adresini ödeme firmasına eklenmezse, gelen siparişler panele düşmeyecektir."></i></label>
                <input class="form-control" readonly="" value="<?php echo ns_filter('siteurl').'payment/payguru/';?>">
            </div>
            <div class="form-group col-md-12">
                <div class="alert alert-danger text-center">
                    <p><b>DİKKAT!</b><br>Payguru entegrasyonu stabil çalışmamaktadır ödemelerin manuel kontrol edilip onaylanması gerekmektedir. Bu konu ilerleyen güncellemelerde çözülmeye çalışılacaktır.</p>
                </div>
            </div>
            <div class="col-md-12 text-right mt-3">
                <input type="hidden" name="item2" value="payguru">
                <input type="hidden" name="statu" value="1">
                <button  type="submit" class="butto butto-success butto-lg butbor pull-right"><i class="fas fa-check"></i> Kaydet</button>
            </div>
        </div>
    </form>
</div>