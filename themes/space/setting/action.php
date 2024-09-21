<?php
    $ayar->select("spaceHeader");
    $ayar->item4 = time();
    $ayar->update();
    if(file_exists("themes/space/assets/spacenivu.css") AND unlink("themes/space/assets/spacenivu.css"));
    if(file_exists("themes/space/assets/spacenivu.js") AND unlink("themes/space/assets/spacenivu.js"));
    if(isset($post["yontem"]) AND $post["yontem"]=="json"){
        $ayar->select($post["olay"]);
        foreach ($post["data"] as $key => $value) {
            if(is_array($value))
                $ayar->$key = json_encode($value);
            else
                $ayar->$key = $value;
        }
        $ayar->update();
    } elseif(isset($post["yontem"]) AND $post["yontem"]=="jsonEdit"){
        $ayar->ayar_1 = $post["olay"];
        if(isset($ayar->id()["ayar_1"])){
            foreach ($post["data"] as $key => $value) {
                if(is_array($value))
                    $ayar->$key = json_encode($value);
                else
                    $ayar->$key = $value;
            }

        }
        $ayar->update();
        $alert->header = "İşlem Başarılı";
        $alert->content = "Yaptığınız değişiklikler başarıyla güncellendi";
        $alert->action = "reload";
        include_once "panel/pages/alert.php";
        exit;
    } elseif(isset($post["yontem"]) AND $post["yontem"]=="delete"){
        $alert->header = $post["head_alert"];
        $alert->content = "Silme işlemi geri alınamaz. Silme işlemi bu platform altında yer alan tüm kategori ve paketleri de kapsamaktadır.";
        $alert->action = "confirm";
        $alert->olay = $post["olay"];
        $alert->page = "theme";
        $alert->statu = "info";
        include_once "panel/pages/alert.php";
        exit;
    } elseif(isset($post["yontem"]) AND $post["yontem"]=="jsonAdd"){
        $item = [];
        foreach ($post["data"] as $key => $value) {
            if(is_array($value))
                $item[$key] = json_encode($value);
            else
                $item[$key]  = $value;
        }
        if($ayar->insert($item)!=false){
            $alert->header = "İşlem Başarılı";
            $alert->content = "Space teması için yeni bir liste eklediniz.";
            $alert->action = $ayar->getpage('theme').'?include='.$get["include"].'&liste='.$ayar->ayar_1;
            include_once "panel/pages/alert.php";
            exit;
        }
    } elseif(isset($post["olay"]) AND $post["olay"]=="deletepageSpace" AND isset($get["liste"])){
        $ayar->ayar_1 = $get["liste"];
        if($ayar->delete()){
            $alert->header = "İşlem Başarılı";
            $alert->content = "Silme İşlemi başarıyla gerçekleşti";
            $alert->action = $ayar->getpage('theme').'?include='.$get["include"];
            include_once "panel/pages/alert.php";
            exit;
        }
    }
	$alert->header = "İşlem Başarılı";
    $alert->content = "Yaptığınız değişiklikler başarıyla güncellendi";
    $alert->action = "close";
    include_once "panel/pages/alert.php";
    exit;
?>