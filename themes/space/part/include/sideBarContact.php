<div class="col-md-4">
	<?php if($contactInfo = $space->sidebarView("spaceSideContactInfo") AND $contactInfo["statu"]=="1") { ?>
	<div class="sidebar-item">
		<div class="sidebar-title">
			<span><?php echo $contactInfo["headLine"];?></span>
			<h3><?php echo $contactInfo["headFirst"];?></h3>
		</div>
		<div class="contact-sidebox">
			<div class="cosi-icon">
				<i class="<?php echo $contactInfo["icon"];?>"></i>
			</div>
			<div class="cosi-detail">
				<h4><?php echo $contactInfo["company"];?></h4>
				<span><?php echo $contactInfo["phone"];?></span>
				<span><?php echo $contactInfo["mail"];?></span>
				<span><?php echo $contactInfo["adres"];?></span>
			</div>
		</div>
	</div>
    <?php } ?>
	<?php if($sssContact = $space->contactSss()) { ?>
	<div class="sidebar-item">
		<div class="sidebar-title">
			<span><?php echo $sssContact["headLine"];?></span>
			<h3><?php echo $sssContact["headFirst"];?></h3>
		</div>
		<div class="ns-accordion">
			<?php foreach ($sssContact["items"] as $value) { ?>
			<div class="nsa-main">
				<div class="nsa-item">
					<div class="nsa-header"><?php echo $value->question;?></div>
					<div class="nsa-body"><?php echo $value->reply;?></div>
				</div>
			</div>
		    <?php } ?>
		</div>
	</div>
    <?php } ?>
	<?php if($sideContact = $space->sidebarView("spaceSidebarContact") AND ($sideContact["place"]==1)) { ?>
	<div class="sidebar-item">
		<div class="sidebar-title">
			<span><?php echo $sideContact["headLine"];?></span>
			<h3><?php echo $sideContact["headFirst"];?></h3>
		</div>
		<div class="sidebar-contact">
			<i class="<?php echo $sideContact["icon"];?>"></i>
			<h4><?php echo $sideContact["headFirst"];?></h4>
			<p><?php echo $sideContact["description"];?></p>
			<?php if($sideContact["button"]) { ?><a href="<?php echo $sideContact["buttonHref"];?>" class="btn sidebar-contact-btn"><?php echo $sideContact["buttonText"];?></a>
		    <?php } ?>
		</div>
	</div>
    <?php } ?>
</div>