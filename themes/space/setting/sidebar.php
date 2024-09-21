<div class="row mt-3">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">
				<div class="box-title">
					Blog Yazıları
				</div>
			</div>
			<div class="card-body">
				<?php if($sblog = $space->settingJson("spaceSidebarBlog")) { ?>
				<form class="action_form_submit" method="POST">
					<input type="hidden" name="page" value="theme">
					<input type="hidden" name="olay" value="spaceSidebarBlog">
					<input type="hidden" name="yontem" value="json">
					<div class="form-row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="font-weight-bold">Üst Başlık</label>
								<input type="text" class="form-control" name="data[item2][headLine]" placeholder="Üst Başlık (İsteğe Bağlı)" value="<?php echo $sblog["headLine"];?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="font-weight-bold">Başlık</label>
								<input type="text" class="form-control" name="data[item2][headFirst]" placeholder="Başlık" value="<?php echo $sblog["headFirst"];?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="font-weight-bold">İcon</label>
								<div class="input-group">
									<div class="butto butto-light mr-1 smgir">
										<i id="iconView_sidebarBlog" class="<?php echo $sblog["icon"];?>" aria-hidden="true"></i>
									</div>
									<input class="form-control smginx" id="iconInput_sidebarBlog" name="data[item2][icon]" value="<?php echo $sblog["icon"];?>">
									<button type="button"
									class="butto butbor butto-dark icon-modal"
									data-toggle="modal"
									data-target="#iconSec"
									data-icon="<?php echo $sblog["icon"];?>"
									data-add="sidebarBlog">Icon Seç</button>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="font-weight-bold">Gösterim Adeti</label>
								<select class="form-control" name="data[item2][count]">
									<option value="3" <?php echo $sblog["count"]=="3" ? 'selected':'';?>>3</option>
									<option value="4" <?php echo $sblog["count"]=="4" ? 'selected':'';?>>4</option>
									<option value="5" <?php echo $sblog["count"]=="5" ? 'selected':'';?>>5</option>
									<option value="6" <?php echo $sblog["count"]=="6" ? 'selected':'';?>>6</option>
									<option value="7" <?php echo $sblog["count"]=="7" ? 'selected':'';?>>7</option>
									<option value="8" <?php echo $sblog["count"]=="8" ? 'selected':'';?>>8</option>
								</select>
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
		<div class="card">
			<div class="card-header">
				<div class="box-title">
					Servis Listesi
				</div>
			</div>
			<div class="card-body">
				<?php if($sservice = $space->settingJson("spaceSidebarServices")) { ?>
				<form class="action_form_submit" method="POST">
					<input type="hidden" name="page" value="theme">
					<input type="hidden" name="olay" value="spaceSidebarServices">
					<input type="hidden" name="yontem" value="json">
					<div class="form-row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="font-weight-bold">Üst Başlık</label>
								<input type="text" class="form-control" name="data[item2][headLine]" placeholder="Üst Başlık (İsteğe Bağlı)" value="<?php echo $sservice["headLine"];?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="font-weight-bold">Başlık</label>
								<input type="text" class="form-control" name="data[item2][headFirst]" placeholder="Başlık" value="<?php echo $sservice["headFirst"];?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="font-weight-bold">İcon</label>
								<div class="input-group">
									<div class="butto butto-light mr-1 smgir">
										<i id="iconView_sidebarService" class="<?php echo $sservice["icon"];?>" aria-hidden="true"></i>
									</div>
									<input class="form-control smginx" id="iconInput_sidebarService" name="data[item2][icon]" value="<?php echo $sservice["icon"];?>">
									<button type="button"
									class="butto butbor butto-dark icon-modal"
									data-toggle="modal"
									data-target="#iconSec"
									data-icon="<?php echo $sservice["icon"];?>"
									data-add="sidebarService">Icon Seç</button>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="font-weight-bold">Gösterim Türü</label>
								<select class="form-control" name="data[item2][options]">
									<option value="0" <?php echo $sservice["options"] == "0" ? 'selected':'';?>>Platformları Listele</option>
									<?php
									foreach ($platform->all(0,100) as $pt) {
										extract($pt);
									?>
									<option value="<?php echo $pt_id;?>" <?php echo $sservice["options"] == $pt_id ? 'selected':'';?>><?php echo $pt_name;?> Kategorileri</option>
									<?php } ?>
								</select>
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
		<div class="card">
			<div class="card-header">
				<div class="box-title">
					Özel Kutu
				</div>
			</div>
			<div class="card-body">
				<?php if($scontact = $space->settingJson("spaceSidebarContact")) { ?>
				<form class="action_form_submit" method="POST">
					<input type="hidden" name="page" value="theme">
					<input type="hidden" name="olay" value="spaceSidebarContact">
					<input type="hidden" name="yontem" value="json">
					<div class="form-row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="font-weight-bold">Üst Başlık</label>
								<input type="text" class="form-control" name="data[item2][headLine]" placeholder="Üst Başlık (İsteğe Bağlı)" value="<?php echo $scontact["headLine"];?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="font-weight-bold">Başlık</label>
								<input type="text" class="form-control" name="data[item2][headFirst]" placeholder="Başlık" value="<?php echo $scontact["headFirst"];?>">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label class="font-weight-bold">Açıklama</label>
								<textarea class="form-control" name="data[item2][description]" placeholder="Açıklama Girin"><?php echo $scontact["description"];?></textarea>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="font-weight-bold">Buton</label>
								<select class="form-control" name="data[item2][button]">
									<option value="1" <?php echo $scontact["button"] == "1" ? 'selected':'';?>>Göster</option>
									<option value="0" <?php echo $scontact["button"] == "0" ? 'selected':'';?>>Gizle</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="font-weight-bold">Buton Adı</label>
								<input type="text" class="form-control" name="data[item2][buttonText]" placeholder="Buton Adı" value="<?php echo $scontact["buttonText"];?>">
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<label class="font-weight-bold">Buton Linki</label>
								<input type="text" class="form-control" name="data[item2][buttonHref]" placeholder="Linki Girin" value="<?php echo $scontact["buttonHref"];?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="font-weight-bold">İcon</label>
								<div class="input-group">
									<div class="butto butto-light mr-1 smgir">
										<i id="iconView_sidebarContact" class="<?php echo $scontact["icon"];?>" aria-hidden="true"></i>
									</div>
									<input class="form-control smginx" id="iconInput_sidebarContact" name="data[item2][icon]" value="<?php echo $scontact["icon"];?>">
									<button type="button"
									class="butto butbor butto-dark icon-modal"
									data-toggle="modal"
									data-target="#iconSec"
									data-icon="<?php echo $sservice["icon"];?>"
									data-add="sidebarContact">Icon Seç</button>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="font-weight-bold">İletişim Sayfasında</label>
								<select class="form-control" name="data[item2][place]">
									<option value="1" <?php echo $scontact["place"] == "1" ? 'selected':'';?>>Göster</option>
									<option value="0" <?php echo $scontact["place"] == "0" ? 'selected':'';?>>Gizle</option>
								</select>
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
		<div class="card bilgi-box">
			<div class="card-header">
				<div class="box-title font-weight-bold">Bilgi Kutusu <i class="fas fa-chevron-right"></i></div>
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