<div class="show-area">
	<div class="show-item1">
		<h1><?php echo $intro["headLine"];?></h1>
		<p><?php echo $intro["description"];?></p>
		<?php if($intro["button"]=="1") { ?>
			<div class="show-buttons">
				<?php foreach ($intro["buttons"] as $value) { ?>
				<div class="sb-item">
					<i class="<?php echo $value->icon;?>"></i> <span><?php echo $value->text;?></span>
				</div>
			    <?php } ?>
			</div>
	    <?php } ?>
	</div>
	<div class="show-item2">
		<img src="<?php echo $space->imagePath($intro["image"]);?>" alt="">
	</div>
</div>