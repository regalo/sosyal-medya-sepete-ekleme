<div class="tab-alani">
	<ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
		<li class="nav-item">
			<a class="nav-link gri alti <?php echo !isset($get["liste"]) ? 'active show':'';?>" href="<?php echo $ayar->getpage('theme').'?include=spacialpackets';?>">Yeni Ekle</a>
		</li>
		<?php foreach (ns_filter('spaceSpecialPacket','list') as $value) {
		$value["string"] = $space->jsonData($value["item2"]); ?>
		<li class="nav-item">
			<a class="nav-link gri alti <?php echo (isset($get["liste"]) AND $get["liste"]==$value["ayar_1"]) ? 'active show':'';?>" href="<?php echo $ayar->getpage('theme').'?include=spacialpackets&liste='.$value["ayar_1"];?>"><i class="<?php echo $value["string"]["icon"];?>"></i> <?php echo $value["string"]["text"];?></a>
		</li>
		<?php } ?>
	</ul>
</div>
<?php foreach (ns_filter('spaceSpecialPacket','list') as $value) { 
	if(isset($get["liste"]) AND $get["liste"]==$value["ayar_1"]){
	$value["string"] = $space->jsonData($value["item2"]); ?>
<div class="tab-pane fade active show">
	<form class="action_form_submit" method="POST">
        <input type="hidden" name="page" value="theme">
        <input type="hidden" name="olay" value="<?php echo $value["ayar_1"];?>">
        <input type="hidden" name="yontem" value="jsonEdit">
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
								<input type="hidden" name="data[item2][packets][]" value="0">
							</div>
							<ul>
								<?php
								$paketler = [];
								foreach ($paket->all(0,1000) as $val) {
									extract($val);
									$kategori->hz_id = $hz_tax;
									$kategori->select();
									$platform->pt_id = $kategori->pt_tax;
									$platform->select();
									$paketler[$pk_id] = array_merge($val,array("icon"=>$platform->pt_icon,"name"=>$platform->pt_name.' '.$pk_adi));
									?>
									<li id="paket-<?php echo $pk_id;?>" style="<?php echo in_array($pk_id,(array) $value["string"]["packets"]) ? 'display: none;':'';?>">
										<span><i class="<?php echo $platform->pt_icon;?>"></i> <?php echo $platform->pt_name.' '.$pk_adi;?></span>
										<?php if(isset($space->specialList[$pk_id]) AND $space->specialList[$pk_id] AND !in_array($pk_id,(array) $value["string"]["packets"])) { ?>
											<button type="button" data-id="<?php echo $pk_id;?>" disabled class="btn pack-add-list"><?php echo $space->specialList[$pk_id]["text"];?></button>
										<?php } else { ?>
											<button type="button" data-id="<?php echo $pk_id;?>" class="btn pack-add-list">Ekle</button>
										<?php } ?>
										<button data-id="<?php echo $pk_id;?>" type="button" onclick="pRemove(this)" class="btn pack-remove-list">Sil</button>
									</li>
								<?php  } ?>
							</ul>
							<div class="pack-list-added">
								<ul>
									<?php
									foreach ($value["string"]["packets"] as $key => $pak) {
									if (is_numeric($pak) AND isset($paketler[$pak]) AND $pak = $paketler[$pak]) { ?>
										<li> <span><i class="<?php echo $pak["icon"];?>" aria-hidden="true"></i> <?php echo $pak["name"];?></span> <button type="button" data-id="<?php echo $pak["pk_id"];?>" class="btn pack-add-list">Ekle</button><button data-id="<?php echo $pak["pk_id"];?>" type="button" onclick="pRemove(this)" class="btn pack-remove-list">Sil</button> <input type="hidden" name="data[item2][packets][<?php echo $pak["pk_id"];?>]" value="<?php echo $pak["pk_id"];?>"></li>
									<?php } } ?>
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
								$(".pack-list-added ul").append('<li>'+plideg+'<input type="hidden" name="data[item2][packets]['+pacId+']" value="'+pacId+'"></li>');
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
											<i id="iconView_spacePacketList" class="<?php echo $value["string"]["icon"];?>" aria-hidden="true"></i>
										</div>
										<input type="text" class="form-control smginx" id="iconInput_spacePacketList" name="data[item2][icon]" value="<?php echo $value["string"]["icon"];?>">
										<button type="button"
										class="butto butbor butto-dark icon-modal"
										data-toggle="modal"
										data-target="#iconSec"
										data-icon="<?php echo $value["string"]["icon"];?>"
										data-add="spacePacketList">Icon Seç</button>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input class="form-control smgin" name="data[item2][text]" placeholder="Başlık Belirle (İndirimde)" value="<?php echo $value["string"]["text"];?>" required="">
								</div>
							</div>
							<div class="col-md-12">
							<div class="form-group">
								<label class="font-weight-bold">Paket Rengi</label>
								<div class="input-group mb-2 renkhover">
									<div class="butto mr-1 smgir rengiyazdir" id="renk-1" style="background: <?php echo $value["string"]["color"];?>; width: calc(100% - 10px); text-shadow: none;">
									</div>
									<input type="text" class="form-control renksecici smginx" name="data[item2][color]" data-renk="renk-1" required="" value="<?php echo $value["string"]["color"];?>"></div>
								</div>
							</div>
							<div class="col-md-6">
								<label class="font-weight-bold">Fake İndirim</label>
								<select class="form-control" name="data[item2][fake]">
									<option value="1" <?php echo $value["string"]["fake"]=="1" ? 'selected':'';?>>Aktif</option>
									<option value="0" <?php echo $value["string"]["fake"]=="0" ? 'selected':'';?>>Pasif</option>
								</select>
							</div>
							<div class="col-md-6">
								<label class="font-weight-bold">İndirim Oranı</label>
								<input type="text" class="form-control" name="data[item2][fakeAmount]" placeholder="Yüzde Olarak Değer Girin" value="<?php echo $value["string"]["fakeAmount"];?>">
							</div>
							<div class="col-md-12 mt-3">
								<button type="button" class="butto butto-lg butto-danger butbor specialPacket_delete"><i class="fas fa-trash" aria-hidden="true"></i></button>
								<button type="submit" class="butto butto-lg butto-success butbor pull-right"><i class="fas fa-check" aria-hidden="true"></i> Kaydet</button>
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
			<form class="action_form_submit" method="POST">
                <input type="hidden" name="page" value="theme">
                <input type="hidden" name="olay" value="spaceSpecialPacket">
                <input type="hidden" name="yontem" value="jsonAdd">
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
											<i id="iconView_spacePacketList" class="fas fa-meteor" aria-hidden="true"></i>
										</div>
										<input type="text" class="form-control smginx" id="iconInput_spacePacketList" name="data[item2][icon]" value="fas fa-meteor">
										<button type="button"
										class="butto butbor butto-dark icon-modal"
										data-toggle="modal"
										data-target="#iconSec"
										data-icon="fas fa-meteor"
										data-add="spacePacketList">Icon Seç</button>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input class="form-control smgin" name="data[item2][text]" placeholder="Başlık Belirle (İndirimde)" value="" required="">
								</div>
							</div>
							<div class="col-md-12">
							<div class="form-group">
								<label class="font-weight-bold">Paket Rengi</label>
								<div class="input-group mb-2 renkhover">
									<div class="butto mr-1 smgir rengiyazdir" id="renk-1" style="background: #41305b; width: calc(100% - 10px); text-shadow: none;">
									</div>
									<input type="text" class="form-control renksecici smginx" name="data[item2][color]" data-renk="renk-1" required="" value="#41305b"></div>
								</div>
							</div>
							<div class="col-md-6">
								<label class="font-weight-bold">Fake İndirim</label>
								<select class="form-control" name="data[item2][fake]">
									<option value="1">Aktif</option>
									<option value="0">Pasif</option>
								</select>
							</div>
							<div class="col-md-6">
								<label class="font-weight-bold">İndirim Oranı</label>
								<input type="text" class="form-control" name="data[item2][fakeAmount]" placeholder="Yüzde Olarak Değer Girin" value="0">
							</div>
							<div class="col-md-12">
								<input type="hidden" name="data[item2][packets][]" value="">
								<input type="hidden" name="data[item1]" value="spaceSpecialPacket">
								<input type="hidden" name="data[item3]" value="">
								<input type="hidden" name="data[item4]" value="">
								<input type="hidden" name="data[item5]" value="">
								<input type="hidden" name="data[statu]" value="1">
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
						<span class="bb-title">Özel Paket Nedir?</span>
						Özel paket sitede yer alan default paketlere göre daha dikkat çekici paket türüdür. Bu özellik ile paketlere renk ve başlık tanımlayabilirsiniz.
						<hr>
						<span class="bb-title">Fake Bildirim Nasıl Kullanılır?</span>
						Özel paketlere belirlemiş olduğunzu fake bilidirim gösteriş amaçlıdır. Fiyatlar % olarak belirlediğiniz miktar kadar düşmüş görünür. (Eğer gerçekten indirim sunmak istiyorsanız Hizmet Yönetimi > Paketler kısmından paket fiyatını değiştirebilirsiniz.)
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>
	<script type="text/javascript">
		$('input[name="data[item3]"]').on("keyup",function(){
		    var text = this.value.replace(" ","").toLowerCase();
	        var text = text.replace(/[^a-z-]/g,'');
	        this.value= text.trim();
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