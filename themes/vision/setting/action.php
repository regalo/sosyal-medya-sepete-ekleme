<?php
    if(isset($post["loftAction"])){
        if(isset($_POST["page"]) AND isset($get["include"]) AND ($get["include"]=="config" OR $get["include"]=="ekkod"))
                $loft->variableStyle("unlink");
        ob_start();
        $ajaxJson = [];
        if($post["olay"]=="loftOptionsDelete"){
                $alert->header = "Silmeyi Onayla";
                $alert->content = "Silme işlemi geri alınamaz. Silme işlemi bu listeyi kalıcı olarak sistemden kaldıracaktır.";
                $alert->action = "confirm";
                $alert->olay = "loftActionDeletet";
                $alert->page = "theme";
                $alert->statu = "info";
        } else if($post["loftAction"]=="commentSave"){
            $ayar->ayar_1 = $post["commentSave"];
            if($post["data"]["statu"]=="delete" AND $ayar->delete()){

            } else {
                foreach ($post["data"] as $key => $value) {
                    $ayar->$key = is_array($value) ? json_encode($value):$value;  
                }
                $ayar->update();
            }
            $alert->header = "İşlem Başarılı";
            $alert->content = "İçerik yorumu üzerinde yaptığınız değişiklikler başarıyla güncellendi";
            $alert->action = "reload";
        } else if($post["loftAction"]=="commentMore"){
            extract($loft->setting($get["include"]));
            if(count($commentList)>0){
                include_once "include/contentCommentArea.php";
                $statu = true;
            }   else {
                echo '<button type="button" class="showMoreBTN">Hepsi bu kadar!</button>';
                $statu = false;
            }
            $listOutPut = ob_get_contents();
            ob_end_clean();
            exit(json_encode(["jsonStatu"=>$statu,"loftAction"=>"commentMore","html"=>$listOutPut,"commentMore"=>$commentStart+$commentCount]));
        } else if($post["loftAction"]=="generalSave"){
            foreach ($post["data"] as $key => $value) {
                $ayar->select($key);
                foreach ($value as $it => $val) {
                    $ayar->$it = is_array($val) ? json_encode($val):$val;
                }
                if((!isset($post["commentActionType"]) OR $post["commentActionType"]!="commentActionType") AND (!isset($post["loftActionType"]) OR $post["loftActionType"]!="loftActionType")) 
                $ayar->update();
            }
            $alert->header = "İşlem Başarılı";
            $alert->content = "Yaptığınız değişiklikler başarıyla güncellendi";
            $alert->action = "close";
        } else if($post["loftAction"]=="spacialPackageUpdate"){
            $ayar->ayar_1 = $post["spacialPackage"];            
            if($ayar->id()!=false){
                foreach ($post["data"] as $key => $value) {
                    $ayar->$key = is_array($value) ? json_encode($value):$value;  
                }
                if(!isset($post["commentActionType"]) OR $post["commentActionType"]!="commentActionType")
                $ayar->update();
                $alert->header = "İşlem Başarılı";
                $alert->content = "Özel paket düzeni üzerinde yaptığınız değişiklikler başarıyla güncellendi";
                $alert->action = "close";
            } else {
                $alert->header = "İşlem Başarısız";
                $alert->content = "Sistem bir sorunla karşılaştı";
                $alert->statu = "danger";
                $alert->action = "reload";
            }
        } else if($post["loftAction"]=="spacialPackageNew"){
            foreach ($post["data"] as $key => $value) {
                $item[$key] = is_array($value) ? json_encode($value):$value;  
            }
            if($ayar->insert($item)!=false){
                $alert->header = "İşlem Başarılı";
                $alert->content = "Yeni bir özel paket listesi oluşturdunuz. Düzenlemek için yönlendiriliyorsunuz.";
                $alert->action =  $ayar->getpage('theme').'?include=spacialpackets&liste='.$ayar->ayar_1;
            } else {
                $alert->header = "İşlem Başarısız";
                $alert->content = "İşlem sırasında önlenemez bir hata oluştu.";
                $alert->statu = "danger";
                $alert->action = "close";
            }
        } else if($post["loftAction"]=="spacialPageUpdate"){
            extract($loft->setting($get["include"]));
            $ayar->ayar_1 = $post["spacialPage"];
            if($ayar->id()!=false){
                foreach ($post["data"] as $key => $value) {
                    $ayar->$key = is_array($value) ? json_encode($value):$value;  
                }
                $ayar->update();
                $result = [];
                foreach ($loftAlignment["list"] as $key => $value) {
                    if($value["include"]=="packetList" AND $value["speacialList"]==$post["spacialPage"]){
                        $value["name"] = "Paket Listesi | ".$post["data"]["item2"]["headLine"];
                        $value["speacialUniq"] = $post["data"]["item3"];
                    }
                    $result[$key] = $value;
                }
                $ayar->select("loftAlignment");
                $ayar->item2 = json_encode(["list"=>$result]);
                $ayar->update();
                $alert->header = "İşlem Başarılı";
                $alert->content = "Özel paket listesi üzerinde yaptığınız değişiklikler başarıyla güncellendi";
                $alert->action = "close";
            } else {
                $alert->header = "İşlem Başarısız";
                $alert->content = "Sistem bir sorunla karşılaştı";
                $alert->statu = "danger";
                $alert->action = "reload";
            }
        } else if($post["loftAction"]=="whyOurNew"){
            extract($loft->setting($get["include"]));
            $loftWhyOur["list"][] = $post["data"]["loftWhyOur"];
            $ayar->select("loftWhyOur");
            $ayar->item2 = json_encode(["list"=>$loftWhyOur["list"]]);
            $ayar->update();
            $alert->header = "İşlem Başarılı";
            $alert->content = "Yeni bir neden biz kutusunu başarıyla oluşturdunuz. Şimdi yönlendiriliyorsunuz";
            $alert->action =  "reload";
            $_SESSION["activeTab"] = "pills-1x2";
        } else if($post["loftAction"]=="spacialPageNew"){
            extract($loft->setting($get["include"]));
            foreach ($post["data"] as $key => $value) {
                $item[$key] = is_array($value) ? json_encode($value):$value;  
            }
            if($ayar->insert($item)!=false AND $go = $ayar->ayar_1){
                $loftAlignment["list"] = array_merge([["statu"=>"1","include"=>"packetList","name"=>"Paket Listesi | ".$post["data"]["item2"]["headLine"],"speacialList"=>$ayar->ayar_1,"speacialUniq"=>$post["data"]["item3"]]],$loftAlignment["list"]);
                $ayar->select("loftAlignment");
                $ayar->item2 = json_encode(["list"=>$loftAlignment["list"]]);
                $ayar->update();
                $alert->header = "İşlem Başarılı";
                $alert->content = "Yeni bir özel paket listesi oluşturdunuz. Düzenlemek için yönlendiriliyorsunuz.";
                $alert->action =  $ayar->getpage('theme').'?include=specialpage&liste='.$go;
            } else {
                $alert->header = "İşlem Başarısız";
                $alert->content = "İşlem sırasında önlenemez bir hata oluştu.";
                $alert->statu = "danger";
                $alert->action = "close";
            }
        } else if($post["loftAction"]=="homeListing"){
            extract($loft->setting($get["include"]));
            if($post["type"]=="reset"){
                $yeniList = [];
                foreach ($loftSpecialPackage as $value) {
                    $yeniList[] = [
                        "statu"=>"1",
                        "include"=>"packetList",
                        "name"=>"Paket Listesi | ".$value["headLine"],
                        "speacialList"=>$value["ayar_1"],
                        "speacialUniq"=>$value["item3"]
                    ];
                }
                $yeniList = array_merge($yeniList,[
                    [
                        "statu"=>"1",
                        "include"=>"aboutArea",
                        "name"=>"Hakkımızda Metin/Görsel",
                    ],
                    [
                        "statu"=>"1",
                        "include"=>"whyOur",
                        "name"=>"Neden Biz?",
                    ],
                    [
                        "statu"=>"1",
                        "include"=>"contentArea",
                        "name"=>"Makale Alanı",
                        "options"=>"1",
                    ],
                    [
                        "statu"=>"1",
                        "include"=>"sssArea",
                        "name"=>"Sıkca Sorulan Sorular",
                    ],
                    [
                        "statu"=>"1",
                        "include"=>"commentList",
                        "name"=>"Müşteri Yorumları",
                    ],
                    [
                        "statu"=>"1",
                        "include"=>"blogList",
                        "name"=>"Son Blog Yazıları",
                    ]
                ]);
            }  else {
                $newList = [];
                for ($i=0; $i < count($loftAlignment["list"]); $i++) { 
                    if($i==$post["key"] AND $post["type"]=="up"){
                        $newList[] = ($post["key"]+1);
                    } else if($i==($post["key"]+1) AND $post["type"]=="up"){
                        $newList[] = $post["key"];
                    } else if($i==$post["key"] AND $post["type"]=="down"){
                        $newList[] = ($post["key"]-1);
                    } else if($i==($post["key"]-1) AND $post["type"]=="down"){
                        $newList[] = $post["key"];
                    } else if($i==$post["key"] AND $post["type"]=="copy"){
                        $newList[] = $post["key"];
                        $newList[] = $post["key"];
                    } else if($i==$post["key"] AND $post["type"]=="trash"){
                    } else {
                        $newList[] = $i;
                    }

                }
                $yeniList = [];
                foreach ($newList as $key => $value) {
                    if(isset($loftAlignment["list"][$value]))
                    $yeniList[] =  $loftAlignment["list"][$value];
                }
            }
            $ayar->select("loftAlignment");
            $ayar->item2 = json_encode(["list"=>$yeniList]);
            $ayar->update();
            foreach ($yeniList as $key => $value) {
                include "include/siralama.php";
             } 
            $listOutPut = ob_get_contents();
            ob_end_clean();
            exit(json_encode(["jsonStatu"=>true,"loftAction"=>"homeListing","html"=>$listOutPut]));
        } else if($post["loftAction"]=="homeListOff"){
            extract($loft->setting($get["include"]));
            $loftAlignment["list"][$post["key"]]["statu"] = $loftAlignment["list"][$post["key"]]["statu"] ? 0:1;
            $ayar->select("loftAlignment");
            $ayar->item2 = json_encode(["list"=>$loftAlignment["list"]]);
            $ayar->update();
            exit(json_encode(["jsonStatu"=>true,"loftAction"=>"homeListOff"]));
        } else if($post["loftAction"]=="homeListOptions"){
            extract($loft->setting($get["include"]));
            $loftAlignment["list"][$post["key"]]["options"] = $post["value"];
            $ayar->select("loftAlignment");
            $ayar->item2 = json_encode(["list"=>$loftAlignment["list"]]);
            $ayar->update();
            exit(json_encode(["jsonStatu"=>true,"loftAction"=>"homeListOff"]));
        }
        if(isset($post["commentActionType"]) AND $post["commentActionType"]=="commentActionType"){
            $post["data"]["loftCustomerComment"]["item2"]["list"][] = ["avatar"=>"upload\/why3-429477.jpg","name"=>"Ad Soyad","job"=>"Meslek","comment"=>"","raitin"=>"5"];
            foreach ($post["data"]["loftCustomerComment"]["item2"]["list"] as $key => $value) {
               include __DIR__."/include/commentList.php";
            }
            echo '<input type="hidden" name="commentActionType" value="">';
            $listOutPut = ob_get_contents();
            ob_end_clean();
            exit(json_encode(["jsonStatu"=>true,"loftAction"=>"commentActionType","html"=>$listOutPut]));
           
        } 
        if(isset($alert->header)){
            include_once "panel/pages/alert.php";
            $listOutPut = ob_get_contents();
            ob_end_clean();
            exit(json_encode(["jsonStatu"=>true,"loftAction"=>"alert","html"=>$listOutPut]));
        }
    } else if($post["olay"]=="loftActionDeletet"){
        $ayar->ayar_1 = $get["liste"];
        if($ayar->delete()){
            if($get["include"]=="specialpage"){
                extract($loft->setting($get["include"]));
                $result = [];
                foreach ($loftAlignment["list"] as $key => $value) {
                    if(isset($value["include"]) AND ($value["include"] != "packetList" OR $value["speacialList"]!=$get["liste"]))
                        $result[] = $value;
                }
                $ayar->select("loftAlignment");
                $ayar->item2 = json_encode(["list"=>$result]);
                $ayar->update();
            }
            $alert->header = "İşlem Başarılı";
            $alert->content = "Silme işlemi başarıyla gerçekleşti. Şimdi yönlendiriliyorsunuz.";
            $alert->statu = "success";
            $alert->action = $ayar->getpage("theme").'?include='.$get["include"];
        } else {
            $alert->header = "İşlem Başarısız";
            $alert->content = "Silme işlemi sırasında önlenemez bir hata oluştu";
            $alert->statu = "danger";
            $alert->action = "close";
        }
        include_once "panel/pages/alert.php";
        exit;
    }
?>