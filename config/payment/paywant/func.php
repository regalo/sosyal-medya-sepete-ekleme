<?php 
$apiKey = ns_filter('payment_company','setting')["item3"];
$apiSecret = ns_filter('payment_company','setting')["item4"];
$odemekanali = ns_filter('payment_company','setting')["item5"];
if(isset($post["SiparisID"])) {
      $SiparisID = $post["SiparisID"];
      $ExtraData = $post["ExtraData"];
	  $post = $_POST;
      $UserID = $post["UserID"];
      $ReturnData = $post["ReturnData"];
      $Status = $post["Status"];
      $OdemeKanali = $post["OdemeKanali"];
      $OdemeTutari = $post["OdemeTutari"];
      $NetKazanc = $post["NetKazanc"];
      $Hash = $post["Hash"];
      if($SiparisID == "" || $ExtraData == "" || $UserID == "" || $ReturnData == "" || $Status == "" || $OdemeKanali == "" || $OdemeTutari == "" || $NetKazanc == "" || $Hash == "")
      exit("eksik veri");
     $hashKontrol = base64_encode(hash_hmac('sha256',"$SiparisID|$ExtraData|$UserID|$ReturnData|$Status|$OdemeKanali|$OdemeTutari|$NetKazanc".$apiKey,$apiSecret,true));
     if($Hash != $hashKontrol)
        exit("hash hatali");
        if($Status == "100"){
            $siparis->sp_code = $ExtraData;
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
        }
        exit("OK");
} else {
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
    return $ip;
}
$userID         = $siparis->paywantid($post["sp_musteri_mail"])+150; 
$userEmail      = $post["sp_musteri_mail"]; 
$userIPAdresi   = getIPAddress();
$hashOlustur    = base64_encode(hash_hmac('sha256',"$userEmail|$userEmail|$userID".$apiKey,$apiSecret,true));
$postData = array(
    'apiKey' => $apiKey,
    'hash' => $hashOlustur,
    'returnData'=> $userEmail,
    'userEmail' => $userEmail,
    'userIPAddress' => $userIPAdresi,
    'userID' => $userID,
    'proApi' => TRUE,
    'productData' => [
        "name" =>  $post["sp_code"]." Sipariş Ödemesi",
        "amount" => $post["sp_musteri_tutar"] * 100,
        "extraData" => $post["sp_code"],
        "paymentChannel" => !empty($odemekanali) ? $odemekanali:2, // 1 Mobil Ödeme, 2 Kredi Kartı,3 Banka Havale/Eft/Atm,4 Türk Telekom Ödeme (TTNET),5 Mikrocard,6 CashU
        "commissionType" => 1 // 1 seçilirse komisyonu bizden al, 2 olursa komisyonu müşteri ödesin
    ]
);
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "http://api.paywant.com/gateway.php",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => http_build_query($postData),
));
$response = curl_exec($curl); $err = curl_error($curl);
curl_close($curl);
if ($err){
    echo $err;
} else {
    $jsonDecode = json_decode($response);
    if($jsonDecode->Status == 100){
    $git = $jsonDecode->Message;
    header("Location:$git");
    exit;
    } else {
        echo $response;
    }
}  } ?>