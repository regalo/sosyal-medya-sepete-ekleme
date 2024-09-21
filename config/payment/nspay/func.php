<?php
 if (isset($post["o_code"]) AND isset($post["o_banka"])) {
	$siparis->sp_code = $post["o_code"];
	if ($siparis->select()) {
		$odeme = isset($odeme) ? $odeme : new Odeme($db);
		$odeme->o_code = $post["o_code"];
		if ($odeme->select()) {
			foreach ($post as $key => $value) {
				$odeme->$key = $value;
			}
			$odeme->o_time = date("Y-m-d");
			if ($odeme->update()) {
				$git = ns_filter('siteurl').ns_filter('tamamlandipage').'/'.$siparis->sp_musteri_link.'/';
			    header("Location:$git");
			    exit("OK");
			}
		} else {
			foreach ($post as $key => $value) {
				$odeme->$key = $value;
			}
			$odeme->o_tutar = $siparis->sp_musteri_tutar;
			if ($odeme->insert()) {
				$odeme->o_code = $post["o_code"];
				$siparis->sp_durum = 0;
				$siparis->update();
				$odeme->select();
				$odeme->MailSMSList();
				$git = ns_filter('siteurl').ns_filter('tamamlandipage').'/'.$siparis->sp_musteri_link.'/';
			    header("Location:$git");
			    exit("OK");
			}
		}
	} else {
		$git = ns_filter('siteurl').'404/';
		header("Location:$git");
		exit("OK");
	}
	$git = ns_filter('siteurl').'404/';
	header("Location:$git");
	exit("OK");
} else { ?>
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,500,700" rel="stylesheet">
<link rel="stylesheet" href="<?= ns_filter('siteurl');?>config/payment/nspay/assets/style.css">
<div class="nspay-mt">
			<div class="kart mb-3 show">
				<div class="kart-ust colpz c-pointer kbt">
					<div class="font-weight-bold"><? _e("Banka Hesapları");?> <i class="chevron float-right"></i></div>
				</div>
				<div class="kart-govde collaps">
					<select class="form-control" id="_selectbank">
						<?php foreach (ns_filter('havalebank','list') as $bnk) {
	                        extract($bnk);
	                        $info = explode('NivuBol', $item3);
	                        echo '<option value="'.$ayar_1.'">'.$item2.'</option>';
	                    }
	                    ?>
					</select>
					<ul class="banklist">
						<?php foreach (ns_filter('havalebank','list') as $bnk) {
	                        extract($bnk);
	                        $info = explode('NivuBol', $item3); ?>
							<li class="bank-flex <?= !isset($none) ? $none=true:'d-none';?>" data-bank="<?= $ayar_1;?>">
								<div class="bank-ico">
									<img src="<?= ns_filter('siteurl').$item5;?>" alt="">
								</div>
								<div class="bank-dets">
									<?php echo !empty($item4)? '<div class="d-block">'._e("ALICI ADI",true).': <span class="font-weight-bold">'.$item4.'</span></div>':'';?>
									<?php echo !empty($info[1])? '<div class="d-block">'._e("ŞUBE KODU",true).': <span class="font-weight-bold">'.$info[1].'</span></div>':'';?>
									<?php echo !empty($info[2])? '<div class="d-block">'._e("HESAP NO",true).': <span class="font-weight-bold">'.$info[2].'</span></div>':'';?>
									<?php echo !empty($info[0])? '<div class="d-block">'._e("IBAN",true).': <span class="font-weight-bold">'.$info[0].'</span></div>':'';?>
								</div>
							</li>
	                    <?php } ?>
					</ul>
					<div class="alert alert-light">
						<p class="nspat-dtext"><?php echo sprintf(_e("Ödenmesi gereken tutar <strong>%s</strong>. Lütfen EFT-Havale açıklamanıza <strong>%u</strong> sipariş kodunuzu ekleyiniz. İşlem sonrası alt bölümden ödeme bildiriminde bulunabilirsiniz",true),_p($post["sp_musteri_tutar"],"true"),$post["sp_code"]);?></p>
					</div>
					<button type="button" class="butto butto-lg butto-dark butbor odendi-btn mt-2 mb-3 float-right"><? _e("Ödeme Bildirimi Yap");?></button>
				</div>
			</div>
			<div id="odeme-bildirimi" class="kart mb-4">
				<div class="kart-ust colpz c-pointer kbt">
					<div class="font-weight-bold"><? _e("Ödeme Bildirimi Yap");?> <i class="chevron float-right"></i></div>
				</div>
				<?php  $odeme = isset($odeme) ? $odeme : new Odeme($db);
					$odeme->o_code = $post["sp_code"];
					$nspay = $odeme->select();
				?>
				<div class="kart-govde text-left collaps">
					<form method="POST" action="<?= ns_filter('siteurl').'payment/nspay/';?>">
						<div class="form-row p-2">
							<div class="col-md-12 mb-3">
								<label for="" class="font-weight-bold"><? _e("Ad Soyad");?></label>
								<input type="text" class="form-control" name="o_ad_soyad" value="<?php echo $nspay ? $odeme->o_ad_soyad:$post["sp_musteri_adi"];?>">
							</div>
							<div class="col-md-12 mb-3">
								<label for="" class="font-weight-bold"><?php _e("Ödeme Yapılan Banka");?></label>
								<select class="form-control" name="o_banka" id="_selectbank2">
									<?php foreach (ns_filter('havalebank','list') as $bnk) {
			                            extract($bnk);
			                            $info = explode('NivuBol', $item3);
			                            if ($nspay AND $odeme->o_banka==$ayar_1) {
			                            	echo '<option value="'.$ayar_1.'" selected="">'.$item2.'</option>';
			                            } else {
			                            	echo '<option value="'.$ayar_1.'">'.$item2.'</option>';
			                            }
			                        }
			                        ?>
								</select>
							</div>
							<div class="col-md-6 mb-3">
								<label for="" class="font-weight-bold"><?php _e("Yatırılan Tutar");?></label>
								<input type="text" class="form-control" required="" value="<?php echo $post["sp_musteri_tutar"];?> TL">
							</div>
							<div class="col-md-6 mb-3">
								<label for="" class="font-weight-bold"><?php _e("Ödeme Tarihi");?></label>
								<input type="date" class="form-control" required="" value="<?php echo $nspay ? $odeme->o_time:date("Y-m-d");?>">
							</div>
							<div class="col-md-12 mb-3">
								<label for="" class="font-weight-bold"><?php _e("Açıklama");?></label>
								<textarea class="form-control" name="o_aciklama"><?php echo $nspay ? $odeme->o_aciklama:'';?></textarea>
							</div>
							<div class="col-md-12 text-right mb-2">
								<input type="hidden" name="o_code" value="<?php echo $post["sp_code"];?>">
								<button type="sutmit" class="butto butto-dark butto-lg butbor"><?php _e("GÖNDER");?></button>
							</div>
						</div>
					</form>
				</div>
			</div>
</div>
<script>
	$('.colpz').click(function(){
		$(this).parent().toggleClass('show');
		$('.colpz').not(this).parent().removeClass('show');
	});
	$('.odendi-btn').click(function(){
		$('.colpz').parent().removeClass('show');
		$('#odeme-bildirimi').addClass('show');
	});
	$(document).ready(function () {
		$('#_selectbank').on('change',function(){
		var list = document.querySelectorAll(".banklist li");
	      for (var i = list.length - 1; i >= 0; i--) {
	      	if(!$(list[i]).hasClass('d-none')) {
	        	$(list[i]).addClass('d-none');
	        }
	      	if ($(list[i]).data('bank')==$(this).val()) {
	          $(list[i]).removeClass('d-none');
	        }
	      }
	    var list = document.querySelectorAll("#_selectbank2 option");
	    for (var i = list.length - 1; i >= 0; i--) {
	      	if ($(list[i]).val()==$(this).val()) {
	          $(list[i]).prop('selected',true);
	        } else {
	        	$(list[i]).prop('selected',false);
	        }
	      }
	});
	$('#_selectbank2').on('change',function(){
		var list = document.querySelectorAll(".banklist li");
	      for (var i = list.length - 1; i >= 0; i--) {
	      	if(!$(list[i]).hasClass('d-none')) {
	        	$(list[i]).addClass('d-none');
	        }
	      	if ($(list[i]).data('bank')==$(this).val()) {
	          $(list[i]).removeClass('d-none');
	        }
	      }
	    var list = document.querySelectorAll("#_selectbank option");
	    for (var i = list.length - 1; i >= 0; i--) {
	      	if ($(list[i]).val()==$(this).val()) {
	          $(list[i]).prop('selected',true);
	        } else {
	        	$(list[i]).prop('selected',false);
	        }
	      }
	});
	  $('.odendi-btn').click(function() {
	  $('html, body').animate({
	    scrollTop: $("#odeme-bildirimi").offset().top - 100
	  }, 1000)
	})
});
</script>
<?php } ?>