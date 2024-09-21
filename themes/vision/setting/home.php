<div class="tab-alani">
	<ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
		<li class="nav-item">
			<a class="nav-link gri alti active show" id="pills-1x0-tab" data-toggle="pill" href="#pills-1x0" role="tab" aria-controls="pills-home" aria-selected="true">Sıralama</a>
		</li>
		<li class="nav-item">
			<a class="nav-link gri alti" id="pills-1x1-tab" data-toggle="pill" href="#pills-1x1" role="tab" aria-controls="pills-home" aria-selected="true">Intro ve Hizmetler</a>
		</li>
		<li class="nav-item">
			<a class="nav-link gri alti" id="pills-1x2-tab" data-toggle="pill" href="#pills-1x2" role="tab" aria-controls="pills-home" aria-selected="true">Neden Biz?</a>
		</li>
		<li class="nav-item">
			<a class="nav-link gri alti" id="pills-1x3-tab" data-toggle="pill" href="#pills-1x3" role="tab" aria-controls="pills-home" aria-selected="true">Müşteri Yorumları</a>
		</li>
		<li class="nav-item">
			<a class="nav-link gri alti" id="pills-1x4-tab" data-toggle="pill" href="#pills-1x4" role="tab" aria-controls="pills-home" aria-selected="true">Hakkımızda</a>
		</li>
		<li class="nav-item">
			<a class="nav-link gri alti" id="pills-1x5-tab" data-toggle="pill" href="#pills-1x5" role="tab" aria-controls="pills-home" aria-selected="true">S.S.S</a>
		</li>
		<li class="nav-item">
			<a class="nav-link gri alti denemeTikla" id="pills-1x6-tab" data-toggle="pill" href="#pills-1x6" role="tab" aria-controls="pills-home" aria-selected="true">Blog</a>
		</li>
	</ul>
