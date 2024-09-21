<?php 
include_once "include/home/introArea.php";
foreach ($loftAlignment["list"] as $value) {
	if($value["statu"])
		include "include/home/".$value["include"].".php";
}