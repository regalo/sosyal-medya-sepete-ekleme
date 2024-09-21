<?php
if($_POST) {echo '<script>location.reload();</script>'; exit;}
if( isset( $_SERVER["HTTP_CLIENT_IP"] ) ) {
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    } elseif( isset( $_SERVER["HTTP_X_FORWARDED_FOR"] ) ) {
        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    } else {
        $ip = $_SERVER["REMOTE_ADDR"];
    }

	$user_ip=$ip;  // !!! Eğer bu kodu sunucuda değil local makinanızda çalıştırıyorsanız buraya dış ip adresinizi(https://www.whatismyip.com/) yazmalısınız.

	$email = trim($post["sp_musteri_mail"]);
	$payment_amount	= $post["sp_musteri_tutar"]*100;
	$merchant_oid = $post["sp_code"]."T".time();
	$payment_type='eft';
	$debug_on=1;//hata mesajlarını ekrana bas

	## İşlem zaman aşımı süresi - dakika cinsinden
	$timeout_limit = "30";

    ## Mağaza canlı modda iken test işlem yapmak için 1 olarak gönderilebilir
    $test_mode = 0;
	
	$hash_str=$merchant_id.$user_ip.$merchant_oid.$email.$payment_amount.$payment_type.$test_mode;
	$paytr_token=base64_encode(hash_hmac('sha256',$hash_str.$merchant_salt,$merchant_key,true));
	
	$post_vals=array(
		'merchant_id'=>$merchant_id,
		'user_ip'=>$user_ip,
		'merchant_oid'=>$merchant_oid,
		'email'=>$email,
		'payment_amount'=>$payment_amount,
		'payment_type'=>$payment_type,
		'paytr_token'=>$paytr_token,
		'debug_on'=>$debug_on,
		'timeout_limit'=>$timeout_limit,
        'test_mode'=>$test_mode,
        'lang'=>explode("_", $language)[0]
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
	{
		die("PAYTR EFT IFRAME connection error. err:".curl_error($ch));
	}
	curl_close($ch);
		
	$result=json_decode($result,1);

	/*
		Başarılı yanıt örneği: (token içerir)
		{"status":"success","token":"28cc613c3d7633cfa4ed0956fdf901e05cf9d9cc0c2ef8db54fa"}

		Başarısız yanıt örneği:
		{"status":"failed","reason":"Zorunlu alan degeri gecersiz: merchant_id"}
	*/
		
	if($result['status']=='success')
	{
		$token=$result['token'];
	}
	else
	{
		die("PAYTR EFT IFRAME failed. reason:".$result['reason']);
	}
	
	?>
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" />
    <script src="https://www.paytr.com/js/iframeResizer.min.js"></script>
    <iframe src="https://www.paytr.com/odeme/api/<?php echo $token;?>" id="paytriframe" frameborder="0" scrolling="no" style="width: 100%;"></iframe>
	<script>iFrameResize({},'#paytriframe');</script>