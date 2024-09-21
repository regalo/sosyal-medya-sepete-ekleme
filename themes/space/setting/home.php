<div class="tab-alani">
	<ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
		<li class="nav-item">
			<a class="nav-link gri alti active show" id="pills-1x1-tab" data-toggle="pill" href="#pills-1x1" role="tab" aria-controls="pills-home" aria-selected="true">Intro</a>
		</li>
		<li class="nav-item">
			<a class="nav-link gri alti" id="pills-1x2-tab" data-toggle="pill" href="#pills-1x2" role="tab" aria-controls="pills-home" aria-selected="true">Hizmetler</a>
		</li>
		<li class="nav-item">
			<a class="nav-link gri alti" id="pills-1x3-tab" data-toggle="pill" href="#pills-1x3" role="tab" aria-controls="pills-home" aria-selected="true">Neden Biz?</a>
		</li>
		<li class="nav-item">
			<a class="nav-link gri alti" id="pills-1x4-tab" data-toggle="pill" href="#pills-1x4" role="tab" aria-controls="pills-home" aria-selected="true">Müşteri Yorumları</a>
		</li>
		<li class="nav-item">
			<a class="nav-link gri alti" id="pills-1x5-tab" data-toggle="pill" href="#pills-1x5" role="tab" aria-controls="pills-home" aria-selected="true">S.S.S</a>
		</li>
		<li class="nav-item">
			<a class="nav-link gri alti" id="pills-1x6-tab" data-toggle="pill" href="#pills-1x6" role="tab" aria-controls="pills-home" aria-selected="true">Blog & Makale</a>
		</li>
	</ul>
