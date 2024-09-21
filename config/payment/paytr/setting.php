<div class="tab-pane fade <?php if(ns_filter($method)=="paytr") { echo "active show";}?>" id="pills-<?php echo $value["folder"].'-'.$method;?>" role="tabpanel" aria-labelledby="pills-<?php echo $value["folder"].'-'.$method;?>-tab">
    <form id="<?php echo $value["folder"].'-'.$method;?>" method="POST" action="" onsubmit="fastpost('<?php echo $value["folder"].'-'.$method;?>','ajaxout'); return false;">
        <input type="hidden" name="page" value="odeme-ayarlari">
        <input type="hidden" id="olay" name="olay" value="<?php echo $method;?>">
        <div class="row">
            <div class="form-group col-md-4">
                <label class="form-control-label font-weight-bold">Mağaza No</label>
                <input class="form-control" name="item3" required="" value="<?php if(ns_filter($method)=="paytr") { echo ns_filter($method,"item3");}?>">
            </div>
            <div class="form-group col-md-4">
                <label class="form-control-label font-weight-bold">Mağaza Parolası</label>
                <input class="form-control" name="item5" required="" value="<?php if(ns_filter($method)=="paytr") { echo ns_filter($method,"item5");}?>">
            </div>
            <div class="form-group col-md-4">
                <label class="form-control-label font-weight-bold">Mağaza Gizli Anahtar</label>
                <input class="form-control" name="item4" required="" value="<?php if(ns_filter($method)=="paytr") { echo ns_filter($method,"item4");}?>">
            </div>
            <div class="form-group col-md-12">
                <label class="form-control-label font-weight-bold">Geri Bildirim Adresi <i class="fas fa-info-circle c-help" title="Geri Bildirim Adresi: ödeme sonrası, firmanın yönlendireceği url'dir. Geri Bildirim adresini ödeme firmasına eklenmezse, gelen siparişler panele düşmeyecektir."></i></label>
                <input class="form-control" readonly="" value="<?php echo ns_filter('siteurl').'payment/paytr/';?>">
            </div>
            <div class="form-group col-md-12">
                <div class="alert alert-danger text-center">
                    <p class="mb-0">Bildirim url ilgili ödeme firmasının sipariş sonucunu sisteme gönderdiği urldir. İlgili ödeme firmasında gerekli alana girdiğinizden emin olun.</p>
                </div>
            </div>
            <div class="col-md-12 text-right mt-3">
                <input type="hidden" name="item2" value="paytr">
                <input type="hidden" name="statu" value="1">
                <button  class="butto butto-success butto-lg butbor pull-right"><i class="fas fa-check"></i> Kaydet</button>
            </div>
        </div>
    </form>
</div>