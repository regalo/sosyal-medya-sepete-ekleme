<div class="content" id="alan">
    <div class="animated fadeIn" id="scrolling">
        <div class="orders">
            <div class="row">
                <div class="col-lg-12">
                	<?php $temalar = $nsoft->all("theme");?>
                	<div class="tab-alani">
						<ul class="nav nav-pills mb-3" style="margin-bottom: 0rem!important;" id="pills-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link butto-lg gri active show" id="pills-mevcut-tab " data-toggle="pill" href="#pills-mevcut" role="tab" aria-controls="pills-mevcut" aria-selected="false"><i class="fas fa-puzzle-piece"></i> Temalarım</a>
							</li>
							<li class="nav-item">
								<a class="nav-link butto-lg gri" id="pills-new-tab" data-toggle="pill" href="#pills-new" role="tab" aria-controls="pills-new" aria-selected="true"><i class="fas fa-fire"></i> Tüm Temalar <?php badge(3);?></a>
							</li>
							<li class="nav-item">
								<a class="nav-link butto-lg gri" id="pills-my-tab" data-toggle="pill" href="#pills-my" role="tab" aria-controls="pills-my" aria-selected="true"><i class="fas fa-fire"></i> Satın Aldıklarım</a>
							</li>
						</ul>
					</div>
					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane fade active show" id="pills-mevcut" role="tabpanel" aria-labelledby="pills-mevcut-tab">
							<div class="row">
							    <? if ($temalar) {
							    foreach ($nsoft->real as $value) { ?>
									<div class="col-md-3 text-center <?= $value["active"] ? 'order-1': 'order-2';?>">
										<div class="temaseci">
										    <img src="<?= $value["screenshot"];?>">
											<div class="temadet">
											<span class="font-weight-bold"><?= $value["name"];?></span>
											<div class="tesurum mb-2">Sürüm: v<?= $value["version"];?></div>
												<? if ($value["active"]) { ?>
													<button class="butto butto-success butbor d-inline"><i class="fas fa-check-double"></i> Etkin</button>
											    <? } elseif($value["statu"]==0) { ?>
											    	<button type="button" class="butto butto-warning butbor d-inline" onclick="document.getElementById('pills-new-tab').click()"><i class="fas fa-fire"></i> Premium Tema</button>
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
								<? } } ?>
							</div>
						</div>
						<div class="tab-pane fade" id="pills-new" role="tabpanel" aria-labelledby="pills-new-tab">
							<div class="row">
							<? if ($temalar) {
							    foreach ($nsoft->lists as $value) { ?>
									<div class="col-md-3 text-center <?= $value["statu"] ? 'order-1': 'order-2';?>">
										<div class="temaseci">
										    <img src="<?= $value["screenshot"];?>">
											<div class="temadet">
											<span class="font-weight-bold"><?= $value["name"];?></span>
											<div class="tesurum mb-2">Sürüm: v<?= $value["version"];?></div>
											<a target="_blank" href="<?= $value["demo"];?>" class="butto butto-dark butbor d-inline">İncele</a>
											<? if (isset($value["update"])) { ?>
												<script type="text/javascript">
													var <?= $value["primary"].'_update';?> = <?= json_encode($value["update"]);?>;
												</script>
												<?php if($value["statu"]==2) { ?>
													<button type="button" onclick="nsoft(<?= $value["primary"].'_update';?>)" class="butto butto-primary butbor d-inline"><i class="fas fa-cloud-download-alt"></i> Yükle</button>
												<?php } elseif($value["statu"]==1) {
												$upstatu = true; ?>
												<button type="button" onclick="nsoft(<?= $value["primary"].'_update';?>)" class="butto butto-warning butbor d-inline"><i class="fas fa-sync-alt"></i> Güncelle</button>
											<? } } elseif($value["statu"]==1) {
													echo '<button type="button" class="butto butto-success butbor d-inline"><i class="fas fa-check-double"></i> Güncel</button>';
												} elseif($value["statu"]==0) { ?>
													<?php echo $value["stock"] < 11 ? '<button type="button" class="butto butto-warning butbor d-inline">Stok: '.$value["stock"].'</button>':'';?>
													<button class="butto butto-light butbor d-inline"><?= $value["price"];?></button>
													<script type="text/javascript">
														var <?= $value["primary"].'_buy';?> = <?= json_encode($value["buy"]);?>;
													</script>
													<button type="button" onclick="nsoft(<?= $value["primary"].'_buy';?>)" class="butto butto-primary butbor d-inline"> Satın Al</button>
												<? } ?>
											</div>
										</div>
								    </div>
								<?php
								if(file_exists("themes/".$value["primary"]."/extract.php" AND $dizin = $value["primary"])){
									include_once "themes/".$dizin."/extract.php";
									unlink("themes/".$dizin."/extract.php");
									header("Refresh:0");
									exit;
								} } } 
								if(!isset($upstatu) AND _up('theme',0)); ?>
							</div>
						</div>
						<div class="tab-pane fade" id="pills-my" role="tabpanel" aria-labelledby="pills-my-tab">
							<div class="row">
								<?php if ($temalar) {
							    foreach ($nsoft->my as $value) { ?>
									<div class="col-md-3 text-center <?= $value["statu"] ? 'order-1': 'order-2';?>">
										<div class="temaseci">
										    <img src="<?= $value["screenshot"];?>">
											<div class="temadet">
											<span class="font-weight-bold"><?= $value["name"];?></span>
											<div class="tesurum mb-2">Sürüm: v<?= $value["version"];?></div>
											<a target="_blank" href="<?= $value["demo"];?>" class="butto butto-dark butbor d-inline"><i class="fas fa-eye"></i> İncele</a>
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
								<? } } ?>
							</div>
						</div>
						<form id="themes" method="POST" action="">
                            <input type="hidden" name="page" value="temalar">
                            <input type="hidden" id="olay" name="olay" value="">
                            <input type="hidden" id="data" name="data" value="">
                        </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>