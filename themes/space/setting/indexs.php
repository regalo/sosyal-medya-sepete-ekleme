<div class="tab-alani">
	<ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
		<li class="nav-item">
			<a class="nav-link gri active show" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-home"></i> Home</a>
		</li>
		<li class="nav-item">
			<a class="nav-link gri" id="pills-intro-tab" data-toggle="pill" href="#pills-intro" role="tab" aria-controls="pills-intro" aria-selected="true"><i class="fas fa-bolt"></i> Genel</a>
		</li>
		<li class="nav-item">
			<a class="nav-link gri" id="pills-most-tab" data-toggle="pill" href="#pills-most" role="tab" aria-controls="pills-most" aria-selected="true"><i class="fab fa-hotjar"></i> Çok Satanlar</a>
		</li>
		<li class="nav-item">
			<a class="nav-link gri" id="pills-why-tab" data-toggle="pill" href="#pills-why" role="tab" aria-controls="pills-why" aria-selected="true"><i class="fas fa-award"></i> Neden Biz?</a>
		</li>
		<li class="nav-item">
			<a class="nav-link gri" id="pills-blog-tab" data-toggle="pill" href="#pills-blog" role="tab" aria-controls="pills-blog" aria-selected="true"><i class="fas fa-code"></i> Blog & Makale</a>
		</li>
		<li class="nav-item">
			<a class="nav-link gri" id="pills-footer-tab" data-toggle="pill" href="#pills-footer" role="tab" aria-controls="pills-footer" aria-selected="true"><i class="fas fa-angle-double-down"></i> Footer</a>
		</li>
		<li class="nav-item">
			<a class="nav-link gri" id="pills-temel-tab" data-toggle="pill" href="#pills-ozel" role="tab" aria-controls="pills-temel" aria-selected="false"><i class="fas fa-cog"></i> Özelleştirme</a>
		</li>
	</ul>
