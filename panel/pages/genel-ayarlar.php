<?php
if (isset($post["olay"]) AND $post["olay"]=="yeni") {
	if (!$ayar->select($post["item1"]) OR $post["tur"]==0)
	{
		$ayar->item = $post;
		$ayar->insert();
		$alert->header = "Ayarlar Eklendi";
		$alert->content = "Ayar başarıyla eklendi";
		$alert->action =  $post["tur"]==0 ? "close":"reload";
	} else 
	{
		$alert->header = "Zaten Var";
		$alert->content = "Eklediğin ayar zaten mevcut";
		$alert->action = "close";
		$alert->statu = "danger";
	}
	include_once "alert.php";
	exit;
} elseif (isset($post["olay"]) AND $post["olay"]=="cache-clear") {
	$nsoft->delete("config/cache",false);
	$alert->header = "Önbellek Temizlendi";
	$alert->content = "Önbellek temizleme işlemi başarıyla gerçekleştirildi";
	$alert->action = "reload";
	include_once "alert.php";
	exit;
} elseif (isset($post["olay"]) AND $post["olay"]=="genel-ayarlar") {
	foreach ($post as $key => $value) {
		if ($ayar->select($key))
		{
			$ayar->item2 = $value;
			$ayar->update();
		}
		if ($key=="yonlendirme")
		{
			$ayar->remove("siteurl");
			$ayar->select("siteurl");
			$ayar->statu = $post["yonlendirme"];
			$ayar->update();
		}
	}
	if (isset($post["currency-statu"]))
		{   $ayar->remove("currency");
	if ($ayar->select("currency")) 
	{
		$ayar->statu = $post["currency-statu"];
		$ayar->update();
	}
}
$alert->header = "Ayarlar Kaydedildi";
$alert->content = "Genel ayarlar bölümünde yaptığınız değişiklikler kaydedildi";
$alert->action = (isset($post["panelurl"]) AND $ayar->panelurl!=$post["panelurl"]) ? str_replace($ayar->panelurl, $post["panelurl"], $ayar->getpage('genel-ayarlar')): "reload";
$alert->action = isset($post["sitelogo"]) ? "close": $alert->action;
include_once "alert.php";
exit;
} elseif (isset($post["olay"]) AND $post["olay"]=="permalink") {
	$ayar->select('permalink');
	$ayar->item2 = $post["permalink"];
	$ayar->update();
	$ayar->permalink = $post["permalink"];
	foreach ($post as $key => $value) {
		if ($ayar->select($key)) {
			$ayar->item2 = $value;
			$ayar->update();
		}
	}
	$alert->header = "Ayarlar Güncellendi";
	$alert->content = "SEO ve URL Ayarları güncellendi";
	$alert->action = "close";
	include_once "alert.php";
	exit;
}  elseif (isset($post["olay"]) AND $post["olay"]=="page-setting") {
	foreach ($post["array"] as $value) {
		if (is_numeric($value) AND isset($post["item1"][$value]) AND $ayar->select($post["item1"][$value])) {
			$ayar->item2 = $post["item2"][$value];
			$ayar->item3 = $post["item3"][$value];
			$ayar->item4 = $post["item4"][$value];
			$ayar->item5 = $post["item5"][$value];
			$ayar->statu = $post["statu"][$value];
			if ($ayar->update()) {

			}
		}
	}
	$alert->header = "Ayarlar Güncellendi";
	$alert->content = "Sayfa tercihleriniz başarıyla kaydedildi.";
	$alert->action = "close";
	include_once "alert.php";
	exit;
} elseif (isset($post["olay"])) {
	if ($ayar->select($post["olay"])) {
		foreach ($post as $key => $value) {
			$ayar->$key = $value;
		}
		$ayar->update();
	}
	$alert->header = "Ayarlar Güncellendi";
	$alert->content = "Yaptığınız değişiklikler başarıyla kaydedildi";
	$alert->action = "close";
	if($post["olay"]=="ns_cache")
		$alert->action = "reload";
	include_once "alert.php";
	exit;
}
?><div class="content" id="alan">
	<div class="animated fadeIn" id="scrolling">
		<div class="orders">
			<div class="row">
				<div class="col-lg-12">
					<div class="tab-alani">
						<ul class="nav nav-pills"id="pills-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link butto-lg gri active show" id="pills-temel-tab" data-toggle="pill" href="#pills-temel" role="tab" aria-controls="pills-temel" aria-selected="false"><i class="fas fa-cogs"></i> Genel Ayarlar</a>
							</li>
							<li class="nav-item">
								<a class="nav-link butto-lg gri" id="pills-url-tab" data-toggle="pill" href="#pills-url" role="tab" aria-controls="pills-url" aria-selected="true"><i class="fas fa-link"></i> SEO ve URL Ayarları</a>
							</li>
							<li class="nav-item">
								<a class="nav-link butto-lg gri" id="pills-guvenlik-tab" data-toggle="pill" href="#pills-guvenlik" role="tab" aria-controls="pills-guvenlik" aria-selected="true"><i class="fas fa-shield-alt"></i> Güvenlik Ayarları</a>
							</li>
							<li class="nav-item">
								<a class="nav-link butto-lg gri" id="cron-tab" data-toggle="pill" href="#cron-job" role="tab" aria-controls="cron-guvenlik" aria-selected="true"><i class="fas fa-stopwatch"></i> Cron Job Ayarları</a>
							</li>
						</ul>
					</div>
					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane fade active show" id="pills-temel" role="tabpanel" aria-labelledby="pills-temel-tab">
							<div class="row">
								<div class="col-md-8">
									<div class="card">
										<div class="card-header">
											<strong>Site Ayarları</strong>
										</div>
										<div class="card-body">
											<form id="genel-ayarlar" method="POST" action="" onsubmit="fastpost('genel-ayarlar','ajaxout'); return false;">
												<input type="hidden" name="page" value="genel-ayarlar">
												<input type="hidden" name="olay" value="genel-ayarlar">
												<div class="form-row">
													<div class="form-group col-md-12">
														<label class="form-control-label font-weight-bold">Lisans Kodunuz</label>
														<input class="form-control" placeholder="XXXX-XXXX-XXXX-XXXX-XXXX" disabled="" value="<?php echo $ayar->scriptlisans;?>">
													</div>
													<div class="form-group col-md-2">
														<label class="form-control-label font-weight-bold">URL Tipi</label>
														<select class="form-control" name="siteurl">
															<?php $domain = str_replace(array('https://','http://',"www."), "", $ayar->siteurl);?>
															<option
															value="<?php echo 'http://'.$domain;?>"
															<?php echo strstr($ayar->siteurl,'http://'.$domain) ? 'selected=""':'';?>>
														http://</option>
														<option
														value="<?php echo 'http://www.'.$domain;?>"
														<?php echo strstr($ayar->siteurl,'http://www.'.$domain) ? 'selected=""':'';?>>
													http://www.</option>
													<option
													value="<?php echo 'https://'.$domain;?>"
													<?php echo strstr($ayar->siteurl,'https://'.$domain) ? 'selected=""':'';?>>
												https://</option>
												<option
												value="<?php echo 'https://www.'.$domain;?>"
												<?php echo strstr($ayar->siteurl,'https://www.'.$domain) ? 'selected=""':'';?>>
											https://www.</option>
										</select>
									</div>
									<div class="form-group col-md-4">
										<label class="form-control-label font-weight-bold">Domain</label>
										<input class="form-control" placeholder="https://siteadresi.com" disabled="" value="<?php echo $domain;?>">
									</div>
									<div class="form-group col-md-2">
										<label class="form-control-label font-weight-bold">Yönlendirme</label>
										<select class="form-control" name="yonlendirme">
											<option value="1" <?php echo ns_filter('siteurl','statu') ? 'selected':'';?>>Aktif</option>
											<option value="0" <?php echo !ns_filter('siteurl','statu') ? 'selected':'';?>>Pasif</option>
										</select>
									</div>
									<div class="form-group col-md-4">
										<label class="form-control-label font-weight-bold">
											<i class="fas fa-info-circle c-help" title="Bu kısım yönetim paneline giriş adresinizi belirler. Örn: 'admin' olarak belirlerseniz, yönetim paneli adresiniz: siteadresi.com/admin/ şeklinde olur."></i> Panel Dizini</label>
											<input class="form-control" placeholder="admin" name="panelurl" minlength="4" value="<?php echo $ayar->panelurl;?>">
										</div>
										<div class="col-md-12">
											<div class="alert alert-danger mt-3">
												<p class="mb-0"><b>DİKKAT!</b><br>Bazı hosting hesaplarında otomatik SSL yönlendirmesi mevcut olabiliyor. Bu durumda kod içerisinde sağladığımız kontrol sitenizi sürekli yenilemeye sokabilir. Böyle bir durumda yönlendirmeyi pasif durumunda bırakmanız gerekiyor.</p>
											</div>
										</div>
										<div class="form-group col-md-12">
											<label class="form-control-label font-weight-bold">Site Adı</label>
											<input class="form-control" placeholder="Site Adı" name="sitename" value="<?php echo $ayar->sitename;?>">
										</div>
										<div class="form-group col-md-4">
											<label class="form-control-label font-weight-bold">Site Dili</label>
											<div class="input-group mb-3">
												<?php
												foreach ($ayar->languages() as $value) {
													extract($value);
													if($lang_code==ns_filter('language')){
														echo '<input type="text" class="form-control" disabled="" value="'.$lang_name.'" id="language">';
														$langselect = true;
													}
												}
												if(!isset($langselect))
													echo '<input type="text" class="form-control" disabled="" value="Türkçe" id="language">';
												?>
												<input type="hidden" id="languagehidden" name="language" value="<?php echo ns_filter("language");?>">
												<div class="input-group-append">
													<button class="butto butto-light ml-1 butbor" type="button" data-toggle="modal" data-target="#dilmodal"><i class="fas fa-tools"></i></button>
												</div>
											</div>
											<div class="modal fade  bd-example-modal-md" id="dilmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog dil-modal-width pt-5" role="document">
													<div class="modal-content card mt-3">
														<div class="modal-header card-header">
															<h5 class="box-title d-inline-block mt-1" id="exampleModalLabel">Dil Tercihi</h5>
															<button type="button" id="langclose" class="butto butto-xs butto-light butbor float-right" data-dismiss="modal"><i class="fas fa-times" aria-hidden="true"></i></button>
														</div>
														<div class="modal-body p-0">
															<div class="table-stats order-table ov-h" id="tb-scroll">
																<table class="table orders-list" id="orders-list">
																	<?php $diller = $nsoft->all("modul","language");?>
																	<thead>
																		<tr>
																			<th>Dil</th>
																			<th>Kodu</th>
																			<th>Versiyon</th>
																			<th></th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php
																		$lang = array();
																		foreach ($nsoft->lists as $value) {
																			$lang[$value["primary"]] = $value;
																		}
																		foreach ($nsoft->real as $value) {
																			if(!isset($lang[$value["primary"]]))
																				$lang[$value["primary"]] = $value;
																		}
																		?>
																		<?php
																		foreach ($lang as $value) { ?>
																			<tr>
																				<td><?php echo $value["name"];?></td>
																				<td><?php echo $value["primary"];?></td>
																				<td>v<?php echo $value["version"];?></td>
																				<td class="text-right">
																					<? if (isset($value["update"])) { ?>
																						<script type="text/javascript">
																							var <?= $value["primary"].'_update';?> = <?= json_encode($value["update"]);?>;
																						</script>
																						<? if($value["statu"]==2) { ?>
																							<button type="button" onclick="nsoft(<?= $value["primary"].'_update';?>)" class="butto butto-primary butbor d-inline"><i class="fas fa-cloud-download-alt"></i> Yükle</button>
																						<? } elseif($value["statu"]==1) { ?>
																							<button type="button" onclick="nsoft(<?= $value["primary"].'_update';?>)" class="butto butto-warning butbor d-inline"><i class="fas fa-sync-alt"></i> Güncelle</button>
																						<?php } } else { ?>
																							<button type="button" data-primary="<?php echo $value["primary"];?>" data-name="<?php echo $value["name"];?>" class="langselect butto butto-<?php echo $value["primary"]==ns_filter('language') ? 'success':'secondary';?> butbor d-inline"><i class="fas fa-check"></i></button>
																						<? } ?>
																					</td>
																				</tr>
																			<?php } ?>
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
													</div>
												</div>
												<script type="text/javascript">
													$('.langselect').click(function(){
														$('#language').val($(this).data("name"));
														$('#languagehidden').val($(this).data("primary"));
														$('#langclose').click();
														$('.langselect').attr('class','langselect butto butto-secondary butbor d-inline');
														$(this).attr('class','langselect butto butto-success butbor d-inline');
													});
												</script>
											</div>
											<div class="form-group col-md-4">
												<label class="form-control-label font-weight-bold">Para Birimi</label>
												<select class="form-control" name="currency">
													<?php
													foreach ($ayar->currency_format(0,"list") as $value) {
														extract($value);
														if($code==ns_filter('currency'))
															echo '<option value="'.$code.'" selected="">'.$name.' ('.$symbol.')</option>';
														else
															echo '<option value="'.$code.'" >'.$name.' ('.$symbol.')</option>';
													}
													?>
												</select>
											</div>
											<div class="form-group col-md-4">
												<label class="form-control-label font-weight-bold">Ücret Görünümü</label>
												<select class="form-control" name="currency-statu">
													<option value="0" <?php echo ns_filter('currency','statu')=="0" ? 'selected=""':'';?>>Sembol (₺)</option>
													<option value="1" <?php echo ns_filter('currency','statu')=="1" ? 'selected=""':'';?>>Kısaltma (TL)</option>
												</select>
											</div>
											<div class="col-md-12 text-right mt-3">
												<button type="submit" class="butto butto-success butto-lg butbor"><i class="fas fa-check"></i> Değişiklikleri Kaydet</button>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="card">
								<div class="card-header">
									<strong>Platform - Kategori - Paket Sıralamaları</strong>
								</div>
								<div class="card-body">
									<form id="ns_ranking" method="POST" action="" onsubmit="fastpost('ns_ranking','ajaxout'); return false;">
										<input type="hidden" name="page" value="genel-ayarlar">
										<input type="hidden" name="olay" value="ns_ranking">
										<div class="form-row">
											<div class="form-group col-md-4">
												<label class="form-control-label font-weight-bold">Platform Sırala</label>
												<select class="form-control" name="item4">
													<option value="pt_row ASC" <?php echo ns_filter('ns_ranking','item4') == 'pt_row ASC' ? 'selected=""':'';?>>Opsiyonel Değer</option>
													<option value="pt_name ASC" <?php echo ns_filter('ns_ranking','item4') == 'pt_name ASC' ? 'selected=""':'';?>>A-Z Sıralama</option>
													<option value="pt_name DESC" <?php echo ns_filter('ns_ranking','item4') == 'pt_name DESC' ? 'selected=""':'';?>>Z-A Sıralama</option>
													<option value="pt_id DESC" <?php echo ns_filter('ns_ranking','item4') == 'pt_id DESC' ? 'selected=""':'';?>>En Yeniler</option>
													<option value="pt_id ASC" <?php echo ns_filter('ns_ranking','item4') == 'pt_id ASC' ? 'selected=""':'';?>>En Eskiler</option>
												</select>
											</div>
											<div class="form-group col-md-4">
												<label class="form-control-label font-weight-bold">Kategori Sırala</label>
												<select class="form-control" name="item3">
													<option value="hz_row ASC" <?php echo ns_filter('ns_ranking','item3') == 'hz_row ASC' ? 'selected=""':'';?>>Opsiyonel Değer</option>
													<option value="hz_adi ASC" <?php echo ns_filter('ns_ranking','item3') == 'hz_adi ASC' ? 'selected=""':'';?>>A-Z Sıralama</option>
													<option value="hz_adi DESC" <?php echo ns_filter('ns_ranking','item3') == 'hz_adi DESC' ? 'selected=""':'';?>>Z-A Sıralama</option>
													<option value="hz_id DESC" <?php echo ns_filter('ns_ranking','item3') == 'hz_id DESC' ? 'selected=""':'';?>>En Yeniler</option>
													<option value="hz_id ASC" <?php echo ns_filter('ns_ranking','item3') == 'hz_id ASC' ? 'selected=""':'';?>>En Eskiler</option>
												</select>
											</div>
											<div class="form-group col-md-4">
												<label class="form-control-label font-weight-bold">Paket Sırala</label>
												<select class="form-control" name="item2">
													<option value="pk_fiyat ASC" <?php echo ns_filter('ns_ranking','item2') == 'pk_fiyat ASC' ? 'selected=""':'';?>>Fiyata Göre Artan</option>
													<option value="pk_fiyat DESC" <?php echo ns_filter('ns_ranking','item2') == 'pk_fiyat DESC' ? 'selected=""':'';?>>Fiyata Göre Azalan</option>
													<option value="pk_adet ASC" <?php echo ns_filter('ns_ranking','item2') == 'pk_adet ASC' ? 'selected=""':'';?>>Miktara Göre Artan</option>
													<option value="pk_adet DESC" <?php echo ns_filter('ns_ranking','item2') == 'pk_adet DESC' ? 'selected=""':'';?>>Miktara Göre Azalan</option>
													<option value="pk_adi ASC" <?php echo ns_filter('ns_ranking','item2') == 'pk_adi ASC' ? 'selected=""':'';?>>A-Z Sıralama</option>
													<option value="pk_adi DESC" <?php echo ns_filter('ns_ranking','item2') == 'pk_adi DESC' ? 'selected=""':'';?>>Z-A Sıralama</option>
													<option value="pk_id DESC" <?php echo ns_filter('ns_ranking','item2') == 'pk_id DESC' ? 'selected=""':'';?>>En Yeniler</option>
													<option value="pk_id ASC" <?php echo ns_filter('ns_ranking','item2') == 'pk_id ASC' ? 'selected=""':'';?>>En Eskiler</option>
												</select>
											</div>
											<div class="col-md-12 text-right mt-3">
												<button type="submit" class="butto butto-success butto-lg butbor"><i class="fas fa-check"></i> Değişiklikleri Kaydet</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<form id="logo-favicon" method="POST" action="" onsubmit="fastpost('logo-favicon','ajaxout'); return false;">
								<input type="hidden" name="page" value="genel-ayarlar">
								<input type="hidden" name="olay" value="genel-ayarlar">
								<div class="row">
									<div class="col-md-12">
										<div class="card mb-4">
											<div class="card-header">
												<div class="box-title">Site Logosu</div>
												<button class="butto butto-success butbor butto-xs pull-right"><i class="fas fa-check"></i> Kaydet</button>
											</div>
											<div class="card-body" style="margin-bottom: 0">
												<div class="onecik-onizle ortambut" data-ortam="sitelogo" data-url="<?php echo ns_filter('siteurl').$ayar->sitelogo;?>" data-input="<?php echo $ayar->sitelogo;?>">
													<img class="ortam-sec" src="<?php echo ns_filter('siteurl').'panel/images/ortam-sec.png';?>">
													<div class="tumb-oniztext">
														<img id="sitelogo-onizleme" src="<?php echo $ayar->siteurl.$ayar->sitelogo;?>">
														<input type="hidden" id="sitelogo-input" name="sitelogo" required="" value="<?php echo $ayar->sitelogo;?>">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="card mb-4">
											<div class="card-header">
												<div class="box-title">Site Favicon</div>
												<button class="butto butto-success butbor butto-xs pull-right"><i class="fas fa-check"></i> Kaydet</button>
											</div>
											<div class="card-body" style="margin-bottom: 0">
												<div class="onecik-onizle ortambut" data-ortam="favicon" data-url="<?php echo ns_filter('siteurl').$ayar->favicon;?>" data-input="<?php echo $ayar->favicon;?>">
													<img class="ortam-sec" src="<?php echo ns_filter('siteurl').'panel/images/ortam-sec.png';?>">
													<div class="tumb-oniztext">
														<img id="favicon-onizleme" width="120" src="<?php echo $ayar->siteurl.$ayar->favicon;?>">
														<input type="hidden" id="favicon-input" name="favicon" required="" value="<?php echo $ayar->favicon;?>">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>

				</div>
				<div class="tab-pane fade" id="pills-url" role="tabpanel" aria-labelledby="pills-url-tab">
					<div class="card">
						<div class="card-body">
							<form id="permalink" method="POST" action="" onsubmit="fastpost('permalink','ajaxout'); return false;">
								<input type="hidden" name="page" value="genel-ayarlar">
								<input type="hidden"  name="olay" value="permalink">
								<div class="row">
									<div class="col-md-12 form-group">
										<label class="form-label font-weight-bold">Kategori Url Yapısı Seçin</label>
										<select class="form-control mt-2" name="permalink">
											<option value="default" <?php if($ayar->permalink=="default"){ echo "selected";}?>>Klasik URL Yapısı</option>
											<option value="seo" <?php if($ayar->permalink=="seo"){ echo "selected";}?>>Seo URL Yapısı</option>
										</select>
										<div class="alert alert-danger mt-3">
											<p class="mb-0"><b>DİKKAT!</b><br>Kategori url yapısını klasik olarak seçerseniz urller; siteadi.com/instagram/takipci/ şeklinde olur. <br>
											Kategori url yapısını seo başlık olarak seçerseniz url yapısı; siteadresi.com/instagram-ucuz-takipci-satin-al/ şeklinde olur. </p>
										</div>
									</div>
									<div class="form-group col-md-12">
										<label class="form-control-label font-weight-bold">Ana Sayfa Title</label>
										<input class="form-control" placeholder="Site Başlığı" name="sitetitle" value="<?php echo $ayar->sitetitle;?>">
									</div>
									<div class="form-group col-md-12">
										<label class="form-control-label font-weight-bold">Ana Sayfa Açıklama</label>
										<textarea class="form-control" placeholder="Site Açıklaması" name="sitedesc"><?php echo $ayar->sitedesc;?></textarea>
									</div>
									<div class="form-group col-md-12">
										<label class="form-control-label font-weight-bold">Anahtar Kelimeler</label>
										<textarea class="form-control" placeholder="Anahtar Kelimeler (,)" name="sitekey"><?php echo ns_filter('sitekey','item2');?></textarea>
									</div>
									<div class="col-md-12 text-right">
										<button type="submit" class="butto butto-success butto-lg butbor"><i class="fas fa-check"></i> Değişiklikleri Kaydet</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="card">
						<div class="card-header">
							<div class="box-title">
								<b>Url Ayarları</b>
							</div>
						</div>
						<div class="card-body">
							<div class="tab-alanix">
								<ul class="nav nav-pills mb-4 " id="pills-tab" role="tablist">
									<li class="nav-item">
										<a class="nav-link alti butto-lg active show" id="pills-iletisimpage-tab" data-toggle="pill" href="#pills-iletisimpage" role="tab" aria-controls="pills-iletisimpage" aria-selected="false">İletişim Sayfası</a>
									</li>
									<li class="nav-item">
										<a class="nav-link alti butto-lg " id="pills-siparispage-tab" data-toggle="pill" href="#pills-siparispage" role="tab" aria-controls="pills-siparispage" aria-selected="false">Sipariş Sayfası</a>
									</li>
									<li class="nav-item">
										<a class="nav-link alti butto-lg " id="pills-tamamlandipage-tab" data-toggle="pill" href="#pills-tamamlandipage" role="tab" aria-controls="pills-tamamlandipage" aria-selected="false">Sipariş Başarılı S.</a>
									</li>
									<li class="nav-item">
										<a class="nav-link alti butto-lg " id="pills-tamamlanamadipage-tab" data-toggle="pill" href="#pills-tamamlanamadipage" role="tab" aria-controls="pills-tamamlanamadipage" aria-selected="false">Sipariş Başarısız S.</a>
									</li>
									<li class="nav-item">
										<a class="nav-link alti butto-lg " id="pills-blogpage-tab" data-toggle="pill" href="#pills-blogpage" role="tab" aria-controls="pills-blogpage" aria-selected="false">Blog Listesi S.</a>
									</li>
									<li class="nav-item">
										<a class="nav-link alti butto-lg " id="pills-404page-tab" data-toggle="pill" href="#pills-404page" role="tab" aria-controls="pills-404page" aria-selected="false">404 Sayfası</a>
									</li>
								</ul>
							</div>
							<div class="tab-content" id="pills-tabContent">
								<form id="page-setting" method="POST" action="" onsubmit="fastpost('page-setting','ajaxout'); return false;">
									<input type="hidden" name="page" value="genel-ayarlar">
									<input type="hidden"  name="olay" value="page-setting">
									<div class="tab-pane fade active show" id="pills-iletisimpage" role="tabpanel" aria-labelledby="pills-iletisimpage-tab">
										<div class="form-row">
											<input type="hidden" name="array[]" value="1">
											<input type="hidden" name="item1[1]" value="iletisimpage">
											<div class="form-group col-md-6">
												<label class="form-control-label font-weight-bold">Sayfa Uzantısı</label>
												<input class="form-control primary-text" required="" placeholder="iletisim" name="item2[1]" value="<?php echo ns_filter('iletisimpage');?>">
											</div>
											<div class="form-group col-md-6">
												<label class="form-control-label font-weight-bold">Sayfa Adı</label>
												<input class="form-control" required="" placeholder="İletişime Geç" name="item3[1]" value="<?php echo ns_filter('iletisimpage','item3');?>">
											</div>
											<div class="form-group col-md-12">
												<label class="form-control-label font-weight-bold">Sayfa Açıklaması</label>
												<textarea class="form-control" required="" name="item4[1]"><?php echo ns_filter('iletisimpage','item4');?></textarea>
											</div>
											<div class="form-group col-md-12">
												<label class="form-control-label font-weight-bold">Anahtar Kelimeler</label>
												<input class="form-control ns-append" name="item5[1]" aria-describedby="basic-addon2" value="<?php echo ns_filter('iletisimpage','item5');?>">
											</div>
											<div class="form-group col-md-12">
												<label class="form-control-label font-weight-bold">Indexleme Durumu</label>
												<select class="form-control ns-append" name="statu[1]">
													<option value="1" <?php echo ns_filter('iletisimpage','statu')==1 ? 'selected=""':'';?>>İndexlemeye İzin Verme</option>
													<option value="0" <?php echo ns_filter('iletisimpage','statu')==0 ? 'selected=""':'';?>>İndexlemeye İzin Ver</option>
												</select>
											</div>
										</div>
									</div>
									<div class="tab-pane fade " id="pills-siparispage" role="tabpanel" aria-labelledby="pills-siparispage-tab">
										<h4 class="font-weight-bold">Kısa Kodlar</h4>
										<div class="alert alert-info">
											<p class="mt-2">Paket Adı = %paket_adi% | Platform Adı = %platform_adi% | Kategori Adı = %kategori_adi%</p>
										</div>
										<div class="form-row">
											<input type="hidden" name="array[]" value="2">
											<input type="hidden" name="item1[2]" value="siparispage">
											<div class="form-group col-md-6">
												<label class="form-control-label font-weight-bold">Sayfa Uzantısı</label>
												<input class="form-control primary-text" required="" placeholder="siparis" name="item2[2]" value="<?php echo ns_filter('siparispage');?>">
											</div>
											<div class="form-group col-md-6">
												<label class="form-control-label font-weight-bold">Sayfa Adı</label>
												<input class="form-control" required="" placeholder="Sipariş Oluştur" name="item3[2]" value="<?php echo ns_filter('siparispage','item3');?>">
											</div>
											<div class="form-group col-md-12">
												<label class="form-control-label font-weight-bold">Sayfa Açıklaması</label>
												<textarea class="form-control" required="" name="item4[2]"><?php echo ns_filter('siparispage','item4');?></textarea>
											</div>
											<div class="form-group col-md-12">
												<label class="form-control-label font-weight-bold">Anahtar Kelimeler</label>
												<input class="form-control" name="item5[2]" value="<?php echo ns_filter('siparispage','item5');?>">
											</div>
											<div class="form-group col-md-12">
												<label class="form-control-label font-weight-bold">Indexleme Durumu</label>
												<select class="form-control" name="statu[2]">
													<option value="1" <?php echo ns_filter('siparispage','statu')==1 ? 'selected=""':'';?>>İndexlemeye İzin Verme</option>
													<option value="0" <?php echo ns_filter('siparispage','statu')==0 ? 'selected=""':'';?>>İndexlemeye İzin Ver</option>
												</select>
											</div>
										</div>
									</div>
									<div class="tab-pane fade " id="pills-tamamlandipage" role="tabpanel" aria-labelledby="pills-tamamlandipage-tab">
										<div class="form-row">
											<input type="hidden" name="array[]" value="3">
											<input type="hidden" name="item1[3]" value="tamamlandipage">
											<div class="form-group col-md-6">
												<label class="form-control-label font-weight-bold">Sayfa Uzantısı</label>
												<input class="form-control primary-text" required="" placeholder="siparis-tamamlandi" name="item2[3]" value="<?php echo ns_filter('tamamlandipage');?>">
											</div>
											<div class="form-group col-md-6">
												<label class="form-control-label font-weight-bold">Sayfa Adı</label>
												<input class="form-control" required="" placeholder="Sipariş Tamamlandı" name="item3[3]" value="<?php echo ns_filter('tamamlandipage','item3');?>">
											</div>
											<div class="form-group col-md-12">
												<label class="form-control-label font-weight-bold">Sayfa Açıklaması</label>
												<textarea class="form-control" required="" name="item4[3]"><?php echo ns_filter('tamamlandipage','item4');?></textarea>
											</div>
											<div class="form-group col-md-12">
												<label class="form-control-label font-weight-bold">İzleme Kodu</label>
												<textarea class="form-control" name="item5[3]"><?php echo ns_filter('tamamlandipage','item5');?></textarea>
											</div>
											<input type="hidden" name="statu[3]"  value="0">
										</div>
									</div>
									<div class="tab-pane fade " id="pills-tamamlanamadipage" role="tabpanel" aria-labelledby="pills-tamamlanamadipage-tab">
										<div class="form-row">
											<input type="hidden" name="array[]" value="4">
											<input type="hidden" name="item1[4]" value="tamamlanamadipage">
											<div class="form-group col-md-6">
												<label class="form-control-label font-weight-bold">Sayfa Uzantısı</label>
												<input class="form-control primary-text" required="" placeholder="siparis-tamamlanamadi" name="item2[4]" value="<?php echo ns_filter('tamamlanamadipage');?>">
											</div>
											<div class="form-group col-md-6">
												<label class="form-control-label font-weight-bold">Sayfa Adı</label>
												<input class="form-control" required="" placeholder="Sipariş Tamamlanamadı" name="item3[4]" value="<?php echo ns_filter('tamamlanamadipage','item3');?>">
											</div>
											<div class="form-group col-md-12">
												<label class="form-control-label font-weight-bold">Sayfa Açıklaması</label>
												<textarea class="form-control" required="" name="item4[4]"><?php echo ns_filter('tamamlanamadipage','item4');?></textarea>
											</div>
											<input type="hidden" name="item5[4]"  value="">
											<input type="hidden" name="statu[4]"  value="0">
										</div>
									</div>
									<div class="tab-pane fade " id="pills-blogpage" role="tabpanel" aria-labelledby="pills-blogpage-tab">
										<div class="form-row">
											<input type="hidden" name="array[]" value="5">
											<input type="hidden" name="item1[5]" value="blogpage">
											<input type="hidden"  name="item2[5]" readonly=""  value="<?php echo ns_filter('blogpage');?>">
											<div class="form-group col-md-12">
												<label class="form-control-label font-weight-bold">Sayfa Adı</label>
												<input class="form-control" required="" placeholder="İletişime Geç" name="item3[5]" value="<?php echo ns_filter('blogpage','item3');?>">
											</div>
											<div class="form-group col-md-12">
												<label class="form-control-label font-weight-bold">Sayfa Açıklaması</label>
												<textarea class="form-control" required="" name="item4[5]"><?php echo ns_filter('blogpage','item4');?></textarea>
											</div>
											<div class="form-group col-md-12">
												<label class="form-control-label font-weight-bold">Anahtar Kelimeler</label>
												<input class="form-control" name="item5[5]" value="<?php echo ns_filter('blogpage','item5');?>">
											</div>
											<div class="form-group col-md-12">
												<label class="form-control-label font-weight-bold">Indexleme Durumu</label>
												<select class="form-control" name="statu[5]">
													<option value="1" <?php echo ns_filter('blogpage','statu')==1 ? 'selected=""':'';?>>İndexlemeye İzin Verme</option>
													<option value="0" <?php echo ns_filter('blogpage','statu')==0 ? 'selected=""':'';?>>İndexlemeye İzin Ver</option>
												</select>
											</div>
										</div>
									</div>
									<div class="tab-pane fade " id="pills-404page" role="tabpanel" aria-labelledby="pills-404page-tab">
										<div class="form-row">
											<input type="hidden" name="array[]" value="6">
											<input type="hidden" name="item1[6]" value="404page">
											<input type="hidden"  name="item2[6]" readonly=""  value="<?php echo ns_filter('404page');?>">
											<div class="form-group col-md-12">
												<label class="form-control-label font-weight-bold">Sayfa Adı</label>
												<input class="form-control" required="" name="item3[6]" aria-describedby="basic-addon2" value="<?php echo ns_filter('404page','item3');?>">
											</div>
											<div class="form-group col-md-12">
												<label class="form-control-label font-weight-bold">Sayfa Açıklaması</label>
												<textarea class="form-control" required="" name="item4[6]"><?php echo ns_filter('404page','item4');?></textarea>
											</div>
											<div class="form-group col-md-12">
												<label class="form-control-label font-weight-bold">Anahtar Kelimeler</label>
												<input class="form-control" name="item5[6]" value="<?php echo ns_filter('404page','item5');?>">
											</div>
											<div class="form-group col-md-12">
												<label class="form-control-label font-weight-bold">Indexleme Durumu</label>
												<select class="form-control ns-append" name="statu[6]">
													<option value="1" <?php echo ns_filter('404page','statu')==1 ? 'selected=""':'';?>>İndexlemeye İzin Verme</option>
													<option value="0" <?php echo ns_filter('404page','statu')==0 ? 'selected=""':'';?>>İndexlemeye İzin Ver</option>
												</select>
											</div>
										</div>
									</div>
									<button type="submit" class="butto butto-success butto-lg butbor pull-right"><i class="fas fa-check" aria-hidden="true"></i> Değişiklikleri Kaydet</button>
								</form>
								<script type="text/javascript">
									$('.primary-text').keyup(function() {
										var text = this.value.replace(" ","");
										var text = text.replace(/[^a-z-]/g,'');
										this.value= text.trim();
									});
								</script>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="pills-guvenlik" role="tabpanel" aria-labelledby="pills-guvenlik-tab">
					<div class="card">
						<div class="card-header">
							<div class="box-title">Güvenlik Ayarları</div>
						</div>
						<div class="card-body">
							<form id="securty-setting" method="POST" action="" onsubmit="fastpost('securty-setting','ajaxout'); return false;">
								<input type="hidden" name="page" value="genel-ayarlar">
								<input type="hidden"  name="olay" value="recaptcha">
								<div class="row">
									<div class="col-md-12 mb-3">
										<div class="row">
											<div class="col-md-6">
												<label class="font-weight-bold">Captcha Site Anahtarı</label>
												<input type="text" class="form-control" name="item2" placeholder="Site Anahtarı" value="<?php echo ns_filter('recaptcha');?>">
											</div>
											<div class="col-md-6">
												<label class="font-weight-bold">Captcha Güvenlik Anahtarı</label>
												<input type="text" class="form-control" name="item3" placeholder="Güvenlik Anahtarı" value="<?php echo ns_filter('recaptcha','item3');?>">
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<label class="font-weight-bold">Panel Login</label>
										<select class="form-control" name="statu">
											<option value="1" <?php echo ns_filter('recaptcha','statu') ? 'selected=""':'';?>>Açık</option>
											<option value="0" <?php echo ns_filter('recaptcha','statu') ? '':'selected=""';?>>Kapalı</option>
										</select>
									</div>
									<div class="col-md-4">
										<label class="font-weight-bold">Sipariş Formu Captcha</label>
										<select class="form-control" name="item4">
											<option value="1" <?php echo ns_filter('recaptcha','item4') ? 'selected=""':'';?>>Açık</option>
											<option value="0" <?php echo ns_filter('recaptcha','item4') ? '':'selected=""';?>>Kapalı</option>
										</select>
									</div>
									<div class="col-md-4">
										<label class="font-weight-bold">İletişim Sayfası Captcha</label>
										<select class="form-control" name="item5">
											<option value="1" <?php echo ns_filter('recaptcha','item5') ? 'selected=""':'';?>>Açık</option>
											<option value="0" <?php echo ns_filter('recaptcha','item5') ? '':'selected=""';?>>Kapalı</option>
										</select>
									</div>
									<div class="col-md-12">
										<div class="alert alert-light pb-4 mt-4">
											<p class="mb-0">Captcha yardımı ile Google Recaptcha uygulama sayfasına gidin ve web siteniz için yeni bir Recaptcha uygulaması oluşturun. Bu konuda yardımcı bir çok makaleye Google araması ile ulaşabilirsiniz.
												<a target="_blank" href="https://www.google.com/recaptcha" class="butto butto-dark butbor d-inline-block mt-3"><i class="fas fa-external-link-alt"></i> Captcha Api</a>
											</p>

										</div>
									</div>
									<div class="col-md-12">
										<button class="butto butto-lg butto-success butbor mt-3 pull-right"><i class="fas fa-check"></i> Kaydet</button>
									</div>
								</div>
							</form>
							<script type="text/javascript">
								$('#pills-guvenlik select').on('change',function(){
									if($('input[name="item2"]').val().length < 10){
										$('input[name="item2"]').focus();
									} else if ($('input[name="item3"]').val().length < 10) {
										$('input[name="item3"]').focus();
									} else {
										return true;
									}
									$(this).val("0");
									return false;
								});
							</script>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="cron-job" role="tabpanel" aria-labelledby="cron-tab">
					<div class="row">
						<div class="col-md-8">
							<div class="card">
								<div class="card-header">
									<div class="box-title">Cron Job Ayarları</div>
									<button class="butto butto-<?php echo ns_filter('CronJobSetting','statu') ? 'success':'danger';?> butto-xs pull-right"><?php echo $ayar->zamanfarki(ns_filter('CronJobSetting'),"cron");?></button>
								</div>
								<div class="card-body">
									<form id="CronJobSetting" method="POST" action="" onsubmit="fastpost('CronJobSetting','ajaxout'); return false;">
										<input type="hidden" name="page" value="genel-ayarlar">
										<input type="hidden"  name="olay" value="CronJobSetting">
										<div class="form-row">
											<div class="col-md-5 mb-2">
												<label class="font-weight-bold">CronJob Linkiniz</label>
												<input type="text" readonly="" id="cronaction" class="form-control"  title="Tıkla ve Kopyala" style="cursor: copy;" onclick="copyto('cronaction',this)" value="<?php echo ns_filter('siteurl');?>cron.php">
											</div>
											<div class="col-md-7 mb-2">
												<label class="font-weight-bold">Panel Komutu</label>
												<input type="text" readonly="" id="cronaction2" class="form-control"  title="Tıkla ve Kopyala" style="cursor: copy;" onclick="copyto('cronaction2',this)" value='curl --silent <?php echo ns_filter('siteurl');?>cron.php'>
											</div>
											<div class="col-md-4">
												<label class="font-weight-bold">Bayi Sipariş Sorguları</label>
												<select class="form-control" name="item3">
													<option value="1" <?php echo ns_filter('CronJobSetting','item3') ? 'selected=""':'';?>>Aktif</option>
													<option value="0" <?php echo !ns_filter('CronJobSetting','item3') ? 'selected=""':'';?>>Pasif</option>
												</select>
											</div>
											<div class="col-md-4">
												<label class="font-weight-bold">Kontrol Gün Sayısı</label>
												<input type="number" class="form-control" name="item5" required="" min="1" value="<?php echo ns_filter('CronJobSetting','item5');?>">
											</div>
											<div class="col-md-4">
												<label class="font-weight-bold">Bayi Bakiye Sorguları</label>
												<select class="form-control" name="item4">
													<option value="1" <?php echo ns_filter('CronJobSetting','item4') ? 'selected=""':'';?>>Aktif</option>
													<option value="0" <?php echo !ns_filter('CronJobSetting','item4') ? 'selected=""':'';?>>Pasif</option>
												</select>
											</div>
											<div class="col-md-12">
												<button class="butto butto-lg butto-success butbor mt-3 pull-right"><i class="fas fa-check"></i> Kaydet</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="alert alert-danger"><p>Cron Job yukarıdaki iki görev dışında zamanlanmış mail ve sms gönderimlerini gerçekleştirir. Sorunsuz sistem işleyişi için cronjob ayarlarınızı kesinlikle doğru yapılandırmanız gerekmektedir.</p><p><b>Kontrol Gün Sayısı Nedir?</b><br> Kontrol gün sayısı bayi sorgusu yapılacak siparişlerin bu günden geçmişe dönük kaç gün önceki siparişlerin kontrol edileceğini belirler.</p>
								<p><b>Cron Pasif?</b><br> Cron komutunuz son 1 gündür çalışmamış ise üst bölümde pasif uyarısını göreceksiniz. Komutu ekleyerek çalışır hale getirdiğinizde ilk çalışma ile ilgili uyarı kalkacaktır.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<style type="text/css">
	.ns-append {
		border-radius: 0px 8px 8px 0px !important;
	}
	.ns-append-add {
		width: 156px;
	}
</style>