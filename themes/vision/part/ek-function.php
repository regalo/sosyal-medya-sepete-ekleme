<?php
function _py($item,$string = null){
    if($item=="onlinepay" OR $item =="0"){
        $result = ["icon"=>"fas fa-credit-card","text"=>_e("onlinepay",true)];
    } else if($item=="mobilepay" OR $item =="2") {
        $result = ["icon"=>"fas fa-mobile-alt","text"=>_e("mobilepay",true)];
    } else if($item=="havalepay" OR $item =="1"){
        $result = ["icon"=>"fas fa-university","text"=>_e("havalepay",true)];
    }
    return empty($string) ? $result:$result[$string];
}
if(ns_filter("include")=="payment" AND file_exists(ns_filter('payment_company','file'))){
    include_once ns_filter('payment_company','file');
    exit;
}
