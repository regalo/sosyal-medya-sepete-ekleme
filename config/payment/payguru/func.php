<?php
$postData["merchantId"] = ns_filter('payment_company','setting')["item3"];
$postData["serviceId"] = ns_filter('payment_company','setting')["item4"];
$postData["key"] = ns_filter('payment_company','setting')["item5"];
if (isset($post["merchant"]) AND $post["merchant"] == $postData["merchantId"] AND $post["service"] == $postData["serviceId"] AND $post["statusDescription"] AND ns_filter('mobilepay')=="payguru") {
	$siparis->sp_code = $post["order"];
	if ($siparis->select() AND ($siparis->sp_durum == 10 OR $siparis->sp_durum == 0)) {
		$siparis->sp_durum = 1;
	    $siparis->update();
		if ($siparis->islem_turu=="otomatik" AND !empty($siparis->islem_smm)) {
			$api = !isset($api) ? new Api($db): $api;
	        $api->smm_id = explode("-", $siparis->islem_smm)[0];
	        $api->serviceid = explode("-", $siparis->islem_smm)[1];
	        if ($api->select()) {
	            $order = $api->order(array('service' => $api->serviceid, 'link' => $siparis->islem_adres, 'quantity' => $siparis->islem_miktar));
	            if (isset($order->order)) {
	                $siparis->panel_code = $order->order;
	                $siparis->sp_durum = 2;
	                $siparis->MailSMSList('yeni-siparis',true);
	            } else {
	            	$siparis->sp_durum = 1;
	            	$siparis->islem_turu = "manuel";
	            	$siparis->MailSMSList('yeni-siparis',true);
	            	$siparis->MailSMSList('tamamlanamadi');
	            }
	        } else {
	        	$siparis->sp_durum = 1;
	            $siparis->islem_turu = "manuel";
	            $siparis->MailSMSList('yeni-siparis',true);
	        }
		} else {
			$siparis->sp_durum = 1;
	        $siparis->sp_tur = "manuel";
	        $siparis->MailSMSList('yeni-siparis',true);
		}
	    $siparis->update();
	    $siparis->updateislem();
	    $git = ns_filter('siteurl').ns_filter('tamamlandipage').'/'.$siparis->sp_musteri_link.'/';
	    header("Location:$git");
	    exit("OK");
	}
    $git = ns_filter('siteurl').ns_filter('tamamlandipage').'/'.md5($siparis->sp_code).'/';
    header("Location:$git");
    exit("OK");
} elseif(isset($post["sp_code"])) {
	$postData["merchantId"] = ns_filter('payment_company','setting')["item3"];
	$postData["serviceId"] = ns_filter('payment_company','setting')["item4"];
	$postData["key"] = ns_filter('payment_company','setting')["item5"];
	$postData["referenceCode"] = $post["sp_code"];
	$postData["item"] = $post["sp_paket_adi"];
	$postData["price"] = $post["sp_musteri_tutar"];
	$postData["successUrl"] = ns_filter('siteurl').'payment/payguru/';
	$postData["failureUrl"] = ns_filter('siteurl').ns_filter('tamamlanmadipage').'/'.$post["sp_musteri_link"].'/';
	$postData["key"] = md5($postData["merchantId"].$postData["serviceId"].$postData["referenceCode"].$postData["item"].$postData["price"].$postData["successUrl"].$postData["failureUrl"].$postData["key"]);
	$curl = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_URL => "https://cp.payguru.com/token",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => http_build_query($postData),
	));
	$response = curl_exec($curl); 
	$err = curl_error($curl);
	curl_close($curl);
	$jsonDecode = json_decode($response, true);
	if ($jsonDecode["response"]["result"]=="SUCCESS") {
		$token = $jsonDecode["tokenData"]["redirectUrl"];
		header("Location:$token");
	} else {
		echo $jsonDecode["response"]["resultDescription"];
	}
}