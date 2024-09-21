<div class="row">
	<div class="col-md-8">
		<?php if($setting = $space->settingJson("spaceSetting")) { ?>
		<form class="action_form_submit" method="POST">
			<input type="hidden" name="page" value="theme">
			<input type="hidden" name="olay" value="spaceSetting">
			<input type="hidden" name="yontem" value="json">
			<input type="hidden" name="removeCssJs" value="1">
			<div class="card">
				<div class="card-header">
					<div class="box-title">Renk Ayarları</div>
				</div>
				<div class="card-body">
					<div class="form-row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="font-weight-bold">1. Renk</label>
								<div class="input-group mb-2 renkhover">
									<div class="butto mr-1 smgir rengiyazdir" id="colorOne" style="background:<?php echo $setting["colorOne"];?>">
									</div>
									<input type="text" class="form-control renksecici smginx" name="data[item2][colorOne]" data-renk="colorOne" required="" value="<?php echo $setting["colorOne"];?>">
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="font-weight-bold">2. Renk</label>
								<div class="input-group mb-2 renkhover">
									<div class="butto mr-1 smgir rengiyazdir" id="colorTwo" style="background:<?php echo $setting["colorTwo"];?>">
									</div>
									<input type="text" class="form-control renksecici smginx" name="data[item2][colorTwo]" data-renk="colorTwo" required="" value="<?php echo $setting["colorTwo"];?>">
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="font-weight-bold">Menü ve Başlık Yazıları</label>
								<div class="input-group mb-2 renkhover">
									<div class="butto mr-1 smgir rengiyazdir" id="colorThree" style="background:<?php echo $setting["colorThree"];?>">
									</div>
									<input type="text" class="form-control renksecici smginx" name="data[item2][colorThree]" data-renk="colorThree" required="" value="<?php echo $setting["colorThree"];?>">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-header">
					<div class="box-title">Preloader</div>
				</div>
				<div class="card-body">
					<div class="form-row">
						<div class="col-md-12">
							<div class="form-group">
								<p>Site açılışında ve sayfa geçişlerinde yüklenme ekranını göstermek için aktif hale getirin.</p>
								<select class="form-control" name="data[item2][preloader]">
									<option value="0" <?php echo (isset($setting["preloader"]) AND $setting["preloader"]=="0") ? 'selected':'';?>>Pasif</option>
									<option value="1" <?php echo (isset($setting["preloader"]) AND $setting["preloader"]=="1") ? 'selected':'';?>>Aktif</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="card-header">
					<div class="box-title">Köşe Yapısı</div>
				</div>
				<div class="card-body">
					<div class="form-row">
						<div class="col-md-12">
							<div class="form-group">
								<p>Sitede bulunan tüm elemanların köşe yapısı bu kısımdan belirlenir. Eğer keskin tercih edilirse tüm elemanlar keskin köşe yapısına sahip olur.</p>
								<select class="form-control" name="data[item2][cornerType]">
									<option value="default" <?php echo $setting["cornerType"] == "default" ? 'selected':'';?>>Default</option>
									<option value="sharp" <?php echo $setting["cornerType"] == "sharp" ? 'selected':'';?>>Keskin</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="card-header">
					<div class="box-title">Paket Yapısı</div>
				</div>
				<div class="card-body">
					<div class="form-row">
						<div class="col-md-12">
							<p>Paket özelliklerinde 5den fazla gözükmemesi için scroll aktif edin. Bu özellik paket yüksekliklerinin eşit olmasını sağlar. Anasayfada yer alan paketler için geçerli değildir.</p>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="font-weight-bold">Scroll Özelliği</label>
								<select class="form-control" name="data[item2][packetScroll]">
									<option value="1" <?php echo $setting["packetScroll"] == "1" ? 'selected':'';?>>Aktif</option>
									<option value="0" <?php echo $setting["packetScroll"] == "0" ? 'selected':'';?>>Pasif</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="font-weight-bold">Paket Çerçevesi</label>
								<select class="form-control" name="data[item2][packedBorder]">
									<option value="1" <?php echo $setting["packedBorder"] == "1" ? 'selected':'';?>>Çerçeveli</option>
									<option value="0" <?php echo $setting["packedBorder"] == "0" ? 'selected':'';?>>Çerçevesiz</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="card-header">
					<div class="box-title">Fixed Buton Tercihleri</div>
				</div>
				<div class="card-body">
					<div class="form-row">
						<div class="col-md-12">
							<p>Fake bildirim, canlı destek gibi elemanları sol alt kısımda gösteriyorsanız, butonlarla üst üste gelmemesi için butonları orta alana alabilirsiniz.</p>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="font-weight-bold">Butonların Konumu</label>
								<select class="form-control" name="data[item2][fixedButton][place]">
									<option value="left_bottom" <?php echo $setting["fixedButton"]->place == 'left_bottom' ? 'selected':'';?>>Sol Alt</option>
									<option value="left_center"<?php echo $setting["fixedButton"]->place == 'left_center' ? 'selected':'';?>>Sol Orta</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="font-weight-bold">Mobil Tercihi</label>
								<select class="form-control" name="data[item2][fixedButton][mobile]">
									<option value="1" <?php echo $setting["fixedButton"]->mobile == "1" ? 'selected':'';?>>Mobilde Göster</option>
									<option value="0" <?php echo $setting["fixedButton"]->mobile == "0" ? 'selected':'';?>>Mobilde Gizle</option>
								</select>
							</div>
						</div>
						<div class="col-md-12">
							<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check" aria-hidden="true"></i> Kaydet</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	    <?php } ?>
	</div>
	<div class="col-md-4">
		<?php if($buttons = $space->settingJson("spaceButtons")) { ?>
		<form class="action_form_submit" method="POST">
			<input type="hidden" name="page" value="theme">
			<input type="hidden" name="olay" value="spaceButtons">
			<input type="hidden" name="yontem" value="json">
			<div class="card mb-3">
				<div class="card-header">
					<div class="box-title font-weight-bold w-100">Menü Butonları
					</div>
				</div>
				<div class="card-body">
					<div class="form-group">
						<label class="font-weight-bold">İletişim Butonu</label>
						<select class="form-control" name="data[item2][menuContact][statu]">
							<option value="1" <?php echo $buttons["menuContact"]->statu == "1" ? 'selected':'';?>>Aktif</option>
							<option value="0" <?php echo $buttons["menuContact"]->statu == "0" ? 'selected':'';?>>Pasif</option>
						</select>
					</div>
					<div class="form-group">
						<label class="font-weight-bold">Sipariş Sorgula Butonu</label>
						<select class="form-control" name="data[item2][menuSearch][statu]">
							<option value="1" <?php echo $buttons["menuSearch"]->statu == "1" ? 'selected':'';?>>Aktif</option>
							<option value="0" <?php echo $buttons["menuSearch"]->statu == "0" ? 'selected':'';?>>Pasif</option>
						</select>
					</div>
					<div class="col-md-12">
							<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check" aria-hidden="true"></i> Kaydet</button>
						</div>
				</div>
			</div>
			<div class="card mb-3">
				<div class="card-header">
					<div class="box-title font-weight-bold w-100">Fixed Sipariş Sorgula
					</div>
				</div>
				<div class="card-body">
					<div class="form-group">
						<label class="font-weight-bold">Durum</label>
						<select class="form-control" name="data[item2][fixedSearch][statu]">
							<option value="1" <?php echo $buttons["fixedSearch"]->statu == "1" ? 'selected':'';?>>Aktif</option>
							<option value="0" <?php echo $buttons["fixedSearch"]->statu == "0" ? 'selected':'';?>>Pasif</option>
						</select>
					</div>
				</div>
				<div class="card-header">
					<div class="box-title font-weight-bold w-100">Fixed Telefon Butonu
					</div>
				</div>
				<div class="card-body">
					<div class="form-group">
						<label class="font-weight-bold">Durum</label>
						<select class="form-control" name="data[item2][fixedPhone][statu]">
							<option value="1" <?php echo $buttons["fixedPhone"]->statu == "1" ? 'selected':'';?>>Aktif</option>
							<option value="0" <?php echo $buttons["fixedPhone"]->statu == "0" ? 'selected':'';?>>Pasif</option>
						</select>
					</div>
					<div class="form-group">
						<label class="font-weight-bold">Telefon Numaranız</label>
						<input type="text" class="form-control" name="data[item2][fixedPhone][phone]" value="<?php echo $buttons["fixedPhone"]->phone;?>">
					</div>
					<div class="form-group">
						<label class="font-weight-bold">Buton Rengi</label>
						<div class="input-group mb-2 renkhover">
							<div class="butto mr-1 smgir rengiyazdir" id="fixedPhone" style="background:<?php echo $buttons["fixedPhone"]->color;?>;">
							</div>
							<input type="text" class="form-control renksecici smginx" name="data[item2][fixedPhone][color]" data-renk="fixedPhone" required="" value="<?php echo $buttons["fixedPhone"]->color;?>">
						</div>
					</div>
				</div>
				<div class="card-header">
					<div class="box-title font-weight-bold w-100">Fixed WhatsApp Butonu
					</div>
				</div>
				<div class="card-body">
					<div class="form-group">
						<label class="font-weight-bold">Durum</label>
						<select class="form-control" name="data[item2][fixedWhatsApp][statu]">
							<option value="1" <?php echo $buttons["fixedWhatsApp"]->statu == "1" ? 'selected':'';?>>Aktif</option>
							<option value="0" <?php echo $buttons["fixedWhatsApp"]->statu == "0" ? 'selected':'';?>>Pasif</option>
						</select>
					</div>
					<div class="form-group">
						<label class="font-weight-bold">Whatsapp Numaranız(+90..)</label>
						<input type="text" class="form-control" name="data[item2][fixedWhatsApp][phone]" value="<?php echo $buttons["fixedWhatsApp"]->phone;?>">
					</div>
					<div class="form-group">
						<label class="font-weight-bold">Giriş Mesajı</label>
						<textarea class="form-control" name="data[item2][fixedWhatsApp][text]" placeholder="Giriş Mesajı"><?php echo $buttons["fixedWhatsApp"]->text;?></textarea>
					</div>
					<div class="w-100">
						<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check" aria-hidden="true"></i> Kaydet</button>
					</div>
				</div>
			</div>
		</form>
		<?php } ?>
	</div>
</div>