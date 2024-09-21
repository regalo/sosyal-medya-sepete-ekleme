<?php
class Paket {
    use PDOCache;
    private $conn;
    private $table_name = "paketler";
    public $pk_id;
    public $pk_tur;
    public $pk_oto_servis_id;
    public $pk_adi;
    public $pk_pri;
    public $pk_adet;
    public $pk_fiyat;
    public $hz_tax;
    public $pk_durum;
    public function __construct($db){
        $this->conn = $db;
    }
    public function select($item = "", $out = "row"){
        $this->pk_id = isset($this->pk_id) ? $this->pk_id: $item;
        if(!$row = $this->export($this->pk_id)){
            $query = "SELECT * FROM " . $this->table_name . " WHERE pk_id = :pk_id limit 0,1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':pk_id', $this->pk_id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->import($this->pk_id,$row);
        }
        if (isset($row["pk_id"]) AND $item!="nonethis") {
            foreach ($row as $key => $value) {
                $this->$key = $value;
            }
            return true;
        } elseif (isset($row["pk_id"]) AND $item=="nonethis") {
            return $row;
        }
        return false;
    }
    public function primary($item){
        $query = "SELECT pk_id FROM " . $this->table_name . " WHERE pk_pri = :pk_pri limit 0,1";
        $stmt = $this->conn->prepare($query);
        $this->pk_pri = htmlspecialchars(strip_tags($item));
        $stmt->bindParam(':pk_pri', $this->pk_pri);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($row["pk_id"])) {
            $this->pk_id = $row["pk_id"];
            return true;
        }
        return false;
    }
    public function sonid(){
        $query = "SELECT pk_id FROM " . $this->table_name . " ORDER BY pk_id DESC limit 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $item);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->pk_id = $row["pk_id"];
        return $row["pk_id"];
    }
    public function all($from_record_num = 0, $records_per_page = 20){
        $siralama = ns_filter('ns_ranking');
        if (isset($this->hz_tax)) {
            $query = "SELECT * FROM ".$this->table_name." WHERE hz_tax = :hz_tax ORDER BY {$siralama} LIMIT {$from_record_num}, {$records_per_page}";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':hz_tax', $this->hz_tax);
            $stmt->execute();
            return $stmt;
        }
        $query = "SELECT * FROM ".$this->table_name." ORDER BY hz_tax DESC, {$siralama} LIMIT {$from_record_num}, {$records_per_page}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function count(){
        if (isset($this->hz_tax)) {
             $query = "SELECT COUNT(pk_id) FROM ".$this->table_name." WHERE hz_tax = :hz_tax";
             $stmt = $this->conn->prepare($query);
             $stmt->bindParam(':hz_tax', $this->hz_tax);
             $stmt->execute();
             return $stmt->fetchColumn();
        }
        $query = "SELECT COUNT(pk_id) FROM ".$this->table_name."";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    public function api($smm_id){
        $query = "SELECT pk_id FROM ".$this->table_name." WHERE pk_oto_servis_id LIKE ?";
        $stmt = $this->conn->prepare($query);
        $search_term = "{$smm_id}-%";
        $stmt->bindParam(1, $search_term);
        $stmt->execute();
        return $stmt;
    }
    public function update($idsi = ""){
        $query = "UPDATE ".$this->table_name." SET pk_tur = :pk_tur, pk_oto_servis_id = :pk_oto_servis_id, pk_adi = :pk_adi, pk_pri = :pk_pri, pk_adet = :pk_adet, pk_fiyat = :pk_fiyat, hz_tax = :hz_tax, pk_durum = :pk_durum WHERE pk_id = :id";     
        $stmt = $this->conn->prepare($query);
        $this->pk_tur = htmlspecialchars(strip_tags($this->pk_tur));
        $this->pk_oto_servis_id = $this->pk_tur == "manuel" ? "" : htmlspecialchars(strip_tags($this->pk_oto_servis_id));
        $this->pk_adi = htmlspecialchars(strip_tags($this->pk_adi));
        $this->hz_tax = htmlspecialchars(strip_tags($this->hz_tax));
        $this->pk_pri = isset($this->primary) ? $this->primary:$this->pri();
        $this->pk_adet = htmlspecialchars(strip_tags($this->pk_adet));
        $this->pk_fiyat = htmlspecialchars(strip_tags($this->pk_fiyat));
        $this->pk_durum = htmlspecialchars(strip_tags($this->pk_durum));
        $id = empty($idsi) ? $this->pk_id: $idsi;
        $stmt->bindParam(':pk_tur', $this->pk_tur);
        $stmt->bindParam(':pk_oto_servis_id', $this->pk_oto_servis_id);
        $stmt->bindParam(':pk_adi', $this->pk_adi);
        $stmt->bindParam(':pk_pri', $this->pk_pri);
        $stmt->bindParam(':pk_adet', $this->pk_adet);
        $stmt->bindParam(':pk_fiyat', $this->pk_fiyat);
        $stmt->bindParam(':hz_tax', $this->hz_tax);
        $stmt->bindParam(':pk_durum', $this->pk_durum);
        $stmt->bindParam(':id', $id);
        if($stmt->execute()){
            if (isset($this->ozellik)) {
                $this->ozellikdelete();
                $this->oz_tax = $this->pk_id;
                foreach ($this->ozellik as $value) {
                    $this->oz_text = $value;
                    $this->ozellikinsert();
                }
            }
            return true;
        }
        return false;
    }
    public function insert($item = ""){
        $item = empty($item) ? $this->item: $item;
        $query = "INSERT INTO ".$this->table_name." SET pk_tur = :pk_tur, pk_oto_servis_id = :pk_oto_servis_id, pk_adi = :pk_adi, pk_pri = :pk_pri, pk_adet = :pk_adet, pk_fiyat = :pk_fiyat, hz_tax = :hz_tax, pk_durum = :pk_durum";
        $stmt = $this->conn->prepare($query);
        $this->pk_tur = isset($item["pk_tur"]) ? htmlspecialchars(strip_tags($item["pk_tur"])): "manuel";
        $this->pk_oto_servis_id = $this->pk_tur == "manuel" ? "" : htmlspecialchars(strip_tags($item["pk_oto_servis_id"]));
        $this->pk_adi = isset($item["pk_adi"]) ? htmlspecialchars(strip_tags($item["pk_adi"])): "";
        $this->hz_tax = isset($item["hz_tax"]) ? htmlspecialchars(strip_tags($item["hz_tax"])): "";
        $this->pk_pri = "new";
        $this->pk_adet = isset($item["pk_adet"]) ? htmlspecialchars(strip_tags($item["pk_adet"])): 0;
        $this->pk_fiyat = isset($item["pk_fiyat"]) ? htmlspecialchars(strip_tags($item["pk_fiyat"])): "";
        $this->pk_durum = 1;
        $stmt->bindParam(':pk_tur', $this->pk_tur);
        $stmt->bindParam(':pk_oto_servis_id', $this->pk_oto_servis_id);
        $stmt->bindParam(':pk_adi', $this->pk_adi);
        $stmt->bindParam(':pk_pri', $this->pk_pri);
        $stmt->bindParam(':pk_adet', $this->pk_adet);
        $stmt->bindParam(':pk_fiyat', $this->pk_fiyat);
        $stmt->bindParam(':hz_tax', $this->hz_tax);
        $stmt->bindParam(':pk_durum', $this->pk_durum);
        if($stmt->execute()){
            $this->pk_id = $this->sonid();
            $this->pk_pri = $this->pri();
            $this->update();
            $this->oz_tax = $this->pk_id;
            foreach ($item["ozellik"] as $value) {
                $this->oz_text = $value;
                $this->ozellikinsert();
            }
            return true;
        }else{
            return false;
        }
    }
    public function copy($item = ""){
        $query = "INSERT INTO ".$this->table_name." SET pk_tur = :pk_tur, pk_oto_servis_id = :pk_oto_servis_id, pk_adi = :pk_adi, pk_pri = :pk_pri, pk_adet = :pk_adet, pk_fiyat = :pk_fiyat, hz_tax = :hz_tax, pk_durum = :pk_durum";
        $stmt = $this->conn->prepare($query);
        $this->pk_tur = htmlspecialchars(strip_tags($this->pk_tur));
        $this->pk_oto_servis_id = $this->pk_tur == "manuel" ? "" : htmlspecialchars(strip_tags($this->pk_oto_servis_id));
        $this->pk_adi = htmlspecialchars(strip_tags($this->pk_adi));
        $this->pk_pri = $this->pri();
        $this->pk_adet = htmlspecialchars(strip_tags($this->pk_adet));
        $this->pk_fiyat = htmlspecialchars(strip_tags($this->pk_fiyat));
        $this->hz_tax = htmlspecialchars(strip_tags($this->hz_tax));
        $this->pk_durum = htmlspecialchars(strip_tags($this->pk_durum));
        $this->ozellikler = $this->ozellikler();
        $stmt->bindParam(':pk_tur', $this->pk_tur);
        $stmt->bindParam(':pk_oto_servis_id', $this->pk_oto_servis_id);
        $stmt->bindParam(':pk_adi', $this->pk_adi);
        $stmt->bindParam(':pk_pri', $this->pk_pri);
        $stmt->bindParam(':pk_adet', $this->pk_adet);
        $stmt->bindParam(':pk_fiyat', $this->pk_fiyat);
        $stmt->bindParam(':hz_tax', $this->hz_tax);
        $stmt->bindParam(':pk_durum', $this->pk_durum);
        if($stmt->execute()){
            $this->pk_id = $this->sonid();
            $this->pk_pri = $this->pri();
            $this->update();
            $this->oz_tax = $this->pk_id;
            foreach ($this->ozellikler as $value) {
                $this->oz_text = $value["oz_text"];
                $this->ozellikinsert();
            }
            return $this->pk_id;
        }else{
            return false;
        }
    }
    public function delete($bind = "pk_id", $idsi = ""){
        $query = "DELETE FROM ".$this->table_name." WHERE ".$bind." = :id";
        $stmt = $this->conn->prepare($query);
        $id = empty($idsi) ? $this->pk_id: $idsi;
        $stmt->bindParam(':id', $id);
        if($result = $stmt->execute()){
            $this->ozellikdelete();
            return true;
        } else {
            return false;
        }
    }
    public function ozellik(){
        if(!$row = $this->export('_ozellik'.$this->oz_id)) {
            $query = "SELECT oz_text FROM ozellikler WHERE oz_id = ? limit 0,1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->pk_id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->import('_ozellik'.$this->oz_id,$row);
        }
        if(isset($row{"oz_text"})){
            $this->oz_text = $row["oz_text"];
            return $out == "row" ? $row : $row[$out];
        }
        return false;
    }
    public function ozellikler(){
        if(!$stmt = $this->export('_ozellikler'.$this->pk_id)) {
            $query = "SELECT oz_text, oz_id FROM ozellikler WHERE oz_tax = :oz_tax ORDER BY oz_id ASC";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':oz_tax', $this->pk_id);
            $stmt->execute();
            $list = [];
            foreach ($stmt as $key => $value) {
                $list[] = $value;
            }
            $this->import('_ozellikler'.$this->pk_id,$list);
            $stmt = $list;
        }
        return $stmt;
    }
    public function ozellikinsert(){
        $query = "INSERT INTO ozellikler SET oz_tax = :oz_tax , oz_text = :oz_text";
        $stmt = $this->conn->prepare($query);
        $this->oz_tax = htmlspecialchars(strip_tags($this->oz_tax));
        $this->oz_text = htmlspecialchars(strip_tags($this->oz_text));
        $stmt->bindParam(':oz_tax', $this->pk_id);
        $stmt->bindParam(':oz_text', $this->oz_text);
        if($stmt->execute()){
             return true;
        } else {
            return false;
        }
    }
    public function ozellikdelete($bind = "oz_tax", $idsi = ""){
        $query = "DELETE FROM ozellikler WHERE ".$bind." = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->pk_id);
        if($result = $stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function PaketLink(){
        foreach ($this->all(0,1000) as $value) {
            $this->pk_id = $value["pk_id"];
            $this->select();
            unset($this->primary);
            $this->update();
        }
    }
    public function pri(){
        global $platform,$kategori;
        $kategori->hz_id = htmlspecialchars(strip_tags($this->hz_tax));
        $text = $this->pk_id.'-'.$this->pk_adi;
        $trHarf = array('’',"'",'|','ñ',' ', 'ß', 'ä', '.',',','ş','Ş','ö','Ö','ğ','Ğ','ü','Ü','ç','Ç','ı','İ',"'",'"','%','é','/','?','=','(',')','_',':',';','~','¨','<','>','£','#','$','½','{','}','*','!','\\','&','^','+');
        $enHarf = array('-','','-','n','-','b','a','','','s','s','o','o','g','g','u','u','c','c','i','i','-','-','-','e','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-');
        $text = str_replace($trHarf, $enHarf, $text);
        $text = str_replace("---", "-", $text);
        $text = str_replace("--", "-", $text);
        $text = strtolower($text);
        return $text;
    }
}