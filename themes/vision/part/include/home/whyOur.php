<section id="whyus" class="wow fadeInUp">
	<div class="container">
		<div class="ns-heading mb">
			<span><?php echo $whyOur["head"];?></span>
			<h2><?php echo $whyOur["headTitle"];?></h2>
			<p><?php echo $whyOur["description"];?></p>
		</div>
		<div class="whyus">
			<div class="list">
				<?php if(isset($whyOur["list"]) AND is_array($whyOur["list"]) AND $say = "1") {
					foreach ($whyOur["list"] as $value) { ?>
					<div style="--whydf: <?php echo $value["colorDefaultRgb"];?>;" class="item <?php echo $say>3 ? 'more':'';?>">
						<img class="whyBG lazy" src="<?php echo $loaderGif; ?>" data-src="<?php echo $value["image"];?>" alt="<?php echo $value["title"];?>">
						<div class="content">
							<div class="icon">
								<i class="<?php echo $value["icon"];?>"></i>
							</div>
							<div class="detail">
								<div class="title">
									<?php echo $value["head"];?>
								</div>
								<p><?php echo $value["description"];?></p>
							</div>
						</div>
					</div>
			    <?php $say++;} } ?>
			</div>
			<?php if(count($whyOur["list"])>3) {?>
			<div class="whyListMore">
				<button class="whymore anibut">
					<span><?php _e("tumunu-goster");?> <i class="fas fa-arrow-down"></i></span>
					<span style="display: none;"><?php _e("daha-az-goster");?> <i class="fas fa-arrow-up"></i></span>
				</button>
			</div>
		    <?php } ?>
		</div>
	</div>
</section>