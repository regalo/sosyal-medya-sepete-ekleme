<?php
$merchant_id 	= ns_filter('payment_company','setting')["item3"];
$merchant_key 	= ns_filter('payment_company','setting')["item5"];
$merchant_salt	= ns_filter('payment_company','setting')["item4"];
if (isset($post['merchant_oid']) AND isset($post['total_amount'])) {
	$post = $_POST;
	$hash = base64_encode( hash_hmac('sha256', $post['merchant_oid'].$merchant_salt.$post['status'].$post['total_amount'], $merchant_key, true) );
	if($hash != $post['hash'])
		die('PAYTR notification failed: bad hash');
	if($post['status'] == 'success') {
		$siparis->sp_code = explode("T", $post['merchant_oid'])[0];
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
		    exit("OK");
		}
	    exit("OK");
	}
	exit("OK");
} else if(isset($post["sp_code"])) {
	if(ns_filter('payment_company','setting')["item1"]=="onlinepay") {
		require "online.php";
	} else {
		require "eft.php";
	}
} else {
	echo "Bu url paytr panelinden geribildirim url'i alanına girilmelidir. Bu şekilde ziyaret edildiğinde herhangi bir aksiyon alınmaz";
} ?>