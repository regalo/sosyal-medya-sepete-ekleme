<?php if($intro = $space->homeIntro()) { ?>
	<section class="intro wow fadeInDown">
		<div class="ordersearch-area" style="background: url(<?php echo $space->imagePath(ns_filter('spaceIntroBack'));?>);">
			<div class="container">
				<?php include_once "include/".$intro["include"].".php"; ?>
			</div>
		</div>
	</section>
<?php } ?>
<?php if($mainList = $space->mainList()) { ?>
	<section class="intro-start wow fadeIn">
		<div class="container">
			<div class="story-area">
				<div id="storytype" class="">	
					<?php foreach ($mainList as $value) { ?>
						<div class="is-item">
							<a href="<?php echo $value["href"];?>">
								<div class="iservice-item">
									<i class="<?php echo $value["icon"];?>"></i>
									<div class="iser-detail">
										<?php echo $value["headLine"];?>
										<span><?php echo $value["footLine"];?></span>
									</div>
								</div>
							</a>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>
<?php } ?>
<?php foreach ($space->packetList as $value) {
	if($value["list"]) { ?>
		<section class="best-seller wow fadeInUp">
			<div class="container">
				<div class="best-seller-area">
					<div class="best-sell-title">
						<h2>
							<i class="<?php echo $value["icon"];?>"></i> <?php echo $value["head"];?>
						</h2>
						<p><?php echo $value["description"];?></p>
					</div>
					<div class="best-sell-all">
						<a href="<?php echo $space->url($value["pri"]);?>"><span><?php _e("Tümünü Gör");?></span> <i class="fas fa-chevron-right"></i></a>
					</div>
				</div>
				<div class="owl-carousel owl-theme mustu">
					<?php foreach ($value["packets"] as $val) { ?>
						<div class="item" id="paket-<?php echo $val["pk_id"];?>">
							<div class="pack-item <?php echo !empty($val["visuality"]) ? "special":"";?> packbor" <?php echo $space->color($val,'border');?>/>
								<?php if(!empty($val["visuality"])) { ?>
									<div class="pack-special-detail" <?php echo $space->color($val,'b');?>>
										<i class="<?php echo $val["visuality"]["icon"];?>"></i>
										<span><?php echo $val["visuality"]["text"];?></span>
									</div>
								<?php } ?>
								<div class="pack-icon">
									<i <?php echo $space->color($val);?> class="<?php echo $val["icon"];?>"></i>
								</div>
								<div class="pack-title" <?php echo $space->color($val);?>>
									<?php echo $val["platform"];?>
									<span><?php echo $val["pk_adi"];?></span>
								</div>
								<div class="pack-detail detailscroll">
									<ul><?php echo $space->paketOzellik($val["ozellikler"]);?></ul>
								</div>
								<div class="pack-price" <?php echo $space->color($val);?>>
									<?php echo !empty($val["visuality"]["fake"]) ? '<span>'._p($val["visuality"]["fakeAmount"]).'</span>':'';?>
									<?php echo _p($val["pk_fiyat"]);?>
								</div>
								<div class="pack-button-area">
									<a <?php echo $val["href"] ? 'href="'.$val["href"].'"':'disable="true"';?>>
										<button type="button" class="btn btn-pack-buy" <?php echo $space->color($val,'back');?>><?php echo $val["buttonText"];?></button>
									</a>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</section>
	<?php } } ?>
	<?php if($whyUs = $space->whyUs()) { ?>
		<section class="about-us wow fadeInUp">
			<div class="container">
				<div class="why-us-text">
					<span><?php echo $whyUs["headLine"];?></span>
					<h2><i class="fas fa-thumbs-up"></i> <?php echo $whyUs["headFirst"];?></h2>
					<p><?php echo $whyUs["description"];?></p>
				</div>
				<div class="why-us-box">
					<?php foreach ($whyUs["items"] as $value) { ?>
						<div class="wu-item">
							<i class="<?php echo $value->icon;?>"></i>
							<span><?php echo $value->head;?></span>
							<p><?php echo $value->description;?></p>
						</div>
					<?php } ?>
				</div>
			</div>
		</section>
	<?php } ?>
	<?php if($comment = $space->comment()) { ?>
		<section class="testimonial wow fadeInUp">
			<div class="gtco-testimonials">
				<div class="container">
					<span><?php echo $comment["headLine"];?></span>
					<h2><i class="fas fa-comments"></i> <?php echo $comment["headFirst"];?></h2>
					<p><?php echo $comment["description"];?></p>
				</div>
				<div class="owl-carousel owl-theme owl-carousel1">
					<?php foreach ($comment["items"] as $value) { ?>
						<div>
							<div class="card text-center">
								<img class="card-img-top lazy" src="" data-src="<?php echo $space->imagePath($value->avatar);?>" alt="<?php echo $value->name;?>" width="120" height="120">
								<div class="card-body pb-5">
									<h5><?php echo $value->name;?>
									<br/>
									<span><?php echo $value->job;?></span>
								</h5>
								<p class="card-text"><?php echo $value->comment;?></p>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>
<?php } ?>
<?php if($sss = $space->homeSss()) { ?>
	<section class="faq wow fadeInUp">
		<div class="container">
			<div class="why-us-text">
				<span><?php echo $sss["headLine"];?></span>
				<h2><i class="fas fa-question-circle"></i> <?php echo $sss["headFirst"];?></h2>
				<p><?php echo $sss["description"];?></p>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="ns-accordion">
						<?php foreach ($sss["items"]["left"] as $value) { ?>
							<div class="nsa-main">
								<div class="nsa-item">
									<div class="nsa-header"><?php echo $value->question;?></div>
									<div class="nsa-body"><?php echo $value->reply;?></div>
								</div>
							</div>
						<?php  } ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="ns-accordion">
						<?php foreach ($sss["items"]["right"] as $value) { ?>
							<div class="nsa-main">
								<div class="nsa-item">
									<div class="nsa-header"><?php echo $value->question;?></div>
									<div class="nsa-body"><?php echo $value->reply;?></div>
								</div>
							</div>
						<?php  } ?>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php } ?>
<?php if($blog = $space->blogViewList()) { ?>
	<section class="blog-posts wow fadeInUp">
		<div class="container">
			<div class="lb-area">
				<div class="lb-title">
					<h2>
						<i class="fas fa-signature"></i> <?php echo $blog["headLine"];?></h2>
						<p><?php echo $blog["description"];?></p>
					</div>
					<div class="lb-area-all">
						<a href="<?php echo $ayar->menulink('blog');?>"><span><?php _e("Tümünü Gör");?></span> <i class="fas fa-chevron-right"></i></a>
					</div>
				</div>
				<?php if(count($blog["blog_list"])>0) { ?>
					<div class="last-blog-list">
						<?php foreach ($blog["blog_list"] as $value) { ?>
							<div class="lb-item">
								<div class="lb-top">
									<a href="<?php echo $value["href"];?>">
										<img class="lazy" src="" data-src="<?php echo $space->imagePath($value["sayfa_icon"]);?>"
										alt="<?php echo $value["sayfa_seo_baslik"];?>" width="100%" height="210">
									</a>
								</div>
								<div class="lb-detail">
									<a href="<?php echo $value["href"];?>">
										<h4><?php echo $value["sayfa_baslik"];?></h4>
									</a>
									<p><?php echo $value["sayfa_aciklama"];?></p>
								</div>
								<div class="lb-read-button">
									<a class="btn lb-read-btn" href="<?php echo $value["href"];?>"><?php _e("Devamını Oku");?>
									<i class="fas fa-arrow-right"></i>
								</a>
							</div>
						</div>
					<?php } ?>
				</div>
			<?php } ?>

			<?php if(is_array(($blog["page"]))) { ?>
				<div class="post-content packbor mt-5 mb-0">
					<div class="entry-content p-3"><?php echo $blog["page"]["sayfa_icerik"];?></div>
				</div>
			<?php } ?>
		</div>
	</section>

<?php } ?>
<?php $space->footBox("home");?>