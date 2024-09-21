<?php
class Nivulog{
    private $conn;
    private $table_name = "nivu_log";
    public $log_idsi;
    public $log_time;
    public $log_content;
    public $log_type;
    public function __construct($db){
        $this->conn = $db;
    }
    public function logType($type){
        if($type=="1")
            $result = ["name"=>"Yeni Sipariş","class"=>"primary"];
        if($type=="2")
            $result = ["name"=>"İletişim İsteği","class"=>"secondary"];
        if($type=="3")
            $result = ["name"=>"Başarılı Giriş","class"=>"success"];
        if($type=="4")
            $result = ["name"=>"Giriş Denemesi","class"=>"danger"];
        if($type=="5")
            $result = ["name"=>"Şifre Sıfırlama","class"=>"arsiv"];
        return $result;
    }
    public function all($from_record_num = 0, $records_per_page = 20){
        $this->pagination('waiting');
        $where = isset($this->search) ? $this->search:'';
        $from_record_num = $this->from_record_num;
        $records_per_page = $this->records_per_page;
        $query = "SELECT * FROM ".$this->table_name." WHERE log_idsi != 0 ".$where." ORDER BY log_idsi DESC LIMIT {$from_record_num}, {$records_per_page}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function log_count(){
        $where = isset($this->search) ? $this->search:'';
        $query = "SELECT COUNT(log_idsi) FROM ".$this->table_name."  WHERE log_idsi != 0 ".$where;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    public function pagination(){
        global $get,$ayar;
        if(isset($get["search"])) {
            $this->search = "AND log_content LIKE '%".$get["search"]."%'";
        }
        $this->page = isset($get["p"]) ? $get["p"]:'1';
        $this->records_per_page = 20;
        $this->from_record_num = ($this->page*$this->records_per_page) - $this->records_per_page;
        $this->count = $this->log_count();
        $this->totalpage = ceil($this->count/$this->records_per_page);
        $this->pagination = [];
        for ($i=($this->page - 3); $i < $this->page + 3; $i++) {
            $active = $this->page==$i;
            if($this->count > 0 AND $i>0 AND $i<=$this->totalpage) {
                if(isset($get["search"])) {
                    $this->pagination[] = array("href"=>$ayar->getpage("log-kayitlari").'?search='.$get["search"].'&p='.$i,"text"=>$i,"active"=>$active);
                    $search = $get["search"];
                } else {
                    $this->pagination[] = array("href"=>$ayar->getpage("log-kayitlari").'?p='.$i,"text"=>$i,"active"=>$active);
                }
            }
        }

    }
    public function insert($data=null){
        $query = "INSERT INTO ".$this->table_name." SET log_time = :log_time, log_content = :log_content, log_type = :log_type";
        $stmt = $this->conn->prepare($query);
        foreach ($data as $key => $value) {
            $this->$key = $value;
            $stmt->bindParam(':'.$key, $this->$key);
        }
        if($stmt->execute())
            return true;
        return false;
    }
    public function time(){
        return date("Y-m-d H:i:s");
    }
    public function agent(){
        return [
            "user_agent"=>$_SERVER['HTTP_USER_AGENT'],
            "ip"=>$this->getIp()
        ];
    }
    public function getIp(){
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
    public function jsonData($data){
        $result = [];
        foreach (json_decode($data) as $key => $value) {
            if (is_array($value))
                $result[$key] = $this->jsonData(json_encode($value));
            else
                $result[$key] = $value;
        }
        return $result;
    }
    public function zamanfarki($zaman = NULL){
        if (empty($zaman)) {
            $zaman = $this->sp_time;
        }
        $tarih = explode(" ", $zaman)[0];
        $tarih = explode("-", $tarih);
        date_default_timezone_set('Europe/Istanbul');
        $explode = explode(" ", $zaman);
        $date = explode("-", $explode[0]);
        $time = explode(":", $explode[1]);
        $zaman =  mktime($time[0],$time[1],$time[2],$date[1],$date[2],$date[0]);
        $zaman_farki = time() - $zaman;
        $saniye = $zaman_farki;
        $dakika = round($zaman_farki/60);
        $saat = round($zaman_farki/3600);
        $gun = round($zaman_farki/86400);
        $hafta = round($zaman_farki/604800);
        $ay = round($zaman_farki/2419200);
        $yil = round($zaman_farki/29030400);
        if( $saniye < 60 ){
            if ($saniye == 0){
                return "az önce";
            } else {
                return $saniye .' sn önce';
            }
        } else if ( $dakika < 60 ){
            return $dakika .' dk önce';
        } else if ( $saat < 24 ){
            return $saat.' saat önce';
        } else {
            return $tarih[2].'/'.$tarih[1].'/'.$tarih[0];
        }
    }
    public function href($type,$string){
        global $ayar;
        if($type=="1")
            return $ayar->getpage("siparis",$string);
        if($type=="2")
            return $ayar->getpage("iletisim",$string);
        if(($type=="3" OR $type=="4") AND !empty($string))
            return $ayar->getpage("kullanicilar",$string);
        if($type=="3" OR $type=="4")
            return $ayar->getpage("kullanicilar");
    }
}