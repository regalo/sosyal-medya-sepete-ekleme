<section id="intall">	
	<div class="container">
		<div class="intall reserve">
			<img class="introBG lazy" src="<?php echo $loaderPng;?>" data-src="<?php echo $introBack;?>" alt="">
			<div class="conts">
				<div class="icobox">
					<i class="<?php echo $icon;?>"></i>
				</div>
				<div class="detabox">
					<h1><?php echo $title_page;?></h1>
					<p><?php echo $description;?></p>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="singlePostArea">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="post-area">
					<div class="post-content mt-3 mb-5">
						<div class="post-body">
							<?php echo $content;?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<?php include_once "include/sidebar.php";?>
			</div>
		</div>
	</div>
</section>