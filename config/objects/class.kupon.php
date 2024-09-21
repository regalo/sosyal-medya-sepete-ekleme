<?php
class Kupon{
    private $conn;
    private $table_name = "kuponlar";
    public $kupon_id;
    public $kupon_tax;
    public $kupon_kodu;
    public $kupon_oran;
    public $kupon_durum;
    public function __construct($db){
        $this->conn = $db;
    }
    function select($item = "", $out = "row"){
        $query = "SELECT * FROM " . $this->table_name . " WHERE kupon_id = ? limit 0,1";
        $stmt = $this->conn->prepare($query);
        $item = empty($item) ? $this->kupon_id: $item;
        $stmt->bindParam(1, $item);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->kupon_id = $row["kupon_id"];
        $this->kupon_tax = $row["kupon_tax"];
        $this->kupon_kodu = $row["kupon_kodu"];
        $this->kupon_oran = $row["kupon_oran"];
        $this->kupon_durum = $row["kupon_durum"];
        return $out == "row" ? $row : $row[$out];
    }
    function sonid(){
        $query = "SELECT kupon_id FROM " . $this->table_name . " ORDER BY kupon_id DESC limit 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $item);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->kupon_id = $row["kupon_id"];
        return $row["kupon_id"];
    }
    public function all($from_record_num = 0, $records_per_page = 20){
        $query = "SELECT * FROM ".$this->table_name." ORDER BY kupon_id DESC LIMIT {$from_record_num}, {$records_per_page}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function count(){
        $query = "SELECT COUNT(kupon_id) FROM ".$this->table_name." ORDER BY kupon_id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    public function coupon_control($code,$pk_tutar){
        $this->kupon_kodu = htmlspecialchars(strip_tags($code)); 
        if (!empty($this->kupon_kodu)) {
            $this->paket = htmlspecialchars(strip_tags($this->paket));
            $this->kategori = htmlspecialchars(strip_tags($this->kategori));
            $this->platform = htmlspecialchars(strip_tags($this->platform));
            $this->pktax = $this->platform.'-'.$this->kategori.'-'.$this->paket;
            $this->ktax = $this->platform.'-'.$this->kategori.'-0';
            $this->ptax = $this->platform.'-0-0';
            $this->full = '0-0-0';
            $query = "SELECT kupon_tax, kupon_id FROM ".$this->table_name."  WHERE kupon_kodu = :kupon_kodu AND kupon_durum = 1 ORDER BY kupon_oran DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':kupon_kodu', $this->kupon_kodu);
            $stmt->execute();
            foreach ($stmt->fetchAll() as $value) {
                extract($value);
                if ($kupon_tax == $this->pktax OR $kupon_tax == $this->ktax OR $kupon_tax == $this->ptax OR $kupon_tax == $this->full) {
                    $this->kupon_id = $kupon_id;
                    $this->select();
                    $this->indirim = ($pk_tutar/100)*$this->kupon_oran;
                    $this->kupon_fee = $pk_tutar - $this->indirim;
                    return true;
                }
            }
        }
        $this->indirim = 0;
        $this->kupon_fee = $pk_tutar;
        return false;
    }
    public function update($idsi = ""){
        $query = "UPDATE ".$this->table_name." SET kupon_tax = :kupon_tax, kupon_kodu = :kupon_kodu, kupon_oran = :kupon_oran, kupon_durum = :kupon_durum WHERE kupon_id = :id";     
        $stmt = $this->conn->prepare($query);
        $this->kupon_tax = htmlspecialchars(strip_tags($this->kupon_tax));
        $this->kupon_kodu = htmlspecialchars(strip_tags($this->kupon_kodu));
        $this->kupon_oran = htmlspecialchars(strip_tags($this->kupon_oran));
        $this->kupon_durum = htmlspecialchars(strip_tags($this->kupon_durum));
        $id = empty($idsi)? $this->kupon_id: $idsi;
        $stmt->bindParam(':kupon_tax', $this->kupon_tax);
        $stmt->bindParam(':kupon_kodu', $this->kupon_kodu);
        $stmt->bindParam(':kupon_oran', $this->kupon_oran);
        $stmt->bindParam(':kupon_durum', $this->kupon_durum);
        $stmt->bindParam(':id', $id);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    function insert($item=""){
        $item = empty($item) ? $this->item: $item;
        $query = "INSERT INTO ".$this->table_name." SET kupon_tax = :kupon_tax,kupon_kodu = :kupon_kodu, kupon_oran = :kupon_oran, kupon_durum = :kupon_durum";
        $stmt = $this->conn->prepare($query);
        $this->kupon_tax = isset($item["kupon_tax"]) ? htmlspecialchars(strip_tags($item["kupon_tax"])): "";
        $this->kupon_kodu = isset($item["kupon_kodu"]) ? htmlspecialchars(strip_tags($item["kupon_kodu"])): "";
        $this->kupon_oran = isset($item["kupon_oran"]) ? htmlspecialchars(strip_tags($item["kupon_oran"])): 10;
        $this->kupon_durum = 1;
        $stmt->bindParam(':kupon_tax', $this->kupon_tax);
        $stmt->bindParam(':kupon_kodu', $this->kupon_kodu);
        $stmt->bindParam(':kupon_oran', $this->kupon_oran);
        $stmt->bindParam(':kupon_durum', $this->kupon_durum);
        if($stmt->execute()){
             $this->kupon_id = $this->sonid();
             return $this->kupon_id;
        }else{
            return false;
        }
    }
    function delete($bind = "kupon_id", $idsi = ""){
        $query = "DELETE FROM ".$this->table_name." WHERE ".$bind." = :id";
        $stmt = $this->conn->prepare($query);
        $id = empty($idsi) ? $this->kupon_id: $idsi;
        $stmt->bindParam(':id', $id);
        if($result = $stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function tur($item){
        $parcala = explode("-", $item);
        if (empty($parcala[0])) {
            $this->tur = "all";
        } elseif (empty($parcala[1])) {
            $this->tur = "platform";
        } elseif (empty($parcala[2])) {
            $this->tur = "kategori";
        } else {
            $this->tur = "paket";
        }
        $this->pt_id = $parcala[0];
        $this->hz_id = $parcala[1];
        $this->pk_id = $parcala[2];
        return true;
    }
}