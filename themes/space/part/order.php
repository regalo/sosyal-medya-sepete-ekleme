<?php if($siparis->packet = $space->orderNow($orderStep)) {?>
<section class="intro-head" style="background: url(<?php echo $space->imagePath(ns_filter('spaceIntroBack'));?>);">
	<div class="container">
		<div class="ihead-well">
			<div class="well-one">
				<i class="<?php echo ns_filter('icon');?>"></i>
			</div>
			<div class="well-two">
				<h1><?php echo ns_filter('title');?></h1>
				<p><?php echo ns_filter('description');?></p>
				<div class="wt-icons">
					<span><?php _e("Ödeme Yöntemleri");?></span>
					<?php
						$payment_medhods = $ayar->OdemeFirma();
						if (is_array($payment_medhods)) {
							foreach ($payment_medhods as $value) {
								extract($value);
								if($statu)
									echo '<a href="#" title="'._py($id)["name"].'"><i class="'._py($id)["icon"].'"></i></a>';
							}
						}
					?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php include_once $siparis->packet["include"];?>
<?php } ?>
<?php $space->footBox("order");?>