<?php
class Odeme{
    private $conn;
    private $table_name = "odemeler";
    public $o_id;
    public $o_code;
    public $o_time;
    public $o_ad_soyad;
    public $o_aciklama;
    public $o_banka;
    public $o_tutar;
    public $o_durum;
    public function __construct($db){
        $this->conn = $db;
    }
    function select(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE o_code = ? limit 0,1";
        $stmt = $this->conn->prepare($query);
        $this->o_code = htmlspecialchars(strip_tags($this->o_code));
        $stmt->bindParam(1, $this->o_code);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($row["o_id"])) {
            foreach ($row as $key => $value) {
                $this->$key = $value;
            }
            return true;
        }
        return false;
    }
    function sonid(){
        $query = "SELECT o_id FROM " . $this->table_name . " ORDER BY o_id DESC limit 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $item);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->o_id = $row["o_id"];
        return $row["o_id"];
    }
    public function count($statu=""){
        if ($statu!="") {
             $query = "SELECT COUNT(o_id) FROM ".$this->table_name." WHERE o_durum = 0 ORDER BY o_id DESC";
        } else {
             $query = "SELECT COUNT(o_id) FROM ".$this->table_name." ORDER BY o_id DESC";
        }
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    function all($from_record_num = 0, $records_per_page = 20){
        $query = "SELECT * FROM ".$this->table_name." ORDER BY o_durum ASC, o_id DESC LIMIT {$from_record_num}, {$records_per_page}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    function update(){
        $query = "UPDATE ".$this->table_name." SET o_banka = :o_banka, o_time = :o_time, o_aciklama = :o_aciklama, o_ad_soyad = :o_ad_soyad, o_durum = :o_durum WHERE o_id = :id";     
        $stmt = $this->conn->prepare($query);
        $this->o_banka = htmlspecialchars(strip_tags($this->o_banka));
        $this->o_time = htmlspecialchars(strip_tags($this->o_time));
        $this->o_aciklama = htmlspecialchars(strip_tags($this->o_aciklama));
        $this->o_ad_soyad = htmlspecialchars(strip_tags($this->o_ad_soyad));
        $this->o_durum = htmlspecialchars(strip_tags($this->o_durum));
        $this->o_id = htmlspecialchars(strip_tags($this->o_id));
        $stmt->bindParam(':o_banka', $this->o_banka);
        $stmt->bindParam(':o_time', $this->o_time);
        $stmt->bindParam(':o_aciklama', $this->o_aciklama);
        $stmt->bindParam(':o_ad_soyad', $this->o_ad_soyad);
        $stmt->bindParam(':o_durum', $this->o_durum);
        $stmt->bindParam(':id', $this->o_id);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    function insert(){
        $query = "INSERT INTO ".$this->table_name." SET o_code = :o_code,o_time = :o_time, o_ad_soyad = :o_ad_soyad, o_aciklama = :o_aciklama, o_banka = :o_banka, o_tutar = :o_tutar, o_durum = :o_durum";
        $stmt = $this->conn->prepare($query);
        $this->o_code = htmlspecialchars(strip_tags($this->o_code));
        $this->o_time = date("Y-m-d H:i:s");
        $this->o_ad_soyad = htmlspecialchars(strip_tags($this->o_ad_soyad));
        $this->o_aciklama = htmlspecialchars(strip_tags($this->o_aciklama));
        $this->o_banka = htmlspecialchars(strip_tags($this->o_banka));
        $this->o_tutar = htmlspecialchars(strip_tags($this->o_tutar));
        $this->o_durum = 0;
        $stmt->bindParam(':o_code', $this->o_code);
        $stmt->bindParam(':o_time', $this->o_time);
        $stmt->bindParam(':o_ad_soyad', $this->o_ad_soyad);
        $stmt->bindParam(':o_aciklama', $this->o_aciklama);
        $stmt->bindParam(':o_banka', $this->o_banka);
        $stmt->bindParam(':o_tutar', $this->o_tutar);
        $stmt->bindParam(':o_durum', $this->o_durum);
        if($stmt->execute()){
             return true;
        }else{
            return false;
        }
    }
    function delete($bind = "o_id", $idsi = ""){
        $query = "DELETE FROM ".$this->table_name." WHERE ".$bind." = :id";
        $stmt = $this->conn->prepare($query);
        $id = empty($idsi) ? $this->o_id: $idsi;
        $stmt->bindParam(':id', $id);
        if($result = $stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function statu($o_durum){
        if ($o_durum==0) {
            $this->color = 'danger';
            $this->text = "BEKLEMEDE";
        } else {
            $this->color = 'success';
            $this->text = "ONAYLANDI";
        }
        return true;
    }
    public function MailSMSList(){
        global $ayar;
        $ayar->ayar_1 = $this->o_banka;
        $ayar->id();
        $this->list = array();
        global $user;
        $user->bildirimlist();
        $this->list[] = array(
            "item1" => "SmsGonderimListesi",
            "item2" => $user->phonelist,
            "item3" => $this->o_code." kodlu sipariş için ".$this->o_ad_soyad.", ".$ayar->item2." hesabınıza ".$this->o_tutar." TL tutarında ödeme yaptığını bildirdi.",
            "item4" => "sms_yonetici_yeni_odeme",
            "item5" => date("Y-m-d H:i:s"));
        $this->list[] = array(
            "item1" => "MailGonderimListesi",
            "item2" => $this->o_code,
            "item3" => $this->o_code." kodlu sipariş için ".$this->o_ad_soyad.", ".$ayar->item2." hesabınıza ".$this->o_tutar." TL tutarında ödeme yaptığını bildirdi.",
            "item4" => "mail_yonetici_yeni_odeme",
            "item5" => date("Y-m-d H:i:s"));
        foreach ($this->list as $value) {
            $ayar->item = $value;
            $ayar->insert();
        }
    }
}