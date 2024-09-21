<?php if (isset($post["olay"]) AND ($post["olay"]=="ortam-dosyasi" OR $post["olay"]=="gorsel-sil" OR $post["olay"]=="gorsel-sil-onay")) {
if ($post["olay"]=="gorsel-sil") {
	$post["olay"] = "gorsel-sil-onay";
	$nsoft->data = $post;
    $alert->header = "Silme İşlemi";
    $alert->content = "Bu ortam dosyasını sunucudan kalıcı olarak silmek istediğinize emin misiniz?";
    $alert->action = "nsoft";
    $alert->statu = "info";
    include_once "panel/pages/alert.php";
    exit;
 } elseif ($post["olay"]=="gorsel-sil-onay") {
 	if (file_exists($post["ortam-data"])) {
		unlink($post["ortam-data"]);
	}
 	$alert->header = "İşlem Başarılı";
 	$alert->content = "Seçtiğiniz ortam dosyası sunucu üzerinden tamamen silindi";
    $alert->action = "close";
    ?>
    <script type="text/javascript">
    	loadtotal = 0;
    	deleteim.remove();
    	list = document.querySelectorAll("#path_img_list li img");
    	imageselect(list[2]);
    	$('#loadimg').click();
    	loadtotal = 11;
    </script>
    <?
    include_once "panel/pages/alert.php";
    exit;
 } ?>
	<li id="uplos">
		<label class="pointer ortam-dosyasi mb-0" for="ortam-dosyasi">
			<img src="<?= ns_filter('siteurl').'panel/images/load-img.png';?>" alt="" title="Görsel Yükle">
		</label>
		<label class="ortam-dosyasi-load mb-0" style="display: none;">
            <img height="35" src="<?= ns_filter('siteurl').'panel/images/load.gif';?>">
        </label>
		<input id="ortam-dosyasi" onChange="upload('ortam-dosyasi','ortam');" accept="image/*" type="file"/>
	</li>
	<? $say = 2; if (!$ayar->uploadPhoto('file',$post["olay"])) {
	$load = true; ?>
		<li id="kirik-link"><img src="https://icon2.cleanpng.com/20180626/rbu/kisspng-business-incubator-management-service-sales-problem-icon-5b3205080bc158.6027597615300047440482.jpg"><script type="text/javascript">setTimeout(function(){$('#kirik-link').remove();},1000); </script></li>
    <? } ?>
	<?  foreach ($nsoft->folderlist('upload') as $value) { ?>
		<li data-view="<?= $say>11 ? 'false" style="display:none;':'true';?>"><img <?= (!isset($load) AND $say==2) ? 'onload="imageselect(this)"':'';?> onclick="imageselect(this)" src="<?= ns_filter('siteurl').$value["name"];?>" title="<?php echo $value["time"];?>" data-url="<?= ns_filter('siteurl').$value["name"];?>" data-input="<?= $value["name"];?>"></li>
	<? $say++;} 
exit; } ?>
<? if (isset($ayar->page) AND $ayar->page=="ortam") { ?>
<div class="content" id="alan">
    <div class="animated fadeIn" id="scrolling">
        <div class="orders">
<? } else { ?>
<div class="ortam-bg" data-columns="6">
	<div class="ortam-box">
	<div class="ortam-close"><i class="fas fa-times"></i></div>
<? }?>
		<div class="row">
			<div class="col-md-8">
				<? if (isset($ayar->page) AND $ayar->page=="ortam") { ?>
				<div class="card">
				<? } ?>
				<div class="card-header <? if(isset($ayar->page) AND $ayar->page!="ortam") { echo "p-1 pb-3"; } ?>">
					<span class="font-weight-bold">Ortam Kütüphanesi</span>
				</div>
				<? if (isset($ayar->page) AND $ayar->page=="ortam") { ?>
				<div class="card-body">
					<div class="ortam-all">
				<? } ?>
				<div class="tumbnails mt-3">
					<ul id="path_img_list">
						<li id="uplos">
							<label class="pointer ortam-dosyasi mb-0" for="ortam-dosyasi">
								<img src="<?= ns_filter('siteurl').'panel/images/load-img.png';?>" alt="" title="Görsel Yükle">
							</label>
							<label class="ortam-dosyasi-load mb-0" style="display: none;">
                                <img height="35" src="<?= ns_filter('siteurl').'panel/images/load.gif';?>">
                            </label>
							<input id="ortam-dosyasi" onChange="upload('ortam-dosyasi','ortam');" accept="image/*" type="file"/>
						</li>
						<? $say = 1; foreach ($nsoft->folderlist('upload') as $value) { ?>
							<li  data-view="<?= $say>11 ? 'false" style="display:none;':'true';?>"><img onclick="imageselect(this)" src="<?= ns_filter('siteurl').$value["name"];?>" data-url="<?= ns_filter('siteurl').$value["name"];?>" data-input="<?= $value["name"];?>"></li>
						<? $say++;} ?>
					</ul>
					<div class="text-center">
						<button type="button" id="loadimg" data-total="10" class="butto butto-dark butto-lg butbor">Daha Fazla Göster</button>
					</div>
				</div>
				<? if (isset($ayar->page) AND $ayar->page=="ortam") { ?>
					</div>
					</div>
				<? } ?>
				<? if (isset($ayar->page) AND $ayar->page=="ortam") { ?>
				</div>
				<? } ?>
			</div>
			<div class="col-md-4">
				<? if (isset($ayar->page) AND $ayar->page=="ortam") { ?>
				<div class="card">
				<? } ?>
				<form id="gorsel-sil" method="POST" action="" onsubmit="fastpost('gorsel-sil','ajaxout'); return false;">
                    <input type="hidden" name="page" value="ortam">
                    <input type="hidden" name="olay" value="gorsel-sil">
					<div class="card-header <? if(isset($ayar->page) AND $ayar->page!="ortam") { echo "p-1 pb-3"; } ?>">
						<span class="font-weight-bold">Önizleme</span>
					</div>
					<? if (isset($ayar->page) AND $ayar->page=="ortam") { ?>
					<div class="card-body pt-0">
					<? } ?>
					<div class="tumb-onizle mt-3">
						<div class="tumb-oniztext">
							<img id="ortam-onizleme" src="<?= ns_filter('siteurl').'panel/images/none.png';?>">
							<input type="text" class="ortam-action form-control mt-3" id="ortam-url" readonly="" value="" onclick="copyto('ortam-url','none')">
							<input type="hidden" id="ortam-input" name="ortam-data" value="">
						</div>
					</div>
					<div class="ortam-action text-center mt-3">
						<button type="submit" class="butto butto-danger butto-lg butbor gorsecsil pull-left">Ortamı Sil</button>
						<? if(isset($ayar->page) AND $ayar->page!="ortam") { ?>
						<button type="button" class="butto butto-success butto-lg butbor gorsecbut pull-right">Ekle</button>
						<?php  }  ?>
					</div>
					<? if (isset($ayar->page) AND $ayar->page=="ortam") { ?>
					</div>
					<? } ?>
				</form>
				<? if (isset($ayar->page) AND $ayar->page=="ortam") { ?>
				</div>
				<? } ?>
			</div>
		</div>
	</div>
