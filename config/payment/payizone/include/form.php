<link rel="stylesheet" href="<?php echo ns_filter("siteurl");?>config/payment/payizone/assets/payizone.css">
<div class="payizorOdemeForm">
    <div id="payizoneAlert" class="alert" style="<?php echo !isset($payizone->error) ? 'display: none;':'';?>">
        <span class="closebtn" onclick="$('#payizoneAlert').hide();">&times;</span>
        <p class="m-0 p-0"><b><?php echo isset($payizone->error) ? $payizone->error["head"]:'';?>:</b> <?php echo isset($payizone->error) ? $payizone->error["text"]:'';?></p>
        
        
    </div>
    <?php if(!empty($payizone->token)){ ?>
    <form class="payizoneAjaxForm">
        <div class="pgBack">
            <label for="ccnum"><?php _e("kart-numarası");?></label>
            <input type="text" id="payizorOdemeFormccnum" name="ccnum"
            name="kartno"
            required placeholder="<?php _e("kart-numarası");?>">
            <div class="inpGrid">
                <div class="GridItem">
                    <label for="expyear"><?php _e("son-kullanma-tarihi");?></label>
                    <input type="text" id="payizorOdemeFormexp" name="exp" required
                    placeholder="<?= date('m') ?>/<?= date('Y') ?>">
                </div>
                <div class="GridItem">
                    <label for="cvv"><?php _e("cvv");?></label>
                    <input type="text" id="payizorOdemeFormcvv" name="cvv" required
                    placeholder="000">
                </div>
            </div>
            <label for="cname"><?php _e("kart-sahibi-ad-soyad");?></label>
            <input type="text" id="cname" name="cardname" required
            placeholder="<?php _e("adiniz-soyadiniz");?>">
            <label for="installment_number"><?php _e("taksit-sayisi");?></label>
            <select name="installment_number" required  disabled>
                <option value="1"><?php _e("tek-cekim");?></option>
            </select>
            <input type="hidden" name="orderToken" value="<?php echo $payizone->orderToken;?>">
            <input type="hidden" name="paymentToken" required value="">
            <input type="hidden" name="json" value="pay3D">
            <button type="submit" disabled class="pzSubmitBTN"><?php _e("odemeyi-tamamla");?> (<?php echo $payizone->amount;?>)</button>
        </div>
    </form>
    <div class="securityBox">
        <img class="logo" src="<?php echo ns_filter("siteurl");?>config/payment/payizone/img/payizone.png" alt="">
        <img class="security" src="<?php echo ns_filter("siteurl");?>config/payment/payizone/img/footer_i.png" alt="Payizone Güvenli Ödeme Sistemi">
    </div>
    <?php } ?>
</div>
<script src="<?php echo ns_filter("siteurl");?>config/payment/payizone/assets/payizone.js?version=2" type="application/javascript"></script>
<script type="text/javascript">
    paymentPart = "<?php echo ns_filter("siteurl").'payment/payizone/';?>";
    oneShot = "<?php _e("tek-cekim");?>";
    
</script>
<style type="text/css">
    .loadAjaxBefore {
        box-shadow: 0 4px 10px 0 rgb(33 33 33 / 15%);
        border-radius: 4px;
        position: relative;
        overflow: hidden;
        opacity: .4;
        cursor: not-allowed !important;
        pointer-events: none;
    }
</style>