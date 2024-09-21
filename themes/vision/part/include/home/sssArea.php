<?php if(isset($sss["quest"]) AND is_array($sss["quest"])){ ?>
<section id="faq" class="wow fadeInUp">
	<div class="container">
		<div class="ns-heading mb-0">
			<span><?php echo $sss["head"];?></span>
			<h2><?php echo $sss["headTitle"];?></h2>
			<p><?php echo $sss["description"];?></p>
		</div>
		<div class="faqArea">
			<div class="row">
				<div class="col-12 col-lg-6">
					<div class="faqwell">
						<?php foreach ($sss["quest"] as $count => $value) {
						if($count %2 == 0){ ?>
						<div class="item">
							<div class="fs-head">
								<span><?php echo $value["ques"];?></span>
								<div class="plusminus">
									<span class="plus"><i class="fas fa-plus"></i></span>
									<span class="minus"><i class="fas fa-minus"></i></span>
								</div>
							</div>
							<div class="fs-content">
								<p><?php echo $value["reply"];?></p>
							</div>
						</div>
					    <?php } } ?>
					</div>
				</div>
				<div class="col-12 col-lg-6">
					<div class="faqwell">
						<?php foreach ($sss["quest"] as $count => $value) {
						if($count %2 == 1){ ?>
						<div class="item">
							<div class="fs-head">
								<span><?php echo $value["ques"];?></span>
								<div class="plusminus">
									<span class="plus"><i class="fas fa-plus"></i></span>
									<span class="minus"><i class="fas fa-minus"></i></span>
								</div>
							</div>
							<div class="fs-content">
								<p><?php echo $value["reply"];?></p>
							</div>
						</div>
					    <?php } } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php } ?>


<script>
    $('.lazy').each(function () {
        const $this = $(this);
        let image_url = $this.attr('data-src');
        $this.attr('src', image_url);
    });
</script>