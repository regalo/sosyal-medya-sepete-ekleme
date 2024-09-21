<div class="fast-flex">
	<div class="fast-first">
		<h1><?php echo $intro["headLine"];?></h1>
		<p><?php echo $intro["description"];?></p>
		<?php if($intro["button"]=="1") { ?>
			<div class="fast-box-area">
				<?php foreach ($intro["buttons"] as $value) { ?>
					<div class="fast-box">
						<i class="<?php echo $value->icon;?>"></i> <span><?php echo $value->text;?></span>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
	<div class="fast-sec">
		<div class="hizlisip keskin hizlisip2">
			<div class="form-row" id="hizli-al">
				<?php 
				$select["platform"] = '';
				$select["kategori"] = '';
				$select["paket"] = '';
				foreach ($platform->all(0,50) as $value) {
				    extract($value);
				    $select["platform"] .= '<li data-type="platform" data-id="'.$pt_id.'"><i class="'.$pt_icon.'"></i> '.$pt_name.'</li>';
				    $kategori->pt_tax = $pt_id;
				    foreach ($kategori->all(0,100) as $cat) {
						extract($cat);
				        $select["kategori"] .= '<li class="d-none" data-type="kategori" data-select="'.$pt_id.'" data-id="'.$hz_id.'"><i class="'.$hz_icon.'"></i> '.$hz_adi.'</li>';
				        $paket->hz_tax = $hz_id;
				        foreach ($paket->all(0,1000) as $pk) {
				        	$visuality = $space->packetVisuality($pk);
				        	$icon = isset($visuality["icon"]) ? $visuality["icon"]:'fas fa-check-circle';
				            extract($pk);
				            if ($pk_durum) {
				            	$select["paket"] .= '<li class="d-none" data-type="paket" data-fee="'._p($pk_fiyat).'" data-select="'.$hz_id.'" data-url="'.$ayar->menulink('paket',$pk_pri).'"><i class="'.$icon.'"></i> '.$pk_adi.'</li>';
				            }
				        }
				    }
				}
				?>
				<div class="w-100">
					<div class="ns-select-area">
						<div class="ns-select" data-type="platform">
							<span id="platform_select"><?php _e("Platform Seç");?></span>
							<span>
								<i class="fas fa-chevron-right dropicon" aria-hidden="true"></i>
							</span>
						</div>
						<ul class="ns-dropselect" id="platform_list">
							    <?php echo $select["platform"];?>
						</ul>
					</div>
					<div class="ns-select-area">
						<div class="ns-select" data-type="kategori">
							<span id="kategori_select"><?php _e("Kategori Seç");?></span>
							<span>
								<i class="fas fa-chevron-right dropicon" aria-hidden="true"></i>
							</span>
						</div>
						<ul class="ns-dropselect" id="platform_alt">
							 <?php echo $select["kategori"];?>
						</ul>
					</div>
					<div class="ns-select-area">
						<div class="ns-select" data-type="paket"><span id="paket_select"><?php _e("Paket Seç");?></span>
							<span>
								<i class="fas fa-chevron-right dropicon" aria-hidden="true"></i>
							</span>
						</div>
						<ul class="ns-dropselect" id="kategori_alt">
							<?php echo $select["paket"];?>
						</ul>
					</div>
					<div class="w-100 mt-4">
						<a href="" id="hizli-satin-al" onclick="return fsnone();" class="btn hiz-but xrb keskin text-white"><?php _e("Satın Al");?></a>
					</div>
				</div>
				<script>
					  var SatinAl = "<?php _e("SATIN AL");?>";
					  var PaketSec = "<?php _e("Paket Seç");?>";
					  var KategoriSec = "<?php _e("Kategori Seç");?>";
					  var selector_step = "platform";
					  var activeToggle = false;
					  $(".ns-select").click(function(){
					  	  if ($(this).data("type")=="kategori" && selector_step=="platform") {
					  	  	$('#platform_select').parent().addClass("nonshake");
					          setTimeout(function(){
					            $('#platform_select').parent().removeClass("nonshake");},500);
					          return;
					  	  }
					  	  if ($(this).data("type")=="paket" && selector_step!="paket") {
					  	  	$('#kategori_select').parent().addClass("nonshake");
					          setTimeout(function(){
					            $('#kategori_select').parent().removeClass("nonshake");},500);
					          if (selector_step!="kategori") {
					          	$('#platform_select').parent().addClass("nonshake");
					          setTimeout(function(){
					            $('#platform_select').parent().removeClass("nonshake");},500);
					          }
					          return;
					  	  }
					  	  
					  	  if(activeToggle!=this && $(activeToggle).hasClass('show')) {
					  	  	  $(activeToggle).toggleClass("show");
						      $(activeToggle).parent().toggleClass("show");
						      $(activeToggle).next(".ns-dropselect").slideToggle(100);
					  	  }
					      $(this).toggleClass("show");
					      $(this).parent().toggleClass("show");
					      $(this).next(".ns-dropselect").slideToggle(100);
					      activeToggle = this;
					  });
					  $('.ns-dropselect li').click(function(){
					  	$('#'+$(this).data("type")+'_select').html($(this).html());
					  	$('#'+$(this).data("type")+'_select').parent().click();
					  	thisid = $(this).parent().attr("id");
					  	$('.ns-select show').removeClass('show');
					  	$("#"+thisid+" .active").removeClass("active");
					  	$(this).addClass('active');
					  	if ($(this).data("type")=="platform") {
					  		selector_step = "kategori";
					  		$('#kategori_select').html(KategoriSec);
					  		$('#paket_select').html(PaketSec);
						  	var list = document.querySelectorAll("#"+$(this).data("type")+"_alt li");
						  	for (var i = list.length - 1; i >= 0; i--) {
						  		if ($(list[i]).data('select')==$(this).data("id")) {
						  			$(list[i]).removeClass("d-none");
						  		} else {
						  			$(list[i]).addClass("d-none");
						  		}
						  	}
					  	}
					  	if ($(this).data("type")=="kategori") {
					  		selector_step = "paket";
					  		$('#paket_select').html(PaketSec);
						  	var list = document.querySelectorAll("#"+$(this).data("type")+"_alt li");
						  	for (var i = list.length - 1; i >= 0; i--) {
						  		if ($(list[i]).data('select')==$(this).data("id")) {
						  			$(list[i]).removeClass("d-none");
						  		} else {
						  			$(list[i]).addClass("d-none");
						  		}
						  	}
					  	}
					  	if ($(this).data("type")=="paket") {
					  		$('#hizli-satin-al').attr('href',$(this).data('url'));
					        $('#hizli-satin-al').html(SatinAl+' ('+$(this).data('fee')+')');
					        $('#hizli-satin-al').attr("onclick","");
					  	} else {
					  		$('#hizli-paket').prop('disabled',false);
						    $('#hizli-satin-al').attr('href','');
						    $('#hizli-satin-al').html(SatinAl);
						    $('#hizli-satin-al').attr("onclick","return fsnone();");
					  	}

					  });
					  function fsnone(){
					  	$('#paket_select').parent().addClass("nonshake");
					    setTimeout(function(){
					    $('#paket_select').parent().removeClass("nonshake");},500);
					    return false;
					  }
					</script>
					<style type="text/css">
						.ns-dropselect li.active {
						    background: #efefef;
						}
					</style>
		</div>
	</div>
	</div>
	</div>