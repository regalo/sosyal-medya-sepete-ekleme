<?php
class Siparis{
    private $conn;
    private $table_name = "siparisler";
    public $sp_id;
    public $sp_code;
    public $sp_tur;
    public $sp_time;
    public $sp_musteri_adi;
    public $sp_musteri_mail;
    public $sp_musteri_telefon;
    public $sp_musteri_adres;
    public $sp_musteri_vd;
    public $sp_musteri_vn;
    public $sp_paket_adi;
    public $sp_musteri_paket;
    public $sp_musteri_tutar;
    public $sp_musteri_kupon;
    public $sp_musteri_link;
    public $sp_musteri_not;
    public $sp_odeme;
    public $sp_durum;
    public function __construct($db){
        $this->conn = $db;
    }
    public  function select($row=""){
        if (isset($this->sp_code)) {
           $this->sp_code = htmlspecialchars(strip_tags($this->sp_code));
           $query = "SELECT * FROM " . $this->table_name . " WHERE sp_code = :sp_code limit 0,1";
           $stmt = $this->conn->prepare($query);
           $stmt->bindParam(':sp_code', $this->sp_code);
        } else {
           $this->sp_id = htmlspecialchars(strip_tags($this->sp_id));
           $query = "SELECT * FROM " . $this->table_name . " WHERE sp_id = :sp_id limit 0,1";
           $stmt = $this->conn->prepare($query);
           $stmt->bindParam(':sp_id', $this->sp_id);
        }
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($row["sp_id"])) {
            foreach ($row as $key => $value) {
                $this->$key = $value;
            }
            $this->islem();
            $this->durum($this->sp_durum);
            $this->aciklama();
            return empty($row) ? true: $row;
        }
        return false;
    }
    function primary($item){
        $query = "SELECT sp_id,sp_musteri_paket FROM " . $this->table_name . " WHERE sp_musteri_link = :sp_musteri_link limit 0,1";
        $stmt = $this->conn->prepare($query);
        $this->pk_pri = htmlspecialchars(strip_tags($item));
        $stmt->bindParam(':sp_musteri_link', $this->pk_pri);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($row["sp_id"])) {
            $this->sp_id = $row["sp_id"];
            $this->sp_musteri_paket = $row["sp_musteri_paket"];
            return true;
        }
        return false;
    }
    public function last(){
        $query = "SELECT sp_id,sp_code FROM " . $this->table_name . " ORDER BY sp_id DESC limit 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->sp_id = $row["sp_id"];
        $this->sp_code = $row["sp_code"];
        return $row["sp_id"];
    }
    public function paywantid($mail){
        $query = "SELECT sp_id FROM " . $this->table_name . " WHERE sp_musteri_mail = :mail ORDER BY sp_id ASC limit 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':mail', $mail);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row["sp_id"];
    }
    public function all($from_record_num = 0, $records_per_page = 20){
        $this->action = isset($this->action) ? htmlspecialchars(strip_tags($this->action)):'';
        if (!isset($this->all)) {
           $this->all = array('*');
        }
        if (isset($this->search)) {
            $query = "SELECT * FROM ".$this->table_name." WHERE sp_code LIKE ? OR sp_musteri_adi LIKE ? OR sp_paket_adi LIKE ? ORDER BY sp_id DESC LIMIT 20";
            $stmt = $this->conn->prepare($query);
            $search_term = "%".$this->search."%";
            $stmt->bindParam(1, $search_term);
            $stmt->bindParam(2, $search_term);
            $stmt->bindParam(3, $search_term);
        } elseif ($this->action == NULL) {
            $query = "SELECT ".$this->tocomma($this->all)." FROM ".$this->table_name." WHERE sp_durum != 10 ORDER BY sp_id DESC LIMIT {$from_record_num}, {$records_per_page}";
            $stmt = $this->conn->prepare($query);
        } elseif($this->action=="acik") {
            $query = "SELECT ".$this->tocomma($this->all)." FROM ".$this->table_name." WHERE (sp_durum != 0 AND sp_durum < 4) OR sp_durum = 6 ORDER BY sp_id DESC LIMIT {$from_record_num}, {$records_per_page}";
            $stmt = $this->conn->prepare($query);
        } elseif(is_numeric($this->action)) {
            $query = "SELECT ".$this->tocomma($this->all)." FROM ".$this->table_name." WHERE sp_durum = :sp_durum ORDER BY sp_id DESC LIMIT {$from_record_num}, {$records_per_page}";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':sp_durum', $this->action);
        }
        $stmt->execute();
        return $stmt;
    }
    public function api($smm_id){
        $query = "SELECT sp_code FROM siparis_islem WHERE islem_smm LIKE ?";
        $stmt = $this->conn->prepare($query);
        $search_term = "{$smm_id}-%";
        $stmt->bindParam(1, $search_term);
        $stmt->execute();
        return $stmt;
    }
    public function kazanc($sure = "month"){
        if ($sure == "day") {
            $this->last = date("Y-m-d H:i:s");
            $this->sure = date("Y-m-d").' 00:00:01';
        } else if ($sure == "month") {
            $this->last = date("Y-m-d H:i:s");
            $this->sure = date("Y-m").'-01 00:00:01';
        } else if($sure == "beforeMonth")
        {   $this->last = date("Y-m").'-01 00:00:01';
            $this->sure = date('Y-m-d H:i:s',strtotime($this->last . ' -1 month'));
        } else if($sure == "beforeDay")
        {   $this->last = date("Y-m-d").' 00:00:01';
            $this->sure = date('Y-m-d H:i:s',strtotime($this->last . ' -1 day'));
        } else if($sure == "last7Day")
        {   $this->last = date("Y-m-d H:i:s");
            $this->sure = date('Y-m-d H:i:s',strtotime(date("Y-m-d").' 00:00:01 -7 day'));
        } else if($sure == "last30Day")
        {   $this->last = date("Y-m-d H:i:s");
            $this->sure = date('Y-m-d H:i:s',strtotime(date("Y-m-d").' 00:00:01 -30 day'));
        } else if($sure == "allTimes")
        {   $this->last = date("Y-m-d H:i:s");
            $this->sure = "2018-01-01 00:00:01";
        }
        $query = "SELECT SUM(sp_musteri_tutar) AS toplam FROM ".$this->table_name." WHERE sp_durum = 4 AND sp_time > :sp_time AND sp_time < :sp_last";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':sp_time', $this->sure);
        $stmt->bindParam(':sp_last', $this->last);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $this->format($row["toplam"]);
    }
    public function count($action = ""){
        if (!empty($action) OR $action=="0") {
            $action = htmlspecialchars(strip_tags($action));
            if ($action=="code") {
                $query = "SELECT COUNT(sp_id) FROM " . $this->table_name . " WHERE sp_code = :sp_code limit 0,1";
                $stmt = $this->conn->prepare($query);
                $this->sp_code = htmlspecialchars(strip_tags($this->sp_code));
                $stmt->bindParam(':sp_code', $this->sp_code);
                $stmt->execute();
                return $stmt->fetchColumn();
            }
            $this->action = $action;
        }
        $this->action=htmlspecialchars(strip_tags($this->action));
        if ($this->action == NULL) {
            $query = "SELECT COUNT(sp_id) FROM ".$this->table_name." ORDER BY sp_id DESC";
            $stmt = $this->conn->prepare($query);
        } elseif($this->action=="acik") {
            $query = "SELECT COUNT(sp_id) FROM ".$this->table_name." WHERE (sp_durum != 0 AND sp_durum < 4) OR sp_durum = 6 ORDER BY sp_id DESC";
            $stmt = $this->conn->prepare($query);
        } elseif(is_numeric($this->action)) {
            $query = "SELECT COUNT(sp_id) FROM ".$this->table_name." WHERE sp_durum = :sp_durum ORDER BY sp_id DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':sp_durum', $this->action);
        }
        $stmt->execute();
        return $stmt->fetchColumn();

    }
    public function CuoponCount($code){
        $query = "SELECT COUNT(sp_id) FROM ".$this->table_name." WHERE sp_musteri_kupon =:sp_musteri_kupon AND sp_durum != 0 AND sp_durum != 10 ORDER BY sp_id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':sp_musteri_kupon', $code);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    public function paketsiparis($pk_id){
        $query = "SELECT COUNT(sp_id) FROM " . $this->table_name . " WHERE sp_musteri_paket = :sp_musteri_paket AND sp_durum != 10 AND sp_durum != 0";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':sp_musteri_paket', $pk_id);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    public function update(){
        $query = "UPDATE ".$this->table_name." SET sp_code = :sp_code, sp_tur = :sp_tur, sp_odeme = :sp_odeme, sp_musteri_tutar = :sp_musteri_tutar, sp_durum = :sp_durum WHERE sp_id = :id";     
        $stmt = $this->conn->prepare($query);
        $this->sp_code = htmlspecialchars(strip_tags($this->sp_code));
        $this->sp_tur = htmlspecialchars(strip_tags($this->sp_tur));
        $this->sp_odeme = htmlspecialchars(strip_tags($this->sp_odeme));
        $this->sp_musteri_tutar = htmlspecialchars(strip_tags($this->sp_musteri_tutar));
        $this->sp_durum = htmlspecialchars(strip_tags($this->sp_durum));
        $this->sp_id = htmlspecialchars(strip_tags($this->sp_id));
        $stmt->bindParam(':sp_code', $this->sp_code);
        $stmt->bindParam(':sp_tur', $this->sp_tur);
        $stmt->bindParam(':sp_odeme', $this->sp_odeme);
        $stmt->bindParam(':sp_musteri_tutar', $this->sp_musteri_tutar);
        $stmt->bindParam(':sp_durum', $this->sp_durum);
        $stmt->bindParam(':id', $this->sp_id);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    public function insert(){
        $item = $this->item;
        $query = "INSERT INTO ".$this->table_name." SET sp_code = :sp_code, sp_tur = :sp_tur, sp_time = :sp_time, sp_musteri_adi = :sp_musteri_adi, sp_musteri_mail = :sp_musteri_mail, sp_musteri_telefon = :sp_musteri_telefon, sp_musteri_adres = :sp_musteri_adres, sp_musteri_vd = :sp_musteri_vd, sp_musteri_vn = :sp_musteri_vn, sp_paket_adi = :sp_paket_adi, sp_musteri_paket = :sp_musteri_paket, sp_musteri_tutar = :sp_musteri_tutar, sp_musteri_kupon = :sp_musteri_kupon, sp_musteri_link = :sp_musteri_link, sp_musteri_not = :sp_musteri_not,sp_odeme = :sp_odeme, sp_durum = :sp_durum";
        $stmt = $this->conn->prepare($query);
        $this->sp_code = $this->code();
        $this->sp_tur = isset($item["sp_tur"]) ? htmlspecialchars(strip_tags($item["sp_tur"])): "manuel";
        $this->sp_time = date("Y-m-d H:i:s");
        $this->sp_miktar = isset($item["sp_miktar"]) ? htmlspecialchars(strip_tags($item["sp_miktar"])): "";
        $this->sp_islem_turu = isset($item["sp_islem_turu"]) ? htmlspecialchars(strip_tags($item["sp_islem_turu"])): "";
        $this->sp_islem_id = isset($item["sp_islem_id"]) ? htmlspecialchars(strip_tags($item["sp_islem_id"])): "";
        $this->sp_musteri_adi = isset($item["sp_musteri_adi"]) ? htmlspecialchars(strip_tags($item["sp_musteri_adi"])): "";
        $this->sp_musteri_mail = isset($item["sp_musteri_mail"]) ? htmlspecialchars(strip_tags($item["sp_musteri_mail"])): "";
        $this->sp_musteri_telefon = isset($item["sp_musteri_telefon"]) ? htmlspecialchars(strip_tags($item["sp_musteri_telefon"])): "";
        $this->sp_musteri_adres = (isset($item["sp_musteri_adres"]) AND !empty($item["sp_musteri_adres"])) ? htmlspecialchars(strip_tags($item["sp_musteri_adres"])): "DIJITAL URUN";
        $this->sp_musteri_vd = isset($item["sp_musteri_vd"]) ? htmlspecialchars(strip_tags($item["sp_musteri_vd"])): "1";
        $this->sp_musteri_vn =  (isset($item["sp_musteri_vn"]) AND !empty($item["sp_musteri_vn"])) ? htmlspecialchars(strip_tags($item["sp_musteri_vn"])): "1";
        $this->sp_paket_adi = isset($item["sp_paket_adi"]) ? htmlspecialchars(strip_tags($item["sp_paket_adi"])): "";
        $this->sp_musteri_paket = isset($item["sp_musteri_paket"]) ? htmlspecialchars(strip_tags($item["sp_musteri_paket"])): "";
        $this->sp_musteri_tutar = isset($item["sp_musteri_tutar"]) ? htmlspecialchars(strip_tags($item["sp_musteri_tutar"])): "";
        $this->sp_musteri_kupon = (isset($item["sp_musteri_kupon"]) AND !empty($item["sp_musteri_kupon"])) ? htmlspecialchars(strip_tags($item["sp_musteri_kupon"])): "KULLANILMADI";
        $this->islem_adres = isset($item["islem_adres"]) ? htmlspecialchars(strip_tags($item["islem_adres"])): "";
        $this->sp_musteri_link = md5($this->sp_code);
        $this->sp_musteri_not = isset($item["sp_musteri_not"]) ? htmlspecialchars(strip_tags($item["sp_musteri_not"])): "";
        $this->sp_odeme = isset($item["sp_odeme"]) ? htmlspecialchars(strip_tags($item["sp_odeme"])): 0;
        $this->sp_durum = $this->sp_odeme == 1 ? 0:10;
        $stmt->bindParam(':sp_code', $this->sp_code);
        $stmt->bindParam(':sp_tur', $this->sp_tur);
        $stmt->bindParam(':sp_time', $this->sp_time);
        $stmt->bindParam(':sp_musteri_adi', $this->sp_musteri_adi);
        $stmt->bindParam(':sp_musteri_mail', $this->sp_musteri_mail);
        $stmt->bindParam(':sp_musteri_telefon', $this->sp_musteri_telefon);
        $stmt->bindParam(':sp_musteri_adres', $this->sp_musteri_adres);
        $stmt->bindParam(':sp_musteri_vd', $this->sp_musteri_vd);
        $stmt->bindParam(':sp_musteri_vn', $this->sp_musteri_vn);
        $stmt->bindParam(':sp_paket_adi', $this->sp_paket_adi);
        $stmt->bindParam(':sp_musteri_paket', $this->sp_musteri_paket);
        $stmt->bindParam(':sp_musteri_tutar', $this->sp_musteri_tutar);
        $stmt->bindParam(':sp_musteri_kupon', $this->sp_musteri_kupon);
        $stmt->bindParam(':sp_musteri_link', $this->sp_musteri_link);
        $stmt->bindParam(':sp_musteri_not', $this->sp_musteri_not);
        $stmt->bindParam(':sp_odeme', $this->sp_odeme);
        $stmt->bindParam(':sp_durum', $this->sp_durum);
        if($stmt->execute()){
             $this->sp_id = $this->last();
             $this->insertaciklama();
             $this->insertislem();
             return true;
        }else{
            return false;
        }
    }
    public function aciklama(){
        $query = "SELECT aciklama FROM siparis_aciklama WHERE sp_code = :sp_code ORDER BY sp_code DESC limit 0,1";
        $stmt = $this->conn->prepare($query);
        $this->sp_code = htmlspecialchars(strip_tags($this->sp_code));
        $stmt->bindParam(':sp_code', $this->sp_code);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($row["aciklama"])) {
            $this->aciklama = $row["aciklama"];
            return true;
        }
        return false;
    }
    public function insertaciklama(){
        $query = "INSERT INTO siparis_aciklama SET sp_code = :sp_code, aciklama = :aciklama";
        $stmt = $this->conn->prepare($query);
        $this->aciklama = isset($this->aciklama) ? $this->aciklama :"";
        $stmt->bindParam(':sp_code', $this->sp_code);
        $stmt->bindParam(':aciklama', $this->aciklama);
        if($stmt->execute()){
             return true;
        } else{
            return false;
        }
    }
    public function updateaciklama(){
        $query = "UPDATE siparis_aciklama SET aciklama = :aciklama WHERE sp_code = :sp_code";
        $stmt = $this->conn->prepare($query);
        $this->sp_code = htmlspecialchars(strip_tags($this->sp_code));
        $this->aciklama = htmlspecialchars(strip_tags($this->aciklama));
        $stmt->bindParam(':sp_code', $this->sp_code);
        $stmt->bindParam(':aciklama', $this->aciklama);
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }
    public function islem(){
        $query = "SELECT * FROM siparis_islem WHERE sp_code = :id ORDER BY islem_id DESC limit 0,1";
        $stmt = $this->conn->prepare($query);
        $this->sp_id = htmlspecialchars(strip_tags($this->sp_id));
        $stmt->bindParam(':id', $this->sp_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($row["sp_code"])) {
            $this->panel_code = $row["panel_code"];
            $this->islem_tarih = $row["islem_tarih"];
            $this->islem_adres = $row["islem_item"];
            $this->islem_turu = $row["islem_turu"];
            $this->islem_miktar = $row["islem_miktar"];
            $this->islem_smm = $row["islem_smm"];
            $this->bayi_durum = $row["sp_durum"];
            $this->sp_start = $row["sp_start"];
            $this->sp_kalan = $row["sp_kalan"];
            $this->sp_tutar = $row["sp_tutar"];
            $this->bayi_kontrol = $row["bayi_kontrol"];
            return $row;
        }
        return false;  
    }
    public function insertislem(){
        $query = "INSERT INTO siparis_islem SET sp_code = :sp_code, panel_code = :panel_code, islem_tarih = :islem_tarih, islem_item = :islem_item, islem_miktar = :islem_miktar,islem_turu = :islem_turu, islem_smm = :islem_smm, sp_durum = :sp_durum, sp_start = :sp_start, sp_kalan = :sp_kalan, sp_tutar = :sp_tutar, bayi_kontrol = :bayi_kontrol";
        $stmt = $this->conn->prepare($query);
        $this->sp_id = isset($this->sp_id) ? htmlspecialchars(strip_tags($this->sp_id)): "";
        $this->panel_code = isset($this->panel_code) ? htmlspecialchars(strip_tags($this->panel_code)): 0;
        $this->islem_tarih = isset($this->islem_tarih) ? htmlspecialchars(strip_tags($this->islem_tarih)): date("Y-m-d H:i:s");
        $this->islem_adres = isset($this->islem_adres) ? htmlspecialchars(strip_tags($this->islem_adres)): "";
        $this->islem_miktar = isset($this->sp_miktar) ? htmlspecialchars(strip_tags($this->sp_miktar)): 0;
        $this->islem_turu = isset($this->sp_islem_turu) ? htmlspecialchars(strip_tags($this->sp_islem_turu)): "manuel";
        $this->islem_smm = isset($this->sp_islem_id) ? htmlspecialchars(strip_tags($this->sp_islem_id)): "";
        $this->bayi_durum = isset($item["sp_durum"]) ? htmlspecialchars(strip_tags($item["sp_durum"])): 0;
        $this->sp_start = isset($item["sp_start"]) ? htmlspecialchars(strip_tags($item["sp_start"])): 0;
        $this->sp_kalan = isset($item["sp_kalan"]) ? htmlspecialchars(strip_tags($item["sp_kalan"])): 0;
        $this->sp_tutar = isset($item["sp_tutar"]) ? htmlspecialchars(strip_tags($item["sp_tutar"])): 0;
        $this->bayi_kontrol = date("Y-m-d H:i:s");
        $stmt->bindParam(':sp_code', $this->sp_id);
        $stmt->bindParam(':panel_code', $this->panel_code);
        $stmt->bindParam(':islem_tarih', $this->islem_tarih);
        $stmt->bindParam(':islem_item', $this->islem_adres);
        $stmt->bindParam(':islem_miktar', $this->islem_miktar);
        $stmt->bindParam(':islem_turu', $this->islem_turu);
        $stmt->bindParam(':islem_smm', $this->islem_smm);
        $stmt->bindParam(':sp_durum', $this->bayi_durum);
        $stmt->bindParam(':sp_start', $this->sp_start);
        $stmt->bindParam(':sp_kalan', $this->sp_kalan);
        $stmt->bindParam(':sp_tutar', $this->sp_tutar);
        $stmt->bindParam(':bayi_kontrol', $this->bayi_kontrol);
        if($stmt->execute()){
             return true;
        } else{
            return false;
        }
    }
    public function islemdelete(){
        $query = "DELETE FROM siparis_islem WHERE sp_code = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->sp_id);
        if($stmt->execute()){
             return true;
        } else{
            return false;
        }
    }
    public function aciklamadelete(){
        $query = "DELETE FROM siparis_aciklama WHERE sp_code = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->sp_code);
        if($stmt->execute()){
             return true;
        } else{
            return false;
        }
    }
    public function updateislem(){
        $query = "UPDATE siparis_islem SET panel_code = :panel_code, islem_item = :islem_item,islem_smm = :islem_smm, islem_miktar = :islem_miktar,islem_turu = :islem_turu, sp_durum = :sp_durum, sp_start = :sp_start, sp_kalan = :sp_kalan, sp_tutar = :sp_tutar , bayi_kontrol = :bayi_kontrol WHERE sp_code = :sp_code";
        $stmt = $this->conn->prepare($query);
        $this->panel_code = htmlspecialchars(strip_tags($this->panel_code));
        $this->islem_adres = htmlspecialchars(strip_tags($this->islem_adres));
        $this->islem_smm = htmlspecialchars(strip_tags($this->islem_smm));
        $this->islem_miktar = htmlspecialchars(strip_tags($this->islem_miktar));
        $this->islem_turu = htmlspecialchars(strip_tags($this->islem_turu));
        $this->bayi_durum = htmlspecialchars(strip_tags($this->bayi_durum));
        $this->sp_start = htmlspecialchars(strip_tags($this->sp_start));
        if (empty($this->sp_start)) {
            $this->sp_start = 0;
        }
        $this->sp_kalan = htmlspecialchars(strip_tags($this->sp_kalan));
        $this->sp_tutar = htmlspecialchars(strip_tags($this->sp_tutar));
        $this->bayi_kontrol = date("Y-m-d H:i:s");
        $this->sp_id = htmlspecialchars(strip_tags($this->sp_id));
        $stmt->bindParam(':panel_code', $this->panel_code);
        $stmt->bindParam(':islem_item', $this->islem_adres);
        $stmt->bindParam(':islem_smm', $this->islem_smm);
        $stmt->bindParam(':islem_miktar', $this->islem_miktar);
        $stmt->bindParam(':islem_turu', $this->islem_turu);
        $stmt->bindParam(':sp_durum', $this->bayi_durum);
        $stmt->bindParam(':sp_start', $this->sp_start);
        $stmt->bindParam(':sp_kalan', $this->sp_kalan);
        $stmt->bindParam(':sp_tutar', $this->sp_tutar);
        $stmt->bindParam(':bayi_kontrol', $this->bayi_kontrol);
        $stmt->bindParam(':sp_code', $this->sp_id);
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }
    public function delete($bind = "sp_id", $idsi = ""){
        $query = "DELETE FROM ".$this->table_name." WHERE ".$bind." = :id";
        $stmt = $this->conn->prepare($query);
        $id = empty($idsi) ? $this->sp_id: $idsi;
        $stmt->bindParam(':id', $id);
        if($result = $stmt->execute()){
            $this->islemdelete();
            if ($this->aciklama()) {
                $this->aciklamadelete();
            }
            return true;
        }else{
            return false;
        }
    }
    private function tocomma($list){
        $cikti = "";
        foreach ($list as $key) {
            $cikti .= $key.',';
        }
       return substr($cikti, 0,-1);
    }

    private function code(){
        for ($i=0; $i < 10; $i++) {
            $this->sp_code = rand(10000000,9000099999);
            if ($this->count("code")<1) {
                return $this->sp_code;
            }
        }
    }
    public function tur() {
        $this->action=htmlspecialchars(strip_tags($this->action));
        if ($this->action == NULL) { $this->tur = "Tüm Siparişler";  }
        elseif ($this->action == "acik") { $this->tur = "Açık Siparişler";  }
        elseif ($this->action == "kapali") { $this->tur = "Kapanan Siparişler";  }
        elseif ($this->action == 0) { $this->tur = "Ödeme Bekleyenler"; }
        elseif ($this->action == 1) { $this->tur = "İşlem Bekleyenler"; }
        elseif ($this->action == 2) { $this->tur = "Gönderim Sırasındakiler"; }
        elseif ($this->action == 3) { $this->tur = "Kısmi Tamamlananlar";}
        elseif ($this->action == 4) { $this->tur = "Tamamlananlar";  }
        elseif ($this->action == 5) { $this->tur = "İptal Edilenler";  }
        elseif ($this->action == 10) { $this->tur = "Diğer Siparişler"; }
        else { $this->tur = "Diğer Siparişler"; ; }
        return true;
    }
    public function durum($item) {
        if ($item == 0) {
            $s[1] = "ÖDEME BEKLİYOR";
            $s[2] = "warning";
            $s[3] = "Siparişin ödemesini onayla, iptal et yada tamamen sistemden sil.";
            $s[4] = "Siparişinizin işleme alınabilmesi için ödeme yapmanız gerekiyor";
            $s[5] = "ÖDEME BEKLENİYOR";
        } elseif ($item == 1) {
            $s[1] = "İŞLEM BEKLİYOR";
            $s[2] = "secondary";
            $s[3] = "Siparişe aşağıdan otomatik servis tanımlayıp otomatik olarak gönderebilir yada manuel olarak bir işlem yaptıysanız tamamlandı olarak işatetleyebilirsiniz.";
            $s[4] = "Siparişiniz işleme alındı. Servis yoğunluğuna göre kısa süre içerisinde gönderim sağlanacak";
            $s[5] = "İŞLEM SIRASINDA";
        } elseif ($item == 2) {
            $s[1] = "İŞLEM SIRASINDA";
            $s[2] = "primary";
            $s[3] = "Siparişiniz otomatik olarak ilgili bayiye gönderildi. İlgili bayiden sonuçlar belli aralıklarla çekilmekte. Ancak siz bu siparişi işlem sonucu beklemeden tamamlandı olarak işaretleyebilirsiniz";
            $s[4] = "Siparişiniz işleme alındı. Servis yoğunluğuna göre kısa süre içerisinde gönderim sağlanacak";
            $s[5] = "İŞLEME ALINDI";
        } elseif ($item == 3) {
            $s[1] = "KISMİ TAMAMLANDI";
            $s[2] = "niv";
            $s[3] = "İlgili bayiye gönderilen siparişden kısmi tamamlandı cevabı alındı ve sisteme işlendi. Lütfen bu siparişle ilgili manuel olarak işlem yapın ve siparişi tamamlandı olarak onaylayın";
            $s[4] = "Siparişiniz işleme alındı. Servis yoğunluğuna göre kısa süre içerisinde gönderim sağlanacak";
            $s[5] = "İŞLEM SÜRÜYOR";
        } elseif ($item == 4) {
            $s[1] = "TAMAMLANDI";
            $s[2] = "success";
            $s[3] = "Sipariş başarıyla tamamlandı";
            $s[4] = "Siparişiniz başarıyla sonuçlandırıldı. Bizi tercih ettiğiniz için teşekkürler";
            $s[5] = "TAMAMLANMIŞ";
        } elseif ($item == 5) {
            $s[1] = "İPTAL EDİLDİ";
            $s[2] = "warning";
            $s[3] = "Bu sipariş iptal edildi. Dilerseniz tekrar aktif edebilirsiniz.";
            $s[4] = "Siparişiniz iptal edildi. Bunun bir hata olduğunu düşünüyorsanız lütfen iletişim bölümünden bize ulaşın";
            $s[5] = "İPTAL EDİLDİ";
        } elseif ($item == 6 OR $item == 7) {
            $s[1] = "TAMAMLANAMADI";
            $s[2] = "danger";
            $s[3] = "Sipariş bayi tarafından iptal edildi lütfen url yada kullanıcı adını kontrol edin ve farklı bir servisle yada manuel olarak işlemi gerçekleştirin";
            $s[4] = "Siparişiniz yeniden incelenip işlem sırasına alınmayı bekliyor";
            $s[5] = "BEKLEMEYE ALINDI";
        } elseif ($item == 8) {
            $s[1] = "ARŞIVLENEN SİPARİŞ";
            $s[2] = "arsiv";
            $s[3] = "Bu sipariş arşivlenmiş. Arşivlenmiş siparişler sadece güvenlik amacıyla sistemde tutulur. Silinmesine ve düzenlenmesine izin verilmez.";
            $s[4] = "Siparişiniz başarıyla sonuçlandırıldı. Bizi tercih ettiğiniz için teşekkürler";
            $s[5] = "TAMAMLANMIŞ";
        } elseif ($item == 10) {
            $s[1] = "ÖDEME YAPILMAMIŞ";
            $s[2] = "warning";
            $s[3] = "Bu sipariş için ilgili ödeme firmasından ödendi yanıtı alınamamış. Bir hata olduğunu düşünüyorsanız bu siparişin ödemesini manuel olarak kontrol edip işleme alabilirsiniz.";
            $s[4] = "Siparişinizin işleme alınabilmesi için ödeme yapmanız gerekiyor";
            $s[5] = "ÖDEME BEKLİYOR";
        }
            $this->stext = $s[1];
            $this->sbutton = $s[2];
            $this->sadmin = $s[3];
            $this->sorder = $s[4];
            $this->border = $s[5];
            return true;
    }
    public function donustur($item){
        if ($item=="Processing") {
            $this->bayi_durum = 2;
            $this->sp_durum = 2;
            $this->bayititle = "İşlem Sırasında";
            $this->bayitext = "Siparişiniz bayi sorgusunda işlemde olarak görünüyor";
        } elseif ($item=="Canceled") {
            $this->bayi_durum = 6;
            $this->sp_durum = 6;
            $this->bayititle = "Tamamlanamadı";
            $this->bayitext = "Siparişiniz bayi sorgusunda TAMAMLANAMAMIŞ olarak görünüyor";
        } elseif ($item=="Completed") {
            $this->bayi_durum = 4;
            $this->sp_durum = 4;
            $this->bayititle = "Tamamlandı";
            $this->bayitext = "Siparişiniz bayi sorgusunda Tamamlanmış olarak görünüyor";
        } elseif ($item=="Partial") {
            $this->bayi_durum = 3;
            $this->sp_durum = 3;
            $this->bayititle = "Kısmi Tamamlandı";
            $this->bayitext = "Siparişiniz bayi sorgusunda Kısmi Tamamlanmış olarak görünüyor";
        } elseif ($item=="Inprogress" OR $item == "In progress") {
            $this->bayi_durum = 2;
            $this->sp_durum = 2;
            $this->bayititle = "İşlem Sırasında";
            $this->bayitext = "Siparişiniz bayi sorgusunda işlemde olarak görünüyor";
        } elseif ($item=="Pending") {
            $this->bayi_durum = 2;
            $this->sp_durum = 2;
            $this->bayititle = "İşlem Bekliyor";
            $this->bayitext = "Siparişiniz bayi kayılarında işlem bekliyor olarak görünüyor";
        } else {
            $this->bayi_durum = 7;
            $this->sp_durum = 7;
            $this->bayititle = "Belirsiz Sonuç";
            $this->bayitext = "Siparişiniz bayi sorgusunda belirsiz bir yanıt döndürüyor. Manuel kontrol yapınız";
        }
        
    }
    public function kontrollistesi(){
        $liste = [];
        $this->kontrolGunSayisi = is_numeric(ns_filter('CronJobSetting','item5')) ? ns_filter('CronJobSetting','item5'):1;
        $this->kontrolSiniri = date('Y-m-d H:i:s',strtotime(date("Y-m-d H:i:s") . "-".$this->kontrolGunSayisi." day"));
        $query = "SELECT * FROM " . $this->table_name . " WHERE sp_durum = 2";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        foreach ($stmt as $value) {
            $query = "SELECT * FROM siparis_islem WHERE islem_smm != '0' AND panel_code != '0' AND  sp_code = '".$value["sp_id"]."' AND bayi_kontrol < '".$this->timer."' AND bayi_kontrol > '".$this->kontrolSiniri."' ORDER BY islem_id DESC LIMIT 0,1";
            $islem = $this->conn->prepare($query);
            $islem->execute();
            $row = $islem->fetch(PDO::FETCH_ASSOC);
            if(isset($row["islem_id"])){
                if(count($liste)<20)
                    $liste[] = $row;
            }
        }
        return $liste;
    }
    public function format($item){
        return number_format($item, 2, '.', '');
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
    public function yontem($item = NULL){
        if (empty($item)) {
            $zaman = $this->sp_odeme;
        }
        if ($item==0) {
            return "ONLINE";
        } elseif($item==1) {
            return "EFT/HAVALE";
        } elseif($item==2) {
            return "MOBIL";
        } else {
            return "DİĞER";
        }
    }
    public function MailSMSList($sablon,$hedef = false){
        global $ayar;
        if (empty($this->sp_code))
            return;
        $this->list = array();
        if ($sablon=="yeni-siparis") {
            $this->list[] = array(
                "item1" => "SmsGonderimListesi",
                "item2" => $this->sp_musteri_telefon,
                "item3" => sprintf(_e("%s kodlu siparişinizin ödemesi onaylandı ve siparişiniz işleme alındı",true).' =>'.ns_filter('siteurl'),$this->sp_code),
                "item4" => "sms_musteri_yeni_siparis",
                "item5" => date("Y-m-d H:i:s"));
            $this->list[] = array(
                "item1" => "MailGonderimListesi",
                "item2" => $this->sp_id,
                "item3" => sprintf(_e("%s kodlu siparişinizin ödemesi onaylandı ve siparişiniz işleme alındı",true),$this->sp_code),
                "item4" => "mail_musteri_yeni_siparis",
                "item5" => date("Y-m-d H:i:s"));
            if ($hedef) {
                global $user;
                $user->bildirimlist();
                $this->list[] = array(
                    "item1" => "SmsGonderimListesi",
                    "item2" => $user->phonelist,
                    "item3" => $this->sp_paket_adi." adlı ürün için ".$this->sp_code." kodlu yeni bir siparişiniz var. Gönderim Türü:".$this->islem_turu,
                    "item4" => "sms_yonetici_yeni_siparis",
                    "item5" => date("Y-m-d H:i:s"));
                $this->list[] = array(
                    "item1" => "MailGonderimListesi",
                    "item2" => $this->sp_id,
                    "item3" => $this->sp_paket_adi." adlı ürün için ".$this->sp_code." kodlu yeni bir siparişiniz var. Gönderim Türü:".$this->islem_turu,
                    "item4" => "mail_yonetici_yeni_siparis",
                    "item5" => date("Y-m-d H:i:s"));
            }
        } elseif ($sablon=="iade-edildi") {
            $this->list[] = array(
                "item1" => "SmsGonderimListesi",
                "item2" => $this->sp_musteri_telefon,
                "item3" => sprintf(_e("%u kodlu siparişiniz iptal edilerek ödeme iade süreciniz başlatılmıştır. İade süreci 3-10 iş günü sürebilir",true).' =>'.ns_filter('siteurl'),$this->sp_code),
                "item4" => "sms_musteri_siparis_iptal_edildi",
                "item5" => date("Y-m-d H:i:s"));
            $this->list[] = array(
                "item1" => "MailGonderimListesi",
                "item2" => $this->sp_id,
                "item3" => sprintf(_e("%u kodlu siparişiniz iptal edilerek ödeme iade süreciniz başlatılmıştır. İade süreci 3-10 iş günü sürebilir",true),$this->sp_code),
                "item4" => "mail_musteri_siparis_iptal_edildi",
                "item5" => date("Y-m-d H:i:s"));
        } elseif ($sablon=="tamamlandi") {
            $this->list[] = array(
                "item1" => "SmsGonderimListesi",
                "item2" => $this->sp_musteri_telefon,
                "item3" => sprintf(_e("%u kodlu siparişinizin gönderimi tamamlanmıştır. Bizi tercih ettiğiniz için teşekkür ederiz",true).' =>'.ns_filter('siteurl'),$this->sp_code),
                "item4" => "sms_musteri_siparis_tamamlandi",
                "item5" => date("Y-m-d H:i:s"));
            $this->list[] = array(
                "item1" => "MailGonderimListesi",
                "item2" => $this->sp_id,
                "item3" => sprintf(_e("%u kodlu siparişinizin gönderimi tamamlanmıştır. Bizi tercih ettiğiniz için teşekkür ederiz",true),$this->sp_code),
                "item4" => "mail_musteri_siparis_tamamlandi",
                "item5" => date("Y-m-d H:i:s"));
        } elseif ($sablon=="tamamlanamadi") {
            global $user;
            $user->bildirimlist();
            $this->list[] = array(
                "item1" => "SmsGonderimListesi",
                "item2" => $user->phonelist,
                "item3" => $this->sp_code." kodlu ".$this->sp_paket_adi." siparişi gönderildiği bayide tamamalanamadı yada bayiye iletilemedi. Manuel olarak kontrol sağlamanız gerekiyor",
                "item4" => "sms_yonetici_siparis_hata",
                "item5" => date("Y-m-d H:i:s"));
            $this->list[] = array(
                "item1" => "MailGonderimListesi",
                "item2" => $this->sp_id,
                "item3" => $this->sp_code." kodlu ".$this->sp_paket_adi." siparişi gönderildiği bayide tamamalanamadı yada bayiye iletilemedi. Manuel olarak kontrol sağlamanız gerekiyor",
                "item4" => "mail_yonetici_siparis_hata",
                "item5" => date("Y-m-d H:i:s"));
        }
        foreach ($this->list as $value) {
            $ayar->item = $value;
            $ayar->insert();
        }
        unset($this->list);
        return true;
    }
}
