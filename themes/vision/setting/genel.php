<div class="tab-alani">
	<ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
		<li class="nav-item">
			<a class="nav-link gri alti active show" id="pills-1x1-tab" data-toggle="pill" href="#pills-1x1" role="tab" aria-controls="pills-home" aria-selected="true">Header</a>
		</li>
		<li class="nav-item">
			<a class="nav-link gri alti" id="pills-1x2-tab" data-toggle="pill" href="#pills-1x2" role="tab" aria-controls="pills-home" aria-selected="true">Footer</a>
		</li>
		<li class="nav-item">
			<a class="nav-link gri alti" id="pills-1x3-tab" data-toggle="pill" href="#pills-1x3" role="tab" aria-controls="pills-home" aria-selected="true">İletişim Bilgileri</a>
		</li>
	</ul>
</div>
<div class="tab-pane fade active show" id="pills-1x1" role="tabpanel" aria-labelledby="pills-1x1-tab">
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<div class="box-title font-weight-bold"> Header Ayarları
					</div>
				</div>
				<div class="card-body">
					<form class="loftForm" method="POST">
						<input type="hidden" name="olay" value="loftOptions">
						<input type="hidden" name="page" value="theme">
						<input type="hidden" name="loftAction" value="generalSave">
						<div class="form-row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold mb-1">Menü Seç</label>
									<p><b>Görünüm » Menüler</b> kısmından oluşturduğunuz menülerden birisini seçerek header kısmında menüyü listeleyebilirsiniz.</p>
									<select class="form-control" name="data[loftHeaderItems][item2]">
										<?php foreach ($menuList as $key => $value) { ?>
											<option value="<?php echo $key;?>" <?php echo $loftHeaderItems["item2"]==$key ? 'selected':'';?>><?php echo $value["name"];?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<label class="font-weight-bold mb-1">Header Kod Alanı</label>
								<p>Analitik, site doğrulama, canlı destek gibi sistemler tarafından verilen kodları bu alana ekleyebilirsiniz.
								</p>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<textarea class="form-control" name="data[loftHeaderItems][item3][code]" placeholder="Header için Kod Alanı"><?php echo $loftHeaderItems["code"];?></textarea>
								</div>
							</div>
							<div class="col-md-12">
								<div class="alert alert-danger text-center">
									<p class="mb-0">
										<span class="d-block font-weight-bold">
											Script kodlarını bazı sunucular güvenlik nedeni (ModSecurty) ile kabul etmemektedir. Kaydet sonrası hata alır veya yükleme ekranında takılırsanız lütfen hizmet sağlayıcı firmanız ile iletişime geçin.
										</span>
									</p>
								</div>
							</div>
							<div class="col-md-12">
								<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3">
									<i class="fas fa-check" aria-hidden="true"></i> Kaydet
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card bilgi-box">
				<div class="card-header">
					<div class="box-title font-weight-bold">Bilgi Kutusu <i class="fas fa-chevron-right" aria-hidden="true"></i>
					</div>
				</div>
				<div class="card-body">
					<div class="bb-box">
						<span class="bb-title">Header Kod Alanı</span>
						Header kod alanı Analitik, site doğrulama, canlı destek gibi ekstraların kodlarını eklemek içindir. Script kodlarını Header yerine Footer Ekstra Kod Alanına eklemeniz daha sağlıklı olacaktır.
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="tab-pane fade" id="pills-1x2" role="tabpanel" aria-labelledby="pills-1x2-tab">
	<div class="row">
		<div class="col-md-7">
			<div class="card">
				<div class="card-header">
					<div class="box-title font-weight-bold">Footer Ayarları</div>
				</div>
				<div class="card-body">
					<form class="loftForm" method="POST">
						<input type="hidden" name="olay" value="loftOptions">
						<input type="hidden" name="page" value="theme">
						<input type="hidden" name="loftAction" value="generalSave">
						<div class="form-row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold mb-1">Menü Seç</label>
									<p>
										<b>Görünüm &gt; Menüler</b> kısmından oluşturduğunuz menülerden birisini seçerek footer kısmında menüyü listeleyebilirsiniz.
									</p>
									<select class="form-control" name="data[loftFooterItems][item2]">
										<?php foreach ($menuList as $key => $value) { ?>
											<option value="<?php echo $key;?>" <?php echo $loftFooterItems["item2"]==$key ? 'selected':'';?>><?php echo $value["name"];?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group">
									<label class="font-weight-bold mb-1">Copyright</label>
									<input type="text" class="form-control" name="data[loftFooterItems][item3][copyright]" value="<?php echo $loftFooterItems["copyright"];?>" placeholder="Copyright Yazısı">
								</div>
							</div>
							<div class="col-md-12">
								<label class="font-weight-bold mb-2">Sosyal Medya İconları</label>
								<p>Sosyal medya hesabınız varsa linkleri aşağıdaki alana girebilir veya görünmesini istemiyorsanız boş bırakabilirsiniz.</p>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="input-group">
										<div class="butto butto-light mr-1 smgir">
											<i class="fab fa-instagram" aria-hidden="true"></i>
										</div>
										<input class="form-control smginx" name="data[loftFooterItems][item3][instagram]" placeholder="Link Girin" value="<?php echo $loftFooterItems["instagram"];?>">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="input-group">
										<div class="butto butto-light mr-1 smgir">
											<i class="fab fa-youtube" aria-hidden="true"></i>
										</div>
										<input class="form-control smginx" name="data[loftFooterItems][item3][youtube]" placeholder="Link Girin" value="<?php echo $loftFooterItems["youtube"];?>">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="input-group">
										<div class="butto butto-light mr-1 smgir">
											<i class="fab fa-twitter" aria-hidden="true"></i>
										</div>
										<input class="form-control smginx" name="data[loftFooterItems][item3][twitter]" placeholder="Link Girin" value="<?php echo $loftFooterItems["twitter"];?>">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="input-group">
										<div class="butto butto-light mr-1 smgir">
											<input type="hidden" name="" value="fab fa-facebook"> <i class="fab fa-facebook" aria-hidden="true"></i>
										</div>
										<input class="form-control smginx" name="data[loftFooterItems][item3][facebook]" placeholder="Link Girin" value="<?php echo $loftFooterItems["facebook"];?>">
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold mb-1">Footer Görseli</label>
									<select class="form-control mb-2" name="data[loftFooterItems][item3][footImgStatu]" data-showHide="true" data-class='div[class="footimgar"]'>
										<option value="aktif" <?php echo $loftFooterItems["footImgStatu"]=="aktif" ? 'selected':'';?>>Aktif</option>
										<option value="pasif" <?php echo $loftFooterItems["footImgStatu"]=="pasif" ? 'selected':'';?>>Pasif</option>
									</select>
									<div class="footimgar" style="<?php echo $loftFooterItems["footImgStatu"]=="pasif" ? 'display: none;':'';?>">
										<div class="onecik-onizle ortambut mb-3" data-ortam="footImg" data-url="<?php echo $loft->path($loftFooterItems["footImg"],"img");?>" data-input="<?php echo $loftFooterItems["footImg"];?>">
											<img class="ortam-sec m-1" src="https://demo.nivusoft.com/space/panel/images/ortam-sec.png">
											<div class="tumb-oniztext">
												<img id="footImg-onizleme" src="<?php echo $loft->path($loftFooterItems["footImg"],"img");?>">
												<input type="hidden" id="footImg-input" name="data[loftFooterItems][item3][footImg]" required="" value="<?php echo $loftFooterItems["footImg"];?>">
											</div>
										</div>
										<div class="mt-2">
											<div class="alert alert-success mb-0 text-center p-2">
												<p class="mb-0">Ödeme yöntemleri ve firmalarının logolarını içeren yatay bir görsel ekleyin. <strong>(Yükseklik: 50px)</strong></p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<label class="font-weight-bold mb-1">Footer Kod Alanı</label>
								<p>Canlı destek gibi sistemler tarafından verilen kodları bu alana ekleyebilirsiniz.</p>
							</div>
							<div class="col-md-12"> <div class="form-group">
								<textarea class="form-control" name="data[loftFooterItems][item3][code]" placeholder="Footer için Kod Alanı"><?php echo $loftFooterItems["code"];?></textarea>
							</div>
						</div>
						<div class="col-md-12">
							<div class="alert alert-danger text-center">
								<p class="mb-0">
									<span class="d-block font-weight-bold"> Script kodlarını bazı sunucular güvenlik nedeni (ModSecurty) ile kabul etmemektedir. Kaydet sonrası hata alır veya yükleme ekranında takılırsanız lütfen hizmet sağlayıcı firmanız ile iletişime geçin.
									</span>
								</p>
							</div>
						</div>
						<div class="col-md-12">
							<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3">
								<i class="fas fa-check" aria-hidden="true"></i> Kaydet
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-5">
		<div class="card">
			<div class="card-header">
				<div class="box-title font-weight-bold">Footer İletişim Alanı</div>
			</div>
			<div class="card-body">
				<form class="loftForm" method="POST">
					<input type="hidden" name="olay" value="loftOptions">
					<input type="hidden" name="page" value="theme">
					<input type="hidden" name="loftAction" value="generalSave">
					<div class="form-row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="font-weight-bold mb-1">Durum</label>
								<select class="form-control" name="data[loftFooterItems][item4][areaStatu]" data-showHide="true" data-class='div[id="areaStatu2"]'>
									<option value="aktif" <?php echo $loftFooterItems["areaStatu"]=="aktif" ? 'selected':'';?>>Aktif</option>
									<option value="pasif" <?php echo $loftFooterItems["areaStatu"]=="pasif" ? 'selected':'';?>>Pasif</option>
								</select>
							</div>
						</div>
						<div class="col-md-12" id="areaStatu2" style="<?php echo $loftFooterItems["areaStatu"]=="pasif" ? 'display: none;':'';?>">
							<div class="row">
								<div class="col-md-12" data-class="areaStatu">
									<div class="form-group">
										<label class="font-weight-bold mb-1">Üst Satır</label>
										<input type="text" class="form-control" name="data[loftFooterItems][item4][head]" placeholder="Text Girin" value="<?php echo $loftFooterItems["head"];?>">
									</div>
									<div class="form-group">
										<label class="font-weight-bold mb-1">Alt Satır</label>
										<input type="text" class="form-control" name="data[loftFooterItems][item4][headLine]" placeholder="Text Girin" value="<?php echo $loftFooterItems["headLine"];?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="font-weight-bold mb-1">Whatsapp Butonu</label>
										<select class="form-control" name="data[loftFooterItems][item4][whatsappStatu]">
											<option value="aktif" <?php echo $loftFooterItems["whatsappStatu"]=="aktif" ? 'selected':'';?>>Aktif</option>
											<option value="pasif" <?php echo $loftFooterItems["whatsappStatu"]=="pasif" ? 'selected':'';?>>Pasif</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 ekButtonWhatsapp">
									<div class="form-group">
										<label class="font-weight-bold mb-1">Whatsapp Numara</label>
										<input type="text" class="form-control" name="data[loftFooterItems][item4][whatsappNumber]" placeholder="+90555.." value="<?php echo $loftFooterItems["whatsappNumber"];?>">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label class="font-weight-bold mb-1">Whatsapp Mesajı</label>
										<input type="text" class="form-control" name="data[loftFooterItems][item4][whatsappText]" placeholder="+90555.." value="<?php echo $loftFooterItems["whatsappText"];?>">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label class="font-weight-bold mb-1">Ek Buton Metni</label>
										<input type="text" class="form-control" name="data[loftFooterItems][item4][buttonText]" placeholder="İletişime Geç!" value="<?php echo $loftFooterItems["buttonText"];?>">
									</div>
									<div class="form-group">
										<label class="font-weight-bold mb-1">Ek Buton Iconu</label>
										<div class="input-group">
											<div class="butto butto-light mr-1 smgir">
												<i id="iconView_FootButtonIcon" class="<?php echo $loftFooterItems["buttonIcon"];?>" aria-hidden="true"></i>
											</div>
											<input class="form-control smginx" id="iconInput_FootButtonIcon" name="data[loftFooterItems][item4][buttonIcon]" value="<?php echo $loftFooterItems["buttonIcon"];?>">
											<button type="button" class="butto butbor butto-dark icon-modal" data-toggle="modal" data-target="#iconSec" data-icon="<?php echo $loftFooterItems["buttonIcon"];?>" data-add="FootButtonIcon">Icon Seç</button>
										</div>
									</div>
									<div class="form-group">
										<label class="font-weight-bold mb-1">Ek Buton Linki</label>
										<input type="text" class="form-control" name="data[loftFooterItems][item4][buttonHref]" placeholder="https://siteadi.com/iletisim/" value="<?php echo $loftFooterItems["buttonHref"];?>">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check" aria-hidden="true"></i> Kaydet</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
<div class="tab-pane fade" id="pills-1x3" role="tabpanel" aria-labelledby="pills-1x3-tab">
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<div class="box-title"> Genel İletişim Bilgileri</div>
				</div>
				<div class="card-body">
					<form class="loftForm" method="POST">
						<input type="hidden" name="olay" value="loftOptions">
						<input type="hidden" name="page" value="theme">
						<input type="hidden" name="loftAction" value="generalSave">
						<div class="form-row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold">Firma Adı</label>
									<input type="text" class="form-control" name="data[loftContactItems][item2][company]" placeholder="Firma Adı" value="<?php echo $loftContactItems["company"];?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-weight-bold">Telefon</label>
									<input type="text" class="form-control" name="data[loftContactItems][item2][phone]" placeholder="Telefon" value="<?php echo $loftContactItems["phone"];?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-weight-bold">E-Posta</label>
									<input type="text" class="form-control" name="data[loftContactItems][item2][mail]" placeholder="E-Posta Adresi" value="<?php echo $loftContactItems["mail"];?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold">Adres</label>
									<textarea class="form-control" name="data[loftContactItems][item2][adres]" placeholder="Adres"><?php echo $loftContactItems["adres"];?></textarea>
								</div>
							</div>
							<div class="col-md-12">
								<div class="alert alert-danger text-center">
									<p class="mb-0">
										<span class="d-block font-weight-bold"> Gözükmesini istemediğiniz kısımları boş bırakabilirsiniz.</span>
									</p>
								</div>
							</div>
						</div>
						<div class="w-100">
							<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-2">
								<i class="fas fa-check" aria-hidden="true"></i> Kaydet</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card bilgi-box">
					<div class="card-header">
						<div class="box-title font-weight-bold">Bilgi Kutusu <i class="fas fa-chevron-right" aria-hidden="true"></i>
						</div>
					</div>
					<div class="card-body">
						<div class="bb-box">
							<span class="bb-title">İletişim Bilgileri Nedir?</span>
							İletişim sayfasında ve footer kısmında yer alan iletişim bilgileri alanlarına çekilen veriler bu kısımdan alınmaktadır.
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>