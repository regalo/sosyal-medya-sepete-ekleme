<?php
if (isset($payment)) {
    include_once ns_filter('payment_company','file');
} else {
$payment_medhods = $ayar->OdemeFirma();
if (is_array($payment_medhods)) {
    foreach ($payment_medhods as $value) {
        extract($value);
        if ((!isset($post["sp_odeme"]) AND $statu==2) OR isset($post["sp_odeme"]) AND $post["sp_odeme"]==$id) {
            $payment_method = $id;
            $payment_info = $hizmet_bedeli["item4"];
        }
    }
}
$ajax = array(
    "coupon" => $coupon_code,
    "coupon_code" => $coupon_code ? strtoupper($post["sp_musteri_kupon"]):'',
    "coupon_button_class" => $coupon_code ? 'coupon_code_click btn btn-kpn-uyg keskin xrb':'coupon_code_click btn btn-kpn-uyg keskin xrb',
    "coupon_button_text" => $coupon_code ? _e("KALDIR",true):_e("UYGULA",true),
    "payment_info" => !empty($payment_info) ? $payment_info:false,
    "payment_method" => $payment_method,
    "total_amount" => _p(ns_filter('toplam_tutar')),
    "product_amount" => _p(ns_filter('paket','pk_fiyat')),
    "service_amount" => _p(ns_filter('hizmet_tutari')),
    "discount_amount" => _p(ns_filter('kupon_indirim'))
     );
exit(json_encode($ajax));
}