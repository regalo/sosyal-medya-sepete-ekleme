<?php foreach ($commentList as $value) { ?>
<div class="item">
	<div class="detail">
		<div class="top">
			<span>(<?php echo $value["type"];?>)<?php echo $value["ayar_1"];?></span> <?php echo $value["contentTitle"];?>
		</div>
		<div class="bottom">
			<?php echo $value["comment"];?>
		</div>
	</div>
	<div class="action">
		<a href="#" class="butto butto-xs badge-<?php echo $value["statu"] ? 'success':'danger';?> butbor d-inline-block">
			<i class="fas fa-<?php echo $value["statu"] ? 'check':'info';?>"></i>
		</a>
		<a href="<?php echo $value["statu"] ? $value["priveHref"].'" target="_blank':'javascript:void(0);';?>" class="butto butto-xs badge-dark butbor d-inline-block">
			<i class="fas fa-eye"></i>
		</a>
		<a href="#" class="butto butto-xs badge-primary butbor d-inline-block" onclick="commentDetail(<?php echo $value["ayar_1"];?>);" data-toggle="modal" data-target="#commentmod">
			<i class="fas fa-layer-group"></i> Detay
		</a>
	</div>
</div>
<script type="text/javascript">
dataComment[<?php echo $value["ayar_1"];?>] = <?php echo json_encode($value);?>;
</script>
<?php } ?>