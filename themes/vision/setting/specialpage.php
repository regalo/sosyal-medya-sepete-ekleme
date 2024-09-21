<div class="tab-alani">
	<ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
		<li class="nav-item">
			<a class="nav-link gri alti <?php echo !isset($get["liste"]) ? 'active show':'';?>" href="<?php echo $ayar->getpage('theme').'?include=specialpage';?>">Yeni Ekle</a>
		</li>
		<?php
		$primarys = [];
		foreach ($loftSpecialPackage as $value) {
			if((!isset($get["liste"]) OR $get["liste"]!=$value["ayar_1"]))
				$primarys[] = $value["item3"]; 
		?>
		<li class="nav-item">
			<a class="nav-link gri alti <?php echo (isset($get["liste"]) AND $get["liste"]==$value["ayar_1"]) ? 'active show':'';?>" href="<?php echo $ayar->getpage('theme').'?include=specialpage&liste='.$value["ayar_1"];?>"><i class="<?php echo $value["icon"];?>"></i> <?php echo $value["headLine"];?></a>
		</li>
		<?php } ?>
	</ul>
</div>
<?php foreach ($loftSpecialPackage as $value) { 
	if(isset($get["liste"]) AND $get["liste"]==$value["ayar_1"]){ ?>
<div class="tab-pane fade active show">
	<form class="loftForm" method="POST">
		<input type="hidden" name="olay" value="loftOptions">
		<input type="hidden" name="page" value="theme">
		<input type="hidden" name="loftAction" value="spacialPageUpdate">
		<input type="hidden" name="spacialPage" value="<?php echo $value["ayar_1"];?>">
		<div class="row">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<div class="box-title">Sergilenecek Paketler</div>
					</div>
					<div class="card-body">
						<div class="pack-list-area">
							<div class="plist-filter">
								<input type="text" placeholder="Paket Ara" class="form-control pack-filter-search">
							</div>
							<ul>
								<?php
								$mevcut = [];
								foreach ($value["packageList"] as $key => $val) {
									$mevcut[] = $val["pk_id"];
								}
								$paketler = [];
								foreach ($packageList as $val) {
									extract($val);
									?>
									<li id="paket-<?php echo $pk_id;?>" style="<?php echo in_array($pk_id,(array) $mevcut) ? 'display: none;':'';?>">
										<span><i class="<?php echo $icon;?>"></i> <?php echo $productName; ?></span>
										<button type="button" data-id="<?php echo $pk_id;?>" class="btn pack-add-list">Ekle</button>
										<button data-id="<?php echo $pk_id;?>" type="button" onclick="pRemove(this)" class="btn pack-remove-list">Sil</button>
									</li>
								<?php  } ?>
							</ul>
							<div class="pack-list-added">
								<ul>
									<?php
									foreach ($value["packageList"] as $key => $val) { ?>
										<li> <span><i class="<?php echo $val["icon"];?>" aria-hidden="true"></i> <?php echo $val["productName"];?></span> <button type="button" data-id="<?php echo $val["pk_id"];?>" class="btn pack-add-list">Ekle</button><button data-id="<?php echo $val["pk_id"];?>" type="button" onclick="pRemove(this)" class="btn pack-remove-list">Sil</button> <input type="hidden" name="data[item2][package][]" value="<?php echo $val["pk_id"];?>"></li>
									<?php } ?>
								</ul>
							</div>
						</div>
						<script>
							$(".pack-filter-search").on("focus", function(){
								$(".pack-list-area > ul").fadeIn(100);
								$(".pack-filter-search").on("keyup", function() {
									var value = $(this).val().toLowerCase();
									$(".pack-list-area > ul li").filter(function() {
										$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
									});
								});
							});
							$("*").click(function (e) {
					            if (!$(e.target).is(".pack-list-area input,.pack-list-area > ul, .pack-list-area > ul li, .pack-list-area > ul li span, .pack-list-area > ul li button")) {
									$(".pack-list-area > ul").fadeOut(100);
					            }
					        });
					        $(".pack-list-area button").click(function(){
					        	var plideg = $(this).parent().html();
					        	var pacId = $(this).attr("data-id");
								$(this).parent().attr("style","display:none;");
								$(".pack-list-added ul").append('<li>'+plideg+'<input type="hidden" name="data[item2][package][]" value="'+pacId+'"></li>');
								$('.pack-filter-search').focus();
							});
							function pRemove(thiss){
								$(thiss).parent().remove();
								$("#paket-"+$(thiss).attr("data-id")).attr("style","");
							};
						</script>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<div class="box-title font-weight-bold">Sayfa Bilgileri</div>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col-md-12">
								<div class="form-group">
									<div class="input-group">
										<div class="butto butto-light mr-1 smgir">
											<i id="iconView_spacePacketList" class="<?php echo $value["icon"];?>" aria-hidden="true"></i>
										</div>
										<input type="text" class="form-control smginx" id="iconInput_spacePacketList" name="data[item2][icon]" value="<?php echo $value["icon"];?>">
										<button type="button"
										class="butto butbor butto-dark icon-modal"
										data-toggle="modal"
										data-target="#iconSec"
										data-icon="<?php echo $value["icon"];?>"
										data-add="spacePacketList">Icon Seç</button>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold">Üst Başlık</label>
									<input class="form-control smgin" name="data[item2][head]" placeholder="Başlık Belirle (Çok Satanlar)" value="<?php echo $value["head"];?>" required="">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold">Ana Başlık</label>
									<input class="form-control smgin" name="data[item2][headLine]" placeholder="Başlık Belirle (Çok Satanlar)" value="<?php echo $value["headLine"];?>" required="">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold">Kısa Açıklama</label>
									<textarea class="form-control" name="data[item2][description]" placeholder="Açıklama gir"><?php echo $value["description"];?></textarea>
								</div>
							</div>
							<div class="col-md-12">
								<label class="font-weight-bold">Sayfa Uzantısı</label>
								<p>Oluşturulan özel sayfasının sayfa uzantısını belirleyin.</p>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text form-control mr-2" id="basic-addon3">siteadresi.com/</span>
									</div>
									<input type="text" class="form-control" name="data[item3]" placeholder="Sayfa Uzantısı Belirle" required="" value="<?php echo $value["item3"];?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="alert alert-danger d-none" id="submitAlert">
								</div>
							</div>
							<div class="col-md-12 mt-3">
								<a href="../../<?php echo $value["item3"];?>/" target="_blank"><button type="button" class="butto butto-lg butto-dark butbor"><i class="fas fa-eye" aria-hidden="true"></i> Görüntüle</button></a>
								<button type="submit" class="butto butto-lg butto-danger butbor" data-loftAction="loftOptions" data-type="loftOptionsDelete"><i class="fas fa-trash" aria-hidden="true"></i></button>
									<button type="submit" class="butto butto-lg butto-success butbor pull-right" data-loftAction="loftOptions" data-type="loftOptions"><i class="fas fa-check" aria-hidden="true"></i> Kaydet</button>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<?php } } ?>