</div>
<? if(isset($ayar->page) AND $ayar->page=="ortam") { ?>
</div>
<?php  }  ?>

<script>
	function imageselect(element){
		$('#ortam-onizleme').attr('src',$(element).data('url'));
		$('#ortam-input').val($(element).data('input'));
		$('#ortam-url').val($(element).data('url'));
		$('.ortam-action').show();
		$(".tumbnails ul li").removeClass("selected");
		$(element).parent().addClass("selected");
		deleteim = $(element).parent();
	}
	$(".ortambut").click(function(){
		ortamend = $(this).data('ortam');
		if($(this).data('url')){
			imageselect(this);
		}
		$(".ortam-bg").fadeIn(100);
		$(".ortam-box").fadeIn(100);
	});
	$(".ortam-close").click(function(){
		$(".ortam-bg").fadeOut(100);
		$(".ortam-box").fadeOut(100);
	});
	$(".gorsecbut").click(function(){
		if (ortamend=="editor") {
			response = '<img src="'+$('#ortam-onizleme').attr('src')+'">';
			editor_data = CKEDITOR.instances.editor.getData();
            CKEDITOR.instances['editor'].setData(editor_data+''+response);
		} else {
			$('#'+ortamend+'-onizleme').attr('src',$('#ortam-onizleme').attr('src'));
			$('#'+ortamend+'-input').val($('#ortam-input').val());
		}
		$(".ortam-bg").fadeOut(100);
		$(".ortam-box").fadeOut(100);
	});
	loadtotal = 11;
	$("#loadimg").click(function(){
		var list = document.querySelectorAll("#path_img_list li");
		say = 0;
		for (var i = 0; i <= list.length; i++) {
			if ($(list[i]).attr('style')=="display:none;") {
				$(list[i]).show();
				$(list[i]).attr('data-view',true);
				say++;
			}
			if( say > loadtotal){
				return;
			}
		}
		if(say <= loadtotal){
			$('#loadimg').remove();
		}
    	
	});
</script>