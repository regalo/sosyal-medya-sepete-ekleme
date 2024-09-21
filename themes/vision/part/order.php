<section class="orderArea">
	<div class="container">
		<?php
		if($step=="form")
			include_once "include/order.form.loft.php";
		else if($step=="payment")
			include_once "include/order.payment.loft.php";
		?>
	</div>
</section>
<?php if(isset($contract)){ ?>
<div class="modal termsofuse fade" id="termsofuse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?php echo $contract["head"];?></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php _e("kapat");?>"></button>
			</div>
			<div class="modal-body">
				<p class="mb-0">
					<?php echo $contract["content"];?>
				</p>
			</div>
			<div class="modal-footer ">
				<button type="button" class="modalbtn anibut" data-contract="true" data-bs-dismiss="modal" aria-label="Close"><?php _e("kabul-et");?></button>
			</div>
		</div>
	</div>
</div>
<?php } ?>