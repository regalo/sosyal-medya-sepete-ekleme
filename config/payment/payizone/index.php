<?php
$name = "Payizone Ödeme Modülü";
$primary = "payizone";
$demo = "#";
$screenshot = ns_filter('siteurl').'config/payment/payizone/screenshot.png';
$version = 1.0;
$autor = "nivusoft";
$description = "Nivusosyal Paket satış yazılımı için geliştirilmiş Payizone ödeme modülü.";
$payment_method = array("onlinepay");   // Listelenecek Ödeme Yöntemi Kategorisidir //Mobil için mobilepay Havale için havalepay KrediKartı için onlinepay yazılır
$payment_name = "Payizone"; // Panelde görünen adıdır
$payment_primary = "payizone"; // Ödeme firma kısa kodu
$payment_folder = "payizone"; // Entegrasyon klasör adı
if(file_exists(__DIR__."/extract.php"))
	include "extract.php";
	