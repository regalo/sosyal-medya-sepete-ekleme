<section id="testimonial" class="wow fadeInUp">
	<div class="ns-heading mb-0">
		<span><?php echo $customerComment["head"];?></span>
		<h2><?php echo $customerComment["headTitle"];?></h2>
		<p><?php echo $customerComment["description"];?></p>
	</div>
	<div class="testiarea">
		<div class="splide testimonial">
			<div class="splide__track">
				<ul class="splide__list">
					<?php foreach ($customerComment["list"] as $value) { ?>
					<li class="splide__slide">
						<div class="testimonial-item">
							<div class="inside">
								<div class="person">
									<img src="<?php echo $value["avatar"];?>" alt="<?php echo $value["name"];?>">
									<div class="name"><?php echo $value["name"];?></div>
									<div class="CustomerJob"><?php echo $value["job"];?></div>
								</div>
								<div class="detail">
									<p><?php echo $value["comment"];?></p>
									<div class="stars">
										<span class="star <?php echo $value["raiting"]>0 ? 'active':'';?>"><i class="fas fa-star"></i></span>
										<span class="star <?php echo $value["raiting"]>1 ? 'active':'';?>"><i class="fas fa-star"></i></span>
										<span class="star <?php echo $value["raiting"]>2 ? 'active':'';?>"><i class="fas fa-star"></i></span>
										<span class="star <?php echo $value["raiting"]>3 ? 'active':'';?>"><i class="fas fa-star"></i></span>
										<span class="star <?php echo $value["raiting"]>4 ? 'active':'';?>"><i class="fas fa-star"></i></span>
									</div>
								</div>
							</div>
						</div>
					</li>
				    <?php } ?>
				</ul>
			</div>
		</div>
	</div>
</section>