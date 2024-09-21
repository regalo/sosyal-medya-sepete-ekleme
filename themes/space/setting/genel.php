<div class="tab-alani">
	<ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
		<li class="nav-item">
			<a class="nav-link gri alti active show" id="pills-1x1-tab" data-toggle="pill" href="#pills-1x1" role="tab" aria-controls="pills-home" aria-selected="true">Header</a>
		</li>
		<li class="nav-item">
			<a class="nav-link gri alti" id="pills-1x2-tab" data-toggle="pill" href="#pills-1x2" role="tab" aria-controls="pills-home" aria-selected="true">Footer</a>
		</li>
		<li class="nav-item">
			<a class="nav-link gri alti" id="pills-1x3-tab" data-toggle="pill" href="#pills-1x3" role="tab" aria-controls="pills-home" aria-selected="true">İletişim Sayfası</a>
		</li>
	</ul>
</div>
<div class="tab-pane fade active show" id="pills-1x1" role="tabpanel" aria-labelledby="pills-1x1-tab">
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<div class="box-title font-weight-bold">
						Header Ayarları
					</div>
				</div>
				<div class="card-body">
					<form class="action_form_submit" method="POST">
                        <input type="hidden" name="page" value="theme">
                        <input type="hidden" name="olay" value="spaceHeader">
                        <input type="hidden" name="yontem" value="json">
						<div class="form-row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold mb-1">Menü Seç</label>
									<p><b>Görünüm > Menüler</b> kısmından oluşturduğunuz menülerden birisini seçerek header kısmında menüyü listeleyebilirsiniz.</p>
									<select class="form-control" name="data[item2][headerMenu]">
										<?php foreach ($ayar->all('nsmenu') as $value) { ?>
											<option value="<?= $value["ayar_1"];?>" <?= $value["ayar_1"]==$header["headerMenu"] ? 'selected=""':'';?>><?= $value["item2"];?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<label class="font-weight-bold mb-1">Header Tercihi</label>
								<p>Header'ın sayfa ile birlikte kaymasını istiyorsanız <b>Kayan</b>, kaymasını istemiyorsanız <b>Sabit</b> seçeneğini ayarlayın. Tam genişlikte olması için <b>Full Width</b>, kutu genişliğinde olması için <b>Boxed</b> seçeneğini ayarlayın.  </p>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<select class="form-control" name="data[item2][position]">
										<option value="fixed" <?php echo $header["position"] == 'fixed' ? 'selected':'';?>>Kayan</option>
										<option value="constant"  <?php echo $header["position"] == 'constant' ? 'selected':'';?>>Sabit</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<select class="form-control" name="data[item2][width]">
										<option value="fixed" <?php echo $header["width"] == 'fixed' ? 'selected':'';?>>Full Width</option>
										<option value="boxed"  <?php echo $header["width"] == 'boxed' ? 'selected':'';?>>Boxed</option>
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<label class="font-weight-bold mb-1">Header Kod Alanı</label>
								<p>Analitik, site doğrulama, canlı destek gibi sistemler tarafından verilen kodları bu alana ekleyebilirsiniz.</p>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<textarea class="form-control" name="data[item2][headerExtra]" placeholder="Header için Kod Alanı"><?php echo $header["headerExtra"];?></textarea>
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
								<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check" aria-hidden="true"></i> Kaydet</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card bilgi-box">
				<div class="card-header">
					<div class="box-title font-weight-bold">Bilgi Kutusu <i class="fas fa-chevron-right"></i></div>
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
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<div class="box-title font-weight-bold">
						Footer Ayarları
					</div>
				</div>
				<div class="card-body">
					<form class="action_form_submit" method="POST">
                        <input type="hidden" name="page" value="theme">
                        <input type="hidden" name="olay" value="spaceFooter">
                        <input type="hidden" name="yontem" value="json">
						<div class="form-row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold mb-1">Menü Seç</label>
									<p><b>Görünüm > Menüler</b> kısmından oluşturduğunuz menülerden birisini seçerek footer kısmında menüyü listeleyebilirsiniz.</p>
									<select class="form-control" name="data[item2][footerMenu]">
										<?php foreach ($ayar->all('nsmenu') as $value) { ?>
											<option value="<?= $value["ayar_1"];?>" <?= $value["ayar_1"]==$footer["footerMenu"] ? 'selected=""':'';?>><?= $value["item2"];?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold mb-1">Copyright</label>
									<input type="text" class="form-control" name="data[item2][copyright]" value="<?php echo $footer["copyright"];?>" placeholder="Copyright Yazısı">
								</div>
							</div>
							<div class="col-md-12">
								<label class="font-weight-bold mb-1">Sosyal Medya İconları</label>
								<p>Sosyal medya hesabınız varsa linkleri aşağıdaki alana girebilir veya görünmesini istemiyorsanız boş bırakabilirsiniz.</p>
							</div>
							<?php foreach ($footer["socialMedia"] as $key => $value) { ?>
							    <div class="col-md-6">
									<div class="form-group">
										<div class="input-group">
											<div class="butto butto-light mr-1 smgir">
												<input type="hidden" name="data[item2][socialMedia][<?php echo $key;?>][icon]" value="<?php echo $value->icon;?>">
												<i class="<?php echo $value->icon;?>" aria-hidden="true"></i>
											</div>
											<input class="form-control smginx" name="data[item2][socialMedia][<?php echo $key;?>][href]" placeholder="Link Girin" value="<?php echo $value->href;?>">
										</div>
									</div>
								</div>
							<?php } ?>

							<div class="col-md-12">
								<label class="font-weight-bold mb-1">Footer Kod Alanı</label>
								<p>Canlı destek gibi sistemler tarafından verilen kodları bu alana ekleyebilirsiniz.</p>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<textarea class="form-control" name="data[item2][footerExtra]" placeholder="Footer için Kod Alanı"><?php echo $footer["footerExtra"];?></textarea>
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
								<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check" aria-hidden="true"></i> Kaydet</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<div class="box-title font-weight-bold">
						Sayfa Sonu Kutusu
					</div>
				</div>
				<div class="card-body">
					<?php if($footBox = $space->footBox("setting")) { ?>
					<form class="action_form_submit" method="POST">
                        <input type="hidden" name="page" value="theme">
                        <input type="hidden" name="olay" value="spacefootBox">
                        <input type="hidden" name="yontem" value="json">
						<div class="form-row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold mb-1">Başlık</label>
									<input type="text" class="form-control" name="data[item2][headLine]" placeholder="Başlık Girin" value="<?php echo $footBox["headLine"];?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold mb-1">Açıklama</label>
									<textarea class="form-control" name="data[item2][description]" placeholder="Açıklama Girin"><?php echo $footBox["description"];?></textarea>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-weight-bold mb-1">Buton Text</label>
									<input type="text" class="form-control" name="data[item2][buttonText]" placeholder="Buton Yazısı" value="<?php echo $footBox["buttonText"];?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-weight-bold mb-1">Buton URL</label>
									<input type="text" class="form-control" name="data[item2][href]" placeholder="Buton Linki" value="<?php echo $footBox["href"];?>">
								</div>
							</div>
							<div class="col-md-12">
								<p class="mt-3">Footer üstünde yer alan sayfa sonu kutusunun hangi sayfalarda görüneceğini belirleyin.</p>
								<div class="cb-group">
					    			<input class="hide" type="checkbox" name="data[item2][places][home]" 
					    			<?php echo isset($footBox["places"]->home) ? 'checked':'';?>>
					    			<label class="cb-item <?php echo isset($footBox["places"]->home) ? 'selected':'';?>" data-input="home">Anasayfa</label>

					    			<input class="hide" type="checkbox" name="data[item2][places][platform]" 
					    			<?php echo isset($footBox["places"]->platform) ? 'checked':'';?>>
					    			<label class="cb-item <?php echo isset($footBox["places"]->platform) ? 'selected':'';?>" data-input="platform">Kategoriler</label>

					    			<input class="hide" type="checkbox" name="data[item2][places][category]" 
					    			<?php echo isset($footBox["places"]->category) ? 'checked':'';?>>
					    			<label class="cb-item <?php echo isset($footBox["places"]->category) ? 'selected':'';?>" data-input="category">Paketler</label>

					    			<input class="hide" type="checkbox" name="data[item2][places][order]" 
					    			<?php echo isset($footBox["places"]->order) ? 'checked':'';?>>
					    			<label class="cb-item <?php echo isset($footBox["places"]->order) ? 'selected':'';?>" data-input="order">Sipariş Sayfası</label>

					    			<input class="hide" type="checkbox" name="data[item2][places][single_page]" 
					    			<?php echo isset($footBox["places"]->single_page) ? 'checked':'';?>>
					    			<label class="cb-item <?php echo isset($footBox["places"]->single_page) ? 'selected':'';?>" data-input="single_page">Tekil Sayfa</label>

					    			<input class="hide" type="checkbox" name="data[item2][places][blog_list]" 
					    			<?php echo isset($footBox["places"]->blog_list) ? 'checked':'';?>>
					    			<label class="cb-item <?php echo isset($footBox["places"]->blog_list) ? 'selected':'';?>" data-input="blog_list">Blog Listesi</label>

					    			<input class="hide" type="checkbox" name="data[item2][places][single_post]" 
					    			<?php echo isset($footBox["places"]->single_post) ? 'checked':'';?>>
					    			<label class="cb-item <?php echo isset($footBox["places"]->single_post) ? 'selected':'';?>" data-input="single_post">Blog Yazısı</label>

					    			<input class="hide" type="checkbox" name="data[item2][places][contact]" 
					    			<?php echo isset($footBox["places"]->contact) ? 'checked':'';?>>
					    			<label class="cb-item <?php echo isset($footBox["places"]->contact) ? 'selected':'';?>" data-input="contact">İletişim Sayfası</label>

					    			<input class="hide" type="checkbox" name="data[item2][places][error]" 
					    			<?php echo isset($footBox["places"]->error) ? 'checked':'';?>>
					    			<label class="cb-item <?php echo isset($footBox["places"]->error) ? 'selected':'';?>" data-input="error">404 Error</label>


				  				</div>
							</div>	
							<div class="col-md-12">
								<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check" aria-hidden="true"></i> Kaydet</button>
							</div>
						</div>
					</form>
				    <?php } ?>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card bilgi-box">
				<div class="card-header">
					<div class="box-title font-weight-bold">Bilgi Kutusu <i class="fas fa-chevron-right"></i></div>
				</div>
				<div class="card-body">
					<div class="bb-box">
						<span class="bb-title">Footer Kod Alanı</span>
						Footer kod alanı Analitik, Canlı Destek gibi ekstraların kodlarını eklemek içindir. (Canlı destek kodları için ideal konum footer alanıdır.)
						<hr>
						<span class="bb-title">Sayfa Sonu Kutusu</span>
						Sayfa sonunda, footer bölgesinde yer alan kısımdır. Bu alanın hangi sayfalarda gözükeceğini belirleyebilirsiniz.
						<hr>
						<span class="bb-title">Sosyal Medya Butonları</span>
						Sosyal medya hesaplarınız varsa footer kısmında yer alan sosyal medya iconları için linklerinizi ekleyebilirsiniz. Eğer butonların görünmesini istemiyorsanız inputları boş bırakabilirsiniz.
					</div>
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
					<div class="box-title">
						İletişim Bilgileri Kutusu
					</div>
				</div>
				<div class="card-body">
					<?php if($contactInfo = $space->sidebarView("spaceSideContactInfo")) { ?>
					<form class="action_form_submit" method="POST">
                        <input type="hidden" name="page" value="theme">
                        <input type="hidden" name="olay" value="spaceSideContactInfo">
                        <input type="hidden" name="yontem" value="json">
						<div class="form-row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold">Durum</label>
									<select class="form-control" name="data[item2][statu]">
										<option value="1" <?php echo $contactInfo["statu"]=="1" ? 'selected':'';?>>Aktif</option>
										<option value="0" <?php echo $contactInfo["statu"]=="0" ? 'selected':'';?>>Pasif</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-weight-bold">Sidebar Üst Başlık</label>
									<input type="text" class="form-control" name="data[item2][headLine]" placeholder="Sidebar Üst Başlık" value="<?php echo $contactInfo["headLine"];?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-weight-bold">Sidebar Ana Başlık</label>
									<input type="text" class="form-control" name="data[item2][headFirst]" placeholder="Sidebar Ana Başlık" value="<?php echo $contactInfo["headFirst"];?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-weight-bold">Icon</label>
									<div class="input-group">
										<div class="butto butto-light mr-1 smgir">
											<i id="iconView_ContactInfo" class="<?php echo $contactInfo["icon"];?>" aria-hidden="true"></i>
										</div>
										<input id="iconInput_ContactInfo" name="data[item2][icon]" required="" class="form-control smginx" value="<?php echo $contactInfo["icon"];?>">
										<button type="button"
										class="butto butbor butto-dark icon-modal"
										data-toggle="modal"
										data-target="#iconSec"
										data-icon="<?php echo $contactInfo["icon"];?>"
										data-add="ContactInfo">Icon Seç</button>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-weight-bold">Firma Adı</label>
									<input type="text" class="form-control" name="data[item2][company]" placeholder="Firma Adı" value="<?php echo $contactInfo["company"];?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-weight-bold">Telefon</label>
									<input type="text" class="form-control" name="data[item2][phone]" placeholder="Telefon" value="<?php echo $contactInfo["phone"];?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-weight-bold">E-Posta</label>
									<input type="text" class="form-control" name="data[item2][mail]" placeholder="E-Posta Adresi" value="<?php echo $contactInfo["mail"];?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold">Adres</label>
									<textarea class="form-control" name="data[item2][adres]" placeholder="Adres"><?php echo $contactInfo["adres"];?></textarea>
								</div>
							</div>
							<div class="col-md-12">
								<div class="alert alert-danger text-center">
									<p class="mb-0">
										<span class="d-block font-weight-bold">
											Gözükmesini istemediğiniz kısımları boş bırakabilirsiniz.
										</span>
									</p>
								</div>
							</div>
						</div>
						<div class="w-100">
							<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-2"><i class="fas fa-check" aria-hidden="true"></i> Kaydet</button>
						</div>
					</form>
				    <?php } ?>
				</div>
			</div>
		</div>
		<div class="col-md-4">
				<?php if($contactsss = $space->contactSss()){ ?>
				<form class="action_form_submit" method="POST">
			<div class="card">
			<div class="card-header">
				<div class="box-title">
					S.S.S. Sidebar Ayarları
				</div>
			</div>
			<div class="card-body">
                    <input type="hidden" name="page" value="theme">
                    <input type="hidden" name="olay" value="spaceContactSss">
                    <input type="hidden" name="yontem" value="json">
					<div class="form-row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="font-weight-bold">Üst Başlık</label>
								<input type="text" class="form-control" name="data[item2][headLine]" placeholder="S.S.S. Üst Başlık" value="<?php echo $contactsss["headLine"];?>">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label class="font-weight-bold">Ana Başlık</label>
								<input type="text" class="form-control" name="data[item2][headFirst]" placeholder="S.S.S. Ana Başlık" value="<?php echo $contactsss["headFirst"];?>">
							</div>
						</div>
					</div>
					
			</div>
		</div>
		<div class="card mb-3">
			<div class="card-header border-0">
				<div class="box-title">
					Soru ve Cevaplar
				</div>
			</div>
		</div>
		<div class="faq-list">
						<?php foreach ($contactsss["items"] as $key => $value) { ?>
						<div class="card bilgi-box active mb-2">
							<div class="card-header border-bottom-0">
									<?php echo $value->question;?>
									<i class="fas fa-chevron-right" aria-hidden="true"></i>
							</div>
							<div class="card-body" style="display: none;">
								<div class="faq-element mb-4">
							<div class="form-group mb-2">
								<input type="text" class="form-control" required="" name="data[item3][<?php echo $key;?>][question]" placeholder="Soru" value="<?php echo $value->question;?>">
							</div>
							<div class="form-group">
								<textarea class="form-control" required="" name="data[item3][<?php echo $key;?>][reply]" placeholder="Cevap"><?php echo $value->reply;?></textarea>
							</div>
						</div>
						<button type="button" class="butto butto-danger butbor ml-2 mb-3 faqcikar"><i class="fas fa-trash" aria-hidden="true"></i> Sil</button>
							</div>
						</div>
					    <?php $cSssLastKey = $key; } ?>
					</div>
					<button type="button" class="butto butto-primary butbor mb-3 mt-2 faqekle"><i class="fas fa-plus" aria-hidden="true"></i> Soru Ekle</button>
					<div class="w-100">
						<button type="submit" class="butto butto-xl butto-success butbor w-100 mt-2 mb-5"><i class="fas fa-check" aria-hidden="true"></i> Kaydet</button>
					</div>
				</form>
			    <?php   $cSssLastKey = isset($cSssLastKey) ? ($cSssLastKey+1):0;
					    echo '<script>cSssKey = '.$cSssLastKey.';</script>'; } ?>
		</div>
	</div>
</div>