<?php
$name = "Payguru Mobil Ödeme Modülü";
$primary = "payguru";
$demo = "#";
$screenshot = ns_filter('siteurl').'config/payment/payguru/screenshot.png';
$version = 1.1;
$autor = "nivusoft";
$description = "Nivusosyal Paket satış yazılımı için geliştirilmiş default Payguru Mobil ödeme modülü.";
$payment_method = array("mobilepay");  // Listelenecek Ödeme Yöntemi Kategorisidir //Mobil için mobilepay Havale için havalepay KrediKartı için onlinepay yazılır
$payment_name = "Payguru"; // Panelde görünen adıdır
$payment_primary = "payguru"; // Ödeme firma kısa kodu
$payment_folder = "payguru"; // Entegrasyon klasör adı