</div>
<div class="tab-pane fade active show" id="pills-1x0" role="tabpanel" aria-labelledby="pills-1x0-tab">
	<div class="row">
		<div class="col-md-8">
			<div class="homeListingArea">
				<div class="text-right mb-3">
					<button type="button" class="butto butto-light butto-xs butbor"  onclick="homeListing(this);" data-key="1" data-type="reset"><i class="fas fa-redo-alt"></i> Sıralamayı Sıfırla</button>
				</div>
				<div class="HomeListing">
                    
					<?php foreach ($loftAlignment["list"] as $key => $value) {
						include "include/siralama.php";
					 } ?>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card bilgi-box">
				<div class="card-header">
					<div class="box-title font-weight-bold">Bilgi Kutusu
						<i class="fas fa-chevron-right" aria-hidden="true"></i>
					</div>
				</div>
				<div class="card-body" style="">
					<div class="bb-box">
						<span class="bb-title">Sıralama Nedir?</span>
						Anasayfada bulunan bölümleri istediğiniz sıralamada gösterebilirsiniz. Intro alanı hariç tüm bölümleri farklı sıralamaya sokabilirsiniz.
					</div>
					<hr>
					<div class="bb-box">
						<span class="bb-title">Göster Gizle Nedir?</span>
						Anasayfada yer alan bölümler arasında göstermek/kullanmak istemediğiniz, alanları gizleyebilirsiniz.
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="tab-pane fade" id="pills-1x1" role="tabpanel" aria-labelledby="pills-1x1-tab">
	<div class="row">
		<div class="col-md-8">
			<form class="loftForm" method="POST">
				<input type="hidden" name="olay" value="loftOptions">
				<input type="hidden" name="page" value="theme">
				<input type="hidden" name="loftAction" value="generalSave">
				<div class="card">
					<div class="card-header">
						<span class="box-title font-weight-bold">Intro ve Hizmetler</span>
					</div>
					<div class="card-body pb-2">
						<div class="form-row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold mb-2">Intro ve Hizmet Yerleşimi</label>
									<select class="form-control" name="data[loftSlideOptions][item2][class]">
										<option value="one" <?php echo $loftSlideOptions["class"]=="one" ? 'selected':'';?>>Hizmetler Üstte İntro Altta</option>
										<option value="two" <?php echo $loftSlideOptions["class"]=="two" ? 'selected':'';?>>İntro Üstte Hizmetler Altta</option>
										<option value="three" <?php echo $loftSlideOptions["class"]=="three" ? 'selected':'';?>>Hizmetler Üstte İntro Altta (Mobilde Tersi)</option>
										<option value="four" <?php echo $loftSlideOptions["class"]=="four" ? 'selected':'';?>>İntro Üstte Hizmetler Altta (Mobilde Tersi)</option>
										<option value="one noneService" <?php echo $loftSlideOptions["class"]=="one noneService" ? 'selected':'';?>>Sadece Intro - Hizmet Listesi Yok</option>
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold mb-2">Hizmet Listeleme Tercihi</label>
									<select class="form-control" name="data[loftSlideOptions][item2][option]">
										<option value="platform" <?php echo $loftSlideOptions["option"]=="platform" ? 'selected':'';?>>Platformları Listele</option>
										<?php foreach ($platformList as $value) { ?>
										<option value="<?php echo $value["pt_id"];?>" <?php echo $loftSlideOptions["option"]==$value["pt_id"] ? 'selected':'';?>><?php echo $value["pt_name"];?> Kategorilerini Listele</option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="card-header">
						<span class="box-title font-weight-bold">Intro İçeriği</span>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold mb-2">Üst Satır</label>
									<input type="text" class="form-control" name="data[loftSlideOptions][item2][head]" placeholder="Örn: Sosyal Medya'da" value="<?php echo $loftSlideOptions["head"];?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-weight-bold mb-2">Alt Satır</label>
									<input type="text" class="form-control" name="data[loftSlideOptions][item2][headLine]" placeholder="Örn: Gücüne Güç Kat!" value="<?php echo $loftSlideOptions["headLine"];?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-weight-bold mb-2">Alt Satır Rengi</label>
									<div class="input-group mb-2 renkhover">
										<div class="butto mr-1 smgir rengiyazdir" id="introColor" style="background: <?php echo $loftSlideOptions["introColor"];?>;">
										</div>
										<input type="text" class="form-control renksecici smginx" name="data[loftSlideOptions][item2][introColor]" data-renk="introColor" required="" value="<?php echo $loftSlideOptions["introColor"];?>">
										<input type="hidden" data-renkRgb="introColor" name="data[loftSlideOptions][item2][introColorRgb]" value="<?php echo $loftSlideOptions["introColorRgb"];?>">
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold mb-2">Açıklama</label>
									<textarea class="form-control" name="data[loftSlideOptions][item2][description]" placeholder="Kısa Açıklama"><?php echo $loftSlideOptions["description"];?></textarea>
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
		<div class="col-md-4">
			<form class="loftForm" method="POST">
				<input type="hidden" name="olay" value="loftOptions">
				<input type="hidden" name="page" value="theme">
				<input type="hidden" name="loftAction" value="generalSave">
				<div class="card mb-4">
					<div class="card-header">
						<div class="box-title">Intro Arkaplan</div>
						<button class="butto butto-success butbor butto-xs pull-right">
						<i class="fas fa-check" aria-hidden="true"></i> Kaydet
						</button>
					</div>
					<div class="card-body selected" style="margin-bottom: 0">
						<div class="onecik-onizle ortambut" data-ortam="introBack" data-url="<?php echo $loft->path($loftSlideOptions["item3"],"img");?>" data-input="<?php echo $loftSlideOptions["item3"];?>">
							<img class="ortam-sec" src="https://demo.nivusoft.com/space/panel/images/ortam-sec.png">
							<div class="tumb-oniztext">
								<img id="introBack-onizleme" src="<?php echo $loft->path($loftSlideOptions["item3"],"img");?>">
								<input type="hidden" id="introBack-input" name="data[loftSlideOptions][item3]" required="" value="<?php echo $loftSlideOptions["item3"];?>">
							</div>
						</div>
						<div class="mt-2">
							<div class="alert alert-success mb-0 text-center">
								<p class="mb-0">Anasayfa ve diğer tüm intro alanları için geçerlidir!</p>
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
		<div class="col-md-4">
			<div class="card bilgi-box mb-3 active">
				<div class="card-header border-bottom-0">
					<div class="box-title font-weight-bold">Alan Bilgileri
						<i class="fas fa-chevron-right"></i>
					</div>
				</div>
				<div class="card-body" style="display: none;">
					<form class="loftForm" method="POST">
						<input type="hidden" name="olay" value="loftOptions">
						<input type="hidden" name="page" value="theme">
						<input type="hidden" name="loftAction" value="generalSave">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold">Üst Başlık</label>
									<input type="text" class="form-control" name="data[loftWhyOur][item3][head]" required="" value="<?php echo $loftWhyOur["head"];?>" placeholder="Birçok Site Varken">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold">Alt Başlık</label>
									<input type="text" class="form-control" name="data[loftWhyOur][item3][headTitle]" required="" value="<?php echo $loftWhyOur["headTitle"];?>" placeholder="Birçok Site Varken">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold">Açıklama</label>
									<textarea name="data[loftWhyOur][item3][description]" class="form-control" required="" placeholder="Birçok Site Varken"><?php echo $loftWhyOur["description"];?></textarea>
								</div>
							</div>
							<div class="col-md-12">
								<button type="submit" class="butto butto-lg butto-success butbor pull-right">
								<i class="fas fa-check" aria-hidden="true"></i> Kaydet
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="card bilgi-box mb-3">
				<div class="card-header">
					<div class="box-title font-weight-bold">Yeni Eleman Ekle
						<i class="fas fa-chevron-right"></i>
					</div>
				</div>
				<div class="card-body">
					<form class="loftForm" method="POST">
						<input type="hidden" name="olay" value="loftOptions">
						<input type="hidden" name="page" value="theme">
						<input type="hidden" name="loftAction" value="whyOurNew">
						<div class="row">
							<div class="col-md-12">
								<div class="thumb mb-3">
									<div class="onecik-onizle ortambutLoft" data-ortam="WhyourImage" data-url="https://nivuu.com/space/upload\/why3-429477.jpg" data-input="upload\/why3-429477.jpg">
										<img class="ortam-sec" src="https://demo.nivusoft.com/space/panel/images/ortam-sec.png">
										<div class="tumb-oniztext">
											<img id="WhyourImage-onizleme" style="max-width: 200px" src="https://nivuu.com/space/panel/images/load-img.png">
											<input type="hidden" id="WhyourImage-input" name="data[loftWhyOur][image]" required="" value="upload\/why3-429477.jpg">
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold">Özel Renk</label>
									<div class="input-group mb-2 renkhover">
										<div class="butto mr-1 smgir rengiyazdir" id="colorWhy" style="background:#841919;">
										</div>
										<input type="text" class="form-control renksecici smginx" name="data[loftWhyOur][colorDefault]" data-renk="colorWhy" required="" value="#841919">
										<input type="hidden" data-renkRgb="colorWhy" name="data[loftWhyOur][colorDefaultRgb]" value="128, 24, 24">
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold">İcon</label>
									<div class="input-group">
										<div class="butto butto-light mr-1 smgir">
											<i id="iconView_WhyourIcon" class="fas fa-user" aria-hidden="true"></i>
										</div>
										<input class="form-control smginx" id="iconInput_WhyourIcon" name="data[loftWhyOur][icon]" value="fas fa-user">
										<button type="button" id="iconButton_WhyourIcon" class="butto butbor butto-dark icon-modal" data-toggle="modal" data-target="#iconSec" data-icon="fas fa-user" data-add="WhyourIcon">Icon Seç
										</button>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold">Üst Başlık</label>
									<input type="text" class="form-control" name="data[loftWhyOur][head]" required="" value="Birçok Site Varken" placeholder="Birçok Site Varken">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold">Kısa Açıklama</label>
									<textarea name="data[loftWhyOur][description]" class="form-control" required="" placeholder="Birçok Site Varken">Lorem ipsum dolor sit amet consectetur adipisicing, elit architecto.</textarea>
								</div>
							</div>
						</div>
						<button type="submit" class="butto butto-lg butto-success butbor pull-right">
						<i class="fas fa-check" aria-hidden="true"></i> Yeni Ekle
						</button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="alert alert-light">
				<p class="mb-0">En az 3 adet eleman bulunması gerekir. İlgili alanı kullanmak istemiyorsanız <strong>Anasayfa » Sıralama</strong> bölümünden gizleyebilirsiniz.</p>
			</div>
			<form class="loftForm" method="POST" id="whyOur">
				<input type="hidden" name="olay" value="loftOptions">
				<input type="hidden" name="page" value="theme">
				<input type="hidden" name="loftAction" value="generalSave">
				<div class="whyusSet">
					<div id="whyOurList">
						<?php
						$key = 0;
						foreach ($loftWhyOur["list"] as $value) {
							include __DIR__."/include/whyOur.php";
						$key++;} ?>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="tab-pane fade" id="pills-1x3" role="tabpanel" aria-labelledby="pills-1x3-tab">
	<form class="loftForm" method="POST" id="commentForm">
		<input type="hidden" name="olay" value="loftOptions">
		<input type="hidden" name="page" value="theme">
		<input type="hidden" name="loftAction" value="generalSave">
		<div class="row">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<span class="box-title">Müşteri Yorumları</span>
					</div>
					<div class="card-body">
						<div id="commentList">
							<?php if(isset($loftCustomerComment["list"]) AND is_array($loftCustomerComment["list"])) { ?>
							<?php foreach ($loftCustomerComment["list"] as $key => $value) {
								include __DIR__."/include/commentList.php";
							}  } ?>
							<input type="hidden" name="commentActionType" value="">
						</div>
						<div class="text-center mt-3">
							<button type="button" data-form="commentForm" class="butto butto-primary butbor mb-1 loftCommentNew">
							<i class="fas fa-plus" aria-hidden="true"></i> Yeni Ekle
							</button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card bilgi-box">
					<div class="card-header">
						<div class="box-title font-weight-bold">Alan Bilgileri
							<i class="fas fa-chevron-right" aria-hidden="true"></i>
						</div>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col-md-12">
								<div class="form-group">
									<input type="text" class="form-control" name="data[loftCustomerComment][item2][head]" placeholder="Üst Başlık (İsteğe Bağlı)" value="<?php echo $loftCustomerComment["head"];?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="text" class="form-control" name="data[loftCustomerComment][item2][headTitle]" required="" placeholder="Ana Başlık" value="<?php echo $loftCustomerComment["headTitle"];?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<textarea class="form-control" name="data[loftCustomerComment][item2][description]" required="" placeholder="Açıklama"><?php echo $loftCustomerComment["description"];?></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
				<button type="submit" class="butto butto-lg butto-success butbor pull-right">
				<i class="fas fa-check" aria-hidden="true"></i> Değişiklikleri Kaydet
				</button>
			</div>
		</div>
	</form>
</div>
<div class="tab-pane fade" id="pills-1x4" role="tabpanel" aria-labelledby="pills-1x4-tab">
	<form class="loftForm" method="POST">
		<input type="hidden" name="olay" value="loftOptions">
		<input type="hidden" name="page" value="theme">
		<input type="hidden" name="loftAction" value="generalSave">
		<div class="row">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<span class="box-title">Hakkımızda İçeriği</span>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col-md-6">
								<div class="form-group">
									<input type="text" class="form-control" name="data[loftMainAbout][item2][head]" placeholder="Üst Başlık (İsteğe Bağlı)" value="<?php echo $loftMainAbout["head"];?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input type="text" class="form-control" name="data[loftMainAbout][item2][headTitle]" placeholder="Ana Başlık" value="<?php echo $loftMainAbout["headTitle"];?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<textarea id="editor"><?php echo $loftMainAbout["content"];?></textarea>
									<input type="hidden" id="editorAfter" name="data[loftMainAbout][item2][content]" value="<?php echo $loftMainAbout["content"];?>">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card mt-3">
					<div class="card-header">
						<span class="box-title">
							Kutucuklar
						</span>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold mb-2">Kutucuk Durumu</label>
									<select class="form-control" name="data[loftMainAbout][item2][boxStatu]"  data-showHide="true" data-class='div[id="areaStatu"]'>
										<option value="aktif" <?php echo $loftMainAbout["boxStatu"]=="aktif" ? 'selected':'';?>>Aktif</option>
										<option value="pasif" <?php echo $loftMainAbout["boxStatu"]=="pasif" ? 'selected':'';?>>Pasif</option>
									</select>
								</div>
							</div>
							<div class="col-md-12" id="areaStatu" style="<?php echo $loftMainAbout["boxStatu"]=="pasif" ? 'display: none;':'';?>">
								<div class="row">
									<?php foreach ($loftMainAbout["box"] as $key => $value) { ?>
									<div class="col-md-4">
										<div class="form-group">
											<label class="font-weight-bold mb-2">İcon Seç</label>
											<div class="input-group">
												<div class="butto butto-light mr-1 smgir">
													<i id="iconView_WhyourIcon<?php echo $key;?>" class="<?php echo $value["icon"];?>" aria-hidden="true"></i>
												</div>
												<input class="form-control smginx" id="iconInput_WhyourIcon<?php echo $key;?>" name="data[loftMainAbout][item2][box][<?php echo $key;?>][icon]" value="<?php echo $value["icon"];?>">
												<button type="button" id="iconButton_WhyourIcon<?php echo $key;?>" class="butto butbor butto-dark icon-modal" data-toggle="modal" data-target="#iconSec" data-icon="<?php echo $value["icon"];?>" data-add="WhyourIcon<?php echo $key;?>">Icon Seç</button>
											</div>
										</div>
										<div class="form-group">
											<input type="text" class="form-control" name="data[loftMainAbout][item2][box][<?php echo $key;?>][count]" placeholder="Üst Satır" value="<?php echo $value["count"];?>">
										</div>
										<div class="form-group">
											<input type="text" class="form-control" name="data[loftMainAbout][item2][box][<?php echo $key;?>][text]" placeholder="Alt Satır" value="<?php echo $value["text"];?>">
										</div>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card mb-4">
					<div class="card-header">
						<div class="box-title">Intro Arkaplan</div>
					</div>
					<div class="card-body selected" style="margin-bottom: 0">
						<div class="onecik-onizle ortambutLoft" data-ortam="loftMainAbout" data-url="<?php echo $loft->path($loftMainAbout["background"],"img");?>" data-input="<?php echo $loftMainAbout["background"];?>">
							<img class="ortam-sec" src="https://demo.nivusoft.com/space/panel/images/ortam-sec.png">
							<div class="tumb-oniztext">
								<img id="loftMainAbout-onizleme" src="<?php echo $loft->path($loftMainAbout["background"],"img");?>">
								<input type="hidden" id="loftMainAbout-input" name="data[loftMainAbout][item2][background]" required="" value="<?php echo $loftMainAbout["background"];?>">
							</div>
						</div>
						<div class="form-group mt-3">
							<label class="font-weight-bold mb-2">Görsel Modeli</label>
							<select class="form-control" name="data[loftMainAbout][item2][backgroundType]">
								<option value="styleone" <?php echo $loftMainAbout["backgroundType"]=="kare" ? 'selected':'';?>>Kare</option>
								<option value="styletwo" <?php echo $loftMainAbout["backgroundType"]=="styletwo" ? 'selected':'';?>>Yuvarlak</option>
							</select>
						</div>
						<div class="form-group">
							<label class="font-weight-bold mb-2">Buton</label>
							<select class="form-control" name="data[loftMainAbout][item2][buttonStatu]"  data-showHide="true" data-class='div[id="areaStatu3"]'>
								<option value="aktif" <?php echo $loftMainAbout["buttonStatu"]=="aktif" ? 'selected':'';?>>Aktif</option>
								<option value="pasif" <?php echo $loftMainAbout["buttonStatu"]=="pasif" ? 'selected':'';?>>Pasif</option>
							</select>
						</div>
						<div id="areaStatu3" style="<?php echo $loftMainAbout["buttonStatu"]=="pasif" ? 'display: none;':'';?>">
							<div class="form-group">
								<input type="text" class="form-control" name="data[loftMainAbout][item2][buttonText]" placeholder="Buton Yazısı" value="<?php echo $loftMainAbout["buttonText"];?>">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="data[loftMainAbout][item2][href]" placeholder="Buton URL'si" value="<?php echo $loftMainAbout["href"];?>">
							</div>
						</div>
					</div>
				</div>
				<button type="submit" data-editorAfter="editor" class="butto butto-lg butto-success butbor pull-right" data-editorAfter="editorAfter"><i class="fas fa-check" aria-hidden="true"></i> Değişiklikleri Kaydet</button>
			</div>
		</div>
	</form>
</div>
<div class="tab-pane fade" id="pills-1x5" role="tabpanel" aria-labelledby="pills-1x5-tab">
	<form class="loftForm" method="POST">
		<input type="hidden" name="olay" value="loftOptions">
		<input type="hidden" name="page" value="theme">
		<input type="hidden" name="loftAction" value="generalSave">
		<div class="row">
			<div class="col-md-8">
				<div class="card mb-3">
					<div class="card-header border-0">
						<div class="box-title">Soru ve Cevaplar
						</div>
					</div>
				</div>
				<div class="faq-list" id="faqList">
					<?php
					if(isset($loftSSS["quest"]) AND is_array($loftSSS["quest"])){
					foreach ($loftSSS["quest"] as $key => $value) { ?>
					<div class="card bilgi-box active mb-2" data-key="<?php echo $key;?>">
						<div class="card-header border-bottom-0">
							<span><?php echo $value["ques"];?></span>
							<i class="fas fa-chevron-right" aria-hidden="true"></i>
						</div>
						<div class="card-body" style="display: none;">
							<div class="faq-element mb-4">
								<div class="form-group mb-2">
									<input type="text" class="form-control" required="" name="data[loftSSS][item2][quest][<?php echo $key;?>][ques]" placeholder="Soru" value="<?php echo $value["ques"];?>" onchange="headClone(this);">
								</div>
								<div class="form-group">
									<textarea class="form-control" required="" name="data[loftSSS][item2][quest][<?php echo $key;?>][reply]" placeholder="Cevap"><?php echo $value["reply"];?></textarea>
								</div>
							</div>
							<button type="button" class="butto butto-danger butbor ml-2 mb-3" onclick="boxQuesDelete(this);">
							<i class="fas fa-trash" aria-hidden="true"></i> Sil
							</button>
						</div>
					</div>
					<?php $lastKey = $key;} } ?>
				</div>
				<button type="button" class="butto butto-primary butbor mb-3 mt-2 faqekle2">
				<i class="fas fa-plus" aria-hidden="true"></i> Soru Ekle</button>
				<script type="text/javascript">
				cSssKey = "<?php echo isset($lastKey) ? $lastKey:0;?>";
				cSssKey++;
				$('.faqekle2').click(function(){
				var htmlClone = '<div class="card bilgi-box active mb-2" data-key="'+cSssKey+'"><div class="card-header border-bottom-0" onclick="boxAcKapa(this);"><span>Yeni Soru Başlığı</span><i class="fas fa-chevron-right" aria-hidden="true"></i></div><div class="card-body" style="display: none;"><div class="faq-element mb-4"><div class="form-group mb-2"><input type="text" class="form-control" required="" name="data[loftSSS][item2][quest]['+cSssKey+'][ques]" placeholder="Soru" value="Yeni Soru Başlığı" onchange="headClone(this);"></div><div class="form-group"><textarea class="form-control" required="" name="data[loftSSS][item2][quest]['+cSssKey+'][reply]" placeholder="Cevap">Yeni soru cevap alanı</textarea></div></div><button type="button" class="butto butto-danger butbor ml-2 mb-3" onclick="boxQuesDelete(this);"><i class="fas fa-trash" aria-hidden="true"></i> Sil</button></div></div>';
				$('#faqList').append(htmlClone);
				cSssKey++;
				});
				</script>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<div class="box-title"> Sıkça Sorulan Sorular
						</div>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold">Üst Başlık</label>
									<input type="text" class="form-control" name="data[loftSSS][item2][head]" placeholder="S.S.S. Üst Başlık" value="<?php echo $loftSSS["head"];?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold">Ana Başlık</label>
									<input type="text" class="form-control" name="data[loftSSS][item2][headTitle]" placeholder="S.S.S. Ana Başlık" value="<?php echo $loftSSS["headTitle"];?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold">Açıklama</label>
									<textarea class="form-control" name="data[loftSSS][item2][description]"><?php echo $loftSSS["description"];?></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="w-100">
					<button type="submit" class="butto butto-xl butto-success butbor w-100 mt-2 mb-5">
					<i class="fas fa-check" aria-hidden="true"></i> Kaydet
					</button>
				</div>
			</div>
		</div>
	</form>
</div>
<div class="tab-pane fade" id="pills-1x6" role="tabpanel" aria-labelledby="pills-1x6-tab">
	<form class="loftForm" method="POST">
		<input type="hidden" name="olay" value="loftOptions">
		<input type="hidden" name="page" value="theme">
		<input type="hidden" name="loftAction" value="generalSave">
		<div class="row">
			<div class="col-md-8">
				<form action="">
					<div class="card">
						<div class="card-header">
							<span class="box-title">Blog Alanı</span>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label class="font-weight-bold">Başlık Üstü Yazı</label>
								<input type="text" class="form-control" name="data[loftMainBlog][item2][head]" placeholder="Örn: Son Yayınlanan" value="<?php echo $loftMainBlog["head"];?>">
							</div>
							<div class="form-group">
								<label class="font-weight-bold">Açıklama</label>
								<textarea class="form-control" required="" name="data[loftMainBlog][item2][description]"><?php echo $loftMainBlog["description"];?></textarea>
							</div>
							<input type="hidden" name="data[loftMainBlog][item2][count]" value="3">
							<div class="mb-4">
								<button type="submit" class="butto butto-lg butto-success butbor pull-right">
								<i class="fas fa-check" aria-hidden="true"></i> Kaydet
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-4">
				<div class="card bilgi-box">
					<div class="card-header">
						<div class="box-title font-weight-bold">Bilgi Kutusu
							<i class="fas fa-chevron-right" aria-hidden="true"></i>
						</div>
					</div>
					<div class="card-body">
						<div class="bb-box">
							<span class="bb-title">Anasayfada Blogları Göstermek İstemiyorum?</span> <br>
							Blog yazılarını anasayfada göstermek istemiyorsanız <strong>Anasayfa » Sıralama</strong> bölümünden blog elemanını pasif konuma getirebilirsiniz.
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
<?php if(isset($_SESSION["activeTab"])){ ?>
	setTimeout(function(){
		$('.nav-link').attr("class","nav-link gri alti");
		$('.tab-pane').attr("class","tab-pane fade");
		$('#<?php echo $_SESSION["activeTab"];?>-tab').attr("class","nav-link gri alti show active");
		$('#<?php echo $_SESSION["activeTab"];?>').attr("class","tab-pane fade show active");
	},100);
<?php unset($_SESSION["activeTab"]); } ?>
</script>