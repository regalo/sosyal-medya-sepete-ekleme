<div class="form-row mt-3">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<div class="box-title">
					Ek CSS Kodları
				</div>
			</div>
			<div class="card-body">
				<form class="loftForm" method="POST">
					<input type="hidden" name="olay" value="loftOptions">
					<input type="hidden" name="page" value="theme">
					<input type="hidden" name="loftAction" value="generalSave">
					<p>Aşağıdaki kısıma özel css kodlarınızı ekleyebilirsiniz, bu kodlar güncellemelerden etkilenmez.</p>
					<div class="form-group">
						<textarea class="form-control" placeholder=".class {color:#333;}" name="data[loftEkCode][item2]" style="min-height: 250px;"><?php echo ns_filter("loftEkCode","item2");?></textarea>
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
				<form class="loftForm" method="POST">
					<input type="hidden" name="olay" value="loftOptions">
					<input type="hidden" name="page" value="theme">
					<input type="hidden" name="loftAction" value="generalSave">
					<p>Aşağıdaki kısıma özel js kodlarınızı ekleyebilirsiniz, bu kodlar güncellemelerden etkilenmez.</p>
					<div class="form-group">
						<textarea class="form-control" placeholder='$("button").click(function(){  alert("Nivusoft");   });' name="data[loftEkCode][item3]" style="min-height: 250px;"><?php echo ns_filter("loftEkCode","item3");?></textarea>
					</div>
					<div class="w-100">
						<button type="submit" class="butto butto-lg butto-success butbor pull-right mt-3"><i class="fas fa-check" aria-hidden="true"></i> Kaydet</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>