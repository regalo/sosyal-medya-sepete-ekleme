<?php
if (file_exists(ns_filter('payment_company','file'))) {
	include_once ns_filter('payment_company','file');
} else {
	#ns_filter('404');
};?>