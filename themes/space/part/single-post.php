<section class="content-area">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="post-content">
					<div class="post-image">
						<img class="lazy" src="" data-src="<?php echo $space->imagePath(ns_filter('blog','sayfa_icon'));?>" alt="<?php echo ns_filter('title');?>">
					</div>
					<div class="post-header">
						<h1><?php echo ns_filter('title');?></h1>
					</div>
					<div class="entry-content">
						<?php echo ns_filter('blog','sayfa_icerik');?>
					</div>
				</div>
			</div>
			<?php include_once "include/sideBar.php";?>
		</div>
	</div>
</section>
<?php $space->footBox("single_post");?>