<?php if(!isset($get["liste"])) { ?>
<div class="tab-pane fade active show">
	<div class="row">
		<div class="col-md-8">
			<form class="loftForm" method="POST">
				<input type="hidden" name="olay" value="loftOptions">
				<input type="hidden" name="page" value="theme">
				<input type="hidden" name="loftAction" value="spacialPageNew">
				<div class="card">
					<div class="card-header">
						<div class="box-title font-weight-bold">Sayfa Bilgileri</div>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col-md-12">
								<div class="form-group">
									<div class="input-group">
										<div class="butto butto-light mr-1 smgir">
											<i id="iconView_spacePacketList" class="fas fa-heart" aria-hidden="true"></i>
										</div>
										<input type="text" class="form-control smginx" id="iconInput_spacePacketList" name="data[item2][icon]" value="fas fa-heart">
										<button type="button"
										class="butto butbor butto-dark icon-modal"
										data-toggle="modal"
										data-target="#iconSec"
										data-icon="fas fa-heart"
										data-add="spacePacketList">Icon Seç</button>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold">Üst Başlık</label>
									<input class="form-control smgin" name="data[item2][head]" placeholder="Başlık Belirle (Çok Satanlar)" value="" required="">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold">Ana Başlık</label>
									<input class="form-control smgin" name="data[item2][headLine]" placeholder="Başlık Belirle (Çok Satanlar)" value="" required="">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold">Kısa Açıklama</label>
									<textarea class="form-control" name="data[item2][description]" placeholder="Açıklama gir"></textarea>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
								<label class="font-weight-bold">Sayfa Uzantısı</label>
									<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text form-control mr-2" id="basic-addon3">siteadresi.com/</span>
									</div>
									<input type="text" class="form-control" name="data[item3]" required="" placeholder="Sayfa Uzantısı Belirle">
								</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="alert alert-danger d-none" id="submitAlert">
								</div>
							</div>
							<div class="col-md-12">
								<input type="hidden" name="data[item1]" value="loftSpecialList">
								<input type="hidden" name="data[item4]" value="">
								<input type="hidden" name="data[item5]" value="">
								<input type="hidden" name="data[statu]" value="1">
								<input type="hidden" name="data[item2][package][]" value="0">
								<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check" aria-hidden="true"></i> Ekle</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-4">
			<div class="card bilgi-box">
				<div class="card-header">
					<div class="box-title font-weight-bold">Bilgi Kutusu <i class="fas fa-chevron-right"></i></div>
				</div>
				<div class="card-body">
					<div class="bb-box">
						<span class="bb-title">Özel Sayfa Nedir?</span>
						Özel sayfa sitenizde mevcut seçenekler haricinde paketleri listeleyebileceğiniz, özel bir yapıdır.
						<hr>
						<span class="bb-title">Sayfa Uzantısı Kullanımı?</span>
						Sayfa için belirlemiş olduğunuz uzantı oluşturduğunuz sayfasının adresini belirler. <br>Örneğin <i>kampanya</i> adında uzantı belirlerseniz, oluşturduğunuz sayfaya <i>siteadresi.com/kampanya/</i> şeklinde erişilebilir.
						<hr>
						<span class="bb-title">Listeleme Nedir?</span>
						Oluşturulan sayfanın anasayfada listelenmesini istiyorsanız listelemeyi aktif edin.
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>
	<script type="text/javascript">
		primarys = <?php echo json_encode($primarys);?>;
		$('input[name="data[item3]"]').on("keyup",function(){
		    var text = this.value.replace(" ","").toLowerCase();
	        var text = text.replace(/[^a-z-0-9]/g,'');
	        this.value= text.trim();
		});
		$('button[type="submit"]').click(function(){
			if(primarys.includes($('input[name="data[item3]"]').val())){
	        	$("#submitAlert").removeClass("d-none");
				$("#submitAlert").html("Belirlediğiniz sayfa uzantı benzersiz olmalıdır");
	        	setTimeout(function(){ $("#submitAlert").addClass("d-none") }, 3000);
	        	return false;
	        }
		});
	</script>

	<style type="text/css">
		.pack-list-added .pack-add-list, .pack-list-area .pack-remove-list  {
			display: none;
		}
		.pack-list-added .pack-remove-list {
			display: block !important;
		}
	</style>