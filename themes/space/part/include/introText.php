<div class="intro-text-area">
	<h1><?php echo $intro["headLine"];?></h1>
	<p><?php echo $intro["description"];?></p>
	<?php if($intro["button"]=="1") { ?>
	<div class="it-buttons">
		<?php foreach ($intro["buttons"] as $value) { ?>
			<div class="it-item">
				<i class="<?php echo $value->icon;?>"></i> <span><?php echo $value->text;?></span>
			</div>
		<?php } ?>
	</div>
    <?php } ?>
</div>