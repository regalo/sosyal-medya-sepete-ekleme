<?php
class Kategori{
    use PDOCache;
    private $conn;
    private $table_name = "hizmetler";
    public $hz_id;
    public $hz_adi;
    public $hz_seo_adi;
    public $hz_pri;
    public $hz_text;
    public $hz_makale;
    public $pt_tax;
    public $hz_icon;
    public $i_baslik;
    public $i_place;
    public $i_uyari;
    public $i_extra;
    public function __construct($db){
        $this->conn = $db;
    }
    function select($item = "", $out = "row"){
        $this->hz_id = isset($this->hz_id) ? $this->hz_id: $item;
        if(!$row = $this->export($this->hz_id)) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE hz_id = ? limit 0,1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->hz_id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->import($this->hz_id,$row);
        }
        if (isset($row["hz_id"]) AND $item!="nonethis") {
            foreach ($row as $key => $value) {
                $this->$key = $value;
            }
            return true;
        } elseif (isset($row["hz_id"]) AND $item=="nonethis") {
            return $row;
        }
        return false;
    }
    function sonid(){
        $query = "SELECT hz_id FROM " . $this->table_name . " ORDER BY hz_id  DESC limit 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row["hz_id"];
    }
    function all($from_record_num = 0, $records_per_page = 20){
        $siralama = ns_filter('ns_ranking','item3');
        if (isset($this->pt_tax)) {
             $query = "SELECT * FROM ".$this->table_name." WHERE pt_tax = :pt_tax ORDER BY {$siralama} LIMIT {$from_record_num}, {$records_per_page}";
             $stmt = $this->conn->prepare($query);
             $stmt->bindParam(':pt_tax', $this->pt_tax);
             $stmt->execute();
             return $stmt;
        }
        $query = "SELECT * FROM ".$this->table_name." ORDER BY pt_tax DESC, {$siralama} LIMIT {$from_record_num}, {$records_per_page}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
     function count($item = ""){
        if (!empty($item)) {
            $query = "SELECT COUNT(hz_id) FROM ".$this->table_name." WHERE pt_tax = :pt_tax";
            $stmt = $this->conn->prepare($query);
            $this->pt_tax = htmlspecialchars(strip_tags($item));
            $stmt->bindParam(':pt_tax', $this->pt_tax);
            $stmt->execute();
            return $stmt->fetchColumn();
        }
        $query = "SELECT COUNT(hz_id) FROM ".$this->table_name."";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    function primary($item,$pt_tax=""){
        if (empty($pt_tax)) {
            $query = "SELECT hz_id FROM " . $this->table_name . " WHERE hz_pri = :hz_pri limit 0,1";
            $stmt = $this->conn->prepare($query);
            $this->hz_pri = htmlspecialchars(strip_tags($item));
            $stmt->bindParam(':hz_pri', $this->hz_pri);
            $stmt->execute();
        } else {
            $query = "SELECT hz_id FROM " . $this->table_name . " WHERE hz_pri = :hz_pri AND pt_tax = :pt_tax limit 0,1";
            $stmt = $this->conn->prepare($query);
            $this->hz_pri = htmlspecialchars(strip_tags($item));
            $stmt->bindParam(':hz_pri', $this->hz_pri);
            $stmt->bindParam(':pt_tax', $pt_tax);
            $stmt->execute();
        }
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($row["hz_id"])) {
            $this->hz_id = $row["hz_id"];
            return true;
        }
        return false;
    }
    function update($idsi = ""){
        $query = "UPDATE ".$this->table_name." SET hz_row = :hz_row, hz_adi = :hz_adi, hz_seo_adi = :hz_seo_adi, hz_pri = :hz_pri, hz_text = :hz_text, hz_makale = :hz_makale, pt_tax = :pt_tax, hz_icon = :hz_icon,i_baslik = :i_baslik,i_place = :i_place,i_uyari = :i_uyari,i_extra = :i_extra WHERE hz_id = :id";     
        $stmt = $this->conn->prepare($query);
        $this->hz_id = empty($idsi) ? $this->hz_id: $idsi;
        $this->hz_adi=htmlspecialchars(strip_tags($this->hz_adi));
        $this->hz_seo_adi=htmlspecialchars(strip_tags($this->hz_seo_adi));
        $this->hz_pri = $this->hz_pri_control();
        $this->hz_text=htmlspecialchars(strip_tags($this->hz_text));
        $this->hz_makale= $this->hz_makale;
        $this->pt_tax=htmlspecialchars(strip_tags($this->pt_tax));
        $this->hz_icon=htmlspecialchars(strip_tags($this->hz_icon));
        $this->i_baslik=htmlspecialchars(strip_tags($this->i_baslik));
        $this->i_place=htmlspecialchars(strip_tags($this->i_place));
        $this->i_uyari=htmlspecialchars(strip_tags($this->i_uyari));
        $this->i_extra=htmlspecialchars(strip_tags($this->i_extra));
        $stmt->bindParam(':hz_row', $this->hz_row);
        $stmt->bindParam(':hz_adi', $this->hz_adi);
        $stmt->bindParam(':hz_seo_adi', $this->hz_seo_adi);
        $stmt->bindParam(':hz_pri', $this->hz_pri);
        $stmt->bindParam(':hz_text', $this->hz_text);
        $stmt->bindParam(':hz_makale', $this->hz_makale);
        $stmt->bindParam(':pt_tax', $this->pt_tax);
        $stmt->bindParam(':hz_icon', $this->hz_icon);
        $stmt->bindParam(':i_baslik', $this->i_baslik);
        $stmt->bindParam(':i_place', $this->i_place);
        $stmt->bindParam(':i_uyari', $this->i_uyari);
        $stmt->bindParam(':i_extra', $this->i_extra);
        $stmt->bindParam(':id', $this->hz_id);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    public function hz_pri_control(){
        $kontrol = $this->hz_pri;
        for ($i=2; $i < 25; $i++) { 
            if(ns_filter('permalink')=="seo")
                $query = "SELECT COUNT(hz_id) FROM ".$this->table_name." WHERE hz_pri = :hz_pri AND hz_id != :hz_id";
            else 
                $query = "SELECT COUNT(hz_id) FROM ".$this->table_name." WHERE hz_pri = :hz_pri AND pt_tax = :pt_tax AND hz_id != :hz_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':hz_pri', $kontrol);
            $stmt->bindParam(':hz_id', $this->hz_id);
            if(ns_filter('permalink')!="seo")
                $stmt->bindParam(':pt_tax', $this->pt_tax);
            $stmt->execute();
            if($stmt->fetchColumn()<1)
                return $kontrol;
            $kontrol = $this->hz_pri.'-'.$i;
        }
    }
    function insert($item = ""){
        $item = isset($this->item) ? $this->item: $item;
        $query = "INSERT INTO ".$this->table_name." SET hz_adi = :hz_adi, hz_seo_adi = :hz_seo_adi, hz_pri = :hz_pri, hz_text = :hz_text, hz_makale = :hz_makale, pt_tax = :pt_tax, hz_icon = :hz_icon, i_baslik = :i_baslik, i_place = :i_place, i_uyari = :i_uyari, i_extra = :i_extra";
        $stmt = $this->conn->prepare($query);
        $this->hz_adi = isset($item["hz_adi"]) ? htmlspecialchars(strip_tags($item["hz_adi"])): "";
        $this->hz_seo_adi = isset($item["hz_seo_adi"]) ? htmlspecialchars(strip_tags($item["hz_seo_adi"])): "";
        $this->hz_pri= $this->pri();
        $this->hz_text = isset($item["hz_text"]) ? htmlspecialchars(strip_tags($item["hz_text"])): "";
        $this->hz_makale = isset($item["hz_makale"]) ? $item["hz_makale"]: "";
        $this->pt_tax = isset($item["pt_tax"]) ? htmlspecialchars(strip_tags($item["pt_tax"])): "";
        $this->hz_icon = isset($item["hz_icon"]) ? htmlspecialchars(strip_tags($item["hz_icon"])): "";
        $this->i_baslik = isset($item["i_baslik"]) ? htmlspecialchars(strip_tags($item["i_baslik"])): "";
        $this->i_place = isset($item["i_place"]) ? htmlspecialchars(strip_tags($item["i_place"])): "";
        $this->i_uyari = isset($item["i_uyari"]) ? htmlspecialchars(strip_tags($item["i_uyari"])): "";
        $this->i_extra = isset($item["i_extra"]) ? htmlspecialchars(strip_tags($item["i_extra"])): 0;
        $stmt->bindParam(':hz_adi', $this->hz_adi);
        $stmt->bindParam(':hz_seo_adi', $this->hz_seo_adi);
        $stmt->bindParam(':hz_pri', $this->hz_pri);
        $stmt->bindParam(':hz_text', $this->hz_text);
        $stmt->bindParam(':hz_makale', $this->hz_makale);
        $stmt->bindParam(':pt_tax', $this->pt_tax);
        $stmt->bindParam(':hz_icon', $this->hz_icon);
        $stmt->bindParam(':i_baslik', $this->i_baslik);
        $stmt->bindParam(':i_place', $this->i_place);
        $stmt->bindParam(':i_uyari', $this->i_uyari);
        $stmt->bindParam(':i_extra', $this->i_extra);
        if($stmt->execute()){
            $this->hz_id = $this->sonid();
            return $this->hz_id;
        }else{
            return false;
        }
    }
    function delete($bind = "hz_id", $idsi = ""){ 
        $query = "DELETE FROM ".$this->table_name." WHERE ".$bind." = :id";
        $stmt = $this->conn->prepare($query);
        $id = empty($idsi) ? $this->hz_id: $idsi;
        $stmt->bindParam(':id', $id);
        if($result = $stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function pri(){
        global $ayar;
        if ($ayar->permalink=="seo") {
            $text = $this->hz_seo_adi;
        } else {
            $text = $this->hz_adi;
        }
        $text = mb_substr($text, 0, 49, "UTF-8");
        $trHarf = array('’',"'",'|','ñ',' ', 'ß', 'ä', '.',',','ş','Ş','ö','Ö','ğ','Ğ','ü','Ü','ç','Ç','ı','İ',"'",'"','%','é','/','?','=','(',')','_',':',';','~','¨','<','>','£','#','$','½','{','}','*','!','\\','&','^','+');
        $enHarf = array('-','','-','n','-','b','a','','','s','s','o','o','g','g','u','u','c','c','i','i','-','-','-','e','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-');
        $text = str_replace($trHarf, $enHarf, $text);
        $text = str_replace("---", "-", $text);
        $text = str_replace("--", "-", $text);
        $text = strtolower($text);
        return mb_substr($text, 0,50);
    }
}