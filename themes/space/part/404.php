<section class="intro-head" style="background: url(<?php echo $space->imagePath(ns_filter('spaceIntroBack'));?>);">
	<div class="container">
		<div class="ihead-well">
			<div class="well-one">
				<i class="<?php echo ns_filter('icon');?>"></i>
			</div>
			<div class="well-two">
				<h1><?php echo ns_filter('title');?></h1>
				<p><?php echo ns_filter('description');?></p>
			</div>
		</div>
	</div>
</section>
<section class="notfoundpage">
	<div class="container">
		<div class="notFoundArea">
			<h2><?php _e("contact-head");?></h2>
			<span><?php _e("contact-description");?></span>
			<div class="nf-flex">
				<a href="<?php echo $space->baseUrl;?>">
					<div class="nf-item">
						<i class="fas fa-home"></i> <?php _e("Anasayfa");?>
					</div>
				</a>
				<a href="<?php echo $space->url(ns_filter("iletisimpage"));?>">
					<div class="nf-item">
						<i class="fas fa-envelope"></i> <?php echo ns_filter("iletisimpage","item3");?>
					</div>
				</a>
			</div>
		</div>
	</div>
</section>
<?php $space->footBox("error");?>