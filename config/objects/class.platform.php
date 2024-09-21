<?php
class Platform{
	use PDOCache;
    private $conn;
    private $table_name = "platform";
    public $pt_id;
    public $pt_name;
    public $pt_seo;
    public $pt_primary;
    public $pt_text;
    public $pt_icon;
    public function __construct($db){
        $this->conn = $db;
    }
    function select($item = "", $out = "row"){
        $this->pt_id = htmlspecialchars(strip_tags($this->pt_id));
    	if(!$row = $this->export($this->pt_id)) {
	        $query = "SELECT * FROM " . $this->table_name . " WHERE pt_id = :pt_id limit 0,1";
	        $stmt = $this->conn->prepare($query);
	        $stmt->bindParam(':pt_id', $this->pt_id);
	        $stmt->execute();
	        $row = $stmt->fetch(PDO::FETCH_ASSOC);
	        $this->import($this->pt_id,$row);
	    }
        if (isset($row["pt_id"]) AND $item!="nonethis") {
            foreach ($row as $key => $value) {
                $this->$key = $value;
            }
            return true;
        } elseif (isset($row["pt_id"]) AND $item=="nonethis") {
            return $row;
        }
        return false;
    }
    function primary($item){
        $query = "SELECT * FROM " . $this->table_name . " WHERE pt_primary = :pt_primary limit 0,1";
        $stmt = $this->conn->prepare($query);
        $this->pt_primary = htmlspecialchars(strip_tags($item));
        $stmt->bindParam(':pt_primary', $this->pt_primary);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($row["pt_id"])) {
            foreach ($row as $key => $value) {
                $this->$key = $value;
            }
            return true;
        }
        return false;
    }
    function sonid(){
        $query = "SELECT pt_id FROM " . $this->table_name . " ORDER BY pt_id DESC limit 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $item);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->pt_id = $row["pt_id"];
        return $row["pt_id"];
    }
    function all($from_record_num = 0, $records_per_page = 20){
        $siralama = empty(ns_filter('ns_ranking','item4')) ? 'pt_id DESC':ns_filter('ns_ranking','item4');
        $query = "SELECT * FROM ".$this->table_name." ORDER BY {$siralama} LIMIT {$from_record_num}, {$records_per_page}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    function count(){
        $query = "SELECT COUNT(pt_id) FROM ".$this->table_name." ORDER BY pt_id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    function update(){
        $query = "UPDATE ".$this->table_name." SET pt_row = :pt_row, pt_name = :pt_name, pt_seo = :pt_seo, pt_primary = :pt_primary, pt_text = :pt_text, pt_icon = :pt_icon WHERE pt_id = :pt_id";     
        $stmt = $this->conn->prepare($query);
        $this->pt_row = htmlspecialchars(strip_tags($this->pt_row));
        $this->pt_name = htmlspecialchars(strip_tags($this->pt_name));
        $this->pt_seo = htmlspecialchars(strip_tags($this->pt_seo));
        $this->pt_primary = $this->pri();
        $this->pt_text = htmlspecialchars(strip_tags($this->pt_text));
        $this->pt_icon = htmlspecialchars(strip_tags($this->pt_icon));
        $this->pt_id = htmlspecialchars(strip_tags($this->pt_id));
        $stmt->bindParam(':pt_row', $this->pt_row);
        $stmt->bindParam(':pt_name', $this->pt_name);
        $stmt->bindParam(':pt_seo', $this->pt_seo);
        $stmt->bindParam(':pt_primary', $this->pt_primary);
        $stmt->bindParam(':pt_text', $this->pt_text);
        $stmt->bindParam(':pt_icon', $this->pt_icon);
        $stmt->bindParam(':pt_id', $this->pt_id);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    function insert($item = ""){
        $query = "INSERT INTO ".$this->table_name." SET pt_name = :pt_name, pt_seo = :pt_seo, pt_primary = :pt_primary, pt_text = :pt_text, pt_icon = :pt_icon";
        $stmt = $this->conn->prepare($query);
        $item = empty($item) ? $this->item: $item;
        $this->pt_name = isset($item["pt_name"]) ? htmlspecialchars(strip_tags($item["pt_name"])): "";
        $this->pt_seo = isset($item["pt_seo"]) ? htmlspecialchars(strip_tags($item["pt_seo"])): "";
        $this->pt_primary = $this->pri();
        $this->pt_text = isset($item["pt_text"]) ? htmlspecialchars(strip_tags($item["pt_text"])): "";
        $this->pt_icon = isset($item["pt_icon"]) ? htmlspecialchars(strip_tags($item["pt_icon"])): "";
        $stmt->bindParam(':pt_name', $this->pt_name);
        $stmt->bindParam(':pt_seo', $this->pt_seo);
        $stmt->bindParam(':pt_primary', $this->pt_primary);
        $stmt->bindParam(':pt_text', $this->pt_text);
        $stmt->bindParam(':pt_icon', $this->pt_icon);
        if($stmt->execute()){
             $this->pt_id = $this->sonid();
             return $this->pt_id;
        }else{
            return false;
        }
    }
    function delete($bind = "pt_id", $idsi = ""){
        $query = "DELETE FROM ".$this->table_name." WHERE ".$bind." = :id";
        $stmt = $this->conn->prepare($query);
        $id = empty($idsi) ? $this->pt_id : $idsi;
        $stmt->bindParam(':id', $id);
        if($result = $stmt->execute()){
            return true;
        } else {
            return false;
        }
    }
    function pri(){
        $text = $this->pt_name;
        $trHarf = array('’',"'",'|','ñ',' ', 'ß', 'ä', '.',',','ş','Ş','ö','Ö','ğ','Ğ','ü','Ü','ç','Ç','ı','İ',"'",'"','%','é','/','?','=','(',')','_',':',';','~','¨','<','>','£','#','$','½','{','}','*','!','\\','&','^','+');
        $enHarf = array('-','','-','n','-','b','a','','','s','s','o','o','g','g','u','u','c','c','i','i','-','-','-','e','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-');
        $text = str_replace($trHarf, $enHarf, $text);
        $text = str_replace("---", "-", $text);
        $text = str_replace("--", "-", $text);
        $text = strtolower($text);
        return $text;
    }
}