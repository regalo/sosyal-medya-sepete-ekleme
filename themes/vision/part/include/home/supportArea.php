<section id="support" class="wow fadeInUp">
	<div class="container">
		<div class="support-bottom">
			<div class="text">
				<?php echo $footer["head"];?>
				<span><?php echo $footer["headLine"];?></span>
			</div>
			<div class="action">
				<?php if($footer["whatsappStatu"]=="aktif") { ?>
					<a class="wp anibut" target="_blank" href="<?php echo $footer["whatsapp"];?>" rel="noreferrer">
						<span><?php _e("Whatsapp");?></span> <i class="fab fa-whatsapp"></i>
					</a>
				<?php } ?>
				<a class="fcont anibut" href="<?php echo $footer["buttonHref"];?>">
					<span><?php echo $footer["buttonText"];?></span> <i class="<?php echo $footer["buttonIcon"];?>"></i>
				</a>
			</div>
		</div>
	</div>
</section>