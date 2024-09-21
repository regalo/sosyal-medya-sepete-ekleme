<div class="sidebar">
	<?php if(!isset($pageContact)) { ?>
	<div class="most-popular mb-5">
		<div class="title-heading sitleico">
			<span><?php echo $sidebar["blog"]["head"];?></span>
			<h2><?php echo $sidebar["blog"]["headLine"];?></h2>
			<i class="<?php echo $sidebar["blog"]["icon"];?>"></i>
		</div>
		<?php foreach ($sidebar["blog"]["list"] as $key => $value) { ?>
		<div class="item">
			<div class="thumb">
				<a href="<?php echo $value["url"];?>">
					<img src="<?php echo $value["thumb"];?>" alt="<?php echo $value["sayfa_baslik"];?>">
				</a>
			</div>
			<div class="title">
				<a href="<?php echo $value["url"];?>"><?php echo $value["sayfa_baslik"];?></a>
			</div>
		</div>
		<?php } ?>
	</div>
	<div class="SideServices mb-5">
		<div class="title-heading sitleico">
			<span><?php echo $sidebar["service"]["head"];?></span>
			<h2><?php echo $sidebar["service"]["headLine"];?></h2>
			<i class="<?php echo $sidebar["service"]["icon"];?>"></i>
		</div>
		<div class="sideServiceList">
			<?php foreach ($sidebar["service"]["list"] as $value) { ?>
			<a href="<?php echo $value["url"];?>">
				<div class="item">
					<div class="icon">
						<i class="<?php echo $value["icon"];?>"></i>
					</div>
					<div class="title">
						<?php echo $value["name"];?>
						<span><?php echo $value["span"];?></span>
					</div>
					<div class="action">
						<i class="fas fa-arrow-right"></i>
					</div>
				</div>
			</a>
			<?php } ?>
		</div>
	</div>
	<div class="SideContact mb-5">
		<div class="title-heading sitleico">
			<span><?php echo $sidebar["specialBox"]["head"];?></span>
			<h2><?php echo $sidebar["specialBox"]["headLine"];?></h2>
			<i class="<?php echo $sidebar["specialBox"]["icon"];?>"></i>
		</div>
		<div class="sideContArea">
			<div class="icon">
				<i class="<?php echo $sidebar["specialBox"]["icon"];?>"></i>
			</div>
			<div class="desc">
				<p><?php echo $sidebar["specialBox"]["description"];?></p>
			</div>
			<div class="action">
				<a class="contact-btn anibut navlink" href="<?php echo $sidebar["specialBox"]["buttonHref"];?>">
					<i class="<?php echo $sidebar["specialBox"]["buttonIcon"];?>"></i> <?php echo $sidebar["specialBox"]["buttonText"];?>
				</a>
			</div>
		</div>
	</div>
	<?php } else { ?>
	<?php if($sidebar["contact"]["statu"]=="aktif") { ?>
		<div class="SideContactBox mb-5">
			<div class="title-heading sitleico">
				<span><?php echo $sidebar["contact"]["head"];?></span>
				<h2><?php echo $sidebar["contact"]["headLine"];?></h2>
				<i class="<?php echo $sidebar["contact"]["icon"];?>"></i>
			</div>
			<div class="SideContBoxArea">
				<h3><?php echo $contactInfo["company"];?></h3>
				<ul>
					<li><?php echo $contactInfo["phone"];?></li>
					<li class="email"><?php echo $contactInfo["mail"];?></li>
					<li><?php echo $contactInfo["adres"];?></li>
				</ul>
			</div>
		</div>
	<?php } ?>
	<?php if($sidebar["faq"]["statu"]=="aktif") { ?>
		<div class="SideSSS">
			<div class="title-heading sitleico">
				<span><?php echo $sidebar["faq"]["head"];?></span>
				<h2><?php echo $sidebar["faq"]["headLine"];?></h2>
				<i class="<?php echo $sidebar["faq"]["icon"];?>"></i>
			</div>
			<div class="faqwell">
				<?php if(isset($sidebar["faq"]["ques"]) AND is_array($sidebar["faq"]["ques"])) { ?>
					<?php foreach ($sidebar["faq"]["ques"] as $value) { ?>
						<div class="item">
							<div class="fs-head">
								<span><?php echo $value["ques"];?></span>
								<div class="plusminus">
									<span class="plus">
										<i class="fas fa-plus"></i>
									</span>
									<span class="minus">
										<i class="fas fa-minus"></i>
									</span>
								</div>
							</div>
							<div class="fs-content">
								<p><?php echo $value["reply"];?></p>
							</div>
						</div>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
	<?php } ?>
	<?php } ?>
</div>