<section class="intro-head" style="background: url(<?php echo $space->imagePath(ns_filter('spaceIntroBack'));?>);">
	<div class="container">
		<div class="ihead-well">
			<div class="well-one">
				<i class="<?php echo ns_filter('icon');?>"></i>
			</div>
			<div class="well-two">
				<h1><?php echo sprintf(_e("%s Servisleri",true),ns_filter('title'));?></h1>
				<p><?php echo ns_filter('description');?></p>
				<?php $list = $space->categoryList();?>
				<div class="wt-icons">
					<?php foreach ($list as $value) {
						echo '<a href="'.$value["href"].'"><i class="'.$value["icon"].'"></i></a>';
					} ?>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="platform-area">
	<div class="container">
		<div class="platform-list">
			<!-- Opsiyonel Alan // Eğer eleman sayısı tek sayı ise sonuncu elemana plat-fw classını ekle -->
			<?php foreach ($list as $value) { ?>
				<div class="plat-item">
				<div class="plat-icon">
					<i class="<?php echo $value["icon"];?>"></i>
				</div>
				<div class="plat-detail">
					<h2><?php echo $value["name"];?></h2>
					<p><?php echo $value["description"];?></p>
				</div>
				<div class="plat-action">
					<a href="<?php echo $value["href"];?>" class="btn plat-action-btn"><?php _e("İncele");?></a>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</section>
<?php $space->footBox("platform");?>