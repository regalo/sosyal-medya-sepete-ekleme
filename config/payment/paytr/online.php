<?php
if($_POST) {echo '<script>location.reload();</script>'; exit;}
    $email = trim($post["sp_musteri_mail"]);
	$payment_amount	= $post["sp_musteri_tutar"]*100;
	$merchant_oid = $post["sp_code"]."T".time();
	$user_name =  $post["sp_musteri_adi"];
	$user_address = $post["sp_musteri_adres"];
	$user_phone = trim($post["sp_musteri_telefon"]);
	$merchant_ok_url = ns_filter('siteurl').ns_filter('tamamlandipage').'/'.$post["sp_musteri_link"].'/';
	$merchant_fail_url = ns_filter('siteurl').ns_filter('tamamlanmadipage').'/'.$post["sp_musteri_link"].'/';
	$user_basket = base64_encode(json_encode(array(
		array($post["sp_paket_adi"], $post["sp_musteri_tutar"], "1") ))) ;
	function getIPAddress() {
    if(getenv("HTTP_CLIENT_IP")) {
        $ip = getenv("HTTP_CLIENT_IP");
    } elseif(getenv("HTTP_X_FORWARDED_FOR")){
        $ip = getenv("HTTP_X_FORWARDED_FOR");
        if (strstr($ip, ',')){
            $tmp = explode (',', $ip); $ip = trim($tmp[0]);
        }
    } else { 
        $ip = getenv("REMOTE_ADDR");
    }
    if(empty($ip)){
    	$ip = "112.145.545.11";
    }
    return $ip;
}
	$user_ip = getIPAddress();
	$timeout_limit = "30";
	$debug_on = 1;
    $test_mode = 0;
	$no_installment	= 0; // Taksit yapılmasını istemiyorsanız, sadece tek çekim sunacaksanız 1 yapın
	$max_installment = 0;
	$currency = ns_filter('currency');
	$hash_str = $merchant_id .$user_ip .$merchant_oid .$email .$payment_amount .$user_basket.$no_installment.$max_installment.$currency.$test_mode;
	$paytr_token=base64_encode(hash_hmac('sha256',$hash_str.$merchant_salt,$merchant_key,true));
	$post_vals=array(
			'merchant_id'=>$merchant_id,
			'user_ip'=>$user_ip,
			'merchant_oid'=>$merchant_oid,
			'email'=>$email,
			'payment_amount'=>$payment_amount,
			'paytr_token'=>$paytr_token,
			'user_basket'=>$user_basket,
			'debug_on'=>$debug_on,
			'no_installment'=>$no_installment,
			'max_installment'=>$max_installment,
			'user_name'=>$user_name,
			'user_address'=>$user_address,
			'user_phone'=>$user_phone,
			'merchant_ok_url'=>$merchant_ok_url,
			'merchant_fail_url'=>$merchant_fail_url,
			'timeout_limit'=>$timeout_limit,
			'currency'=>$currency,
			'lang'=>explode("_", $language)[0],
            'test_mode'=>$test_mode
		);
	
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://www.paytr.com/odeme/api/get-token");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1) ;
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_vals);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 20);
	$result = @curl_exec($ch);

	if(curl_errno($ch))
		die("PAYTR IFRAME connection error. err:".curl_error($ch));
	curl_close($ch);
	$result=json_decode($result,1);
	if($result['status']=='success'){
	$token=$result['token']; ?>
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" />
	<script src="https://www.paytr.com/js/iframeResizer.min.js"></script>
    <iframe src="https://www.paytr.com/odeme/guvenli/<?php echo $token;?>" id="paytriframe" frameborder="0" scrolling="no" style="width: 100%;"></iframe>
	<script>iFrameResize({},'#paytriframe');</script>
	<? } else { ?>	
	ÖDEME FIRMASI KAYNAKLI BİR PROBLEM OLUŞTU LÜTFEN FARKLI BİR ÖDEME YÖNTEMİ SEÇİN
	Hata Kodu: <?php echo $result['reason']; }