</div>
<div class="tab-content" id="pills-tabContent">
	<div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
		asd
	</div>
	<div class="tab-pane fade" id="pills-intro" role="tabpanel" aria-labelledby="pills-intro-tab">
		<div class="tab-alani">
			<ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
				<li class="nav-item">
					<a class="nav-link gri alti active show" id="pills-1x1-tab" data-toggle="pill" href="#pills-1x1" role="tab" aria-controls="pills-home" aria-selected="true">Header</a>
				</li>
				<li class="nav-item">
					<a class="nav-link gri alti" id="pills-1x2-tab" data-toggle="pill" href="#pills-1x2" role="tab" aria-controls="pills-home" aria-selected="true">Footer</a>
				</li>
				<li class="nav-item">
					<a class="nav-link gri alti" id="pills-1x3-tab" data-toggle="pill" href="#pills-1x3" role="tab" aria-controls="pills-home" aria-selected="true">Intro</a>
				</li>
			</ul>
		</div>
		<div class="tab-pane fade active show" id="pills-1x1" role="tabpanel" aria-labelledby="pills-1x1-tab">
			1
		</div>
		<div class="tab-pane fade" id="pills-1x2" role="tabpanel" aria-labelledby="pills-1x1-tab">
			2
		</div>
		<?php $heads = ns_filter('default-slogan','row'); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="box-title">Header Menü</div>
					</div>
					<div class="card-body">
						<form id="header-menu" method="POST" action="" onsubmit="fastpost('header-menu','ajaxout'); return false;">
							<input type="hidden" name="page" value="theme">
							<input type="hidden" name="olay" value="default-header-menu">
							<div class="form-row">
								<div class="form-group col-md-12">
									<label class="font-weight-bold">Menü Seç</label>
									<select class="form-control" name="item2">
										<?php foreach ($ayar->all('nsmenu') as $value) { ?>
										<option value="<?= $value["ayar_1"];?>" <?= $value["ayar_1"]==ns_filter('default-header-menu') ? 'selected=""':'';?>><?= $value["item2"];?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-md-12">
									<div class="alert alert-success">
										<p class="mb-0">Header kısmındaki menüyü düzenlemek ve değiştirmek için; <b>Görünüm > Menüler</b> kısmını kullanabilirsiniz.</p>
									</div>
								</div>
								<div class="col-md-12">
									<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check"></i> Kaydet</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<div class="box-title">Intro Yazılar</div>
					</div>
					<div class="card-body">
						<form id="default-slogan" method="POST" action="" onsubmit="fastpost('default-slogan','ajaxout'); return false;">
							<input type="hidden" name="page" value="theme">
							<input type="hidden" name="olay" value="default-slogan">
							<div class="row">
								<div class="form-group col-md-6" style="float: left;">
									<label><b>Üst Satır</b></label>
									<input name="item2" type="text" class="form-control" value="<?php echo $heads["item2"];?>">
								</div>
								<div class="form-group col-md-6" style="float: left;">
									<label><b>Alt Satır</b></label>
									<input name="item4" type="text" class="form-control" value="<?php echo $heads["item4"];?>">
								</div>
								<div class="form-group col-md-12" style="float: left;">
									<label><b>Tanıtım Yazısı</b></label>
									<input name="item3" type="text" class="form-control" value="<?php echo $heads["item3"];?>">
								</div>
								<div class="col-md-12">
									<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check"></i> Kaydet</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<div class="box-title">Intro Butonlar
							<label class="switch ml-2 mb-0">
								<input onclick="status('default-slogan')" type="checkbox" <?= $ayar->statu('default-slogan') ? "checked":"";?>>
								<span class="btn-ackapa round"></span>
							</label>
						</div>
					</div>
					<div class="card-body bcb-mt-3">
						<form id="intro-butonlar" method="POST" action="" onsubmit="fastpost('intro-butonlar','ajaxout'); return false;">
							<input type="hidden" name="page" value="theme">
							<input type="hidden" name="olay" value="intro-butonlar">
							<div class="tab-alani mb-2">
								<ul class="nav nav-pills" id="pills-tab1" role="tablist">
									<li class="nav-item">
										<a class="nav-link gri active show alti" id="pills-buton1-tab" data-toggle="pill" href="#buton1" role="tab" aria-controls="pills-buton1" aria-selected="true">1. Buton</a>
									</li>
									<li class="nav-item">
										<a class="nav-link alti" id="pills-buton2-tab" data-toggle="pill" href="#buton2" role="tab" aria-controls="pills-buton2" aria-selected="true">2. Buton</a>
									</li>
									<li class="nav-item">
										<a class="nav-link alti" id="pills-buton3-tab" data-toggle="pill" href="#buton3" role="tab" aria-controls="pills-buton3" aria-selected="false">3. Buton</a>
									</li>
								</ul>
							</div>
							<div class="tab-content" id="pills-tabContent">
								<div class="row">
									<?php $howbox = explode('=?=', $heads["item5"]);
									$sayis = 1;
									foreach ($howbox as $nasil) {
									$nasil = explode('?=?', $nasil); ?>
									<input type="hidden" name="howbox[]" value="<?= $sayis;?>">
									<div class="tab-pane fade active <?php if ($sayis == 1) echo "show"; ?>" id="buton<?php echo $sayis;?>" role="tabpanel" aria-labelledby="pills-buton<?php echo $sayis;?>-tab">
										<div class="col-md-12">
											<div data-icon="fas fa-award" data-box="<?= $sayis;?>" class="icon-sec"><i class="fas fa-award"></i></div>
											<div data-icon="fas fa-bullhorn" data-box="<?= $sayis;?>" class="icon-sec"><i class="fas fa-bullhorn"></i></div>
											<div data-icon="fas fa-check-double" data-box="<?= $sayis;?>" class="icon-sec"><i class="fas fa-check-double"></i></div>
											<div data-icon="fas fa-chart-line" data-box="<?= $sayis;?>" class="icon-sec"><i class="fas fa-chart-line"></i></div>
											<div data-icon="far fa-grin" data-box="<?= $sayis;?>" class="icon-sec"><i class="far fa-grin"></i></div>
											<div data-icon="fas fa-shopping-cart" data-box="<?= $sayis;?>" class="icon-sec"><i class="fas fa-shopping-cart"></i></div>
											<div data-icon="fas fa-hourglass-start" data-box="<?= $sayis;?>" class="icon-sec"><i class="fas fa-hourglass-start"></i></div>
											<div data-icon="fas fa-clock" data-box="<?= $sayis;?>" class="icon-sec"><i class="fas fa-clock"></i></div>
											<div data-icon="fas fa-mouse-pointer" data-box="<?= $sayis;?>" class="icon-sec"><i class="fas fa-mouse-pointer"></i></div>
											<div class="input-group mb-2">
												<div class="butto butto-light mr-1 smgir" id="icon-sec-<?= $sayis;?>">
													<i class="<?php echo $nasil[1];?>"></i>
												</div>
												<input id="icon-input-<?= $sayis;?>" name="icon[<?= $sayis;?>]" required="" class="form-control smginx" value="<?php echo $nasil[1];?>">
											</div>
											<input class="form-control smgin" name="baslik[<?= $sayis;?>]" value="<?php echo $nasil[0];?>" placeholder="Başlık" required="">
										</div>
									</div>
									<?php $sayis++;  } ?>
									<div class="col-md-12">
										<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check"></i> Kaydet</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="box-title">Intro Hizmetler</div>
					</div>
					<div class="card-body">
						<form id="intro-hizmetler" method="POST" action="" onsubmit="fastpost('intro-hizmetler','ajaxout'); return false;">
							<input type="hidden" name="page" value="theme">
							<input type="hidden" name="olay" value="intro-hizmetler">
							<div class="text-center">
								<?php $yonlendirme = explode(",", ns_filter('default-ustyonlendirme'));
								foreach ($yonlendirme as $item) {?>
								<div class="input-group inpad1">
									<select class="form-control" name="item2[]">
										<option value="secilmedi">Seçim Yap yada Boş Bırak</option>
										<?php
																				$platform = !isset($platform) ? new Platform($db): $platform;
										$kategori = !isset($kategori) ? new Kategori($db): $kategori;
										foreach ($platform->all(0,100) as $pt) {
											extract($pt);
										?>
										<option value="platform-<?= $pt_id;?>" <?= $item == 'platform-'.$pt_id ? 'selected':'';?>><?php echo $pt_name;?> Hizmetleri</option>
										<?php
										$kategori->pt_tax = $pt_id;
										foreach ($kategori->all(0,100) as $hz) {
										extract($hz);
										?>
										<option value="kategori-<?= $hz_id;?>" <?= $item == 'kategori-'.$hz_id ? 'selected':'';?>><?php echo $pt_name.' '.$hz_adi;?></option>
										<?php } } ?>
									</select>
								</div>
								<?php } ?>
								<div class="clear"></div>
							</div>
							<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check"></i> Kaydet</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="box-title">Header Kod Alanı</div>
					</div>
					<div class="card-body">
						<form id="default-headcode" method="POST" action="" onsubmit="fastpost('default-headcode','ajaxout'); return false;">
							<input type="hidden" name="page" value="theme">
							<input type="hidden" name="olay" value="default-headcode">
							<div class="form-row">
								<div class="form-group col-md-12">
									<input type="hidden" name="offsecury[]" value="item2">
									<textarea class="form-control" name="item2" placeholder="Header için ekstra kod alanı"><?= ns_filter('default-headcode');?></textarea>
								</div>
								<div class="col-md-12">
									<div class="alert alert-danger text-center">
										<p class="mb-0">Bu kısım sitenin header kısmına kod eklemek içindir. Site doğrulama, canlı destek gibi ekstralar için size verilen kodları bu kısıma ekleyebilirsiniz.
											<span class="d-block font-weight-bold">
												Script kodlarını bazı sunucular güvenlik nedeni (ModSecurty) ile kabul etmemektedir. Kaydet sonrası hata alırsanız lütfen hizmet sağlayıcı firmanız ile iletişime geçin.
											</span>
										</p>
									</div>
								</div>
								<div class="col-md-12">
									<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check"></i> Kaydet</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="tab-pane fade" id="pills-most" role="tabpanel" aria-labelledby="pills-most-tab">
		<div class="card">
			<div class="card-header">
				<div class="box-title">Çok Satanlar</div>
			</div>
			<div class="card-body">
				<form id="default-coksatan" method="POST" action="" onsubmit="fastpost('default-coksatan','ajaxout'); return false;">
					<input type="hidden" name="page" value="theme">
					<input type="hidden" name="olay" value="default-coksatan">
					<div class="form-row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="font-weight-bold">Başlık</label>
								<input type="text" class="form-control" name="item3" placeholder="Başlık Girin" value="<?= ns_filter('default-coksatan','item3');?>">
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<label class="font-weight-bold">Açıklama</label>
								<input type="text" class="form-control" name="item4"  placeholder="Açıklama Girin" value="<?= ns_filter('default-coksatan','item4');?>">
							</div>
						</div>
					</div>
					<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check"></i> Kaydet</button>
				</form>
			</div>
		</div>
		<div class="card">
			<div class="card-header">
				<div class="box-title">Sergilenecek Paketler</div>
			</div>
			<div class="card-body">
				<form id="paketler-coksatan" method="POST" action="" onsubmit="fastpost('paketler-coksatan','ajaxout'); return false;">
					<input type="hidden" name="page" value="theme">
					<input type="hidden" name="olay" value="paketler-coksatan">
					<div class="text-center" id="paketler">
						<? $paket = isset($paket) ? $paket: new Paket($db);
						$platform = isset($platform) ? $platform: new Platform($db);
						$kategori = isset($kategori) ? $kategori: new Kategori($db);
						$paketler = '<select class="form-control smgin" name="item2[]">';
							foreach ($paket->all(0,1000) as $value) {
							extract($value);
							$kategori->hz_id = $hz_tax;
							$kategori->select();
							$platform->pt_id = $kategori->pt_tax;
							$platform->select();
							$paketler .= '<option value="'.$pk_id.'">'.$platform->pt_name.' '.$pk_adi.'</option>';
							}
						$paketler .='</select>'; ?>
						<?php $liste = explode(",", ns_filter('default-coksatan'));
						$osay = 1;
						foreach ($liste as $idler) {
						if (is_numeric($idler)) { ?>
						<div class="input-group inpad1">
							<?= str_replace('value="'.$idler.'"', 'value="'.$idler.'" selected=""', $paketler); ?>
							<div class="butto butto-lg butto-danger butbor ml-2" onclick="$(this).parent().remove();"><i class="fas fa-trash"></i></div>
						</div>
						<?php $osay++; } } ?>
					</div>
					<div class="clear"></div>
					<button id="yeni-paket" type="button" class="butto butto-lg butto-primary butbor w-100"><i class="fas fa-plus-square"></i> Yeni Ekle</button>
					<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-5"><i class="fas fa-check"></i> Kaydet</button>
				</form>
				<div id="one-cikan" style="display: none;">
					<div class="input-group inpad1">
						<?= $paketler ?>
						<div class="butto butto-lg butto-danger butbor ml-2" onclick="$(this).parent().remove();"><i class="fas fa-trash"></i></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="tab-pane fade" id="pills-why" role="tabpanel" aria-labelledby="pills-why-tab">
		<div class="card">
			<div class="card-header">
				<div class="box-title">Başlık ve Açıklama</div>
			</div>
			<div class="card-body">
				<form id="default-tercih" method="POST" action="" onsubmit="fastpost('default-tercih','ajaxout'); return false;">
					<input type="hidden" name="page" value="theme">
					<input type="hidden" name="olay" value="default-tercih">
					<div class="row">
						<div class="col-md-3" style="float: left;">
							<label><b>Alan Başlığı</b></label>
							<input type="text" name="item2" class="form-control" value="<?php echo ns_filter('default-tercih');?>">
						</div>
						<div class="col-md-9" style="float: left;">
							<label><b>Alan Açıklaması</b></label>
							<input type="text" name="item3" class="form-control" value="<?php echo ns_filter('default-tercih','item3');?>">
						</div>
						<div class="col-md-12">
							<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check"></i> Kaydet</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<div class="box-title">Kutucuklar</div>
					</div>
					<div class="card-body">
						<form id="default-kutucular" method="POST" action="" onsubmit="fastpost('default-kutucular','ajaxout'); return false;">
							<input type="hidden" name="page" value="theme">
							<input type="hidden" name="olay" value="default-kutucular">
							<div class="tab-alani mb-2">
								<ul class="nav nav-pills" id="pills-tab1" role="tablist">
									<li class="nav-item">
										<a class="nav-link gri active show alti" id="pills-kutu10-tab" data-toggle="pill" href="#kutu10" role="tab" aria-controls="pills-kutu10" aria-selected="true">1. Kutu</a>
									</li>
									<li class="nav-item">
										<a class="nav-link alti" id="pills-kutu11-tab" data-toggle="pill" href="#kutu11" role="tab" aria-controls="pills-kutu11" aria-selected="true">2. Kutu</a>
									</li>
									<li class="nav-item">
										<a class="nav-link alti" id="pills-kutu12-tab" data-toggle="pill" href="#kutu12" role="tab" aria-controls="pills-kutu12" aria-selected="false">3. Kutu</a>
									</li>
									<li class="nav-item">
										<a class="nav-link alti" id="pills-kutu13-tab" data-toggle="pill" href="#kutu13" role="tab" aria-controls="pills-kutu13" aria-selected="false">4. Kutu</a>
									</li>
								</ul>
							</div>
							<div class="tab-content" id="pills-tabContent">
								<div class="row" style="margin-left: 0;margin-right: 0;">
									<?php
									$say = 10;
									foreach (ns_filter('default-tercih-box','list') as $kt) { ?>
									<input type="hidden" name="boxs[]" value="<?= $kt["ayar_1"];?>">
									<div class="tab-pane fade active <?php if ($say == 10) echo "show"; ?> w-100" id="kutu<?php echo $say;?>" role="tabpanel" aria-labelledby="pills-kutu<?php echo $say;?>-tab">
										<div class="col-md-12">
											<div data-icon="fas fa-award" data-box="<?= $say;?>" class="icon-sec"><i class="fas fa-award"></i></div>
											<div data-icon="fas fa-bullhorn" data-box="<?= $say;?>" class="icon-sec"><i class="fas fa-bullhorn"></i></div>
											<div data-icon="fas fa-check-double" data-box="<?= $say;?>" class="icon-sec"><i class="fas fa-check-double"></i></div>
											<div data-icon="fas fa-chart-line" data-box="<?= $say;?>" class="icon-sec"><i class="fas fa-chart-line"></i></div>
											<div data-icon="fas fa-fire" data-box="<?= $say;?>" class="icon-sec"><i class="fas fa-fire"></i></div>
											<div data-icon="far fa-grin" data-box="<?= $say;?>" class="icon-sec"><i class="far fa-grin"></i></div>
											<div data-icon="fas fa-headset" data-box="<?= $say;?>" class="icon-sec"><i class="fas fa-headset"></i></div>
											<div data-icon="fas fa-shield-alt" data-box="<?= $say;?>" class="icon-sec"><i class="fas fa-award"></i></div>
											<a target="_blank" href="https://fontawesome.com/icons/" class="icon-sec float-right" title="Tüm Icon Kodları"><i class="fas fa-question-circle" style="color: #dd847d;"></i></a>
											<div class="input-group">
												<div class="butto butto-light mr-1 smgir" id="icon-sec-<?= $say;?>">
													<i class="<?php echo $kt["item4"];?>"></i>
												</div>
												<input id="icon-input-<?= $say;?>" required="" class="form-control smginx mb-2" name="item4[<?=$kt["ayar_1"];?>]" value="<?php echo $kt["item4"];?>">
											</div>
											<input class="form-control smgin mb-2" name="item2[<?=$kt["ayar_1"];?>]" placeholder="Başlık" value="<?php echo $kt["item2"];?>">
											<textarea class="form-control smgin" name="item3[<?=$kt["ayar_1"];?>]" placeholder="Kısa Açıklama"><?php echo $kt["item3"];?></textarea>
											<div class="clear"></div>
										</div>
										<div class="col-md-12">
											<button type="submit" class="butto butto-lg butto-success butbor pull-right"><i class="fas fa-check"></i> Kaydet</button>
										</div>
									</div>
									<?php $say++; } ?>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<div class="box-title">Müşteri Yorumları</div>
					</div>
					<div class="card-body">
						<form id="default-yorumlar" method="POST" action="" onsubmit="fastpost('default-yorumlar','ajaxout'); return false;">
							<input type="hidden" name="page" value="theme">
							<input type="hidden" name="olay" value="default-kutucular">
							<div class="tab-alani mb-2">
								<ul class="nav nav-pills" id="pills-tab2" role="tablist">
									<li class="nav-item">
										<a class="nav-link gri active show alti" id="pills-yorum1-tab" data-toggle="pill" href="#yorum1" role="tab" aria-controls="pills-yorum1" aria-selected="true">1. Yorum</a>
									</li>
									<li class="nav-item">
										<a class="nav-link alti" id="pills-yorum2-tab" data-toggle="pill" href="#yorum2" role="tab" aria-controls="pills-yorum2" aria-selected="true">2. Yorum</a>
									</li>
									<li class="nav-item">
										<a class="nav-link alti" id="pills-yorum3-tab" data-toggle="pill" href="#yorum3" role="tab" aria-controls="pills-yorum3" aria-selected="false">3. Yorum</a>
									</li>
									<li class="nav-item">
										<a class="nav-link alti" id="pills-yorum4-tab" data-toggle="pill" href="#yorum4" role="tab" aria-controls="pills-yorum4" aria-selected="false">4. Yorum</a>
									</li>
								</ul>
							</div>
							<?php
							$say = 1;
							foreach ( ns_filter('default-yorumlar','list') as $yorum) { ?>
							<input type="hidden" name="boxs[]" value="<?= $yorum["ayar_1"];?>">
							<div class="tab-pane fade active <?php if ($say == 1) echo "show"; ?> w-100" id="yorum<?php echo $say;?>" role="tabpanel" aria-labelledby="pills-yorum<?php echo $say;?>-tab">
								<div class="form-row mt-3">
									<div class="col-md-6">
										<div class="form-group">
											<label class="font-weight-bold pl-1">Adı Soyadı</label>
											<input name="item2[<?= $yorum["ayar_1"];?>]" type="text" class="form-control" value="<?php echo $yorum["item2"];?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="font-weight-bold pl-1">Mesleği</label>
											<input name="item4[<?= $yorum["ayar_1"];?>]" type="text" class="form-control" value="<?php echo $yorum["item4"];?>">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label class="font-weight-bold pl-1">Yorum</label>
											<textarea name="item3[<?= $yorum["ayar_1"];?>]" class="form-control"><?php echo $yorum["item3"];?></textarea>
										</div>
									</div>
									<div class="col-md-12">
										<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check"></i> Kaydet</button>
									</div>
								</div>
							</div>
							<?php $say++; } ?>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="tab-pane fade" id="pills-blog" role="tabpanel" aria-labelledby="pills-blog-tab">
		<div class="card">
			<div class="card-header">
				<div class="box-title">Blog Bölümü</div>
			</div>
			<div class="card-body">
				<form id="default-blog" method="POST" action="" onsubmit="fastpost('default-blog','ajaxout'); return false;">
					<input type="hidden" name="page" value="theme">
					<input type="hidden" name="olay" value="default-blog">
					<div class="form-row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="font-weight-bold">Başlık</label>
								<input type="text" class="form-control" name="item3" placeholder="Başlık Girin" value="<?= ns_filter('default-blog','item3');?>">
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<label class="font-weight-bold">Açıklama</label>
								<input type="text" class="form-control" name="item4"  placeholder="Açıklama Girin" value="<?= ns_filter('default-blog','item4');?>">
							</div>
						</div>
						<div class="col-md-12">
							<label class="font-weight-bold">Gösterim Tercihi</label>
							<select class="form-control mb-3" name="item2">
								<option value="0" <?= ns_filter('default-blog')==0 ? 'selected=""': '';?>>Sadece Son Bloglarımı Listele</option>
								<option value="1" <?= ns_filter('default-blog')==1 ? 'selected=""': '';?>>Bloglarımı Listele ve Alt Bölümde Seçtiğim Sayfanın İçeriğini Göster</option>
								<option value="2" <?= ns_filter('default-blog')==2 ? 'selected=""': '';?>>Bloglarımı Gizle ve O Bölümde Sadece Seçtiğim Sayfanın İçeriğini Göster</option>
							</select>
						</div>
						<div class="col-md-12">
							<label class="font-weight-bold">İçeriği Gösterilecek Sayfa Tercihi</label>
							<?  $icerik = isset($icerik) ? $icerik : new Icerik($db);?>
							<select class="form-control mb-3" name="item5">
								<?
								$icerik->sayfa_tur = "sayfa";
								foreach ($icerik->all(0,100) as $value) { ?>
								<option value="<?= $value["sayfa_id"];?>" <?= $value["sayfa_id"]==ns_filter('default-blog','item5') ? 'selected=""': '';?>><?= $value["sayfa_baslik"];?></option>
								<? } ?>
							</select>
							<div class="alert alert-success"> <p class="mb-0">Ana sayfada makale yayınlamak isterseniz içerik yönetiminden sayfa türünde bir içerik oluşturun ve buradan o içeriği seçerek ayarları kaydedin.</p> </div>
						</div>
					</div>
					<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check"></i> Kaydet</button>
				</form>
			</div>
		</div>
	</div>
	<div class="tab-pane fade" id="pills-footer" role="tabpanel" aria-labelledby="pills-footer-tab">
		<?php $ft = ns_filter('default-footbutton','row'); ?>
		<div class="card">
			<div class="card-header">
				<div class="box-title">Footer İçeriği</div>
			</div>
			<div class="card-body">
				<form id="default-footbutton" method="POST" action="" onsubmit="fastpost('default-footbutton','ajaxout'); return false;">
					<input type="hidden" name="page" value="theme">
					<input type="hidden" name="olay" value="default-footbutton">
					<div class="row">
						<div class="form-group col-md-3">
							<label class="font-weight-bold">Başlık</label>
							<input class="form-control" name="item2" value="<?= ns_filter('default-footbutton');?>" placeholder="Başlık Giriniz" required="">
						</div>
						<div class="form-group col-md-9">
							<label class="font-weight-bold">Açıklama</label>
							<input class="form-control" name="item3" value="<?= ns_filter('default-footbutton','item3');?>" placeholder="Alt Başlığı Giriniz" required="">
						</div>
						<div class="form-group col-md-3">
							<label class="font-weight-bold">Buton Yazısı</label>
							<input class="form-control" name="item4" value="<?= ns_filter('default-footbutton','item4');?>" placeholder="Bize Ulaşın" required="">
						</div>
						<div class="form-group col-md-9">
							<label class="font-weight-bold">Buton URL'si</label>
							<input class="form-control" name="item5" value="<?= ns_filter('default-footbutton','item5');?>" placeholder="/iletisim" required="">
						</div>
						<div class="col-md-12">
							<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check"></i> Kaydet</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="card">
			<div class="card-header">
				<div class="box-title">Copyright ve Menü</div>
			</div>
			<div class="card-body">
				<form id="default-footer" method="POST" action="" onsubmit="fastpost('default-footer','ajaxout'); return false;">
					<input type="hidden" name="page" value="theme">
					<input type="hidden" name="olay" value="default-footer-menu">
					<div class="form-row">
						<div class="form-group col-md-8">
							<label class="font-weight-bold">Copyright Yazısı</label>
							<input class="form-control" value="<?= ns_filter('default-footer-menu','item3');?>" name="item3" placeholder="Yazı yazınız" required="">
						</div>
						<div class="form-group col-md-4">
							<label class="font-weight-bold">Menü Seç</label>
							<select class="form-control" name="item2">
								<?php foreach ($ayar->all('nsmenu') as $value) { ?>
								<option value="<?= $value["ayar_1"];?>" <?= $value["ayar_1"]==ns_filter('default-footer-menu') ? 'selected=""':'';?>><?= $value["item2"];?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-12">
							<div class="alert alert-success">
								<p class="mb-0">Footer kısmındaki menüyü düzenlemek ve değiştirmek için; <b>Görünüm > Menüler</b> kısmını kullanabilirsiniz.</p>
							</div>
						</div>
						<div class="col-md-12">
							<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check"></i> Kaydet</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="card">
			<div class="card-header">
				<div class="box-title">Footer Kod Alanı</div>
			</div>
			<div class="card-body">
				<form id="default-footcode" method="POST" action="" onsubmit="fastpost('default-footcode','ajaxout'); return false;">
					<input type="hidden" name="page" value="theme">
					<input type="hidden" name="olay" value="default-footcode">
					<div class="form-row">
						<div class="form-group col-md-12">
							<input type="hidden" name="offsecury[]" value="item2">
							<textarea class="form-control" name="item2" placeholder="Header için ekstra kod alanı"><?= ns_filter('default-footcode');?></textarea>
						</div>
						<div class="col-md-12">
							<div class="alert alert-danger text-center">
								<p class="mb-0">Bu kısım sitenin footer kısmına kod eklemek içindir. Site doğrulama sayaç, canlı destek gibi ekstralar için size verilen kodları bu kısıma ekleyebilirsiniz.
									<span class="d-block font-weight-bold">
										Script tagı içere kodları bazı sunucular güvenlik nedeni (ModSecurty) ile kabul etmemektedir. Kaydet sonrası hata alırsanız lütfen hizmet sağlayıcı firmanız ile iletişime geçin.
									</span>
								</p>
							</div>
						</div>
						<div class="col-md-12">
							<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check"></i> Kaydet</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="tab-pane fade" id="pills-ozel" role="tabpanel" aria-labelledby="pills-ozel-tab">
		<div class="row">
			<div class="col-md-9">
				<div class="card">
					<div class="card-header">
						<div class="box-title">Renk Ayarları</div>
					</div>
					<div class="card-body">
						<?php
						$renk = explode('-', ns_filter('default-ozellestirme'));
						?>
						<form id="default-renk" method="POST" action="" onsubmit="fastpost('default-renk','ajaxout'); return false;">
							<input type="hidden" name="page" value="theme">
							<input type="hidden" name="olay" value="default-renk">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label class="font-weight-bold">Tema Rengi</label>
										<div class="input-group mb-2 renkhover">
											<div class="butto mr-1 smgir rengiyazdir" id="renk-1"></div>
											<input type="text" class="form-control renksecici smginx" name="renk[]" data-renk="renk-1" required="" value="<?php echo $renk[0];?>">
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="font-weight-bold">Tema Yazı Rengi</label>
										<div class="input-group mb-2 renkhover">
											<div class="butto mr-1 smgir rengiyazdir" id="renk-2">
											</div>
											<input type="text" class="form-control renksecici smginx" name="renk[]"  data-renk="renk-2"  required="" value="<?php echo $renk[1];?>">
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<label><b>Menü Rengi</b></label>
									<div class="input-group mb-2 renkhover">
										<div class="butto mr-1 smgir rengiyazdir" id="renk-3">
										</div>
										<input type="text" class="form-control renksecici smginx" name="renk[]" data-renk="renk-3"  required="" value="<?php echo $renk[2];?>">
									</div>
								</div>
								<div class="col-md-2">
									<label><b>Menü Yazı Renkleri</b></label>
									<div class="input-group mb-2 renkhover">
										<div class="butto mr-1 smgir rengiyazdir" id="renk-4">
										</div>
										<input type="text" class="form-control renksecici smginx" name="renk[]" data-renk="renk-4"  required="" value="<?php echo $renk[3];?>">
									</div>
								</div>
								<div class="col-md-3">
									<label><b>Sorgulama Buton Rengi</b></label>
									<div class="input-group mb-2 renkhover">
										<div class="butto mr-1 smgir rengiyazdir" id="renk-5">
										</div>
										<input type="text" class="form-control renksecici smginx" name="renk[]" data-renk="renk-5"  required="" value="<?php echo $renk[4];?>">
									</div>
								</div>
								<div class="col-md-12">
									<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check"></i> Kaydet</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<div class="box-title">Model Ayarları</div>
					</div>
					<div class="card-body">
						<form id="default-ozellestirme" method="POST" action="" onsubmit="fastpost('default-ozellestirme','ajaxout'); return false;">
							<input type="hidden" name="page" value="theme">
							<input type="hidden" name="olay" value="default-ozellestirme">
							<div class="row">
								<div class="col-md-4">
									<label class="font-weight-bold pl-1">Desen</label>
									<?php $desen = ns_filter('default-ozellestirme','item5'); ?>
									<select name="item5" class="form-control">
										<option value="des1" <?php if ($desen=="des1") { echo 'selected'; } ?>>Desen 1</option>
										<option value="des2" <?php if ($desen=="des2") { echo 'selected'; } ?>>Desen 2</option>
										<option value="des3" <?php if ($desen=="des3") { echo 'selected'; } ?>>Desen 3</option>
									</select>
								</div>
								<div class="col-md-4">
									<label class="font-weight-bold pl-1">Geçiş</label>
									<?php $gecis = ns_filter('default-ozellestirme','item4'); ?>
									<select name="item4" class="form-control">
										<option value="dalga" <?php if ($gecis=="dalga") { echo 'selected'; } ?>>Dalgalı</option>
										<option value="keskin" <?php if ($gecis=="keskin") { echo 'selected'; } ?>>Keskin</option>
										<option value="oval" <?php if ($gecis=="oval") { echo 'selected'; } ?>>Oval</option>
										<option value="toval" <?php if ($gecis=="toval") { echo 'selected'; } ?>>Ters Oval</option>
										<option value="duz" <?php if ($gecis=="duz") { echo 'selected'; } ?>>Düz</option>
									</select>
								</div>
								<div class="col-md-4">
									<label class="font-weight-bold pl-1">Köşe Yapısı</label>
									<?php $kenar = ns_filter('default-ozellestirme','item3'); ?>
									<select name="item3" class="form-control">
										<option value="keskin" <?php if ($kenar=="keskin") { echo "selected";} ?>>Keskin Köşeler</option>
										<option value="oval" <?php if ($kenar=="oval") { echo "selected";} ?>>Oval Köşeler</option>
									</select>
								</div>
								<div class="col-md-12">
									<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check"></i> Kaydet</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card mb-2">
					<div class="card-header border-0">
						<div class="box-title w-100">Menü İletişim Butonu
							<label class="switch pull-right mb-0"><input onclick="status('default-menu-iletisim')" type="checkbox" <?= $ayar->statu('default-menu-iletisim') ? "checked":"";?>>
								<span class="btn-ackapa round"></span>
							</label>
						</div>
					</div>
				</div>
				<div class="card mb-2">
					<div class="card-header border-0">
						<div class="box-title w-100">Menü Sorgu Butonu
							<label class="switch pull-right mb-0"><input onclick="status('default-menu-sorgu')" type="checkbox" <?= $ayar->statu('default-menu-sorgu') ? "checked":"";?>>
								<span class="btn-ackapa round"></span>
							</label>
						</div>
					</div>
				</div>
				<div class="card mb-4">
					<div class="card-header border-0">
						<div class="box-title w-100">Fixed Sorgu Butonu
							<label class="switch pull-right mb-0"><input onclick="status('default-sorgu')" type="checkbox" <?= $ayar->statu('default-sorgu') ? "checked":"";?>>
								<span class="btn-ackapa round"></span>
							</label>
						</div>
					</div>
				</div>
				<form id="default-iletisim" method="POST" action="" onsubmit="fastpost('default-iletisim','ajaxout'); return false;">
					<input type="hidden" name="page" value="theme">
					<input type="hidden" name="olay" value="default-iletisim">
					<div class="card mb-3">
						<div class="card-header">
							<div class="box-title w-100">Fixed Telefon Butonu
								<label class="switch pull-right mb-0"><input onclick="status('default-iletisim')" type="checkbox" <?= $ayar->statu('default-iletisim') ? "checked":"";?>>
									<span class="btn-ackapa round"></span>
								</label>
							</div>
						</div>
						<div class="card-body">
							<label class="form-control-label">Telefon Numarası</label>
							<input type="text" name="item2" class="form-control" placeholder="Ülke kodu ile birlikte +90" value="<?php echo ns_filter('default-iletisim');?>">
							<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check"></i> Kaydet</button>
						</div>
					</div>
				</form>
				<form id="default-wp" method="POST" action="" onsubmit="fastpost('default-wp','ajaxout'); return false;">
					<input type="hidden" name="page" value="theme">
					<input type="hidden" name="olay" value="default-wp">
					<div class="card">
						<div class="card-header">
							<div class="box-title w-100">Fixed Whatsapp Butonu
								<label class="switch pull-right mb-0"><input onclick="status('default-wp')" type="checkbox" <?= $ayar->statu('default-wp') ? "checked":"";?>>
									<span class="btn-ackapa round"></span>
								</label>
							</div>
						</div>
						<div class="card-body">
							<label class="form-control-label">Whatsapp Numarası</label>
							<input type="text" name="item2" class="form-control mb-2" placeholder="Ülke kodu ile birlikte +90" value="<?php echo ns_filter('default-wp');?>">
							<label class="form-control-label">Giriş Mesajı</label>
							<textarea name="item3" class="form-control"><?php echo ns_filter('default-wp','item3');?></textarea>
							<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check"></i> Kaydet</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		
		
	</div>
</div>
<form id="ayar-durum" method="POST" action="">
	<input type="hidden" name="page" value="theme">
	<input type="hidden" id="ayar-durum-input" name="olay" value="">
	<input type="hidden" name="ayar-durum" value="">
</form>
<script type="text/javascript">
	$(document).ready(function(){
		$(".icon-sec").click(function(){
			var element = $(this);
			var idsi = element.data('box');
		$('#icon-sec-'+idsi).html(element.html());
		$('#icon-input-'+idsi).val(element.data('icon'));
		});
		$("#yeni-paket").click(function(){
			$('#paketler').append($('#one-cikan').html());
		});
	});
	function status(item){
		$('#ayar-durum-input').val(item);
		fastpost('ayar-durum','ajaxpost');
	}
</script>