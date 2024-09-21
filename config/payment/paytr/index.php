<?php
$name = "Paytr Online Ödeme Modülü";
$primary = "paytr";
$demo = "#";
$screenshot = ns_filter('siteurl').'config/payment/paytr/screenshot.png';
$version = 1.4;
$autor = "nivusoft";
$description = "Nivusosyal Paket satış yazılımı için geliştirilmiş default Paytr Online ödeme modülü.";
$payment_method = array("onlinepay","havalepay");   // Listelenecek Ödeme Yöntemi Kategorisidir //Mobil için mobilepay Havale için havalepay KrediKartı için onlinepay yazılır
$payment_name = "PayTR"; // Panelde görünen adıdır
$payment_primary = "paytr"; // Ödeme firma kısa kodu
$payment_folder = "paytr"; // Entegrasyon klasör adı