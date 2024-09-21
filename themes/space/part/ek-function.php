<?php
function _py($string){
	if ($string==0) {
		$result["icon"] = 'fas fa-credit-card';
		$result["name"] = _e("Online Ödeme",true);
	} elseif ($string==1) {
		$result["icon"] = 'fas fa-university';
		$result["name"] = _e("EFT/Havale",true);
	} elseif ($string==2) {
		$result["icon"] = 'fas fa-mobile-alt';
		$result["name"] = _e("Mobil Ödeme",true);
	}
	return $result;
}