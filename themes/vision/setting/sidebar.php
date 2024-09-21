<div class="tab-alani">
	<ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
		<li class="nav-item">
			<a class="nav-link gri alti active show" id="pills-1x1-tab" data-toggle="pill" href="#pills-1x1" role="tab" aria-controls="pills-home" aria-selected="true">Blog/Sayfa</a>
		</li>
		<li class="nav-item">
			<a class="nav-link gri alti" id="pills-1x2-tab" data-toggle="pill" href="#pills-1x2" role="tab" aria-controls="pills-home" aria-selected="true">İletişim Sayfası</a>
		</li>
	</ul>
</div>
<div class="tab-pane fade active show" id="pills-1x1" role="tabpanel" aria-labelledby="pills-1x1-tab">
	<form class="loftForm" method="POST">
		<input type="hidden" name="olay" value="loftOptions">
		<input type="hidden" name="page" value="theme">
		<input type="hidden" name="loftAction" value="generalSave">
		<div class="row mt-3">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<div class="box-title">Son Blog Yazıları</div>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-weight-bold">Üst Başlık</label>
									<input type="text" class="form-control" name="data[loftSidebar][item2][blog][head]" required="" placeholder="Üst Başlık (İsteğe Bağlı)" value="<?php echo $loftSidebar["blog"]["head"];?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-weight-bold">Başlık</label>
									<input type="text" class="form-control" name="data[loftSidebar][item2][blog][headLine]" required="" placeholder="Başlık" value="<?php echo $loftSidebar["blog"]["headLine"];?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-weight-bold">İcon</label>
									<div class="input-group">
										<div class="butto butto-light mr-1 smgir">
											<i id="iconView_sidebarBlog" class="<?php echo $loftSidebar["blog"]["icon"];?>" aria-hidden="true"></i>
										</div>
										<input class="form-control smginx" id="iconInput_sidebarBlog" name="data[loftSidebar][item2][blog][icon]" value="<?php echo $loftSidebar["blog"]["icon"];?>">
										<button type="button" class="butto butbor butto-dark icon-modal" data-toggle="modal" data-target="#iconSec" data-icon="<?php echo $loftSidebar["blog"]["icon"];?>" data-add="sidebarBlog">Icon Seç
										</button>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-weight-bold">Gösterim Adeti</label>
									<select class="form-control" name="data[loftSidebar][item2][blog][count]">
										<?php for ($i=3; $i < 9; $i++) { ?>
										<option value="<?php echo $i;?>" <?php echo $loftSidebar["blog"]["count"]==$i ? 'selected':'';?>><?php echo $i;?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
						<div class="w-100">
							<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-2">
							<i class="fas fa-check" aria-hidden="true"></i> Kaydet
							</button>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<div class="box-title">Servis Listesi</div>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-weight-bold">Üst Başlık</label>
									<input type="text" class="form-control" name="data[loftSidebar][item2][service][head]" required="" placeholder="Üst Başlık (İsteğe Bağlı)" value="<?php echo $loftSidebar["service"]["head"];?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-weight-bold">Başlık</label>
									<input type="text" class="form-control" name="data[loftSidebar][item2][service][headLine]" placeholder="Başlık" value="<?php echo $loftSidebar["service"]["headLine"];?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-weight-bold">İcon</label>
									<div class="input-group">
										<div class="butto butto-light mr-1 smgir">
											<i id="iconView_sidebarService" class="<?php echo $loftSidebar["service"]["icon"];?>" aria-hidden="true"></i>
										</div>
										<input class="form-control smginx" id="iconInput_sidebarService" name="data[loftSidebar][item2][service][icon]" value="<?php echo $loftSidebar["service"]["icon"];?>">
										<button type="button" class="butto butbor butto-dark icon-modal" data-toggle="modal" data-target="#iconSec" data-icon="<?php echo $loftSidebar["service"]["icon"];?>" data-add="sidebarService">Icon Seç
										</button>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-weight-bold">Gösterim Türü</label>
									<select class="form-control" name="data[loftSidebar][item2][service][option]">
										<option value="platform" <?php echo $loftSidebar["service"]["option"]=="platform" ? 'selected':'';?>>Platformları Listele</option>
										<?php foreach ($platformList as $key => $value) { ?>
										<option value="<?php echo $value["pt_id"];?>" <?php echo $loftSidebar["service"]["option"]==$value["pt_id"] ? 'selected':'';?>><?php echo $value["pt_name"];?> Kategorileri</option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
						<div class="w-100">
							<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-2">
							<i class="fas fa-check" aria-hidden="true"></i> Kaydet
							</button>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<div class="box-title">Özel Kutu</div>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-weight-bold">Üst Başlık</label>
									<input type="text" class="form-control" name="data[loftSidebar][item2][specialBox][head]" required="" placeholder="Üst Başlık (İsteğe Bağlı)" value="<?php echo $loftSidebar["specialBox"]["head"];?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-weight-bold">Başlık</label>
									<input type="text" class="form-control" name="data[loftSidebar][item2][specialBox][headLine]" required="" placeholder="Başlık" value="<?php echo $loftSidebar["specialBox"]["headLine"];?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold">Açıklama</label>
									<textarea class="form-control" name="data[loftSidebar][item2][specialBox][description]" required="" placeholder="Açıklama Girin"><?php echo $loftSidebar["specialBox"]["description"];?></textarea>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold">Buton</label>
									<select class="form-control" name="data[loftSidebar][item2][specialBox][buttonStatu]" data-showHide="true" data-class='div[id="areaStatu3"]'>
										<option value="aktif" <?php echo $loftSidebar["specialBox"]["buttonStatu"]=="aktif" ? 'selected':'';?>>Göster</option>
										<option value="pasif" <?php echo $loftSidebar["specialBox"]["buttonStatu"]=="pasif" ? 'selected':'';?>>Gizle</option>
									</select>
								</div>
							</div>
							<div class="col-md-12" id="areaStatu3" style="<?php echo $loftSidebar["specialBox"]["buttonStatu"]=="pasif" ? 'display: none;':'';?>">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="font-weight-bold">Buton Adı</label>
											<input type="text" class="form-control" name="data[loftSidebar][item2][specialBox][buttonText]" placeholder="Buton Adı" value="<?php echo $loftSidebar["specialBox"]["buttonText"];?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="font-weight-bold">Buton Linki</label>
											<input type="text" class="form-control" name="data[loftSidebar][item2][specialBox][buttonHref]" placeholder="Linki Girin" value="<?php echo $loftSidebar["specialBox"]["buttonHref"];?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="font-weight-bold">Kutu İconu</label>
											<div class="input-group">
												<div class="butto butto-light mr-1 smgir">
													<i id="iconView_sidebarContact" class="<?php echo $loftSidebar["specialBox"]["icon"];?>" aria-hidden="true"></i>
												</div>
												<input class="form-control smginx" id="iconInput_sidebarContact" name="data[loftSidebar][item2][specialBox][icon]" value="<?php echo $loftSidebar["specialBox"]["icon"];?>">
												<button type="button" class="butto butbor butto-dark icon-modal" data-toggle="modal" data-target="#iconSec" data-icon="<?php echo $loftSidebar["specialBox"]["icon"];?>" data-add="sidebarContact">Icon Seç
												</button>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="font-weight-bold">Buton İconu</label>
											<div class="input-group">
												<div class="butto butto-light mr-1 smgir">
													<i id="iconView_buttonIcon" class="<?php echo $loftSidebar["specialBox"]["buttonIcon"];?>" aria-hidden="true"></i>
												</div>
												<input class="form-control smginx" id="iconInput_buttonIcon" name="data[loftSidebar][item2][specialBox][buttonIcon]" value="<?php echo $loftSidebar["specialBox"]["buttonIcon"];?>">
												<button type="button" class="butto butbor butto-dark icon-modal" data-toggle="modal" data-target="#iconSec" data-icon="<?php echo $loftSidebar["specialBox"]["buttonIcon"];?>" data-add="buttonIcon">Icon Seç
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="w-100">
							<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-2">
							<i class="fas fa-check" aria-hidden="true"></i> Kaydet
							</button>
						</div>
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
					<div class="card-body">
						<div class="bb-box">
							<span class="bb-title">Sidebar Nedir?</span>
							Tekil sayfa, blog yazısı ve iletişim sayfası gibi kısımlarda içeriği sağ tarafında yer alan kısımdır.
							<hr>
							<span class="bb-title">Özel Kutunun Amacı Nedir?</span>
							Özel kutunun amacı isteğinize göre bir kutucuk oluşturabilmektir. İsterseniz iletişim sayfanıza yönlendirin, isterseniz oluşturmuş olduğunuz özel sayfaya(Çok Satanlar, İndirimdekiler vs.). Kullanım amacı size bağlıdır. Dilerseniz iletişim sayfasında pasif hale getirebilirsiniz.
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<div class="tab-pane fade" id="pills-1x2" role="tabpanel" aria-labelledby="pills-1x2-tab">
	<div class="row">
		<div class="col-md-7">
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
									<label class="font-weight-bold">Sidebar İletişim Bilgileri Alanı</label>
									<select class="form-control" name="data[loftSidebar][item3][contact][statu]" data-showHide="true" data-class='div[id="areaStatu5"]'>
										<option value="aktif" <?php echo $loftSidebar["contact"]["statu"]=="aktif" ? 'selected':'';?>>Göster</option>
										<option value="pasif" <?php echo $loftSidebar["contact"]["statu"]=="pasif" ? 'selected':'';?>>Gizle</option>
									</select>
								</div>
							</div>
							<div class="col-md-12" id="areaStatu5" style="<?php echo $loftSidebar["contact"]["statu"]=="pasif" ? 'display: none;':'';?>">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="font-weight-bold">Icon</label>
											<div class="input-group">
												<div class="butto butto-light mr-1 smgir">
													<i id="iconView_contactSideIcon" class="<?php echo $loftSidebar["contact"]["icon"];?>" aria-hidden="true"></i>
												</div>
												<input class="form-control smginx" id="iconInput_contactSideIcon" name="data[loftSidebar][item3][contact][icon]" value="<?php echo $loftSidebar["contact"]["icon"];?>">
												<button type="button" class="butto butbor butto-dark icon-modal" data-toggle="modal" data-target="#iconSec" data-icon="<?php echo $loftSidebar["contact"]["icon"];?>" data-add="contactSideIcon">Icon Seç</button>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="font-weight-bold">Sidebar Üst Başlık</label>
											<input type="text" class="form-control" name="data[loftSidebar][item3][contact][head]" required="" placeholder="Sidebar Üst Başlık" value="<?php echo $loftSidebar["contact"]["head"];?>">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="font-weight-bold">Sidebar Ana Başlık</label>
											<input type="text" class="form-control" name="data[loftSidebar][item3][contact][headLine]" placeholder="Sidebar Ana Başlık" value="<?php echo $loftSidebar["contact"]["headLine"];?>">
										</div>
									</div>
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
		<div class="col-md-5">
			<form class="loftForm" method="POST">
				<input type="hidden" name="olay" value="loftOptions">
				<input type="hidden" name="page" value="theme">
				<input type="hidden" name="loftAction" value="generalSave">
				<div class="card mb-3">
					<div class="card-header">
						<div class="box-title"> Soru ve Cevaplar</div>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold">Soru Cevap Durum</label>
									<select class="form-control" name="data[loftSidebar][item4][faq][statu]"  data-showHide="true" data-class='.areaStatuFull'>
										<option value="aktif" <?php echo $loftSidebar["faq"]["statu"]=="aktif" ? 'selected':'';?>>Aktif</option>
										<option value="pasif" <?php echo $loftSidebar["faq"]["statu"]=="pasif" ? 'selected':'';?>>Pasif</option>
									</select>
								</div>
							</div>
							<div class="col-md-6 areaStatuFull"  style="<?php echo $loftSidebar["faq"]["statu"]=="pasif" ? 'display: none;':'';?>">
								<div class="form-group">
									<label class="font-weight-bold">Soru Cevap Üst Başlık</label>
									<input type="text" class="form-control" name="data[loftSidebar][item4][faq][head]" required="" placeholder="Örn: Sağladığımız" value="<?php echo $loftSidebar["faq"]["head"];?>">
								</div>
							</div>
							<div class="col-md-6 areaStatuFull" style="<?php echo $loftSidebar["faq"]["statu"]=="pasif" ? 'display: none;':'';?>">
								<div class="form-group">
									<label class="font-weight-bold">Soru Cevap Alt Başlık</label>
									<input type="text" class="form-control" name="data[loftSidebar][item4][faq][headLine]" required="" placeholder="Örn: Servislerimiz" value="<?php echo $loftSidebar["faq"]["headLine"];?>">
								</div>
							</div>
						</div>
					</div>
				</div>
					<div class="faq-list areaStatuFull" id="faqList" style="<?php echo $loftSidebar["faq"]["statu"]=="pasif" ? 'display: none;':'';?>">
						<?php
						if(isset($loftSidebar["faq"]["ques"]) AND is_array($loftSidebar["faq"]["ques"])){
						foreach ($loftSidebar["faq"]["ques"] as $key => $value) { ?>
						<div class="card bilgi-box active mb-2" data-key="<?php echo $key;?>">
							<div class="card-header border-bottom-0">
								<span><?php echo $value["ques"];?></span>
								<i class="fas fa-chevron-right" aria-hidden="true"></i>
							</div>
							<div class="card-body" style="display: none;">
								<div class="faq-element mb-4">
									<div class="form-group mb-2">
										<input type="text" class="form-control" required="" name="data[loftSidebar][item4][faq][ques][<?php echo $key;?>][ques]" placeholder="Soru" value="<?php echo $value["ques"];?>" onchange="headClone(this);">
									</div>
									<div class="form-group">
										<textarea class="form-control" required="" name="data[loftSidebar][item4][faq][ques][<?php echo $key;?>][reply]" placeholder="Cevap"><?php echo $value["reply"];?></textarea>
									</div>
								</div>
								<button type="button" class="butto butto-danger butbor ml-2 mb-3" onclick="boxQuesDelete(this);">
								<i class="fas fa-trash" aria-hidden="true"></i> Sil
								</button>
							</div>
						</div>
						<?php $lastKey = $key;} } ?>
					</div>
					<button type="button" class="butto butto-primary butbor mb-3 mt-2 faqekle areaStatuFull" style="<?php echo $loftSidebar["faq"]["statu"]=="pasif" ? 'display: none;':'';?>">
					<i class="fas fa-plus" aria-hidden="true"></i> Soru Ekle
					</button>
					<div class="w-100">
						<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-2">
						<i class="fas fa-check" aria-hidden="true"></i> Kaydet
						</button>
					</div>
					<script type="text/javascript">
					lastBoxKey = "<?php echo isset($lastKey) ? $lastKey:0;?>";
					lastBoxKey++;
					$('.faqekle').click(function(){
					var htmlClone = '<div class="card bilgi-box active mb-2" data-key="'+lastBoxKey+'"><div class="card-header border-bottom-0" onclick="boxAcKapa(this);"><span>Yeni Soru Başlığı</span><i class="fas fa-chevron-right" aria-hidden="true"></i></div><div class="card-body" style="display: none;"><div class="faq-element mb-4"><div class="form-group mb-2"><input type="text" class="form-control" required="" name="data[loftSidebar][item4][faq][ques]['+lastBoxKey+'][ques]" placeholder="Soru" value="Yeni Soru Başlığı" onchange="headClone(this);"></div><div class="form-group"><textarea class="form-control" required="" name="data[loftSidebar][item4][faq][ques]['+lastBoxKey+'][reply]" placeholder="Cevap">Yeni soru cevap alanı</textarea></div></div><button type="button" class="butto butto-danger butbor ml-2 mb-3" onclick="boxQuesDelete(this);"><i class="fas fa-trash" aria-hidden="true"></i> Sil</button></div></div>';
					$('#faqList').append(htmlClone);
					lastBoxKey++;
					});
					</script>
			</form>
		</div>
	</div>
</div>