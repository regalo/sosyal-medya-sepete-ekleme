<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">
				<span class="box-title">Yorumlar</span>
			</div>
			<script type="text/javascript">
				dataComment = {};
			</script>
			<div class="card-body">
				<div class="vsCommentList">
					<?php include_once "include/contentCommentArea.php"; ?>
				</div>
				<div class="showMore">
					<form class="loftForm" method="POST">
						<input type="hidden" name="olay" value="loftOptions">
						<input type="hidden" name="page" value="theme">
						<input type="hidden" name="loftAction" value="commentMore">
						<input type="hidden" name="commentMore" value="<?php echo $commentStart+$commentCount;?>">
						<button class="showMoreBTN showMoreComment">Daha Fazla</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
			<div class="card-header">
				<span class="box-title">Yorum Ayarları</span>
			</div>
			<div class="card-body">
				<form class="loftForm" method="POST">
					<input type="hidden" name="olay" value="loftOptions">
					<input type="hidden" name="page" value="theme">
					<input type="hidden" name="loftAction" value="generalSave">
					<div class="form-group">
						<label class="font-weight-bold mb-2">Durum</label>
						<select class="form-control" name="data[loftContentCommentOptions][item2][type]">
							<option value="pasif" <?php echo $loftContentCommentOptions["type"]=="pasif" ? 'selected':'';?>>Kapalı</option>
							<option value="onlyBlog" <?php echo $loftContentCommentOptions["type"]=="onlyBlog" ? 'selected':'';?>>Sadece Bloglarda Aktif</option>
							<option value="onlyKategori" <?php echo $loftContentCommentOptions["type"]=="onlyKategori" ? 'selected':'';?>>Sadece Kategorilerde Aktif</option>
							<option value="allOver" <?php echo $loftContentCommentOptions["type"]=="allOver" ? 'selected':'';?>>Blog ve Kategorilerde Aktif</option>
						</select>
					</div>
					<div class="form-group">
						<label class="font-weight-bold mb-2">Onay Durumu</label>
						<select class="form-control" name="data[loftContentCommentOptions][item2][default]">
							<option value="0" <?php echo $loftContentCommentOptions["default"]=="0" ? 'selected':'';?>>Onay Gerekli</option>
							<option value="1" <?php echo $loftContentCommentOptions["default"]=="1" ? 'selected':'';?>>Direk Yayınlansın</option>
						</select>
					</div>
					<div class="form-group">
						<label class="font-weight-bold mb-2">Gösterilecek Yorum Sayısı</label>
						<input type="number" class="form-control" required="" name="data[loftContentCommentOptions][item2][viewCount]" value="<?php echo $loftContentCommentOptions["viewCount"];?>">
					</div>
					<div class="form-group">
						<label class="font-weight-bold mb-2">Captcha</label>
						<select class="form-control" name="data[loftContentCommentOptions][item2][captcha]">
							<option value="aktif" <?php echo $loftContentCommentOptions["captcha"]=="aktif" ? 'selected':'';?>>Aktif</option>
							<option value="pasif" <?php echo $loftContentCommentOptions["captcha"]=="pasif" ? 'selected':'';?>>Pasif</option>
						</select>
					</div>
						<div class="alert alert-danger">
							<p class="mb-0"><strong>Ayarlar » Güvenlik Ayarları</strong> sayfasında captcha bilgileri doldurulmuş olması gerekir!</p>
						</div>
					<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3">
					<i class="fas fa-check" aria-hidden="true"></i> Kaydet
					</button>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="commentmod" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header comModHead">
				<h5 class="modal-title" id="exampleModalLabel">Yorum Detayları</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="loftForm" method="POST">
					<input type="hidden" name="olay" value="loftOptions">
					<input type="hidden" name="page" value="theme">
					<input type="hidden" name="loftAction" value="commentSave">
					<input type="hidden" name="commentSave" value="">
					<input type="hidden" name="data[item1]" value="loftContentComment">
					<input type="hidden" name="data[item2]" value="">
					<input type="hidden" name="data[item4]" value="">
					<div class="commentShow mb-4">
						<div class="form-row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold">Yorum İçeriği</label>
									<textarea class="form-control" name="data[item3][comment]" required="" placeholder="Yorum İçeriği"></textarea>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-weight-bold">Yorumu Cevapla (Opsiyonel)</label>
									<textarea class="form-control" name="data[item3][reply]" placeholder="Yoruma cevap verebilirsiniz"></textarea>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="font-weight-bold">Yorumcu Adı</label>
									<input type="text" class="form-control" name="data[item3][name]" required="" placeholder="Adı Soyadı" value="">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="font-weight-bold">Yorumcu Mail</label>
									<input type="text" class="form-control" name="data[item3][mail]" placeholder="E-Posta" value="">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="font-weight-bold">Yorum Zamanı</label>
									<input type="text" class="form-control" name="data[item3][date]" readonly="" placeholder="Yorum Tarihi" value="">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="font-weight-bold">İşlem Seç</label>
									<select class="form-control" name="data[statu]">
										<option value="0">Onay Bekliyor</option>
										<option value="1">Onaylanmış</option>
										<option value="delete">Yorumu Sil</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="text-center mb-2">
						<button type="submit" class="butto butto-lg badge-success butbor ml-2"><i class="fas fa-check" aria-hidden="true"></i> UYGULA</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>