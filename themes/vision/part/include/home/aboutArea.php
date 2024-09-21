<section id="aboutus" class="dashline wow fadeInUp">
	<div class="container">
		<div class="AboutArea <?php echo $mainAbout["backgroundType"];?>">
			<div class="imgData">
				<img class="lazy" src="<?php echo $mainAbout["background"]; ?>" data-src="<?php echo $mainAbout["background"];?>" alt="<?php echo $mainAbout["headTitle"];?>">
				<?php if($mainAbout["boxStatu"]=="aktif"){?>
				<div class="datainfo">
					<?php foreach ($mainAbout["box"] as $value) { ?>
						<div class="item">
							<div class="icon">
								<i class="<?php echo $value["icon"];?>"></i>
							</div>
							<div class="detail">
								<span><?php echo $value["count"];?></span>
								<?php echo $value["text"];?>
							</div>
						</div>
					<?php } ?>
				</div>
				<?php } ?>
			</div>
			<div class="AboDetail">
				<div class="heading">
					<span><?php echo $mainAbout["head"];?></span>
					<h2><?php echo $mainAbout["headTitle"];?></h2>
				</div>
				<div class="content">
					<?php echo $mainAbout["content"];?>
				</div>
				<?php if($mainAbout["buttonStatu"]=="aktif"){?>
					<div class="action">
						<div class="aboaction">
							<a class="abobtn anibut" href="<?php echo $mainAbout["href"];?>"><?php echo $mainAbout["buttonText"];?></a>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
<script>
    window.onload = function() {
        var images = new Array(),
            query = $q('img.lazy'),
            processScroll = function() {
            // ...
            };

        for (var i = 0; i < query.length; i++) {
            images.push(query[i]);
        }

        addEventListener('scroll', throttle(processScroll, 500));
    };
</script>