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
<?php 
$per_page = 12;
$record_num = $page*$per_page-$per_page;
if($blog = $space->blogViewList($record_num,$per_page,"list")) { ?>
<section class="blog-list-area">
	<div class="container">
		<div class="blog-list">
			<?php foreach ($blog["blog_list"] as $value) { ?>
				<div class="lb-item">
					<div class="lb-top">
						<a href="<?php echo $value["href"];?>">
							<img class="lazy" src="" data-src="<?php echo $space->imagePath($value["sayfa_icon"]);?>"
							alt="<?php echo $value["sayfa_seo_baslik"];?>">
						</a>
					</div>
					<div class="lb-detail">
						<a href="<?php echo $value["href"];?>">
							<h2><?php echo $value["sayfa_baslik"];?></h2>
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
		<nav aria-label="...">
		  <ul class="pagination ns-pagi">
		  	<?php if(!empty($blog["pagenavi"]["before"])) { ?>
			    <li class="page-item">
			      <a class="page-link" href="<?php echo $blog["pagenavi"]["before"]["href"];?>" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
			    </li>
			<?php } ?>
			<?php foreach ($blog["pagenavi"]["pages"] as $value) { ?>
			    <li class="page-item <?php echo $value["active"] ? 'active':'';?>"><a class="page-link" href="<?php echo $value["href"];?>"><?php echo $value["number"];?> <?php echo $value["active"] ? '<span class="sr-only">(current)</span>':'';?></a></li>
			<?php } ?>
		    <?php if(!empty($blog["pagenavi"]["next"])) { ?>
			    <li class="page-item">
			      <a class="page-link" href="<?php echo $blog["pagenavi"]["next"]["href"];?>"><i class="fas fa-chevron-right"></i></a>
			    </li>
			<?php } ?>
		  </ul>
		</nav>
	</div>
</section>
<?php } ?>
<?php $space->footBox("blog_list");?>