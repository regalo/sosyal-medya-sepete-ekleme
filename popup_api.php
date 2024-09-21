<?php
    include_once("popup_db.php");
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(!empty($_GET["what"])){
            $results = NULL;
            $what = trim($_GET["what"]);
            switch ($what) {
                case 'platforms':{
                    $results = getPlatforms();
                    break;
                };
                case 'services':{
                    $results = getServices();
                    break;
                };
                case 'details':{
                    $results = getPackages();
                    break;
                };
                default: kill();
            }
            if($results != NULL)
                die(json_encode($results));
        }
    }

    //kill();

    function getPlatforms(){
        $table_platform = "platform";
        $rank_direction = NULL;
        $sql_query = "SELECT item4 FROM ns_options WHERE item1='ns_ranking'"; 
        global $myConnection;
        try{
            $command = $myConnection->prepare($sql_query);
            $result = $command->execute();
            $result_rank_direction = NULL;
            if(!$result)
                return NULL;
            $result_rank_direction =  $command->fetch(PDO::FETCH_ASSOC);
            $rank_direction = $result_rank_direction["item4"];
        }
        catch(PDOException $err){
            $command = NULL;
            $myConnection = NULL;
            die("Error:".$err);
        }
        $result = NULL;
        $command = NULL;
        
        $sql_query = "SELECT pt_id,pt_name,pt_icon FROM $table_platform ORDER BY $rank_direction";
        try{   
            $command = $myConnection->prepare($sql_query);
            $result = $command->execute();
            if($result)
                return $command->fetchAll(PDO::FETCH_ASSOC);
            else
                return NULL;
        }
        catch(PDOException $err){
            $command = NULL;
            $myConnection = NULL;
            die("Error:".$err);
        }
        $command = NULL;
        $myConnection = NULL;
    }

    function getServices(){
        if(empty($_GET["id"])){
            return null;
        }
        $platform_id = $_GET["id"];
        $table_services = "hizmetler";
        $rank_direction = NULL;
        $sql_query = "SELECT item3 FROM ns_options WHERE item1='ns_ranking'"; 
        global $myConnection;
        try{
            $command = $myConnection->prepare($sql_query);
            $result = $command->execute();
            $result_rank_direction = NULL;
            if(!$result)
                return NULL;
            $result_rank_direction =  $command->fetch(PDO::FETCH_ASSOC);
            $rank_direction = $result_rank_direction["item3"];
        }
        catch(PDOException $err){
            $command = NULL;
            $myConnection = NULL;
            die("Error:".$err);
        }
        $result = NULL;
        $command = NULL;
        
        $sql_query = "SELECT hz_id,hz_icon,hz_adi FROM $table_services WHERE pt_tax=? ORDER BY $rank_direction";  
        try{   
            $command = $myConnection->prepare($sql_query);
            $result = $command->execute([$platform_id]);
            if($result)
                return $command->fetchAll(PDO::FETCH_ASSOC);
            else
                return NULL;
        }
        catch(PDOException $err){
            $command = NULL;
            $myConnection = NULL;
            die("Error:".$err);
        }
        $command = NULL;
        $myConnection = NULL;
    }
    
    function getPackages(){
        if(empty($_GET["id"])){
            return null;
        }
        $service_id = $_GET["id"];
        $table_details = "paketler";
        $rank_direction = NULL;
        $sql_query = "SELECT item2 FROM ns_options WHERE item1='ns_ranking'"; 
        global $myConnection;
        try{
            $command = $myConnection->prepare($sql_query);
            $result = $command->execute();
            $result_rank_direction = NULL;
            if(!$result)
                return NULL;
            $result_rank_direction =  $command->fetch(PDO::FETCH_ASSOC);
            $rank_direction = $result_rank_direction["item2"];
        }
        catch(PDOException $err){
            $command = NULL;
            $myConnection = NULL;
            die("Error:".$err);
        }
        $result = NULL;
        $command = NULL;
        
        $sql_query = "SELECT pk_adi,pk_fiyat,pk_pri FROM $table_details WHERE hz_tax=? ORDER BY $rank_direction"; 
        try{   
            $command = $myConnection->prepare($sql_query);
            $result = $command->execute([$service_id]);
            if($result)
                return $command->fetchAll(PDO::FETCH_ASSOC);
            else
                return NULL;
        }
        catch(PDOException $err){
            $command = NULL;
            $myConnection = NULL;
            die("Error:".$err);
        }
            $command = NULL;
            $myConnection = NULL;
    }
    function kill(){
        header("Location: https://takipcisepetim.com/en/");
        die("unsuccess");
    }
?>

