<div class="item">
	<div class="number">
		<?php echo $key+1;?>
	</div>
	<div class="updown">
		<div class="HLup" onclick="homeListing(this);" data-key="<?php echo $key>0 ? $key:'none';?>" data-type="down">
			<i class="fas fa-arrow-up"></i>
		</div>
		<div class="HLdown" onclick="homeListing(this);" data-key="<?php echo ($key+1)<count($loftAlignment["list"]) ? $key:'none';?>" data-type="up">
			<i class="fas fa-arrow-down"></i>
		</div>
	</div>
	<div class="input">
		<input type="text" class="form-control" value="<?php echo $value["name"];?>" disabled>
	</div>
	<?php if(isset($value["options"])) { ?>
	<div class="input">
		<select class="form-control" onchange="homeListOff(this);" data-key="<?php echo $key;?>" data-type="options">
			<option value="0" disabled="" selected>Sayfa Seç</option>
			<?php foreach ($pageList as $val) { ?>
			<option value="<?php echo $val["sayfa_id"];?>" <?php echo $value["options"]==$val["sayfa_id"] ? 'selected':'';?>><?php echo $val["sayfa_baslik"];?></option>
			<?php } ?>
		</select>
	</div>
	<?php } ?>
	<?php if($value["include"]=="contentArea"){	?>
	<div class="<?php echo isset($copyKey) ? 'remove':'copy';?>" title="<?php echo isset($copyKey) ? 'Sil':'Çoğalt';?>"  onclick="homeListing(this);" data-key="<?php echo $key;?>" data-type="<?php echo isset($copyKey) ? 'trash':'copy';?>">
		<i class="fas fa-<?php echo isset($copyKey) ? 'trash':'copy';?>"></i>
	</div>
    <?php $copyKey = true;  } ?>
	<div class="statu" title="Göster/Gizle">
		<label class="switch mb-0">
			<input data-key="<?php echo $key;?>" type="checkbox" <?php echo $value["statu"] ? 'checked=""':'';?> onchange="homeListOff(this);" data-type="statu">
			<span class="btn-ackapa round"></span>
		</label>
	</div>
</div>