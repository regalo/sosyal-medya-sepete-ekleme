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
<?php include_once "include/orderCompleted.php";?>