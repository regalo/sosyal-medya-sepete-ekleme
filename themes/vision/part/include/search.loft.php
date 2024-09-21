<div class="osareaBG">
		<div class="close">
			<i class="fas fa-times"></i> <?php _e("kapat");?>
		</div>
	<div class="osarea">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<form class="loftForm">
						<input type="hidden" name="loftAction" value="orderControl">
						<div class="searcharea">
							<div class="content">
								<div class="top">
									<span><?php _e("siparis-sorgula");?></span>
									<p><?php _e("sorgulamak-istediginiz-siparisin-kodunu-giriniz");?></p>
								</div>
								<div class="srcwell">
									<input type="text" name="code" class="os-control" placeholder="<?php _e("siparis-kodu");?>">
									<button type="submit" class="osBtn anibut mt-4"><i class="fas fa-question"></i> <?php _e("siparis-sorgula");?></button>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-6">
					<div class="lastordersarea">
						<div class="content">
							<span><?php _e("gecmis-siparisler");?></span>
							<p><?php _e("tarayici-onbellegine-kaydedilmis-siparisleriniz");?></p>
							<div class="LastOrdersList">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>