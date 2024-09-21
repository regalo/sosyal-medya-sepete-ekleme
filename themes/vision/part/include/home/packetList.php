<?php foreach ($specialList as $key => $val) {
if($val["ayar_1"]==$value["speacialList"]){ ?>
<section id="packList" class="wow fadeInUp" data-slide="true" data-key="<?php echo $val["ayar_1"];?>">
	<div class="container mp0">
		<div class="ns-heading">
			<span><?php echo $val["head"];?></span>
			<div class="ns-headH">
				<h2><?php echo $val["headLine"];?></h2>
				<span class="nheadall">
					<a href="<?php echo $val["href"];?>" class="packallBTN" title="<?php _e("tumunu-gor");?>">
						<i class="fas fa-arrow-right"></i>
					</a>
				</span>
			</div>
			<p><?php echo $val["description"];?></p>
		</div>
		<div class="packListArea">
			<div class="splide packlisti<?php echo $key;?>">
				<div class="splide__track">
					<ul class="splide__list">
						<?php foreach ($val["packageList"] as $package) { ?>
						<li class="splide__slide">
							<?php include "pack.loft.php";?>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<div class="nfootall">
				<a href="<?php echo $val["href"];?>" class="packallBTN" title="Tümünü Gör">
					<span><?php _e("tumunu-gor");?></span> <i class="fas fa-arrow-right"></i>
				</a>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
packListCount[<?php echo $key;?>] = <?php echo $key;?>;
</script>
<?php break; }
}
?>