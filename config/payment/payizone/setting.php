<div class="tab-pane fade <?php if(ns_filter($method)=="payizone") { echo "active show";}?>" id="pills-<?php echo $value["folder"].'-'.$method;?>" role="tabpanel" aria-labelledby="pills-<?php echo $value["folder"].'-'.$method;?>-tab">
    <form id="<?php echo $value["folder"].'-'.$method;?>" method="POST" action="" onsubmit="fastpost('<?php echo $value["folder"].'-'.$method;?>','ajaxout'); return false;">
        <input type="hidden" name="page" value="odeme-ayarlari">
        <input type="hidden" id="olay" name="olay" value="<?php echo $method;?>">
        <div class="row">
            <div class="form-group col-md-6">
                <label class="form-control-label font-weight-bold">API KEY</label>
                <input class="form-control" name="item3" required="" value="<?php echo ns_filter($method,"item2")=="payizone" ? ns_filter($method,"item3"):'';?>">
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label font-weight-bold">API SECRET KEY </label>
                <input class="form-control" name="item4" required="" value="<?php echo ns_filter($method,"item2")=="payizone" ? ns_filter($method,"item4"):'';?>">
            </div>
            <div class="col-md-12 text-right mt-3">
                <input type="hidden" name="item2" value="payizone">
                <input type="hidden" name="item5" value="">
                <input type="hidden" name="statu" value="1">
                <button  type="submit" class="butto butto-success butto-lg butbor pull-right"><i class="fas fa-check"></i> Kaydet</button>
            </div>
        </div>
    </form>
</div>