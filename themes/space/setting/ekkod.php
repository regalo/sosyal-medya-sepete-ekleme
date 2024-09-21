<div class="form-row mt-3">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<div class="box-title">
					Ek CSS Kodları
				</div>
			</div>
			<div class="card-body">
				<form class="action_form_submit" method="POST">
					<input type="hidden" name="page" value="theme">
					<input type="hidden" name="olay" value="spaceHeader">
					<input type="hidden" name="yontem" value="json">
					<input type="hidden" name="removeCssJs" value="1">
					<p>Aşağıdaki kısıma özel css kodlarınızı ekleyebilirsiniz, bu kodlar güncellemelerden etkilenmez.</p>
					<div class="form-group">
						<textarea class="form-control" placeholder=".class {color:#333;}" name="data[item3]" style="min-height: 250px;"><?php echo ns_filter("spaceHeader","item3");?></textarea>
					</div>
					<div class="w-100">
						<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check" aria-hidden="true"></i> Kaydet</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<div class="box-title">
					Ek JS Kodları
				</div>
			</div>
			<div class="card-body">
				<form class="action_form_submit" method="POST">
					<input type="hidden" name="page" value="theme">
					<input type="hidden" name="olay" value="spaceFooter">
					<input type="hidden" name="yontem" value="json">
					<input type="hidden" name="removeCssJs" value="1">
					<p>Aşağıdaki kısıma özel js kodlarınızı ekleyebilirsiniz, bu kodlar güncellemelerden etkilenmez.</p>
					<div class="form-group">
						<textarea class="form-control" placeholder='$("button").click(function(){  alert("Nivusoft");   });' name="data[item3]" style="min-height: 250px;"><?php echo ns_filter("spaceFooter","item3");?></textarea>
					</div>
					<div class="w-100">
						<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check" aria-hidden="true"></i> Kaydet</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>