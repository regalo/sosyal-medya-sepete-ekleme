<?php 
class Payizone {
	public function __construct($request = []){
		$this->app_id = ns_filter("onlinepay","item3");
		$this->app_secret = ns_filter("onlinepay","item4");
		if(isset($_GET["orderToken"]) AND isset($request["VerifyHash"])){
			if($request["resultCode"]!="200"){
				$_SESSION["redirectError"] = ["head"=>_e("islem-basarisiz",true),"text"=>_e('odeme-islemi-basarisiz',true).' ('.$request["resultMessage"].')'];
				$git = ns_filter("siteurl").ns_filter("siparispage").'/'.$_GET["orderToken"].'/';
				exit(header("Location:$git"));
			} else if($this->VerifyHash($request["otherCode"])) {
				$this->siparisAction($request);
				$git = ns_filter("siteurl").ns_filter("tamamlandipage").'/'.$_GET["orderToken"].'/';
				exit(header("Location:$git"));
			}
		}
		if(isset($request["sp_musteri_tutar"]) AND ns_filter("include")=="order"){
			$this->orderToken = $request["sp_musteri_link"];
			$this->price = $request["sp_musteri_tutar"];
			$this->amount = _p($this->price);
			if(!isset($_SESSION["payizoneToken-".$this->orderToken]) OR $this->pretime(30)>$_SESSION["payizoneTokenTime-".$this->orderToken]){
				$this->getToken = $this->tokenCreate();
				if($this->getToken["code"]=="200"){
					$_SESSION["payizoneToken-".$this->orderToken] = $this->getToken["token"];
					$_SESSION["payizoneTokenTime-".$this->orderToken] = date("Y-m-d H:i:s");
				} else {
					if($this->getToken["code"]=="400"){
						unset($_SESSION["payizoneToken-".$this->orderToken]);
						header("Refresh:0");
					    exit;
					}
					$this->error = ["head"=>_e("token-hatasi",true),"text"=>_e("payizone-error-".$this->getToken["code"],true)];
				}
			}
			$this->token = isset($_SESSION["payizoneToken-".$this->orderToken]) ? $_SESSION["payizoneToken-".$this->orderToken]:false;
		}
		if(isset($_SESSION["redirectError"])){
			$this->error = $_SESSION["redirectError"];
			unset($_SESSION["redirectError"]);
		}
		if(isset($request["json"]) AND $request["json"] == "getPos" AND isset($_SESSION["payizoneToken-".$request["orderToken"]])){
			global $siparis;
			$this->token = isset($_SESSION["payizoneToken-".$request["orderToken"]]) ? $_SESSION["payizoneToken-".$request["orderToken"]]:false;
			if($siparis->primary($request["orderToken"]) AND $row = $siparis->select()){
				$this->price = $row["sp_musteri_tutar"];
				$this->getPos = $this->getPos($request);
				if($this->getPos["code"]=="200"){
					$this->payToken = $this->getPos["payToken"];
					$this->installments = [];
					foreach ($this->getPos["installments"] as $key) {
						$this->installments[] = ["value"=>$key,"text"=>$key=="1" ? _e("tek-cekim",true): sprintf(_e("ek-taksit",true),$key)];
					}
					exit(json_encode(["json"=>"installments","installments"=>$this->installments,"payToken"=>$this->payToken]));
				} else {
					exit(json_encode(["json"=>"error","error"=>["head"=>_e("kart-hatasi",true),"text"=>_e("payizone-error-".$this->getPos["code"],true)]]));
				}
			}
			
		} else if(isset($request["json"]) AND $request["json"] == "pay3D" AND isset($_SESSION["payizoneToken-".$request["orderToken"]])){
			global $siparis;
			$this->token = isset($_SESSION["payizoneToken-".$request["orderToken"]]) ? $_SESSION["payizoneToken-".$request["orderToken"]]:false;
			if($siparis->primary($request["orderToken"]) AND $row = $siparis->select()){
				$this->price = $row["sp_musteri_tutar"];
				$this->orderToken = $row["sp_musteri_link"];
				$this->orderCode = $row["sp_code"].'NS'.rand(0,1500);
				$this->redirect = ns_filter("siteurl")."payment/payizone/?orderToken=".$row["sp_musteri_link"];
				$this->note = $row["sp_paket_adi"]." Ödemesi";
				$this->mail = $row["sp_musteri_mail"];
				$this->pay3D = $this->pay3D($request);
				if($this->pay3D["status"] == "true" AND $this->pay3D["code"]=="200"){
					$this->redirectPayizone = $this->pay3D["redirectUrl"];
					exit(json_encode(["json"=>"redirect","url"=>$this->redirectPayizone]));
				} else {
					exit(json_encode(["json"=>"error","error"=>["head"=>_e("odeme-hatasi",true),"text"=>_e($this->pay3D["message"],true)]]));
				}
			}
			exit(json_encode(["json"=>"error","error"=>["head"=>"Hatalı İşlem3","text"=>"Hatalı İşlem".$request["orderToken"]."asdasd"]]));
		}
    }
    public function tokenCreate(){
    	$ch = curl_init("https://service.payizone.com/token");
		$payload = json_encode(array("app_id"=> $this->app_id, "app_secret" => $this->app_secret));
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		$result = curl_exec($ch);
		curl_close($ch);
		return json_decode($result,true);
    }
    public function getPos($request = []){
    	$authorization = "Authorization: Bearer ".$this->token;
		$ch = curl_init("https://service.payizone.com/getPos");
		$payload = json_encode( array( "card_number"=> $request["ccnum"], "amount" => $this->price ) );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', $authorization));
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		$result = curl_exec($ch);
		curl_close($ch);
		return json_decode($result,true);
    }
    public function pay3D($request = []){
    	$ch = curl_init("https://service.payizone.com/pay3D");
		$payload = json_encode(array(
			"card_holder"=> $request["cardname"],
			"card_number" => $request["ccnum"],
			"exp_month" => explode("/", $request["exp"])[0],
			"exp_year" => strlen(explode("/", $request["exp"])[1])==2 ? "20".explode("/", $request["exp"])[1]:explode("/", $request["exp"])[1],
			"cvv" => $request["cvv"],
			"amount" => $this->price,
			"currency"=>ns_filter("currency"),
			"payment_token" => $request["paymentToken"],
			"redirect_url" => $this->redirect,
			"other_code" => $this->orderCode,
			"installment"=>$request["installment_number"],
			"note" => $this->note,
			"mail"=>$this->mail,
		));
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		$result = curl_exec($ch);
		curl_close($ch);
		return json_decode($result,true);
    }
    public function VerifyHash($code){
    	$VerifyHash = hash("sha256", $this->app_id . "|" . $this->app_secret  . "|" . $code . "|true");
		if($VerifyHash == $_POST['VerifyHash']) {
			return true;
		} else {
			return false;
		}
    }
    public function siparisAction($request = []){
    	global $siparis,$api,$db;
    	$siparis->sp_code = explode("NS", $request["otherCode"])[0];
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
		}
    }
    public function pretime($count = 5, $type = "minute"){
        return date('Y-m-d H:i:s', strtotime('-'.$count.' '.$type, strtotime(date("Y-m-d H:i:s"))));
    }
}
if(file_exists(__DIR__."/language/".ns_filter("language").".php"))
include_once __DIR__."/language/".ns_filter("language").".php";
$payizone = new Payizone($post);
if(ns_filter("include")=="order")
include_once __DIR__."/include/form.php";

