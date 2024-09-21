<section class="intro-head" style="background: url(<?php echo $space->imagePath(ns_filter('spaceIntroBack'));?>);">
	<div class="container">
		<div class="ihead-well">
			<div class="well-one">
				<i class="<?php echo ns_filter('icon');?>"></i>
			</div>
			<div class="well-two">
				<h1><?php echo sprintf(_e("%s Paketleri",true),ns_filter('title'));?></h1>
				<p><?php echo ns_filter('description');?></p>
				<div class="wt-icons d-none">
					<a href="#"><i class="fas fa-heart"></i></a>
					<a href="#"><i class="fas fa-comment"></i></a>
					<a href="#"><i class="fas fa-eye"></i></a>
				</div>
			</div>
		</div>
	</div>
</section>
<?php if($category = $space->packetList(ns_filter('paketler','for'))) { ?>
<section class="packs-area">
	<div class="container">
		<div class="pack-list">
		<?php foreach ($category["packets"] as $val) { ?>
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
				<div class="pack-detail">
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
		<?php } ?>
	</div>
	</div>
</section>
<section class="article-area mt-3">
	<div class="container">
		<div class="post-content packbor mt-5">
			<div class="entry-content p-3"><?php echo ns_filter('kategori','hz_makale');?></div>
		</div>
	</div>
</section>
<?php } ?>
<?php $space->footBox("category");?>