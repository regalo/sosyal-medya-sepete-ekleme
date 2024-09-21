<?php
$name = "Paywant Online Ödeme Modülü";
$primary = "paywant";
$demo = "#";
$screenshot = ns_filter('siteurl').'config/payment/paywant/screenshot.png';
$version = 1.1;
$autor = "nivusoft";
$description = "Nivusosyal Paket satış yazılımı için geliştirilmiş default Paywant Online ödeme modülü.";
$payment_method = array("onlinepay","havalepay","mobilepay");  // Listelenecek Ödeme Yöntemi Kategorisidir //Mobil için mobilepay Havale için havalepay KrediKartı için onlinepay yazılır
$payment_name = "Paywant"; // Panelde görünen adıdır
$payment_primary = "paywant"; // Ödeme firma kısa kodu
$payment_folder = "paywant"; // Entegrasyon klasör adı