</div>
<div class="tab-pane fade active show" id="pills-1x1" role="tabpanel" aria-labelledby="pills-1x1-tab">
	<div class="row">
		<div class="col-md-8">
			<?php if($home = $space->homeIntro()) { ?>
				<form class="action_form_submit" method="POST">
					<input type="hidden" name="page" value="theme">
					<input type="hidden" name="olay" value="spaceHomeIntro">
					<input type="hidden" name="yontem" value="json">
					<div class="card">
						<div class="card-header">
							<div class="box-title">Intro Tercihi</div>
						</div>
						<div class="card-body">
							<p>Site genelinde tüm intro alanlarının nasıl görüneceğini belirleyin. Full Width seçimi intronun tam genişlikte, Boxed ise kutu şeklinde olmasını belirler.</p>
							<div class="form-group">
								<select class="form-control" name="data[item2][width]" required="">
									<option value="full" <?php echo $home["width"] == "full" ? 'selected':'';?>>Full Width</option>
									<option value="boxed" <?php echo $home["width"] == "boxed" ? 'selected':'';?>>Boxed</option>
								</select>
							</div>
						</div>
						<div class="card-header">
							<div class="box-title">Intro Modeli</div>
						</div>
						<div class="card-body">
							<p>Anasayfada yer alan intro modelini seçip düzenleme yapın.</p>
							<div class="form-group">
								<select class="form-control" name="data[item2][include]" id="intromodel">
									<option value="introFast" <?php echo $home["include"] == "introFast" ? 'selected':'';?>>Text + Buton + Hızlı Sipariş</option>
									<option value="introSearch" <?php echo $home["include"] == "introSearch" ? 'selected':'';?>>Text + Sipariş Sorgula</option>
									<option value="introShow" <?php echo $home["include"] == "introShow" ? 'selected':'';?>>Text + Buton + Görsel</option>
									<option value="introText" <?php echo $home["include"] == "introText" ? 'selected':'';?>>Text + Buton </option>
								</select>
							</div>
							<div class="intromodel" id="introFast">
								<div class="form-row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="font-weight-bold">Başlık</label>
											<input type="text" class="form-control" name="data[item2][headLine]" placeholder="Başlık Girin" value="<?php echo $home["headLine"];?>">
										</div>
										<div class="form-group">
											<label class="font-weight-bold">Açıklama</label>
											<textarea class="form-control" name="data[item2][description]" placeholder="Açıklama Girin"><?php echo $home["description"];?></textarea>
										</div>
									</div>
									<div class="intro-butonlar mt-3 w-100">
										<div class="form-row">
											<div class="col-md-12">
												<label class="font-weight-bold">Butonlar</label>
												<div class="form-group">
													<select class="form-control" name="data[item2][button]" required="">
														<option value="1" <?php echo $home["button"] == "1" ? 'selected':'';?>>Aktif</option>
														<option value="0" <?php echo $home["button"] == "0" ? 'selected':'';?>>Pasif</option>
													</select>
												</div>
											</div>
											<?php foreach ($home["buttons"] as $key => $value) { ?>
												<div class="col-md-4">
													<div class="form-group">
														<div class="input-group">
															<div class="butto butto-light mr-1 smgir">
																<i id="iconView_HomeButton<?php echo $key;?>" class="<?php echo $value->icon;?>" aria-hidden="true"></i>
															</div>
															<input class="form-control smginx" id="iconInput_HomeButton<?php echo $key;?>"  name="data[item2][buttons][<?php echo $key;?>][icon]" value="<?php echo $value->icon;?>">
															<button type="button"
															class="butto butbor butto-dark icon-modal"
															data-toggle="modal"
															data-target="#iconSec"
															data-icon="<?php echo $value->icon;?>"
															data-add="HomeButton<?php echo $key;?>">Icon Seç</button>
														</div>
														<input type="text" class="form-control mt-2" name="data[item2][buttons][<?php echo $key;?>][text]" placeholder="Buton Yazısı" value="<?php echo $value->text;?>">
													</div>
												</div>
											<?php } ?>
										</div>
									</div>
									<div class="intro-gorseli mt-3 d-none">
										<label class="font-weight-bold">Görsel</label>
										<div class="row">
											<div class="col-md-5">
												<div class="onecik-onizle ortambut" data-ortam="spaceIntroImage" data-url="<?php echo $space->imagePath($home["image"]);?>" data-input="<?php echo $home["image"];?>">
													<img class="ortam-sec" src="<?php echo ns_filter('siteurl').'panel/images/ortam-sec.png';?>">
													<div class="tumb-oniztext">
														<img id="spaceIntroImage-onizleme" src="<?php echo $space->imagePath($home["image"]);?>">
														<input type="hidden" id="spaceIntroImage-input" name="data[item2][image]" required="" value="<?php echo $home["image"];?>">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check" aria-hidden="true"></i> Kaydet</button>
						</div>
					</div>
				</form>
			<?php } ?>
		</div>
		<div class="col-md-4">
			<form class="action_form_submit" method="POST">
				<input type="hidden" name="page" value="theme">
				<input type="hidden" name="olay" value="spaceIntroBack">
				<input type="hidden" name="yontem" value="json">
				<div class="card mb-4">
					<div class="card-header">
						<div class="box-title">Intro Arkaplan</div>
						<button class="butto butto-success butbor butto-xs pull-right"><i class="fas fa-check" aria-hidden="true"></i> Kaydet</button>
					</div>
					<div class="card-body selected" style="margin-bottom: 0">
						<div class="onecik-onizle ortambut" data-ortam="introBack" data-url="<?php echo $space->imagePath(ns_filter('spaceIntroBack'));?>" data-input="<?php echo ns_filter('spaceIntroBack');?>">
							<img class="ortam-sec" src="<?php echo ns_filter('siteurl').'panel/images/ortam-sec.png';?>">
							<div class="tumb-oniztext">
								<img id="introBack-onizleme" src="<?php echo $space->imagePath(ns_filter('spaceIntroBack'));?>">
								<input type="hidden" id="introBack-input" name="data[item2]" required="" value="<?php echo ns_filter('spaceIntroBack');?>">
							</div>
						</div>
						<div class="mt-2">
							<div class="alert alert-success"> <p class="mb-0">Bu arkaplan anasayfa ve diğer tüm sayfalardaki intro alanları için geçerlidir.</p>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="tab-pane fade" id="pills-1x2" role="tabpanel" aria-labelledby="pills-1x2-tab">
	<div class="row">
		<div class="col-md-8">
			<?php if($mainlist = $space->settingJson("spaceMainList")) { ?>
				<form class="action_form_submit" method="POST">
					<input type="hidden" name="page" value="theme">
					<input type="hidden" name="olay" value="spaceMainList">
					<input type="hidden" name="yontem" value="json">
					<div class="card">
						<div class="card-header">
							<div class="box-title">Hizmet Alanı</div>
						</div>
						<div class="card-body">
							<p>Anasayfada hizmet listesinin görünmesi için aktif, görünmemesi için pasif'i seçin.</p>
							<div class="form-group">
								<select class="form-control" name="data[item2][statu]">
									<option value="1" <?php echo $mainlist["statu"] == "1" ? 'selected':'';?>>Aktif</option>
									<option value="0" <?php echo $mainlist["statu"] == "0" ? 'selected':'';?>>Pasif</option>
								</select>
							</div>
						</div>
						<div class="card-header">
							<div class="box-title">Hizmet Alanı Tercihleri</div>
						</div>
						<div class="card-body">
							<label class="font-weight-bold">Görünen Miktar</label>
							<p>Bu alan sadece masaüstü sürümünde görünür alanda kaç adet olacağını belirler. Detalı Bilgi için Bilgi Kutusunu İnceleyin.</p>
							<div class="form-group">
								<select class="form-control" name="data[item2][viewCount]">
									<option value="3" <?php echo $mainlist["viewCount"] == "3" ? 'selected':'';?>>3</option>
									<option value="4" <?php echo $mainlist["viewCount"] == "4" ? 'selected':'';?>>4</option>
									<option value="5" <?php echo $mainlist["viewCount"] == "5" ? 'selected':'';?>>5</option>
								</select>
							</div>
							<label class="font-weight-bold">Liste Tercihi</label>
							<p>İlgili alanda listelemek istediğiniz özelliği belirleyin.</p>
							<div class="form-group">
								<select class="form-control" name="data[item2][options]">
									<option value="0" <?php echo $mainlist["options"] == "0" ? 'selected':'';?>>Platformları Listele</option>
									<?php
									foreach ($platform->all(0,100) as $pt) {
										extract($pt);
										?>
										<option value="<?php echo $pt_id;?>" <?php echo $mainlist["options"] == $pt_id ? 'selected':'';?>><?php echo $pt_name;?> Kategorileri</option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="card-header">
							<div class="box-title">Mobil Tercihi</div>
						</div>
						<div class="card-body">
							<label class="font-weight-bold">Hizmetlerin Mobil Görünümü</label>
							<p>Masaüstünde kaydırmalı olan hizmetler alanını mobilde kaydırmalı veya alt alta listeleme şeklinde gösterebilirsiniz..</p>
							<div class="form-group">
								<select class="form-control" name="data[item2][mobile]">
									<option value="op1" <?php echo (isset($mainlist["mobile"]) AND $mainlist["mobile"] == "op1") ? 'selected':'';?>>Kaydırmalı</option>
									<option value="op2" <?php echo (isset($mainlist["mobile"]) AND $mainlist["mobile"] == "op2") ? 'selected':'';?>>Alt Alta Göster</option>
								</select>
							</div>
							<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check" aria-hidden="true"></i> Kaydet</button>
						</div>
					</div>
				</form>
			<?php } ?>
		</div>
		<div class="col-md-4">
			<div class="card bilgi-box">
				<div class="card-header">
					<div class="box-title font-weight-bold">Bilgi Kutusu <i class="fas fa-chevron-right"></i></div>
				</div>
				<div class="card-body">
					<div class="bb-box">
						<span class="bb-title">Görünen Miktar Nedir?</span>
						Hizmet listesi anasayfada intronun altında yer alan kısımdır. Bu kısımda seçmiş olduğunuz tercihe göre tüm platformlar veya seçilen platfroma ait tüm kategoriler listelenir. Ancak slider alanında sadece belirlediğiniz miktarda eleman gözükür, diğer elemanları görmek için slider'ın kaydırılması gerekir.
						<hr>
						<span class="bb-title">Hizmet Liste Tercihi Nedir?</span>
						Hizmetler alanında isterseniz hizmetini sunduğunuz platformları, isterseniz seçmiş olduğunuz bir platforma ait kategorileri listeyelebilirsiniz.
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
				<div class="card-body">
					<?php if($whyBox = $space->whyUs()) { ?>
						<form class="action_form_submit" method="POST">
							<input type="hidden" name="page" value="theme">
							<input type="hidden" name="olay" value="spaceWhyUs">
							<input type="hidden" name="yontem" value="json">
							<div class="form-row">
								<div class="col-md-12">
									<label class="font-weight-bold mb-0">Alan Bilgileri</label>
									<p>İlgili alan için bilgileri girin.</p>
									<div class="form-row">
										<div class="col-md-4">
											<div class="form-group">
												<input type="text" class="form-control" name="data[item2][headLine]" placeholder="Üst Başlık (İsteğe Bağlı)" value="<?php echo $whyBox["headLine"];?>">
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<input type="text" class="form-control" name="data[item2][headFirst]" placeholder="Ana Başlık" value="<?php echo $whyBox["headFirst"];?>">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<textarea class="form-control" name="data[item2][description]" placeholder="Açıklama"><?php echo $whyBox["description"];?></textarea>
											</div>
										</div>
									</div>
									<label class="font-weight-bold mb-0">Kutucuklar</label>
									<p>Kutucukları oluşturun.</p>
									<div class="why-list">
										<?php foreach ($whyBox["items"] as $key => $value) { ?>
											<div class="why-element">
												<div class="form-row">
													<div class="col-md-4">
														<div class="form-group">
															<div class="input-group">
																<div class="butto butto-light mr-1 smgir">
																	<i id="iconView_whyBox<?php echo $key;?>" class="<?php echo $value->icon;?>" aria-hidden="true"></i>
																</div>
																<input class="form-control smginx" id="iconInput_whyBox<?php echo $key;?>" name="data[item3][<?php echo $key;?>][icon]" value="<?php echo $value->icon;?>">
																<button type="button"
																class="butto butbor butto-dark icon-modal"
																data-toggle="modal"
																data-target="#iconSec"
																data-icon="<?php echo $value->icon;?>"
																data-add="whyBox<?php echo $key;?>">Icon Seç</button>
															</div>
														</div>
													</div>
													<div class="col-md-8">
														<div class="form-group">
															<input type="text" class="form-control" name="data[item3][<?php echo $key;?>][head]" placeholder="Başlık" value="<?php echo $value->head;?>">
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<textarea class="form-control" name="data[item3][<?php echo $key;?>][description]"><?php echo $value->description;?></textarea>
														</div>
													</div>
												</div>
											</div>
										<?php } ?>
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
						<span class="bb-title">Kaç Adet Eklenir?</span>
						Bu alanda sabit 4 kutu bulunur ve hepsinin doldurulması gerekir.
						<hr>
						<span class="bb-title">Kullanmak İstemiyorum</span>
						Alanı pasifleştirme gibi bir imkan bulunmamaktadır.
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="tab-pane fade" id="pills-1x4" role="tabpanel" aria-labelledby="pills-1x4-tab">
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-body">
					<?php if($comment = $space->comment()) { ?>
						<form class="action_form_submit" method="POST">
							<input type="hidden" name="page" value="theme">
							<input type="hidden" name="olay" value="spaceComment">
							<input type="hidden" name="yontem" value="json">
							<div class="form-row">
								<div class="col-md-12">
									<label class="font-weight-bold mb-0">Alan Bilgileri</label>
									<p>İlgili alan için bilgileri girin.</p>
									<div class="form-row">
										<div class="col-md-4">
											<div class="form-group">
												<input type="text" class="form-control" name="data[item2][headLine]" placeholder="Üst Başlık (İsteğe Bağlı)" value="<?php echo $comment["headLine"];?>">
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<input type="text" class="form-control" name="data[item2][headFirst]" placeholder="Ana Başlık" value="<?php echo $comment["headFirst"];?>">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<textarea class="form-control" name="data[item2][description]" placeholder="Açıklama"><?php echo $comment["description"];?></textarea>
											</div>
										</div>
									</div>
									<label class="font-weight-bold mb-0">Yorumlar</label>
									<p>Yorum oluşturun.</p>
									<div class="com-list">
										<?php foreach ($comment["items"] as $key => $value) { ?>
											<div class="com-element">
												<div class="form-row">
													<div class="col com-img-area">
														<div class="onecik-onizle ortambut" data-ortam="commentAvatar<?php echo $key;?>" data-url="<?php echo $space->imagePath($value->avatar);?>" data-input="<?php echo $value->avatar;?>">
															<img class="ortam-sec" src="<?php echo ns_filter('siteurl').'panel/images/ortam-sec.png';?>">
															<div class="tumb-oniztext">
																<img id="commentAvatar<?php echo $key;?>-onizleme" src="<?php echo $space->imagePath($value->avatar);?>">
																<input type="hidden" id="commentAvatar<?php echo $key;?>-input" name="data[item3][<?php echo $key;?>][avatar]" required="" value="<?php echo $value->avatar;?>">
															</div>
														</div>
													</div>
													<div class="col">
														<div class="form-row">
															<div class="col-md-4">
																<div class="form-group">
																	<input type="text" class="form-control" required="" name="data[item3][<?php echo $key;?>][name]" placeholder="Müşteri Adı" value="<?php echo $value->name;?>">
																</div>
															</div>
															<div class="col-md-8">
																<div class="form-group">
																	<input type="text" class="form-control" required="" name="data[item3][<?php echo $key;?>][job]" placeholder="Mesleği" value="<?php echo $value->job;?>">
																</div>
															</div>
															<div class="col-md-12">
																<div class="form-group">
																	<textarea class="form-control" required="" name="data[item3][<?php echo $key;?>][comment]"><?php echo $value->comment;?></textarea>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<?php $lastKey = $key; } ?>
										</div>
										<?php $comLastkey = isset($lastKey) ? ($lastKey+1):'0';
										echo '<script> comLastkey = '.$comLastkey.';</script>';
										?>
										<div class="text-center mt-2">
											<button type="button" id="comekle" class="butto butto-primary butbor mb-3"><i class="fas fa-plus" aria-hidden="true"></i> Yeni Ekle</button><button type="button" id="comcikar" class="butto butto-danger butbor ml-2 mb-3"><i class="fas fa-trash" aria-hidden="true"></i> Çıkar</button>
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
							<span class="bb-title">Kaç Adet Eklenir?</span>
							Müşteri yorumlarını diledğiniz şekilde artırabilir veya azaltabilirsiniz.
							<hr>
							<span class="bb-title">Kullanmak İstemiyorum</span>
							Alanı pasifleştirme gibi bir imkan bulunmamaktadır.
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="tab-pane fade" id="pills-1x5" role="tabpanel" aria-labelledby="pills-1x5-tab">
		<?php if($homeSss = $space->homeSss()){ ?>
			<form class="action_form_submit" method="POST">
				<div class="row">
					<div class="col-md-8">
						<input type="hidden" name="page" value="theme">
						<input type="hidden" name="olay" value="spaceHomeSss">
						<input type="hidden" name="yontem" value="json">
						<div class="card mb-3">
							<div class="card-header border-0">
								<div class="box-title">Soru ve Cevaplar</div>
							</div>
						</div>
						<div class="faq-list">
							<?php foreach (array_merge($homeSss["items"]["left"],$homeSss["items"]["right"]) as $key => $value) { ?>
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
							<?php $cSssLastKey = isset($cSssLastKey) ? ($cSssLastKey+1):0;
							echo '<script>cSssKey = '.$cSssLastKey.';</script>'; } ?>
						</div>
						<div class="col-md-4">
							<div class="card">
								<div class="card-header">
									<div class="box-title">
										Sıkça Sorulan Sorular
									</div>
								</div>
								<div class="card-body">
									<div class="form-row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="font-weight-bold">Üst Başlık</label>
												<input type="text" class="form-control" name="data[item2][headLine]" placeholder="S.S.S. Üst Başlık" value="<?php echo $homeSss["headLine"];?>">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="font-weight-bold">Ana Başlık</label>
												<input type="text" class="form-control" name="data[item2][headFirst]" placeholder="S.S.S. Ana Başlık" value="<?php echo $homeSss["headFirst"];?>">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="font-weight-bold">Açıklama</label>
												<textarea class="form-control" name="data[item2][description]"><?php echo $homeSss["description"];?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="w-100">
								<button type="submit" class="butto butto-xl butto-success butbor w-100 mt-2 mb-5"><i class="fas fa-check" aria-hidden="true"></i> Kaydet</button>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="tab-pane fade" id="pills-1x6" role="tabpanel" aria-labelledby="pills-1x6-tab">
				<div class="row">
					<div class="col-md-8">
						<div class="card">
							<div class="card-body">
								<?php if($blog = $space->settingJson("spaceBlogView",1)) { ?>
									<form class="action_form_submit" method="POST">
										<input type="hidden" name="page" value="theme">
										<input type="hidden" name="olay" value="spaceBlogView">
										<input type="hidden" name="yontem" value="json">
										<div class="form-row">
											<div class="col-md-3">
												<div class="form-group">
													<label class="font-weight-bold">Başlık</label>
													<input type="text" class="form-control" name="data[item2][headLine]" required="" placeholder="Başlık Girin" value="<?php echo $blog["headLine"];?>">
												</div>
											</div>
											<div class="col-md-9">
												<div class="form-group">
													<label class="font-weight-bold">Açıklama</label>
													<textarea class="form-control" required="" name="data[item2][description]"><?php echo $blog["description"];?></textarea>
												</div>
											</div>
											<div class="col-md-12">
												<label class="font-weight-bold">Gösterim Tercihi</label>
												<select class="form-control mb-3" name="data[item2][statu]">
													<option value="0" <?php echo $blog["statu"]=="0" ? 'selected':'';?>>Sadece Son Bloglarımı Listele</option>
													<option value="1" <?php echo $blog["statu"]=="1" ? 'selected':'';?>>Bloglarımı Listele ve Alt Bölümde Seçtiğim Sayfanın İçeriğini Göster</option>
													<option value="2" <?php echo $blog["statu"]=="2" ? 'selected':'';?>>Bloglarımı Gizle ve O Bölümde Sadece Seçtiğim Sayfanın İçeriğini Göster</option>
												</select>
											</div>
											<div class="col-md-12">
												<label class="font-weight-bold">İçeriği Gösterilecek Sayfa Tercihi</label>
												<?php $icerik = isset($icerik) ? $icerik : new Icerik($db);?>
												<select class="form-control mb-3" name="data[item2][page]">
													<?php
													$icerik->sayfa_tur = "sayfa";
													foreach ($icerik->all(0,100) as $value) {
														extract($value); ?>
														<option value="<?php echo $sayfa_id;?>" <?php echo $sayfa_id == $blog["page"] ? 'selected':'';?>><?php echo $sayfa_baslik;?></option>
													<?php } ?>
												</select>
												<div class="alert alert-success">
													<p class="mb-0">Ana sayfada makale yayınlamak isterseniz içerik yönetiminden sayfa türünde bir içerik oluşturun ve buradan o içeriği seçerek ayarları kaydedin.</p>
												</div>
											</div>
										</div>
										<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check" aria-hidden="true"></i> Kaydet</button>
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
									<span class="bb-title">Anasayfaya Makale Nasıl Eklerim?</span>
									Gösterim tercihi kısmından blog & makale veya sadece makale seçeneğini seçin. İçerikler >  Sayfalar kısmında oluşturmuş olduğunuz bir sayfayı Gösterilecek Sayfa Tercihi olarak belirleyin.
									Seçmiş olduğunuz sayfanın içeriği makale alanına eklenecektir.
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>