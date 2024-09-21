<?php
class icerik{
    private $conn;
    private $table_name = "sayfalar";
    public $sayfa_id;
    public $sayfa_baslik;
    public $sayfa_primary;
    public $sayfa_seo_baslik;
    public $sayfa_aciklama;
    public $sayfa_icerik;
    public $sayfa_icon;
    public $sayfa_tur;
    public function __construct($db){
        $this->conn = $db;
    }
    function select($item = "", $out = "row"){
        $query = "SELECT * FROM " . $this->table_name . " WHERE sayfa_id = ? limit 0,1";
        $stmt = $this->conn->prepare($query);
        $this->sayfa_id = !isset($this->sayfa_id) ? $item: $this->sayfa_id;
        $stmt->bindParam(1, $this->sayfa_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($row["sayfa_id"]) AND $item!="nonethis") {
            $this->sayfa_id = $row["sayfa_id"];
            $this->sayfa_baslik = $row["sayfa_baslik"];
            $this->sayfa_primary = $row["sayfa_primary"];
            $this->sayfa_seo_baslik = $row["sayfa_seo_baslik"];
            $this->sayfa_aciklama = $row["sayfa_aciklama"];
            $this->sayfa_icerik = $row["sayfa_icerik"];
            $this->sayfa_icon = $row["sayfa_icon"];
            return true;
        } elseif (isset($row["sayfa_id"]) AND $item=="nonethis") {
            return $row;
        }
        return false;
    }
    function primary($item,$tur){
        if ($tur == "sayfa") {
            $query = "SELECT sayfa_id FROM " . $this->table_name . " WHERE sayfa_primary = ? AND sayfa_icon = 'sayfa' limit 0,1";
        } elseif($tur=="blog") {
            $query = "SELECT sayfa_id FROM " . $this->table_name . " WHERE sayfa_primary = ? AND sayfa_icon != 'sayfa' limit 0,1";
        }
        $this->sayfa_primary = htmlspecialchars(strip_tags($item));
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->sayfa_primary);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($row["sayfa_id"])) {
            $this->sayfa_id = $row["sayfa_id"];
            return true;
        }
        return false;
    }
    function sonid(){
        $query = "SELECT sayfa_id FROM " . $this->table_name . " ORDER BY sayfa_id DESC limit 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $item);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->sayfa_id = $row["sayfa_id"];
        return $row["sayfa_id"];
    }
    function all($from_record_num = 0, $records_per_page = 20){
        if (isset($this->sayfa_tur) AND $this->sayfa_tur == "sayfa") {
            $query = "SELECT * FROM ".$this->table_name." WHERE sayfa_icon = 'sayfa' ORDER BY sayfa_id DESC LIMIT {$from_record_num}, {$records_per_page}";
            $stmt = $this->conn->prepare($query);
        } elseif (isset($this->sayfa_tur)) {
            $query = "SELECT * FROM ".$this->table_name." WHERE sayfa_icon != 'sayfa' ORDER BY sayfa_id DESC LIMIT {$from_record_num}, {$records_per_page}";
            $stmt = $this->conn->prepare($query);
        } else {
            $query = "SELECT sayfa_id,sayfa_icon, sayfa_baslik, sayfa_primary FROM ".$this->table_name." ORDER BY sayfa_id DESC LIMIT {$from_record_num}, {$records_per_page}";
            $stmt = $this->conn->prepare($query);
        }
        $stmt->execute();
        return $stmt;
    }
    function count($tur=""){
        if (empty($tur)) {
            $this->sayfa_tur = "blog";
        }
        if (isset($this->sayfa_tur) AND $this->sayfa_tur == "sayfa") {
            $query = "SELECT COUNT(sayfa_id) FROM ".$this->table_name." WHERE sayfa_icon = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->sayfa_tur);
        } elseif (isset($this->sayfa_tur)) {
            $query = "SELECT COUNT(sayfa_id) FROM ".$this->table_name." WHERE sayfa_icon != ?";
            $stmt = $this->conn->prepare($query);
            $this->sayfa_tur = 'sayfa';
            $stmt->bindParam(1, $this->sayfa_tur);
        } else {
            $query = "SELECT COUNT(sayfa_id) FROM ".$this->table_name."";
            $stmt = $this->conn->prepare($query);
        }
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    function update($idsi = ""){
        $query = "UPDATE ".$this->table_name." SET sayfa_baslik = :sayfa_baslik, sayfa_primary = :sayfa_primary, sayfa_seo_baslik = :sayfa_seo_baslik, sayfa_aciklama = :sayfa_aciklama, sayfa_icerik = :sayfa_icerik, sayfa_icon = :sayfa_icon WHERE sayfa_id = :id";     
        $stmt = $this->conn->prepare($query);
        $this->sayfa_baslik = htmlspecialchars(strip_tags($this->sayfa_baslik));
        $this->sayfa_primary = $this->pri();
        $this->sayfa_seo_baslik = htmlspecialchars(strip_tags($this->sayfa_seo_baslik));
        $this->sayfa_aciklama = htmlspecialchars(strip_tags($this->sayfa_aciklama));
        $this->sayfa_icon = htmlspecialchars(strip_tags($this->sayfa_icon));
        $id = empty($idsi) ? $this->sayfa_id: $idsi;
        $stmt->bindParam(':sayfa_baslik', $this->sayfa_baslik);
        $stmt->bindParam(':sayfa_primary', $this->sayfa_primary);
        $stmt->bindParam(':sayfa_seo_baslik', $this->sayfa_seo_baslik);
        $stmt->bindParam(':sayfa_aciklama', $this->sayfa_aciklama);
        $stmt->bindParam(':sayfa_icerik', $this->sayfa_icerik);
        $stmt->bindParam(':sayfa_icon', $this->sayfa_icon);
        $stmt->bindParam(':id', $id);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    function insert($item = ""){
        $query = "INSERT INTO ".$this->table_name." SET sayfa_baslik = :sayfa_baslik, sayfa_primary = :sayfa_primary, sayfa_seo_baslik = :sayfa_seo_baslik, sayfa_aciklama = :sayfa_aciklama, sayfa_icerik = :sayfa_icerik, sayfa_icon = :sayfa_icon";
        $stmt = $this->conn->prepare($query);
        $item = empty($item) ? $this->item: $item;
        $this->sayfa_baslik = isset($item["sayfa_baslik"]) ? htmlspecialchars(strip_tags($item["sayfa_baslik"])): "";
        $this->sayfa_primary = $this->pri();
        $this->sayfa_seo_baslik = isset($item["sayfa_seo_baslik"]) ? htmlspecialchars(strip_tags($item["sayfa_seo_baslik"])): "";
        $this->sayfa_aciklama = isset($item["sayfa_aciklama"]) ? htmlspecialchars(strip_tags($item["sayfa_aciklama"])): "";
        $this->sayfa_icerik = isset($item["sayfa_icerik"]) ? $item["sayfa_icerik"]: "";
        if (!isset($this->sayfa_icon)) {
            $this->sayfa_icon = isset($item["sayfa_icon"]) ? htmlspecialchars(strip_tags($item["sayfa_icon"])): "sayfa";
        }
        $stmt->bindParam(':sayfa_baslik', $this->sayfa_baslik);
        $stmt->bindParam(':sayfa_primary', $this->sayfa_primary);
        $stmt->bindParam(':sayfa_seo_baslik', $this->sayfa_seo_baslik);
        $stmt->bindParam(':sayfa_aciklama', $this->sayfa_aciklama);
        $stmt->bindParam(':sayfa_icerik', $this->sayfa_icerik);
        $stmt->bindParam(':sayfa_icon', $this->sayfa_icon);
        if($stmt->execute()){
             $this->sayfa_id = $this->sonid();
             return $this->sayfa_id;
        }else{
            return false;
        }
    }
    function delete($bind = "sayfa_id", $idsi = ""){
        $query = "DELETE FROM ".$this->table_name." WHERE ".$bind." = :id";
        $stmt = $this->conn->prepare($query);
        $id = empty($idsi) ? $this->sayfa_id : $idsi;
        $stmt->bindParam(':id', $id);
        if($result = $stmt->execute()){
            return true;
        } else {
            return false;
        }
    }
    public function uploadPhoto(){
        $result_message="";
        if (!empty($_FILES["sayfa_icon"]["name"])) {
            $this->sayfa_icon = $this->pri($_POST["sayfa_baslik"]) . "-" . rand(100000,999999);
        } else {
            return true;
        }
        if($this->sayfa_icon!="sayfa"){
            $uzanti_once = explode(".", $_FILES["sayfa_icon"]["name"]);
            $uzanti = end($uzanti_once);
            $target_directory = "upload/";
            $target_file = $target_directory . $this->sayfa_icon.'.'.$uzanti;
            $this->sayfa_icon = $target_file;
            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
            $file_upload_error_messages="";
            $check = getimagesize($_FILES["sayfa_icon"]["tmp_name"]);
            if($check!==false){
                // submitted file is an image
            } else {
                $file_upload_error_messages .= "<div>Submitted file is not an image.</div>";
            }
            $allowed_file_types = array("jpg", "jpeg", "png", "gif");
            if(!in_array($file_type, $allowed_file_types)){
                $file_upload_error_messages .= "<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
            }
            if(file_exists($target_file)){
                $file_upload_error_messages .= "<div>Image already exists. Try to change file name.</div>";
            }
             
            // make sure submitted file is not too large, can't be larger than 1 MB
            if($_FILES['sayfa_icon']['size'] > (1024000)){
                $file_upload_error_messages .= "<div>Image must be less than 1 MB in size.</div>";
            }
            if(!is_dir($target_directory)){
                mkdir($target_directory, 0777, true);
            }
            if(empty($file_upload_error_messages)){
                if(move_uploaded_file($_FILES["sayfa_icon"]["tmp_name"], $target_file)){
                    return true;
                } else {
                    $result_message .= "<div class='alert alert-danger'>";
                    $result_message .= "<div>Unable to upload photo.</div>";
                    $result_message .= "<div>Update the record to upload photo.</div>";
                    $result_message .= "</div>";
                }
            } else {
                $result_message .= "<div class='alert alert-danger'>";
                $result_message .= "{$file_upload_error_messages}";
                $result_message .= "<div>Update the record to upload photo.</div>";
                $result_message .= "</div>";
            }
        }
        return false;
    }
    function pri($text = ""){
        $text = empty($text) ? trim($this->sayfa_baslik): trim($text);
        $trHarf = array('?','’',"'",'|','ñ',' ', 'ß', 'ä', '.',',','ş','Ş','ö','Ö','ğ','Ğ','ü','Ü','ç','Ç','ı','İ',"'",'"','%','é','/','=','(',')','_',':',';','~','¨','<','>','£','#','$','½','{','}','*','!','\\','&','^','+');
        $enHarf = array('','-','','-','n','-','b','a','','','s','s','o','o','g','g','u','u','c','c','i','i','-','-','-','e','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-');
        $text = str_replace($trHarf, $enHarf, $text);
        $text = str_replace("---", "-", $text);
        $text = str_replace("--", "-", $text);
        $text = strtolower($text);
        if (substr($text, -1)=="-")
            $text = substr($text, 0, -1);
        return $text;
    }
}