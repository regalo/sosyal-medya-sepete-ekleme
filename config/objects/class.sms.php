<?php
class SMS { 
	public function __construct($db){
        $this->ayar = $db;
        $ayar = $this->ayar;
        $ayar->select('smspanel');
        if ($ayar->item2=="masgsm") {
        	$this->company = "masgsm";
        	$this->apikey = $ayar->item3;
        	$this->usercode = $ayar->item4;
            $this->originator = $ayar->item5;
        } elseif($ayar->item2=="netgsm"){
        	$this->company = "netgsm";
        	$this->usercode = $ayar->item3;
        	$this->password = urlencode($ayar->item4);
        	$this->msgheader = $ayar->item5;
        }
    }
    public function connect($url, $body = null){
	    $ch   = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',"Authorization: Key {$this->apikey}"));
	    if($body):
	        curl_setopt($ch, CURLOPT_POST, 1);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
	    endif;
	    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	    $result = curl_exec($ch);
	    curl_close($ch);
	    return $result;
    }
    public function netsent($msg, $telno){
		$msg = html_entity_decode($msg, ENT_COMPAT, "UTF-8");
		$msg = rawurlencode($msg);
		$header = html_entity_decode($header, ENT_COMPAT, "UTF-8");
		$header = rawurlencode($header);
		$startdate=date('d.m.Y H:i');
		$startdate=str_replace('.', '',$startdate );
		$startdate=str_replace(':', '',$startdate);
		$startdate=str_replace(' ', '',$startdate);
		$stopdate=date('d.m.Y H:i', strtotime('+1 day'));
		$stopdate=str_replace('.', '',$stopdate );
		$stopdate=str_replace(':', '',$stopdate);
		$stopdate=str_replace(' ', '',$stopdate);
		$url="http://api.netgsm.com.tr/bulkhttppost.asp?usercode=".$this->usercode."&password=".$this->password."&gsmno=$telno&message=$msg&msgheader=".$this->msgheader."&startdate=$startdate&stopdate=$stopdate";
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		//  curl_setopt($ch,CURLOPT_HEADER, false);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;	
    }
    public function nettest(){
	    $url= "https://api.netgsm.com.tr/sms/header/?usercode=".$this->usercode."&password=".$this->password;
	    $ch = curl_init($url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    $result = curl_exec($ch);
	    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	    if($http_code != 200){
	    	echo "$http_code $http_response\n";
	    	return false;
	    }
	    return $result;
	}
    public function test($post){
    	if ($post["item2"]=="masgsm") {
    		$this->apikey = $post["item3"];
    		$this->usercode = $post["item4"];
    		$this->data = $this->connect('http://178.157.12.155:8080/api/originator/v1?username='.$this->usercode.'&password='.$this->apikey);
    		if(strstr($this->data, "00")){
    			$this->headers = strstr($this->data, "|") ? explode("|", explode("00 ", $this->data)[1]):array(explode("00 ", $this->data)[1]);
    			if(in_array($post["item5"],$this->headers)){
    				$this->head = true;
    				return true;
    			}
    			if(empty($this->headers)){
    				$this->data = array();
			$this->data["status"]["description"] = "Kullanılabilir başlık bulunamadı";
				return false;
    			}
    		}
    		$this->data = array();
			$this->data["status"]["description"] = "Geçersiz kullanıcı adı - api yada  başlık.";
				return false;
    	} elseif($post["item2"]=="netgsm"){
    		$this->usercode = $post["item3"];
        	$this->password = urlencode($post["item4"]);
        	$this->msgheader = $post["item5"];
        	$this->data = $this->nettest();
			if (trim($this->data)=="30") {
				$this->data = array();
				$this->data["status"]["description"] = "Geçersiz kullanıcı adı - şifre yada api erişim izniniz yok. API erişiminizde IP sınırlaması yaptıysanız, şuan scriptin kurulu olduğu sunucunun yada hosting hesabınızın ip adresi bu listede olmayabilir.";
				return false;
			} else {
				$this->head = false;
				if (strstr("<br>",$this->data)) {
					$this->headers = $this->data;
					if($post["item5"]==$this->headers)
						$this->head = true;
				} else {
					$this->headers = array();
					$this->data = explode("<br>", $this->data);
		    		foreach ($this->data as $value) {
		    			$this->headers[] = $value;
		    		}
		    		$this->heads = implode(" | ", $this->headers);
		    		foreach ($this->headers as $value) {
		    			if($post["item5"]==$value)
			    			$this->head = true; break;
		    		}
				}
	    		return true;
			}
		}
    	return false;

    }
    public function send($body){
    	if ($this->company=="masgsm") {
	    	if (strstr($body["to"], ",")) {
	    		$body["to"] = explode(",", $body["to"]);
	    	} else {
	    		$body["to"] = array($body["to"]);
	    	}
	    	foreach ($body["to"] as $value) {
	    		$this->data = $this->connect('http://178.157.12.155:8080/api/smsget/v1?username='.urlencode($this->usercode).'&password='.$this->apikey.'&header='.urlencode($this->originator).'&gsm='.$value.'&message='.urlencode($body["message"]));
	    	}
	    	return true;
	    } elseif ($this->company=="netgsm") {
	    	$this->data = $this->netsent($body["message"], $body["to"]);
	    	if (is_numeric(trim($this->data)) AND (trim($this->data) == 30 OR trim($this->data) == 20 OR trim($this->data) == 40 OR trim($this->data) == 70)) {
	    		$this->data = array();
				$this->data["status"]["description"] = "Hatalı api, hatalı numara yada hatalı sms başlığı";
	    		return false;
	    	}
	    	return true;
	    }
    	return false;
    }
    public function timer(){
    	$bugun = date("Y-m-d H:i:s");
		$cevir = strtotime('+1 hour',strtotime($bugun));
		return date("dmYHis",$cevir);
    }
}