<div class="content" id="alan">
    <div class="animated fadeIn" id="scrolling">
        <div class="orders">
            <div class="row">
                <div class="col-lg-12">
                	<?php $eklentiler = $nsoft->all("plugin");?>
                	<div class="tab-alani">
						<ul class="nav nav-pills mb-3" style="margin-bottom: 0rem!important;" id="pills-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link butto-lg gri active show" id="pills-mevcut-tab " data-toggle="pill" href="#pills-mevcut" role="tab" aria-controls="pills-mevcut" aria-selected="false"><i class="fas fa-puzzle-piece"></i> Eklentilerim</a>
							</li>
							<li class="nav-item">
								<a class="nav-link butto-lg gri" id="pills-new-tab" data-toggle="pill" href="#pills-new" role="tab" aria-controls="pills-new" aria-selected="true"><i class="fas fa-fire"></i> Tüm<span class="mogos">ü</span> <span class="mogiz">Eklentiler</span> <?php badge(4);?></a>
							</li>
							<li class="nav-item">
								<a class="nav-link butto-lg gri" id="pills-my-tab" data-toggle="pill" href="#pills-my" role="tab" aria-controls="pills-my" aria-selected="true"><i class="fas fa-fire"></i> <span class="mogiz">Satın</span> Aldıklarım</a>
							</li>
						</ul>
					</div>
					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane fade active show" id="pills-mevcut" role="tabpanel" aria-labelledby="pills-mevcut-tab">
							<div class="row">
							    <?php if ($eklentiler) {
							    foreach ($nsoft->real as $value) { ?>
								<div class="col-md-12">
									<div class="ekleseci">
										<div class="row">
											<div class="teekimg col-auto">
												<img src="<?= $value["screenshot"];?>">
											</div>
											<div class="teek-title col">
												<span class="font-weight-bold mr-1"><?= $value["name"];?> <div class="eksurum">( v<?= $value["version"];?> )</div></span>
												<p><?= $value["description"];?></p>
												<div class="butto butto-dark butto-xs mt-2 d-inline-block" title="Yapımcı">Üretici: <?= $value["autor"];?></div><div class="butto butto-success butto-xs mt-2 d-inline-block ml-2">Yeni</div>
											</div>
											<div class="teek-buts text-center col-auto">
												<? if ($value["active"]) { ?>
													<a href="<?= $ayar->getpage('plugin',$value["primary"]);?>" class="butto butto-primary butbor d-inline"><i class="fas fa-cogs"></i> Ayarlar</a>
													<script type="text/javascript">
													  var <?= $value["primary"].'_deaktif';?> = <?= json_encode($value["data-deaktif"]);?>;
											    	</script>
													<button type="button" onclick="nsoft(<?= $value["primary"].'_deaktif';?>)" class="butto butto-warning butbor d-inline"><i class="fas fa-unlock"></i> Etkisizleştir</button>
											    <? } elseif($value["statu"]==0) { ?>
											    	<script type="text/javascript">
											    	  var <?= $value["primary"].'_delete';?> = <?= json_encode($value["data-delete"]);?>;
											    	</script>
											    	<button type="button" onclick="nsoft(<?= $value["primary"].'_delete';?>)" class="butto butto-danger butbor d-inline"><i class="fas fa-trash"></i> Sil</button>
											    	<button type="button" class="butto butto-warning butbor d-inline" onclick="document.getElementById('pills-new-tab').click()"><i class="fas fa-fire"></i> Premium Eklenti</button>
											    <? } else { ?>
											    	<script type="text/javascript">
											    	  var <?= $value["primary"].'_active';?> = <?= json_encode($value["data-active"]);?>;
											    	  var <?= $value["primary"].'_delete';?> = <?= json_encode($value["data-delete"]);?>;
											    	</script>
											    	<button type="button" onclick="nsoft(<?= $value["primary"].'_delete';?>)" class="butto butto-danger butbor d-inline"><i class="fas fa-trash"></i> Sil</button>
											    	<button type="button" onclick="nsoft(<?= $value["primary"].'_active';?>)" class="butto butto-primary butbor d-inline"><i class="fas fa-check"></i> Etkinleştir</button>
											    <? } ?>
											</div>
										</div>
									</div>
								</div>
								<?php } } ?>
							</div>
						</div>
						<div class="tab-pane fade" id="pills-new" role="tabpanel" aria-labelledby="pills-new-tab">
							<div class="row">
								<div class="col-md-12">
									<div class="alert alert-info">
										<p>Güncellemenin sorunsuz tamamlanabilmesi için güncelleyeceğiniz eklentiyi etkinse etkisizleştirin ve o şekilde güncellemeyi gerçekleştirin.</p>
									</div>
								</div>
								<?php if ($eklentiler) {
							    foreach ($nsoft->lists as $value) { ?>
								<div class="col-md-12">
									<div class="ekleseci">
										<div class="row">
											<div class="teekimg col-auto">
												<img style="min-height: auto" src="<?= $value["screenshot"];?>">
											</div>
											<div class="teek-title col">
												<span class="font-weight-bold mr-1"><?= $value["name"];?></span>
												<div class="eksurum">( v<?= $value["version"];?> )</div>
												<div class="ekguta">Yayınlanma Tarihi: <?= $nsoft->zamanfarki($value["date"]);?></div>
												<p><?php echo isset($value["update"]["description"]) ? $value["update"]["description"]:$value["description"];?></p>
											</div>
											<div class="teek-buts text-center col-auto">
												<a target="_blank" href="<?= $value["demo"];?>" class="butto butto-dark butbor d-inline"><i class="fas fa-eye"></i> Önizleme</a>
												<?php if (isset($value["update"])) { ?>
												<script type="text/javascript">
													var <?= $value["primary"].'_update';?> = <?= json_encode($value["update"]);?>;
												</script>
												<? if($value["statu"]==2) { ?>
													<button type="button" onclick="nsoft(<?= $value["primary"].'_update';?>)" class="butto butto-primary butbor d-inline"><i class="fas fa-cloud-download-alt"></i> Yükle</button>
												<? } elseif($value["statu"]==1) {
												$upstatu = true; ?>
												<button type="button" onclick="nsoft(<?= $value["primary"].'_update';?>)" class="butto butto-warning butbor d-inline"><i class="fas fa-sync-alt"></i> Güncelle</button>
											<?php } } elseif($value["statu"]==1) {
													echo '<button type="button" class="butto butto-success butbor d-inline"><i class="fas fa-check-double"></i> Güncel</button>';
												} elseif($value["statu"]==0) { ?>
													<button class="butto butto-light butbor d-inline"><?= $value["price"];?></button>
													<script type="text/javascript">
														var <?= $value["primary"].'_buy';?> = <?= json_encode($value["buy"]);?>;
													</script>
													<button type="button" onclick="nsoft(<?= $value["primary"].'_buy';?>)" class="butto butto-primary butbor d-inline"> Satın Al</button>
												<? } ?>
											</div>
										</div>
									</div>
								</div>
								<? } } if(!isset($upstatu) AND _up('plugin',0)); ?>
						    </div>
						</div>
						<div class="tab-pane fade" id="pills-my" role="tabpanel" aria-labelledby="pills-my-tab">
							<div class="row">
								<? if ($eklentiler) {
							    foreach ($nsoft->my as $value) { ?>
								<div class="col-md-12">
									<div class="ekleseci">
										<div class="row">
											<div class="teekimg col-auto">
												<img style="min-height: auto" src="<?= $value["screenshot"];?>">
											</div>
											<div class="teek-title col">
												<span class="font-weight-bold mr-1"><?= $value["name"];?></span>
												<div class="eksurum">( v<?= $value["version"];?> )</div>
												<div class="ekguta">Yayınlanma Tarihi: <?= $nsoft->zamanfarki($value["date"]);?></div>
												<p><?php echo isset($value["update"]["description"]) ? $value["update"]["description"]:$value["description"];?></p>
											</div>
											<div class="teek-buts text-center col-auto">
												<a target="_blank" href="<?= $value["demo"];?>" class="butto butto-dark butbor d-inline"><i class="fas fa-eye"></i> Önizleme</a>
												<? if (isset($value["update"])) { ?>
												<script type="text/javascript">
													var <?= $value["primary"].'_update';?> = <?= json_encode($value["update"]);?>;
												</script>
												<? if($value["statu"]==2) { ?>
													<button type="button" onclick="nsoft(<?= $value["primary"].'_update';?>)" class="butto butto-primary butbor d-inline"><i class="fas fa-cloud-download-alt"></i> Yükle</button>
												<? } elseif($value["statu"]==1) { ?>
												<button type="button" onclick="nsoft(<?= $value["primary"].'_update';?>)" class="butto butto-warning butbor d-inline"><i class="fas fa-sync-alt"></i> Güncelle</button>
											<? } } elseif($value["statu"]==1) {
													echo '<button type="button" class="butto butto-success butbor d-inline"><i class="fas fa-check-double"></i> Güncel</button>';
												} elseif($value["statu"]==0) { ?>
													<button class="butto butto-light butbor d-inline"><?= $value["price"];?></button>
													<script type="text/javascript">
														var <?= $value["primary"].'_buy';?> = <?= json_encode($value["buy"]);?>;
													</script>
													<button type="button" onclick="nsoft(<?= $value["primary"].'_buy';?>)" class="butto butto-primary butbor d-inline"> Satın Al</button>
												<? } ?>
											</div>
										</div>
									</div>
								</div>
								<? } } ?>
							</div>
						</div>
						<form id="themes" method="POST" action="">
                            <input type="hidden" name="page" value="temalar">
                            <input type="hidden" id="olay" name="olay" value="">
                            <input type="hidden" id="data" name="data" value="">
                        </form>
                        <script type="text/javascript">
                        	function TheOnc(olay,data){
                        		$('#olay').val(olay);
                        		$('#data').val(data);
                        		fastpost('themes','ajaxout');
                        	}
                        </script>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>