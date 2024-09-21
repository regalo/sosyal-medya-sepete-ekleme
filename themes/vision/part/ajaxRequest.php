<?php
if($post["loftAction"]=="orderControl"){
	## AJAX SİPARİŞ SORGULAMA İŞLEMİ..
	if(isset($post["code"]) AND strlen($post["code"])>5){
		$query = "SELECT * FROM siparisler WHERE sp_code = :sp_code ORDER BY sp_id DESC LIMIT 0,1";
		$stmt = $db->prepare($query);
		$stmt->bindParam(':sp_code',$post["code"]);
		if($stmt->execute() AND $row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$ajaxJson = array_merge(["jsonStatu"=>"success"],$loft->orderDetail($row));
		} else {
			$ajaxJson = ["jsonStatu"=>"danger","alert"=>["statu"=>"danger","head"=>_e("islem-basarisiz",true),"text"=>_e("siparis-bulunamadi-metni",true)]];
		}
	} else {
		$ajaxJson = ["jsonStatu"=>"danger","alert"=>["statu"=>"danger","head"=>_e("islem-basarisiz",true),"text"=>_e("eksik-yada-hatalı-siparis-kodu",true)]];
	}
} else if($post["loftAction"]=="paymentChange"){
	$ajaxJson = array_merge(["jsonStatu"=>"success"],$loft->orderPage());
} else if($post["loftAction"]=="orderCreate") {
	if(isset($siparis_before)){
		$ajaxJson = ["jsonStatu"=>"success","href"=>$loft->url(ns_filter("siparispage"),$siparis->sp_musteri_link),"token"=>$siparis->sp_musteri_link];
	} elseif(isset($recaptcha) AND $recaptcha!=false) {
		$ajaxJson = ["jsonStatu"=>"danger","alert"=>["statu"=>"danger","head"=>_e("islem-basarisiz",true),"text"=>_e("guvenlik-dogrulamasini-yapmalisiniz",true)]];
	} else {
		$ajaxJson = ["jsonStatu"=>"danger","alert"=>["statu"=>"danger","head"=>_e("islem-basarisiz",true),"text"=>_e("siparis-olustururken-hata-tum-alanlari-eksiksiz-doldurun",true)]];
	}
} else if($post["loftAction"]=="cookieForm"){
	$query = "SELECT * FROM siparisler WHERE sp_musteri_link = :sp_musteri_link ORDER BY sp_id DESC LIMIT 0,1";
	$stmt = $db->prepare($query);
	$stmt->bindParam(':sp_musteri_link',$post["token"]);
	if($stmt->execute() AND $row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$ajaxJson = array_merge(["jsonStatu"=>"success"],$row);
	} else {
		$ajaxJson = ["jsonStatu"=>"danger"];
	}
} else if($post["loftAction"]=="contactCreate"){
	if(isset($succes)){
		$ajaxJson = ["jsonStatu"=>true,"alert"=>["statu"=>"success","head"=>_e("islem-basarili",true),"text"=>_e("iletisim-talebiniz-alindi",true)],"href"=>$loft->url(ns_filter("iletisimpage"))];
	} else if(isset($error)){
		$ajaxJson = ["jsonStatu"=>false,"alert"=>["statu"=>"danger","head"=>_e("islem-basarisiz",true),"text"=>$error]];
	}
} else if($post["loftAction"]=="commentCreate"){
	if(!isset($post["data"]["xasSAa4zkxmm"]) OR !isset($post["data"]["xasSAa4zkxmmADSX"]) OR !isset($post["data"]["xasSAa4FGzkxmmADSX"]) OR strlen($post["data"]["xasSAa4zkxmm"])<4 OR strlen($post["data"]["xasSAa4FGzkxmmADSX"])<20){
		$ajaxJson = ["jsonStatu"=>false,"alert"=>["statu"=>"danger","head"=>_e("islem-basarisiz",true),"text"=>_e("yorum-yapabilmek-icin-formu-eksiksiz-doldurun",true)]];
	} elseif(isset($commentRecaptcha) AND $commentRecaptcha!=false AND !$ns_filter->recaptcha(ns_filter('recaptcha','item3'),$_POST["g-recaptcha-response"])) {
		$ajaxJson = ["jsonStatu"=>false,"alert"=>["statu"=>"danger","head"=>_e("islem-basarisiz",true),"text"=>_e("yorum-yapabilmek-icin-formu-güvenlik-dogrulamasini-yapmalisiniz",true)]];
	} else {
		$item = ["item1"=>"loftContentComment","item2"=>$comment["type"],"item3"=>json_encode(["name"=>$post["data"]["xasSAa4zkxmm"],"mail"=>$post["data"]["xasSAa4zkxmmADSX"],"comment"=>$post["data"]["xasSAa4FGzkxmmADSX"],"date"=>date("Y-m-d H:i:s")]),"item4"=>$comment["tax"],"item5"=>"","statu"=>$comment["statu"]];
		if($ayar->insert($item)!=false){
			$ajaxJson = ["jsonStatu"=>true,"alert"=>["statu"=>"success","head"=>_e("islem-basarili",true),"text"=>$comment["statu"] ? _e("yorumunuz-alindi-ve-yayinlandi",true):_e("yorumunuz-onay-bekliyor",true)],"reload"=>$comment["statu"]];
		} else {
			$ajaxJson = ["jsonStatu"=>false,"alert"=>["statu"=>"danger","head"=>_e("islem-basarisiz",true),"text"=>_e("yorumunuz-alinamadi",true)]];
		}
	}
} else if($post["loftAction"]=="orderFormCheck"){
	if(isset($post["data"]["sp_musteri_telefon"]) AND isset($post["data"]["sp_musteri_mail"]) AND isset($post["data"]["islem_adres"]) AND isset($post["data"]["sp_musteri_adi"])){
		$post["data"]["sp_musteri_mail"] = trim($post["data"]["sp_musteri_mail"]);
		$post["data"]["sp_musteri_telefon"] = trim($post["data"]["sp_musteri_telefon"]);
		if(strlen($post["data"]["islem_adres"])<3){
			$ajaxJson = ["jsonStatu"=>false,"alert"=>["statu"=>"danger","head"=>_e("tum-alanlari-doldurun",true),"text"=>$orderTitle],"focus"=>'input[name="islem_adres"]'];
		} else if(strlen($post["data"]["sp_musteri_adi"])<5){
			$ajaxJson = ["jsonStatu"=>false,"alert"=>["statu"=>"danger","head"=>_e("ad-soyad-eksik",true),"text"=>_e("ad-soyad-bolumunu-eksiksiz-giriniz",true)],"focus"=>'input[name="sp_musteri_adi"]'];
		} else if(!filter_var($post["data"]["sp_musteri_mail"], FILTER_VALIDATE_EMAIL)){
			$ajaxJson = ["jsonStatu"=>false,"alert"=>["statu"=>"danger","head"=>_e("hatali-mail-formati",true),"text"=>_e("mail-adresinizi-uygun-formatta-giriniz",true)],"focus"=>'input[name="sp_musteri_mail"]'];
		} else if(isset($post["data"]["countryCode"]) AND $post["data"]["countryCode"]=="90" AND (substr($post["data"]["sp_musteri_telefon"],0,1)=="0" OR !is_numeric($post["data"]["sp_musteri_telefon"]) OR strlen($post["data"]["sp_musteri_telefon"])!=10)){
			$ajaxJson = ["jsonStatu"=>false,"alert"=>["statu"=>"danger","head"=>_e("telefon-hatali",true),"text"=>_e("telefon-numaranizi-basinda-sifir-olmadan-giriniz",true)],"focus"=>'input[name="sp_musteri_telefon"]'];
		} else if(isset($post["data"]["countryCode"]) AND strlen($post["data"]["sp_musteri_telefon"])<7){
			$ajaxJson = ["jsonStatu"=>false,"alert"=>["statu"=>"danger","head"=>_e("telefon-hatali",true),"text"=>_e("telefon-numaranizi-dogru-ve-eksiksiz-giriniz",true)],"focus"=>'input[name="sp_musteri_telefon"]'];
		} else {
			$post["data"]["sp_musteri_telefon"] = "+".$post["data"]["countryCode"].$post["data"]["sp_musteri_telefon"];
			$ajaxJson = ["jsonStatu"=>true];
		}
	} else {
		$ajaxJson = ["jsonStatu"=>false,"alert"=>["statu"=>"danger","head"=>_e("tum-alanlari-doldurun",true),"text"=>_e("siparis-olustururken-hata-tum-alanlari-eksiksiz-doldurun",true)]];
	}
} else if($post["loftAction"]=="favoriCheck"){
	ob_start();
	$packageList = [];
	if(is_array($post["favoriler"])){
	    foreach ($post["favoriler"] as $package) {
	        $query = "SELECT * FROM paketler WHERE pk_id = :pk_id LIMIT 0,1";
	        $stmt = $db->prepare($query);
	        $stmt->bindParam(":pk_id", $package);
	        if($stmt->execute() AND $row = $stmt->fetch(PDO::FETCH_ASSOC)){
	            $packageList[] = $row;
	        }
	    }
	}
    $packageList = $loft->partPacket($packageList,"favorite");
    if(count($packageList)>0){
	    foreach ($packageList as $package) {
			include "include/home/pack.loft.php";
		}
	} else {
		echo '<div class="notfavlist"><span>'._e("favori-paketiniz-bulunmuyor",true).'</span><p>'._e("ilgili-oldugunuz-paketleri-favorilere-ekleyin",true).'</p></div>';
	}
	?>
	<script type="text/javascript">
		$('button[data-type="packetFavori"]').click(function(){
			packetID = $(this).data("favpacket");
			cookieGuncelle("favorilerim["+packetID+"]",false,-1);
			$('div[data-packet="'+packetID+'"]').remove();
		});
		$(".packDetailMore").click(function(){
			$(this).hide();
			$(this).parent().addClass("more");
			$(this).parent().find(".moresi").slideDown(300);
		});
	</script>
	<?php
    $html = ob_get_contents();
	ob_end_clean();
	$ajaxJson = ["jsonStatu"=>true,"html"=>$html];
} else if($post["loftAction"]=="cookieOrders"){
	ob_start();
	if(isset($post["orders"]) AND is_array($post["orders"])){
		foreach ($post["orders"] as $order) {
	        $query = "SELECT * FROM siparisler WHERE sp_musteri_link = :sp_musteri_link LIMIT 0,1";
	        $stmt = $db->prepare($query);
	        $stmt->bindParam(":sp_musteri_link", $order);
	        if($stmt->execute() AND $row = $stmt->fetch(PDO::FETCH_ASSOC)){
	        $exitingOrder = true; ?>
	           <div class="item">
					<div class="text">
						<span>#<?php echo $row["sp_code"];?></span>
						<?php echo $row["sp_paket_adi"];?>
					</div>
					<div class="action">
						<a href="<?php echo $loft->url(ns_filter("siparispage"),$row["sp_musteri_link"]);?>" class="ordliact">
							<i class="fas fa-layer-group"></i> <?php _e("incele");?></a>
					</div>
				</div>
	        <?php }
	    }
	}
	if(!isset($exitingOrder)){
		echo '<div class="nosearch">'._e("mevcut-siparis-gecmisi-bulunamadi",true).'</div>';
	}
    $html = ob_get_contents();
	ob_end_clean();
	$ajaxJson = ["jsonStatu"=>true,"html"=>$html];
} else if($post["loftAction"]=="moreComment"){
	if(count($commentList)>0){
		ob_start();
			foreach ($commentList as $value) { ?>
				<div class="comment">
					<div class="comHead">
						<div class="costumer"><?php echo $value["name"];?></div>
						<span><?php echo $value["publishDate"];?></span>
					</div>
					<div class="comContent">
						<p><?php echo $value["comment"];?></p>
					</div>
				</div>
			<?php }
		$html = ob_get_contents();
		ob_end_clean();
		$ajaxJson = ["jsonStatu"=>true,"html"=>$html,"commentMore"=>$commentStart+$comment["viewCount"]];
	} else {
		$ajaxJson = ["jsonStatu"=>false,"text"=>_e("hepsi-bu-kadar",true)];
	}
	
}
