</main>
<?php if($footer) { ?>
<footer>
	<div class="footer-area">
		<div class="footer-body">
			<div class="container">
				<div class="foot-content">
					<div class="fc-logo">
						<a href="<?php echo $space->baseUrl;?>">
							<img src="<?php echo $space->logo;?>" alt="<?php echo $space->sitename;?>" width="120" height="70">
						</a>
					</div>
					<div class="fc-navs">
						<ul>
							<?php foreach ($space->menuBuilder("footer",$footer["footerMenu"]) as $value) { extract($value); ?>
							<li><a href="<?php echo $href;?>"><?php echo $head;?></a></li>
						    <?php } ?>
						</ul>
					</div>
				</div>
				<div class="foot-down">
					<div class="fd-copyright"><?php echo $footer["copyright"];?></div>
					<div class="fd-social-media">
						<?php foreach ($footer["socialMedia"] as $value) {
						if(!empty($value->href))
							{ ?>
							<a href="<?php echo $value->href;?>">
								<i class="<?php echo $value->icon;?>"></i>
							</a>
						<?php } } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<?php } ?>
<div class="well-bros">
<div class="wb-itemz">
	<?php if($whatsApp = $space->buttons("fixedWhatsApp")) { ?>
		<a href="<?php echo $whatsApp["href"];?>" target="_blank" rel="noreferrer">
		<div class="wb-item wb-whatsapp">
			<div class="wb-icon">
				<i class="fab fa-whatsapp"></i>
			</div>
			<div class="wb-text"><?php echo $whatsApp["text"];?></div>
		</div>
	</a>
    <?php } ?>
    <?php if($phone = $space->buttons("fixedPhone")) { ?>
	<a href="<?php echo $phone["href"];?>">
		<div class="wb-item wb-phone">
			<div class="wb-icon">
				<i class="fas fa-phone"></i>
			</div>
			<div class="wb-text"><?php echo $phone["text"];?></div>
		</div>
	</a>
	<?php } ?>
	<?php if($search = $space->buttons("fixedSearch")) { ?>
	<div class="wb-item wb-osearch">
		<div class="wb-icon">
			<i class="fas fa-search"></i>
		</div>
		<div class="wb-text"><?php echo $search["text"];?></div>
	</div>
    <?php } ?>
    <?php if(!$whatsApp AND !$search AND !$phone) { 
    	echo '<style type="text/css">.well-bros{display: none !important;]</style>';
    }?>
</div>
<div class="wb-item wb-close">
	<div class="wb-icon">
		<div class="ico-chance">
			<i class="fas fa-times"></i>
		</div>
	</div>
</div>
</div>
<div class="search-area">
<div class="container">
	<form id="order_search" method="POST">
		<div class="search-input">
			<div class="search-input-relative">
				<input type="hidden" name="action" value="response">
                <input type="hidden" name="include" value="orderSearch">
				<input type="text" class="form-control" name="islem_kodu" required="" minlength="6" placeholder="<?php _e("Sipariş Numarası Giriniz");?>">
				<button type="submit" class="btn search-input-btn" data-href="<?php echo $ayar->menulink("iletisim");?>"><i class="fas fa-search"></i> <span><?php _e("Sorgula");?></span></button>
			</div>
			<div class="search-close">
				<i class="fas fa-times"></i>
			</div>
		</div>
	</form>
</div>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo $space->path();?>assets/font-awesome/css/font-awesome.min.css"  async="async">
<link href="<?php echo $space->path();?>assets/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" async="async">
<link rel="stylesheet" type="text/css" href="<?php echo $space->path();?>assets/animate.min.css"  async="async">
<script src="https://kit.fontawesome.com/d3897fd5a7.js" crossorigin="anonymous" async></script>
<script src="<?php echo $space->path();?>assets/spacenivu.js?v=<?php echo ns_filter('spaceHeader',"item4");?>"></script>
<script src="<?php echo $space->path();?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $space->path();?>assets/wow.min.js"></script>
<script src="<?php echo $space->path();?>assets/owlcarousel/owl.carousel.min.js"></script>
<script src="<?php echo $space->path();?>assets/owlcarousel/kaydirmaca.js"></script>
<script src="<?php echo $space->path();?>assets/genel.js?v=searchRequest"></script>
<?php echo ns_filter("footer");?>
<?php if($space->wb_close()) { ?>
<script type="text/javascript">wb_closeFunc();</script>
<?php } ?>
</body>
</html>