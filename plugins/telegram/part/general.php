<div class="card" id="normalalan">
	<div class="card-header">
		<input type="hidden" name="include" value="waiting">
		<div class="row">
			<div class="col-md-7 align-self-center">
				<strong class="box-title">Kullanıcı Bildirimleri</strong>
			</div>
			<div class="col-md-5 text-right">
				<button data-toggle="modal" data-target="#telegramModal"
					data-id="new"
					data-username=""
					data-userid=""
					data-statu="1"
					data-siparis_hata="1"
					data-yeni_odeme="1"
					data-yeni_iletisim="1"
					data-yeni_siparis="1"
					class="butto butto-xs badge-primary butbor sip-detayi d-inline-block telegramModal"><i class="fas fa-layer-group" aria-hidden="true"></i> Yeni Ekle</button></td>
			</div>
		</div>
	</div>
	<div class="table-stats order-tumu order-table ov-h result-table" id="tb-scroll">
		<table class="table orders-list" id="orders-list">
			<thead>
				<tr>
					<th class="text-left" width="120">Durum</th>
					<th class="text-left">Kullanıcı İsmi</th>
					<th class="text-right" width="120">Kullanıcı ID</th>
					<th class="text-right" width="70">İşlem</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($telegram->userlist() as $value) {
				extract($value); ?>
				<tr>
					<td class="text-left" width="120"><button type="button" class="btn buttosi butto butto-<?php echo $statu["class"];?> btn-statu btn-xs"><?php echo $statu["text"];?></a></td>
					<td class="text-left"><?php echo $username;?></td>
					<td class="text-right" width="120"><?php echo $userid;?></td>
					<td class="text-right" width="70">
					<button data-toggle="modal" data-target="#telegramModal"
					data-id="<?php echo $ayar_1;?>"
					data-username="<?php echo $username;?>"
					data-userid="<?php echo $userid;?>"
					data-statu="<?php echo $statu["num"];?>"
					data-siparis_hata="<?php echo $notifications->sms_yonetici_siparis_hata;?>"
					data-yeni_odeme="<?php echo $notifications->sms_yonetici_yeni_odeme;?>"
					data-yeni_iletisim="<?php echo $notifications->sms_yonetici_yeni_iletisim;?>"
					data-yeni_siparis="<?php echo $notifications->sms_yonetici_yeni_siparis;?>"
					class="butto butto-xs badge-primary butbor sip-detayi d-inline-block telegramModal"><i class="fas fa-layer-group" aria-hidden="true"></i></button></td>
				</tr>
			    <?php } ?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	$('.telegramModal').click(function(){
        $('input[name="data[ayar_1]"]').val($(this).data("id"));
        $('input[name="data[item2][username]"]').val($(this).data("username"));
        $('input[name="data[item2][userid]"]').val($(this).data("userid"));
        $('select[name="data[item2][notifications][sms_yonetici_yeni_odeme]"]').val($(this).data("yeni_odeme"));
        $('select[name="data[item2][notifications][sms_yonetici_yeni_siparis]"]').val($(this).data("yeni_siparis"));
        $('select[name="data[item2][notifications][sms_yonetici_yeni_iletisim]"]').val($(this).data("yeni_iletisim"));
        $('select[name="data[item2][notifications][sms_yonetici_siparis_hata]"]').val($(this).data("siparis_hata"));
        $('select[name="data[statu]"]').val($(this).data("statu"));
        if($(this).data("id")=="new")
        	$('#telegramModalTitle').html("Yeni Kullanıcı Tanımla");
        else
        	$('#telegramModalTitle').html("Kullanıcıyı Düzenle");
    });
</script>