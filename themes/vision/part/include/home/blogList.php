<section id="bloglast" class="wow fadeInUp">
	<div class="container mp0">
		<div class="ns-heading flx">
			<div class="left">
				<h2><?php echo $blog["head"];?></h2>
				<p><?php echo $blog["description"];?></p>
			</div>
			<div class="showmore">
				<a class="ns-more" href="<?php echo $blog["url"];?>">
					<span><?php _e("tumunu-gor");?></span> <i class="fas fa-arrow-right"></i>
				</a>
			</div>
		</div>
		<div class="blog-list">
			<?php foreach ($blog["list"] as $value) { ?>
			<div class="blog-item">
				<div class="thumb">
					<a href="<?php echo $value["url"];?>">
						<img class="lazy" src="<?php echo $loaderGif; ?>" data-src="<?php echo $value["thumb"];?>" alt="<?php echo $value["sayfa_baslik"];?>">
					</a>
					<div class="post-date">
						<?php echo $value["publishDate"];?>
					</div>
				</div>
				<div class="detail">
					<a href="<?php echo $value["url"];?>">
						<h3><?php echo $value["sayfa_baslik"];?></h3>
					</a>
					<p><?php echo $value["sayfa_aciklama"];?></p>
				</div>
			</div>
		    <?php } ?>
		</div>
	</div>
</section>