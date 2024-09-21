<div class="tab-alani">
	<ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
		<li class="nav-item">
			<a class="nav-link gri alti active show" id="pills-1x1-tab" data-toggle="pill" href="#pills-1x1" role="tab" aria-controls="pills-home" aria-selected="true">Genel</a>
		</li>
		<li class="nav-item">
			<a class="nav-link gri alti" id="pills-1x2-tab" data-toggle="pill" href="#pills-1x2" role="tab" aria-controls="pills-home" aria-selected="true">Renkler</a>
		</li>
		<li class="nav-item">
			<a class="nav-link gri alti" id="pills-1x3-tab" data-toggle="pill" href="#pills-1x3" role="tab" aria-controls="pills-home" aria-selected="true">Gece Modu</a>
		</li>
		<li class="nav-item">
			<a class="nav-link gri alti" id="pills-1x4-tab" data-toggle="pill" href="#pills-1x4" role="tab" aria-controls="pills-home" aria-selected="true">Favoriler</a>
		</li>
	</ul>
</div>
<div class="tab-pane fade active show" id="pills-1x1" role="tabpanel" aria-labelledby="pills-1x1-tab">
	<form class="loftForm" method="POST">
		<input type="hidden" name="olay" value="loftOptions">
		<input type="hidden" name="page" value="theme">
		<input type="hidden" name="loftAction" value="generalSave">
		<div class="row">
			<div class="col-md-7">
				<div class="card mb-4">
					<div class="card-header">
						<span class="box-title">Header ve Menü Tercihleri</span>
					</div>
					<div class="card-body">
						<p>
							Header'ın tam genişlikte olması için <b>Full Width</b>, kutu genişliğinde olması için <b>Boxed</b> seçeneğini ayarlayın.
						</p>
						<div class="form-group">
							<select class="form-control" name="data[loftsCostimize][item2][header][weight]">
								<option value="full" <?php echo $loftsCostimize["header"]["weight"]=="full" ? 'selected':'';?>>Full Width</option>
								<option value="boxed" <?php echo $loftsCostimize["header"]["weight"]=="boxed" ? 'selected':'';?>>Boxed</option>
							</select>
						</div>
						<div class="form-group">
							<label class="font-weight-bold mb-2">Header Arkaplanı</label>
							<select class="form-control" name="data[loftsCostimize][item2][header][background]">
								<option value="" <?php echo $loftsCostimize["header"]["background"]=="" ? 'selected':'';?>>Şeffaf</option>
								<option value="back" <?php echo $loftsCostimize["header"]["background"]=="back" ? 'selected':'';?>>Renkli</option>
							</select>
						</div>
						<div class="form-row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-weight-bold mb-2">İletişim Butonu</label>
									<select class="form-control" name="data[loftsCostimize][item2][header][contactButton]">
										<option value="aktif" <?php echo $loftsCostimize["header"]["contactButton"]=="aktif" ? 'selected':'';?>>Aktif</option>
										<option value="pasif" <?php echo $loftsCostimize["header"]["contactButton"]=="pasif" ? 'selected':'';?>>Pasif</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-weight-bold mb-2">Sipariş Sorgulama Butonu</label>
									<select class="form-control" name="data[loftsCostimize][item2][header][orderSearchIcon]">
										<option value="aktif" <?php echo $loftsCostimize["header"]["orderSearchIcon"]=="aktif" ? 'selected':'';?>>Aktif</option>
										<option value="pasif" <?php echo $loftsCostimize["header"]["orderSearchIcon"]=="pasif" ? 'selected':'';?>>Pasif</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<label class="font-weight-bold mb-2">Menü Yazı Kalınlığı</label>
								<select class="form-control" name="data[loftsCostimize][item2][header][textWeight]">
									<option value="bold" <?php echo $loftsCostimize["header"]["textWeight"]=="bold" ? 'selected':'';?>>Kalın</option>
									<option value="thin" <?php echo $loftsCostimize["header"]["textWeight"]=="thin" ? 'selected':'';?>>İnce</option>
								</select>
							</div>
							<div class="col-md-6">
								<label class="font-weight-bold mb-2">Menü Yazı Rengi</label>
								<div class="input-group mb-2 renkhover">
									<div class="butto mr-1 smgir rengiyazdir" id="menuTextColor" style="background:<?php echo $loftsCostimize["header"]["menuTextColor"];?>;">
									</div>
									<input type="text" class="form-control renksecici smginx" name="data[loftsCostimize][item2][header][menuTextColor]" data-renk="menuTextColor" required="" value="<?php echo $loftsCostimize["header"]["menuTextColor"];?>">
									<input type="hidden" data-renkRgb="menuTextColor" name="data[loftsCostimize][item2][header][menuTextColorRgb]" value="<?php echo $loftsCostimize["header"]["menuTextColorRgb"];?>">
								</div>
							</div>
						</div>
						<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3 mb-1">
						<i class="fas fa-check" aria-hidden="true"></i> Kaydet
						</button>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<div class="box-title">Fixed Buton Tercihleri</div>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col-md-12">
								<div class="form-group">
									<select class="form-control" name="data[loftsCostimize][item2][buttons][statu]">
										<option value="aktif" <?php echo $loftsCostimize["buttons"]["statu"]=="aktif" ? 'selected':'';?>>Aktif</option>
										<option value="onlyPc" <?php echo $loftsCostimize["buttons"]["statu"]=="onlyPc" ? 'selected':'';?>>Aktif - Mobilde Gizli</option>
										<option value="pasif" <?php echo $loftsCostimize["buttons"]["statu"]=="pasif" ? 'selected':'';?>>Pasif</option>
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3">
								<i class="fas fa-check" aria-hidden="true"></i> Kaydet
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="card mb-3">
					<div class="card-header">
						<div class="box-title font-weight-bold w-100">Fixed Sipariş Sorgula</div>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label class="font-weight-bold">Durum</label>
							<select class="form-control" name="data[loftsCostimize][item2][buttons][orderSearch][statu]">
								<option value="aktif" <?php echo $loftsCostimize["buttons"]["orderSearch"]["statu"]=="aktif" ? 'selected':'';?>>Aktif</option>
								<option value="pasif" <?php echo $loftsCostimize["buttons"]["orderSearch"]["statu"]=="pasif" ? 'selected':'';?>>Pasif</option>
							</select>
						</div>
					</div>
					<div class="card-header">
						<div class="box-title font-weight-bold w-100">Fixed Telefon Butonu
						</div>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold">Durum</label>
									<select class="form-control" name="data[loftsCostimize][item2][buttons][phone][statu]">
										<option value="aktif" <?php echo $loftsCostimize["buttons"]["phone"]["statu"]=="aktif" ? 'selected':'';?>>Aktif</option>
										<option value="pasif" <?php echo $loftsCostimize["buttons"]["phone"]["statu"]=="pasif" ? 'selected':'';?>>Pasif</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-weight-bold">Telefon Numaranız</label>
									<input type="text" class="form-control" name="data[loftsCostimize][item2][buttons][phone][number]" value="<?php echo $loftsCostimize["buttons"]["phone"]["number"];?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-weight-bold">Buton Rengi</label>
									<div class="input-group mb-2 renkhover">
										<div class="butto mr-1 smgir rengiyazdir" id="fixedPhone" style="background:<?php echo $loftsCostimize["buttons"]["phone"]["color"];?>;">
										</div>
										<input type="text" class="form-control renksecici smginx" name="data[loftsCostimize][item2][buttons][phone][color]" data-renk="fixedPhone" required="" value="<?php echo $loftsCostimize["buttons"]["phone"]["color"];?>">
										<input type="hidden" data-renkRgb="fixedPhone" name="data[loftsCostimize][item2][buttons][phone][colorRgb]" value="<?php echo $loftsCostimize["buttons"]["phone"]["colorRgb"];?>">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-header">
						<div class="box-title font-weight-bold w-100">Fixed WhatsApp Butonu</div>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-weight-bold">Durum</label>
									<select class="form-control" name="data[loftsCostimize][item2][buttons][whatsapp][statu]">
										<option value="aktif" <?php echo $loftsCostimize["buttons"]["whatsapp"]["statu"]=="aktif" ? 'selected':'';?>>Aktif</option>
										<option value="pasif" <?php echo $loftsCostimize["buttons"]["whatsapp"]["statu"]=="pasif" ? 'selected':'';?>>Pasif</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-weight-bold">Whatsapp Numaranız(+90..)</label>
									<input type="text" class="form-control" name="data[loftsCostimize][item2][buttons][whatsapp][number]" value="<?php echo $loftsCostimize["buttons"]["whatsapp"]["number"];?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold">Giriş Mesajı</label>
									<textarea class="form-control" name="data[loftsCostimize][item2][buttons][whatsapp][text]" placeholder="Giriş Mesajı"><?php echo $loftsCostimize["buttons"]["whatsapp"]["text"];?></textarea>
								</div>
							</div>
						</div>
						<div class="w-100">
							<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3">
							<i class="fas fa-check" aria-hidden="true"></i> Kaydet
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<div class="tab-pane fade" id="pills-1x2" role="tabpanel" aria-labelledby="pills-1x2-tab">
	<form class="loftForm" method="POST">
		<input type="hidden" name="olay" value="loftOptions">
		<input type="hidden" name="page" value="theme">
		<input type="hidden" name="loftAction" value="generalSave">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="box-title">Renk Ayarları</div>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col-md-3">
								<div class="form-group">
									<label class="font-weight-bold">Arkaplan Rengi</label>
									<div class="input-group mb-2 renkhover">
										<div class="butto mr-1 smgir rengiyazdir" id="backgroundCostimize" style="background:<?php echo $loftsCostimize["background"];?>;">
										</div>
										<input type="text" class="form-control renksecici smginx" name="data[loftsCostimize][item3][background]" data-renk="backgroundCostimize" required="" value="<?php echo $loftsCostimize["background"];?>">
										<input type="hidden" data-renkRgb="backgroundCostimize" name="data[loftsCostimize][item3][backgroundRgb]" value="<?php echo $loftsCostimize["backgroundRgb"];?>">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="font-weight-bold">Temel Renk</label>
									<div class="input-group mb-2 renkhover">
										<div class="butto mr-1 smgir rengiyazdir" id="generalCostimize" style="background:<?php echo $loftsCostimize["general"];?>;">
										</div>
										<input type="text" class="form-control renksecici smginx" name="data[loftsCostimize][item3][general]" data-renk="generalCostimize" required="" value="<?php echo $loftsCostimize["general"];?>">
										<input type="hidden" data-renkRgb="generalCostimize" name="data[loftsCostimize][item3][generalRgb]" value="<?php echo $loftsCostimize["generalRgb"];?>">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="font-weight-bold">Genel Yazı Renkleri</label>
									<div class="input-group mb-2 renkhover">
										<div class="butto mr-1 smgir rengiyazdir" id="generalText" style="background:<?php echo $loftsCostimize["generalText"];?>;">
										</div>
										<input type="text" class="form-control renksecici smginx" name="data[loftsCostimize][item3][generalText]" data-renk="generalText" required="" value="<?php echo $loftsCostimize["generalText"];?>">
										<input type="hidden" data-renkRgb="generalText" name="data[loftsCostimize][item3][generalTextRgb]" value="<?php echo $loftsCostimize["generalTextRgb"];?>">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="font-weight-bold">Intro Arkaplan Rengi</label>
									<div class="input-group mb-2 renkhover">
										<div class="butto mr-1 smgir rengiyazdir" id="introBackground" style="background:<?php echo $loftsCostimize["introBackground"];?>;">
										</div>
										<input type="text" class="form-control renksecici smginx" name="data[loftsCostimize][item3][introBackground]" data-renk="introBackground" required="" value="<?php echo $loftsCostimize["introBackground"];?>">
										<input type="hidden" data-renkRgb="introBackground" name="data[loftsCostimize][item3][introBackgroundRgb]" value="<?php echo $loftsCostimize["introBackgroundRgb"];?>">
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3">
								<i class="fas fa-check" aria-hidden="true"></i> Kaydet
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<div class="tab-pane fade" id="pills-1x3" role="tabpanel" aria-labelledby="pills-1x3-tab">
	<form class="loftForm" method="POST">
		<input type="hidden" name="olay" value="loftOptions">
		<input type="hidden" name="page" value="theme">
		<input type="hidden" name="loftAction" value="generalSave">
		<div class="row">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<div class="box-title">Gece Modu Tercihleri</div>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col-md-12">
								<div class="alert alert-warning">
									<p class="mb-0">Default olarak gece modunu seçer ve <strong>Gece Modu Seçeneğini</strong> pasif yaparsanız siteye giren kullanıcılar gündüz moduna geçiş yapamaz ve siteyi sadece gece modunda görürler. Aynı şekilde gündüz modunu seçip <strong>Gece Modu Seçeneğini</strong> pasif yaparsanız ziyaretçi gece moduna geçiş yapamaz.</p>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="font-weight-bold">Default Tercih</label>
									<select class="form-control" name="data[loftsCostimize][item4][modDefault]">
										<option value="sun" <?php echo $loftsCostimize["modDefault"]=="sun" ? 'selected':'';?>>Gündüz Modu</option>
										<option value="moon" <?php echo $loftsCostimize["modDefault"]=="moon" ? 'selected':'';?>>Gece Modu</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="font-weight-bold">Gece Modu Seçeneği</label>
									<select class="form-control" name="data[loftsCostimize][item4][modChange]">
										<option value="aktif" <?php echo $loftsCostimize["modChange"]=="aktif" ? 'selected':'';?>>Aktif</option>
										<option value="pasif" <?php echo $loftsCostimize["modChange"]=="pasif" ? 'selected':'';?>>Pasif</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="font-weight-bold">Gece Modu Temel Renk</label>
									<div class="input-group mb-2 renkhover">
										<div class="butto mr-1 smgir rengiyazdir" id="modColor" style="background: <?php echo $loftsCostimize["modColor"];?>;">
										</div>
										<input type="text" class="form-control renksecici smginx" name="data[loftsCostimize][item4][modColor]" data-renk="modColor" required="" value="<?php echo $loftsCostimize["modColor"];?>">
										<input type="hidden" data-renkRgb="modColor" name="data[loftsCostimize][item4][modColorRgb]" value="<?php echo $loftsCostimize["modColorRgb"];?>">
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check" aria-hidden="true"></i> Kaydet</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card mb-4" style="overflow: hidden;">
					<div class="card-header">
						<div class="box-title">Gece Modu Site Logosu</div>
						<button class="butto butto-success butbor butto-xs pull-right">
						<i class="fas fa-check" aria-hidden="true"></i> Kaydet
						</button>
					</div>
					<div class="card-body" style="margin-bottom: 0; background: #26272d;">
						<div class="onecik-onizle ortambut" data-ortam="sitelogo" data-url="<?php echo $loft->path($loftsCostimize["modLogo"],"img");?>" data-input="<?php echo $loftsCostimize["modLogo"];?>">
							<img class="ortam-sec" src="https://nivuu.com/space/panel/images/ortam-sec.png">
							<div class="tumb-oniztext">
								<img id="sitelogo-onizleme" src="<?php echo $loft->path($loftsCostimize["modLogo"],"img");?>">
								<input type="hidden" id="sitelogo-input" name="data[loftsCostimize][item4][modLogo]" required="" value="<?php echo $loftsCostimize["modLogo"];?>">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<div class="tab-pane fade" id="pills-1x4" role="tabpanel" aria-labelledby="pills-1x4-tab">
	<form class="loftForm" method="POST">
		<input type="hidden" name="olay" value="loftOptions">
		<input type="hidden" name="page" value="theme">
		<input type="hidden" name="loftAction" value="generalSave">
		<div class="card">
			<div class="card-header">
				<span class="box-title">
					Favori Tercihleri
				</span>
			</div>
			<div class="card-body">
				<div class="form-row">
					<div class="col-md-4">
						<div class="form-group">
							<label class="font-weight-bold mb-2">Favorilerim Özelliği</label>
							<select class="form-control" name="data[loftsCostimize][item5][favoriStatu]">
								<option value="aktif" <?php echo $loftsCostimize["favoriStatu"]=="aktif" ? 'selected':'';?>>Aktif</option>
								<option value="pasif" <?php echo $loftsCostimize["favoriStatu"]=="pasif" ? 'selected':'';?>>Pasif</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="font-weight-bold mb-2">Favoriler Iconu</label>
							<div class="input-group">
								<div class="butto butto-light mr-1 smgir">
									<i id="iconView_favoriIcon" class="<?php echo $loftsCostimize["favoriIcon"];?>" aria-hidden="true"></i>
								</div>
								<input class="form-control smginx" id="iconInput_favoriIcon" name="data[loftsCostimize][item5][favoriIcon]" value="<?php echo $loftsCostimize["favoriIcon"];?>">
								<button type="button" class="butto butbor butto-dark icon-modal" data-toggle="modal" data-target="#iconSec" data-icon="<?php echo $loftsCostimize["favoriIcon"];?>" data-add="favoriIcon">Icon Seç</button>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="font-weight-bold mb-2">Url Uzantısı</label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text form-control mr-2" id="basic-addon3">siteadresi.com/</span>
								</div>
								<input type="text" class="form-control" name="data[loftsCostimize][item5][favoriUniq]" placeholder="Sayfa Uzantısı Belirle" required="" value="<?php echo $loftsCostimize["favoriUniq"];?>">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="font-weight-bold mb-2">Sayfa Başlığı</label>
							<input type="text" class="form-control" name="data[loftsCostimize][item5][favoriTitle]" placeholder="Sayfa Başlığı Giriniz" value="<?php echo $loftsCostimize["favoriTitle"];?>">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="font-weight-bold mb-2">Sayfa Açıklaması</label>
							<textarea type="text" class="form-control" name="data[loftsCostimize][item5][favoriDescription]" required="" placeholder="Sayfa Açıklaması Giriniz"><?php echo $loftsCostimize["favoriDescription"];?></textarea>
						</div>
					</div>
					<div class="col-md-12">
						<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3">
						<i class="fas fa-check" aria-hidden="true"></i> Kaydet
						</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>