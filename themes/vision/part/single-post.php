<section class="blogContent">
	<div class="container">
		<div class="breadcrumb">
			<ul>
				<?php foreach ($breadcrumb as $value) { ?>
					<li><a href="<?php echo $value["href"];?>"><?php echo $value["name"];?> </a></li>
				<?php } ?>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class="post-area">
					<h1><?php echo $title_page;?></h1>
					<div class="post-content mt-3">
						<div class="post-thumbnail">
							<span class="post-date">
								<?php echo $publishDate;?>
							</span>
							<img src="<?php echo $image;?>" alt="<?php echo $title_page;?>">
						</div>
						<div class="post-body">
							<?php echo $content;?>
						</div>
			     <?php include_once "/home/takip179/public_html/hizlime.php";?>
					</div>
				</div>
				<?php include_once "include/comment.php";?>
			</div>
			<div class="col-md-4">
				<?php include_once "include/sidebar.php";?>
			</div>
		</div>
	</div>
</section>