<section class="intro-head" style="background: url(<?php echo $space->imagePath(ns_filter('spaceIntroBack'));?>);">
	<div class="container">
		<div class="ihead-well">
			<div class="well-one">
				<i class="fas fa-paperclip durdur"></i>
			</div>
			<div class="well-two">
				<h1><?php echo ns_filter('title');?></h1>
				<p><?php echo ns_filter('description');?></p>
			</div>
		</div>
	</div>
</section>
<section class="content-area">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="post-content">
					<div class="entry-content page">
						<?php echo ns_filter('sayfa','sayfa_icerik');?>
					</div>
				</div>
			</div>
			<?php include_once "include/sideBar.php";?>
		</div>
	</div>
</section>
<?php $space->footBox("single_page");?>