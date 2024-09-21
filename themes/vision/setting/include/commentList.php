<div class="com-list" data-commentList="<?php echo $key;?>">
	<div class="com-element">
		<div class="com-img-area">
			<div class="onecik-onizle ortambutLoft" data-ortam="commentAvatar<?php echo $key;?>" data-url="<?php echo $loft->path($value["avatar"],"img");?>" data-input="<?php echo $value["avatar"];?>">
				<img class="ortam-sec" src="https://demo.nivusoft.com/space/panel/images/ortam-sec.png">
				<div class="tumb-oniztext">
					<img id="commentAvatar<?php echo $key;?>-onizleme" src="<?php echo $loft->path($value["avatar"],"img");?>">
					<input type="hidden" id="commentAvatar<?php echo $key;?>-input" name="data[loftCustomerComment][item2][list][<?php echo $key;?>][avatar]" required="" value="<?php echo $value["avatar"];?>">
				</div>
			</div>
		</div>
		<div class="cont">
			<div class="form-row">
				<div class="col-md-4">
					<div class="form-group">
						<input type="text" class="form-control" required="" name="data[loftCustomerComment][item2][list][<?php echo $key;?>][name]" placeholder="Müşteri Adı" value="<?php echo $value["name"];?>">
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group">
						<input type="text" class="form-control" required="" name="data[loftCustomerComment][item2][list][<?php echo $key;?>][job]" placeholder="Meslek Giriniz" value="<?php echo $value["job"];?>">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<select class="form-control" name="data[loftCustomerComment][item2][list][<?php echo $key;?>][raiting]">
							<?php for ($i=1; $i < 6; $i++) { ?>
								<option value="<?php echo $i;?>" <?php echo $value["raiting"]==$i ? 'selected':'';?>><?php echo $i;?> Yıldız</option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group mb-0">
						<textarea class="form-control" required="" name="data[loftCustomerComment][item2][list][<?php echo $key;?>][comment]"><?php echo $value["comment"];?></textarea>
					</div>
				</div>
			</div>
		</div>
		<div class="delete">
			<button type="button" class="butto butto-danger butto-xs commentListDelete" data-key="<?php echo $key;?>">Sil</button>
		</div>
	</div>
</div>