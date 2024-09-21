<div class="item" data-whyBox="<?php echo $key;?>">
	<div class="thumb">
		<div class="onecik-onizle ortambutLoft" data-ortam="WhyourImage<?php echo $key;?>" data-url="<?php echo $loft->path($value["image"],"img");?>" data-input="<?php echo $value["image"];?>">
			<img class="ortam-sec" src="https://demo.nivusoft.com/space/panel/images/ortam-sec.png">
			<div class="tumb-oniztext">
				<img id="WhyourImage<?php echo $key;?>-onizleme" src="<?php echo $loft->path($value["image"],"img");?>">
				<input type="hidden" id="WhyourImage<?php echo $key;?>-input" name="data[loftWhyOur][item2][list][<?php echo $key;?>][image]" required="" value="<?php echo $value["image"];?>">
			</div>
		</div>
	</div>
	<div class="inps">
		<div class="form-row">
			<div class="col-md-6">
				<div class="form-group mb-2">
					<div class="input-group mb-2 renkhover">
						<div class="butto mr-1 smgir rengiyazdir" id="colorWhy<?php echo $key;?>" style="background: rgb(<?php echo $value["color"];?>); width: calc(100% - 10px); text-shadow: none;">								</div>
						<input type="text" class="form-control renksecici smginx" name="data[loftWhyOur][item2][list][<?php echo $key;?>][colorDefault]" data-renk="colorWhy<?php echo $key;?>" required="" value="<?php echo $value["colorDefault"];?>">
						<input type="hidden" data-renkRgb="colorWhy<?php echo $key;?>" name="data[loftWhyOur][item2][list][<?php echo $key;?>][colorDefaultRgb]" value="<?php echo $value["colorDefaultRgb"];?>">
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group mb-2">
					<div class="input-group">
						<div class="butto butto-light mr-1 smgir">
							<i id="iconView_WhyourIcon<?php echo $key;?>" class="<?php echo $value["icon"];?>" aria-hidden="true"></i>
						</div>
						<input class="form-control smginx" id="iconInput_WhyourIcon<?php echo $key;?>" name="data[loftWhyOur][item2][list][<?php echo $key;?>][icon]" value="<?php echo $value["icon"];?>">
						<button type="button" id="iconButton_WhyourIcon<?php echo $key;?>" class="butto butbor butto-dark icon-modal" data-toggle="modal" data-target="#iconSec" data-icon="<?php echo $value["icon"];?>" data-add="WhyourIcon<?php echo $key;?>">Icon Seç</button>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group mb-2">
					<input type="text" class="form-control" name="data[loftWhyOur][item2][list][<?php echo $key;?>][head]" placeholder="Başlık (Örn: 7/24 Canlı Destek)" value="<?php echo $value["head"];?>">
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group mb-0">
					<textarea class="form-control" name="data[loftWhyOur][item2][list][<?php echo $key;?>][description]" placeholder="Kısa Açıklama"><?php echo $value["description"];?></textarea>
				</div>
			</div>
		</div>
	</div>
	<div class="delete">
		<button type="submit" class="butto butto-xs butto-success whyOurUpdate">Güncelle</button>
		<button type="button" class="butto butto-xs butto-danger whyOurDeleted ml-2 <?php echo count($loftWhyOur["list"])>3 ? '':'nodelete';?>" data-key="<?php echo $key;?>">Sil</button>
	</div>
</div>