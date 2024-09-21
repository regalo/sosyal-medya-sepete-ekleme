<div class="content" id="alan">
    <div class="animated fadeIn" id="scrolling">
        <div class="orders">
        	<div class="row">
        		<div class="col-lg-12">
        			<div class="card">
        				<div class="card-header">
        					<strong class="box-title">Yazılım Kontrolü v<?= $ayar->select('software_nivusosyal');?></strong>
        				</div>
        				<div class="card-body">
        					<form id="guncellemeler" method="POST" action="" onsubmit="fastpost('guncellemeler','ajaxout'); return false;">
								<input type="hidden" name="page" value="software">
								<input type="hidden" id="olay" name="olay" value="guncellemeler">
        							<?php if ($nsoft->update()) { ?>
										<div class="row">
											<div class="teekimg col-auto">
										    	<img style="min-height: auto" src="<?php echo $nsoft->update["screenshot"];?>">
											</div>
											<div class="teek-title col">
											<span class="font-weight-bold mr-1">NivuSosyal Paket Satış</span>
											<div class="eksurum">( v<?= $nsoft->update["version"];?> )</div>
											<div class="ekguta">Yayınlanma Tarihi: <?= $nsoft->zamanfarki($nsoft->update["date"]);?></div>
											<?php if (empty($nsoft->statu)) { ?>
											<p><?= $nsoft->update["descriptions"];?></p>
										    <div class="col-md-12 pl-0 mt-2">
									    		<div class="text-warning">Yazılımınız Güncel Değil (v<?= $nsoft->version;?>)</div>
									    		<div class="text-primary">Uyarı! "<b>NivuSosyal Paket Satış</b>" yazılımını güncel haliyle kullanmanız, varsa sistem ve güvenlik açıklarına karşı alabileceğiniz önlemlerin başında gelmektedir.</div>
									    		<script type="text/javascript">
													var data = <?= json_encode($nsoft->update);?>;
												</script>
											    <button type="button" onclick="nsoft(data);" class="butto butto-warning butbor mt-2"><i class="fas fa-sync-alt"></i> GÜNCELLE İŞLEMİNİ BAŞLAT</button>
										    <? } else { 
										    	_up("software","0");
										    	?>
										    		<div class="text-success">Yazılımınız Güncel (v<?= $nsoft->version;?>)</div>
										    		<div class="text-primary">Tebrikler! "<b>NivuSosyal Paket Satış</b>" yazılımını güncel haliyle kullanıyorsunuz. Yeni güncellemeleri buradan takip edebileceksiniz.</div>
										    <? } ?>
										    </div>
										    </div>
										</div>
        							<? } else { ?>
        								YAZILIM GÜNCELLE KONTROLÜ BAŞARISIZ OLDU. BU ÖNEMLİ BİR SORUN DEĞİL DAHA SONRA KONTROL EDEBİLİRSİNİZ.
        							<? } ?>
	        				</form>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
    </div>
</div>