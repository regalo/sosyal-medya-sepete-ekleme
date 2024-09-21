<?php
trait PDOCache {
    public $cache = array();
    function import($name,$value){
        $this->cache[$name] = $value;
    }
    function export($name) {
        return !isset($this->cache[$name]) ? false:$this->cache[$name];
    }
    function remove($name){
        if(isset($this->cache[$name]))
            unset($this->cache[$name]);
        return true;
    }
}
class Ayar{
    use PDOCache;
    private $conn;
    private $table_name = "ns_options";
    public $ayar_1;
    public $item1;
    public $item2;
    public $item3;
    public $item4;
    public $item5;
    public $statu;
    public function __construct($db){
        $this->conn = $db;
    }
    public function select($item, $out = "item2"){
        $this->item1 = htmlspecialchars(strip_tags($item));
        if(!$row = $this->export($this->item1)){
            $query = "SELECT * FROM " . $this->table_name . " WHERE item1 = ? ORDER BY ayar_1 ASC limit 0,1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->item1);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        if (isset($row["item2"])) {
            $this->row = $row;
            foreach ($row as $key => $value) {
                $this->$key = $value;
            }
            if ($out=="return")
                return true;
            if ($item=="unmenu" OR $out=="create") {
                return true;
            }
            if (empty($row["item2"]) AND $out != "row") {
                return true;
            }
            return $out == "row" ? $row : $row[$out];
        } elseif($out=="create") {
            $this->item = array("item1"=>$this->item1);
            $this->insert();
            return $this->select($this->item1);
        }
        return false;
    }
    public function statu($item){
        $query = "SELECT statu FROM " . $this->table_name . " WHERE item1 = ? limit 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $item);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($row["statu"]) AND $row["statu"]==1) {
            return true;
        }
        return false;
    }
    public function id(){
        if(!$row = $this->export($this->ayar_1.'_id')){
            $query = "SELECT * FROM " . $this->table_name . " WHERE ayar_1 = ? limit 0,1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->ayar_1);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        if (isset($row["item2"])) {
            foreach ($row as $key => $value) {
                $this->$key = $value;
            }
            return $row;
        }
        return false;
    }
    function all($item){
        if(!$stmt = $this->export($item.'_list')){
            $query = "SELECT * FROM " . $this->table_name . " WHERE item1 = ? ORDER BY ayar_1 ASC";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $item);
            $stmt->execute();
            $list = [];
            foreach ($stmt as $key => $value) {
                $list[] = $value;
            }
            $stmt = $list;
            $this->import($item.'_list',$list);
        }
        return $stmt;
    }
    public function full(){
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY ayar_1 ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        while ($cikti = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($cikti);
            $this->$item1 = $item2;
            $this->import($item1,$cikti);
            $this->import($ayar_1.'_id',$cikti);
        }
        return true;
    }
    public function menu($menu){
        $this->menutur=htmlspecialchars(strip_tags($this->menutur));
        $query = "SELECT * FROM " .$this->table_name . " WHERE item1 = :item1 AND item2 = :menutur ORDER BY ayar_1 ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':item1', $menu);
        $stmt->bindParam(':menutur', $this->menutur);
        $stmt->execute();
        return $stmt;
    }
    function one($item, $out = "item2"){
        if(!$row = $this->export($item.'_id')){
            $query = "SELECT * FROM " . $this->table_name . " WHERE ayar_1 = ? limit 0,1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $item);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        if (isset($row["item2"])) {
            foreach ($row as $key => $value) {
                $this->$key = $value;
            }
            return $out == "row" ? $row : $row[$out];
        }
        return false;
    }
    function update(){
        $query = "UPDATE ".$this->table_name." SET item1 = :item1, item2 = :item2,item3 = :item3, item4 = :item4, item5 = :item5, statu = :statu WHERE ayar_1 = :id";     
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':item1', $this->item1);
        $stmt->bindParam(':item2', $this->item2);
        $stmt->bindParam(':item3', $this->item3);
        $stmt->bindParam(':item4', $this->item4);
        $stmt->bindParam(':item5', $this->item5);
        $stmt->bindParam(':statu', $this->statu);
        $stmt->bindParam(':id', $this->ayar_1);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    function insert($item = ""){
        $item = empty($item) ? $this->item: $item;
        $query = "INSERT INTO ".$this->table_name." SET item1 = :item1, item2 = :item2, item3 = :item3, item4 = :item4, item5 = :item5, statu = :statu";
        $stmt = $this->conn->prepare($query);
        $this->item1 = isset($item["item1"]) ? $item["item1"]: "";
        $this->item2 = isset($item["item2"]) ? $item["item2"]: "";
        $this->item3 = isset($item["item3"]) ? $item["item3"]: "";
        $this->item4 = isset($item["item4"]) ? $item["item4"]: "";
        $this->item5 = isset($item["item5"]) ? $item["item5"]: "";
        $this->statu = isset($item["statu"]) ? $item["statu"]: 1;
        $stmt->bindParam(':item1', $this->item1);
        $stmt->bindParam(':item2', $this->item2);
        $stmt->bindParam(':item3', $this->item3);
        $stmt->bindParam(':item4', $this->item4);
        $stmt->bindParam(':item5', $this->item5);
        $stmt->bindParam(':statu', $this->statu);
        if($stmt->execute()){
            $this->ayar_1 = $this->sonid();
            return $this->ayar_1;
        }else{
            return false;
        }
    }
    function sonid(){
        $query = "SELECT ayar_1 FROM " . $this->table_name . " ORDER BY ayar_1 DESC limit 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $item);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->ayar_1 = $row["ayar_1"];
        return $row["ayar_1"];
    }
    public function delete($bind = "ayar_1", $idsi = ""){
        if ($bind=="menu") {
            $this->delete("item1","unmenu");
            if (empty($this->select($idsi,'item1'))) {
                return true;
            }
            $this->item1 = "unmenu";
            $query = "UPDATE ".$this->table_name." SET item1 = :item1 WHERE item1 = :id";     
            $stmt = $this->conn->prepare($query);
            $this->id=htmlspecialchars(strip_tags($idsi));
            $stmt->bindParam(':item1', $this->item1);
            $stmt->bindParam(':id', $this->id);
            if($stmt->execute()){
                $this->delete("item1","unmenu");
                return true;
            }
            $this->delete("item1","unmenu");
            return false;
        }
        $query = "DELETE FROM ".$this->table_name." WHERE ".$bind." = :id";
        $stmt = $this->conn->prepare($query);
        $id = empty($idsi) ? $this->ayar_1: $idsi;
        $stmt->bindParam(':id', $id);
        if($result = $stmt->execute()){
            return true;
        } else {
            return false;
        }
    }
    public function menubuilder(){
        $this->insert();
        return $this->ayar_1;
    }
    public function getpage($page = "", $action = ""){
        if (!empty($page) AND $page== "yonetim") {
            return $this->siteurl.$this->panelurl.'/';
        }
        if ($page!= "" AND $action!= "") {
            return $this->siteurl.$this->panelurl.'/'.$page.'/'.$action.'/';
        } elseif($page != "") {
            return $this->siteurl.$this->panelurl.'/'.$page.'/';
        }
        if (isset($this->page)) {
            return 'panel/pages/'.$this->page.'.php';
        }
        return 'panel/pages/main.php';
    }
    public function frontpage($primary1 = "", $primary2 = ""){
        if (!empty($primary1) AND !empty($primary2)) {
            return $this->siteurl.$primary1.'/'.$primary2.'/';
        } elseif(!empty($primary1)) {
            if ($primary1=="home") {
                return $this->siteurl;
            }
            return $this->siteurl.$primary1.'/';
        }
        if (isset($this->page)) {
            return 'panel/pages/'.$this->page.'.php';
        }
        return 'panel/pages/main.php';
    }
    public function security($item){
        if (isset($this->panelingo)) {
            return $item;
        }
        if (is_array($item)) {
            foreach ($item as $key => $value) {
                $item[$key] = $this->security($value);
            }
            return $item;
        } else {
            $bul = array("UPDATE","SELECT","UNION","where","WHERE","union","SELECT ","select","update","LIMIT","limit ","=="," (",") "," OR ","1==1"," % ","ORDER+BY","order+by","group_ ","GROUP_ ","TABLE_","_NAME ","table_","_name","<",">");
            $item =  str_replace($bul, '', $item);
            return htmlspecialchars(strip_tags($item));
        }

    }
    public function uploadPhoto($item,$name){
        $result_message="";
        if (!empty($_FILES[$item]["name"])) {
            $this->fileneme = strstr($_FILES[$item]["name"], ".") ? explode(".", $_FILES[$item]["name"])[0]:$_FILES[$item]["name"];
            $this->fileneme = $this->pri(substr($this->fileneme, 0,50)) . "-" . rand(100000,999999);
            $uzanti_once = explode(".", $_FILES[$item]["name"]);
            $uzanti = end($uzanti_once);
            $target_directory = "upload/";
            $target_file = $target_directory . $this->fileneme .'.'.$uzanti;
            $this->fileneme = $target_file;
            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
            $file_upload_error_messages="";
            $check = getimagesize($_FILES[$item]["tmp_name"]);
            if($check!==false){
                // submitted file is an image
            } else {
                $file_upload_error_messages .= "<div>Submitted file is not an image.</div>";
            }
            $allowed_file_types = array("jpg","JPG", "jpeg", "JPEG", "png", "gif");
            if(!in_array($file_type, $allowed_file_types)){
                $file_upload_error_messages .= "<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
            }
            if(file_exists($target_file)){
                $file_upload_error_messages .= "<div>Image already exists. Try to change file name.</div>";
            }
             
            // make sure submitted file is not too large, can't be larger than 1 MB
            if($_FILES[$item]['size'] > (1024000)){
                $file_upload_error_messages .= "<div>Image must be less than 1 MB in size.</div>";
            }
            if(!is_dir($target_directory)){
                mkdir($target_directory, 0777, true);
            }
            if(empty($file_upload_error_messages)){
                if(move_uploaded_file($_FILES[$item]["tmp_name"], $target_file)){
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
    public function menulink($item4,$item5=""){
        if ($item4=="link") {
            return $item5;
        } elseif ($item4=="blog") {
            $this->blog = "blog";
            if (empty($item5)) {
                return $this->siteurl.$this->blog.'/';
            }
            global $icerik;
            $icerik->sayfa_id = $item5;
            $veri = $icerik->select('nonethis');
            return $this->siteurl.$this->blog.'/'.$veri["sayfa_primary"].'/';
        } elseif ($item4=="siteurl") {
            return $this->siteurl;
        } elseif($item4=="paket") {
            if (!empty($this->siparispage)) {
               return $this->siteurl.$this->siparispage.'/'.$item5.'/';
            }
            return $this->siteurl.'siparis/'.$item5.'/';
        } elseif ($item4=="iletisim") {
            if (isset($this->iletisimpage)) {
                return $this->siteurl.$this->iletisimpage.'/';
            } else {
                return $this->siteurl.'iletisim/';
            }
        } elseif($item4=="kategori") {
            global $kategori;
            $kategori->hz_id = $item5;
            $veri = $kategori->select('nonethis');
            if ($this->permalink=="seo") {
                return $this->siteurl.$veri["hz_pri"].'/';
            } else {
                global $platform;
                $platform->pt_id = $veri["pt_tax"];
                $verip = $platform->select('nonethis');
                return $this->siteurl.$verip["pt_primary"].'/'.$veri["hz_pri"].'/';
            }
        } elseif($item4=="platform") {
            global $platform;
            $platform->pt_id = $item5;
            $veri = $platform->select('nonethis');
            return $this->siteurl.$veri["pt_primary"].'/';
        }  elseif($item4=="sayfa") {
            global $icerik;
            $icerik->sayfa_id = $item5;
            $veri = $icerik->select('nonethis');
            return $this->siteurl.$veri["sayfa_primary"].'/';
        } elseif($item4=="linksiz") {
            return "javascript:void(0)";
        } else {
            return $item4;
        }
    }
    public function pri($text){
        $trHarf = array('’',"'",'|','ñ',' ', 'ß', 'ä', '.',',','ş','Ş','ö','Ö','ğ','Ğ','ü','Ü','ç','Ç','ı','İ',"'",'"','%','é','/','?','=','(',')','_',':',';','~','¨','<','>','£','#','$','½','{','}','*','!','\\','&','^','+');
        $enHarf = array('-','','-','n','-','b','a','','','s','s','o','o','g','g','u','u','c','c','i','i','-','-','-','e','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-');
        $text = str_replace($trHarf, $enHarf, $text);
        $text = str_replace("---", "-", $text);
        $text = str_replace("--", "-", $text);
        $text = strtolower($text);
        return $text;
    }
    public function OdemeFirma($select = ""){
        $select = htmlspecialchars(strip_tags($select));
        $this->yontem = array();
        $item = $this->select('onlinepay','row');
        if ($this->statu): $this->statu = 2; endif;
        $this->yontem[0] = array('setting'=>$item,'statu'=> $this->statu,'text' => 'KREDİ/BANKA/ÖN ÖDEMELİ KART','id' => 0, 'hizmet_bedeli' => $this->select('online-hizmet-bedeli','row'));
        $item = $this->select('havalepay','row');
        if ($this->statu AND empty($this->yontem[0]["statu"])): $this->statu = 2; endif;
        $this->yontem[1] = array('setting'=> $item,'statu'=> $this->statu,'text' => 'EFT/HAVALE','id' =>1,'hizmet_bedeli' => $this->select('havale-hizmet-bedeli','row'));
        $item = $this->select('mobilepay','row');
        if ($this->statu AND empty($this->yontem[0]["statu"]) AND empty($this->yontem[1]["statu"])): $this->statu = 2; endif;
        $this->yontem[2] = array('setting'=> $item, 'statu'=> $this->statu,'text' => 'MOBİL ÖDEME','id' =>2,'hizmet_bedeli' => $this->select('mobil-hizmet-bedeli','row'));
        if ($select == "") {
            return $this->yontem;
        } elseif ($select == "") {
            return false;
        } elseif(!is_numeric($select)) {
            foreach ($this->yontem as $key => $value) {
                if ($value["setting"]["item2"]==$select) {
                    return $this->yontem[$key];
                }
            }
            return false;
        }
        return $this->yontem[$select];
    }
    public function language(){
        if(strlen($this->language) > 3 AND  file_exists("config/language/".$this->language."/index.php")){
            include_once "config/language/".$this->language."/index.php";
            $this->charset = $lang_set;
        }
    }
    public function languages(){
        $dizin = opendir("config/language");
        $this->languages = array();
        while($dosya = readdir($dizin)) {
            if (!strstr($dosya, ".") AND file_exists("config/language/".$dosya."/index.php")) {
                include_once "config/language/".$dosya."/index.php";
                if(isset($name) AND isset($primary) AND isset($lang_set)) {
                    $this->languages[] = array("lang_name"=>$name,"lang_code"=>$primary,"lang_set"=>$lang_set);
                    unset($name);
                    unset($primary);
                    unset($lang_set);
                }
            }
        }
        return $this->languages;
    }
    #ÖDEME YÖNTEMLERİ
    public function PaymentMethods(){
        $dizin = opendir("config/payment");
        if (!isset($this->PaymentMethods)) {
            $this->PaymentMethods = array();
            $this->PaymentMethods["havalepay"] = array();
            $this->PaymentMethods["onlinepay"] = array();
            $this->PaymentMethods["mobilepay"] = array();
            while($dosya = readdir($dizin)) {
                if (!strstr($dosya, ".") AND file_exists("config/payment/".$dosya."/index.php")) {
                    include_once "config/payment/".$dosya."/index.php";
                    if(isset($payment_method) AND isset($payment_name) AND isset($payment_primary) AND isset($payment_folder)) {
                        foreach ($payment_method as $key) {
                            $this->PaymentMethods[$key][] = array("name"=>$payment_name,"code"=>$payment_primary,"folder"=>$payment_folder);
                        }
                        unset($payment_method);
                        unset($payment_name);
                        unset($payment_primary);
                        unset($payment_folder);
                    }
                }
            }
        }
        return $this->PaymentMethods;
    }
    #ÖDEME YÖNTEMLERİ
    #PARA BİRİMİ AYARLARINIZI BURADAN YAPINIZ..
    public function currency_format($u,$type = ""){
        $dizin = opendir("config/currency");
        if (!isset($this->currencies)) {
            $this->currencies = array();
            while($dosya = readdir($dizin)) {
                if (strstr($dosya, ".php") AND file_exists("config/currency/".$dosya)) {
                    include_once "config/currency/".$dosya;
                    if(isset($currency_code) AND isset($currency_symbol) AND isset($currency_name) AND isset($currency_location)) {
                        $this->currencies[] = array("name"=>$currency_name,"code"=>$currency_code,"symbol"=>$currency_symbol,"sprintf"=>$currency_location);
                        unset($currency_symbol);
                        unset($currency_code);
                        unset($currency_name);
                        unset($currency_location);
                    }
                }
            }
        }
        if ($type=="list")
            return $this->currencies;
        foreach ($this->currencies as $value) {
            if(ns_filter('currency','item2')==$value["code"]){
                $string = ns_filter('currency','statu') ? $value["code"]:$value["symbol"];
                $u = number_format($u, 2, '.', '');
                if($value["sprintf"]==1 AND ns_filter('currency','statu'))
                    return $u.' '.$string;
                if($value["sprintf"]==1)
                    return $u.$string;
                if(ns_filter('currency','statu'))
                    return $string.' '.$u;
                return $string.$u;
            }
        }
    }
    #PARA BİRİMİ AYARLARI SONU


    public function description($text,$long = 160) {
        $text = htmlspecialchars(strip_tags($text));
        return mb_substr($text, 0,$long);
    }
    public function _format($item){
        return number_format($item, 2, '.', '');
    }
    public function hideinfo($result,$type=""){
        if ($type=="name") {
            if (strstr($result, " ")) {
                return $this->private_str(explode(" ", $result)[0], 3, strlen(explode(" ", $result)[0])/2).' '.$this->private_str(explode(" ", $result)[1], 3, strlen(explode(" ", $result)[1])/2);
            }
            return $this->private_str($result, 4, strlen($result)/2.9);
        } elseif ($type=="telefon") {
            return $this->private_str($result, 4, strlen($result)/1.9);
        } elseif($type=="mail") {
            return $this->private_str(explode('@', $result)[0], 3, strlen(explode('@', $result)[0])/2).'@'.explode('@', $result)[1];
        } elseif($type=="islem_adres") {
            if (strstr($result, ".com")) {
                return $this->private_str(explode(".com", $result)[0], 3, strlen(explode(".com", $result)[0])/2).'.com'.$this->private_str(explode(".com", $result)[1], 3, strlen(explode(".com", $result)[1])/2);
            }
            return $this->private_str($result, 4, strlen($result)/2);
        }
        return $this->private_str($result, 3, strlen($result)/2.4);
    }
    public function private_str($str, $start, $end){
       $after = mb_substr($str, 0, $start, 'utf8');
       $repeat = str_repeat('*', $end);
       $before = mb_substr($str, ($start + $end), strlen($str), 'utf8');
       return $after.$repeat.$before;
    }
    public function zamanfarki($zaman = NULL,$type = NULL){
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
        if($type=="cron" AND $this->select('CronJobSetting')){
            $this->statu = 1;
            $this->update();
        }
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
            if($type=="cron" AND $this->select('CronJobSetting')){
                $this->statu = 0;
                $this->update();
                return "PASİF";
            }
            return $tarih[2].'/'.$tarih[1].'/'.$tarih[0];
        }
    }
    public function idsel($table,$gg){
        $query = "UPDATE ".$table." SET ".$gg;     
        $stmt = $this->conn->query($query);
    }
}
?>