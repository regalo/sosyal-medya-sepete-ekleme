<?php
    $host_url = "https://socialmister.com/";
    //if(strpos($_SERVER["HTTP_REFERER"], $host_url) == false || strpos($_SERVER["HTTP_HOST"], $host_url) == false)
        //die("<html><head><script> window.location.href='https://$host_url'; </script></head></html>") ;
?>
<?php
    $myHost = 'localhost';
    $myDbName = 'social14_nv3';
    $myDbUserName = 'social14_nv3';
    $myDbPassword = 'mister2005';
    $myDbCharset = 'utf8mb4';
    $myConnection = NULL;

    try {
        $myConnection = new PDO("mysql:host=$myHost;dbname=$myDbName;charset=$myDbCharset", $myDbUserName, $myDbPassword);
        $myConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
        die($e->getMessage());
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
?>