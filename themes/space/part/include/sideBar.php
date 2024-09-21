<div class="col-md-4">
	<?php if($sideBlog = $space->sidebarView("spaceSidebarBlog") AND $blog = $space->blogViewList(0,$sideBlog["count"])) { ?>
	<div class="sidebar-item">
		<div class="sidebar-title">
			<span><?php echo $sideBlog["headLine"];?></span>
			<h3><?php echo $sideBlog["headFirst"];?></h3>
			<i class="<?php echo $sideBlog["icon"];?>"></i>
		</div>
		<div class="other-blog-list">
			<?php foreach ($blog["blog_list"] as $value) { ?>
				<div class="ob-item">
					<div class="ob-thumb">
						<a href="<?php echo $value["href"];?>">
							<img class="lazy" src="" data-src="<?php echo $space->imagePath($value["sayfa_icon"]);?>"
							alt="<?php echo $value["sayfa_seo_baslik"];?>">
						</a>
					</div>
					<div class="ob-detail">
						<a href="<?php echo $value["href"];?>">
							<h4><?php echo $value["sayfa_baslik"];?></h4>
						</a>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
    <?php } ?>
    <?php if($sideServices = $space->sidebarView("spaceSidebarServices") AND $mainList = $space->mainList(array("options"=>$sideServices["options"]))) { ?>
	<div class="sidebar-item">
		<div class="sidebar-title">
			<span><?php echo $sideServices["headLine"];?></span>
			<h3><?php echo $sideServices["headFirst"];?></h3>
			<i class="<?php echo $sideServices["icon"];?>"></i>
		</div>
		<div class="sidebar-service-list">
			<?php foreach ($mainList as $value) { ?>
			<div class="sise-item">
				<div class="sise-icon">
					<i class="<?php echo $value["icon"];?>"></i>
				</div>
				<div class="sise-detail">
					<a href="<?php echo $value["href"];?>">
						<?php echo $value["headLine"];?>
					    <span><?php echo $value["footLine"];?></span>
					</a>
				</div>
				<div class="sise-action">
					<a href="<?php echo $value["href"];?>">
						<i class="fas fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
    <?php } ?>
    <?php if($sideContact = $space->sidebarView("spaceSidebarContact")) { ?>
	<div class="sidebar-item">
		<div class="sidebar-title">
			<span><?php echo $sideContact["headLine"];?></span>
			<h3><?php echo $sideContact["headFirst"];?></h3>
		</div>
		<div class="sidebar-contact">
			<i class="<?php echo $sideContact["icon"];?>"></i>
			<h4><?php echo $sideContact["headFirst"];?></h4>
			<p><?php echo $sideContact["description"];?></p>
			<a href="<?php echo $sideContact["buttonHref"];?>" class="btn sidebar-contact-btn"><?php echo $sideContact["buttonText"];?></a>
		</div>
	</div>
    <?php } ?>
</div>