<div style="<?php echo $package["statu"]["style"];?>" class="packitem inslide <?php echo $package["statu"]["head"]!=false ? 'overi':'';?>" data-packet="<?php echo $package["pk_id"];?>">
	<div class="packHead <?php echo $package["statu"]["head"]!=false ? 'have':'';?>">
		<?php if($package["statu"]["head"]!=false) { ?>
			<span>
				<?php echo isset($package["statu"]["icon"]) ? '<i class="'.$package["statu"]["icon"].'"></i>':'';?>
				<?php echo $package["statu"]["head"];?>
			</span>
		<?php } ?>
	</div>
	<div class="packInside">
		<div class="packTop">
			<div class="icon">
				<i class="<?php echo $package["icon"];?>"></i>
			</div>
			<div class="title">
				<span><?php echo $package["platformName"];?></span>
				<?php echo $package["name"];?>
			</div>
		</div>
		<div class="packDetail">
			<ul>
				<?php foreach ($package["features"] as $say => $feature) {
					if($say=="3")
						echo '<span class="moresi">';
					echo '<li>'.$feature.'</li>';
					if($say>count($package["features"]))
						echo '</span>';
				} ?>
			</ul>
			<?php if(count($package["features"])>3){ ?>
				<div class="packDetailMore">
					<span><?php _e("tumunu-gor");?> <i class="fas fa-chevron-down"></i></span>
				</div>
			<?php } ?>
		</div>
		<div class="packPrice">
			<!-- <?php if(isset($package["statu"]["fakediscount"])) { ?>
				<span><?php echo $package["statu"]["fakediscount"];?></span>
			<?php } ?> -->
            <?php if(!empty($package["pk_fake_indirim_orani"]) && ((float)$package["pk_fake_indirim_orani"]) > 0) { ?>
                <?php 
                    $price = (float)$package["price"];
                    $pk_fake_indirim_orani = (float)$package["pk_fake_indirim_orani"];
                    $fake_price =  ($price * 100) / (100 - $pk_fake_indirim_orani);
                    $fake_price = number_format($fake_price, 2, '.', "");
                ?>
				<span><?php echo $fake_price;?>₺</span>
			<?php } ?>
			<?php echo $package["price"];?>
		</div>
		<div class="packBottom">
			<a class="packBuyBTN anibuybtn <?php echo $package["pk_durum"] ? '':'noneOrder';?>" href="<?php echo $package["pk_durum"] ? $package["url"]:'#';?>">
				<?php  $package["pk_durum"] ? _e("satin-al"):_e("satisa-kapali");?> <span><i class="fas fa-arrow-right"></i></span>
			</a>
		</div>
		<?php if($costimize["favoriStatu"]=="aktif") { ?>
			<button data-type="packetFavori" data-favPacket="<?php echo $package["pk_id"];?>" class="favPack" title="<?php _e("favorilerime-ekle");?>"></button>
		<?php } ?>
	</div>
</div>
