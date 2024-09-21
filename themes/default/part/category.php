<section id="intros" class="clearfix xrb <?php echo ns_filter('default-desen'); ?> ns-ortala">
	<div class="container alans1 fadeInUp">
		<div class="text-center text-white">
			<div class="paketbaslik">
				<i class="<?php echo ns_filter('icon');?>"></i>
				<h1 class="font-weight-bold"><?php echo sprintf(_e("%s Paketleri",true),ns_filter('title'));?></h1>
				<p><?php echo ns_filter('description');?></p>
			</div>
		</div>
	</div>
	<div class="<?php echo ns_filter('default-class');?>-head"></div>
</section>
 <div class="hizser">
 	
 </div>
 <main id="main">
 	<section id="paklist" class="mb50 mobmb20">
		<div class="container">
			<div class="paketliste row">
				<?php 
				default_product_list(array(
                'foreach'=>'<div class="col-md-3"><div class="paket wow fadeInUp keskin">%foreach</div></div>',
                'icon'=>'<div class="paket-icon xrc"><i class="%icon"></i></div>',
                'title'=>'<div class="paket-baslik"><b class="xrc">%title</b><br><span>%pk_adi</span></div>',
                'features' => '<div class="paketozellik"><ul>%feature-li</ul></div>',
                'feature-li' => '<li><i class="fas fa-chevron-right xrc"></i> %features</li>',
                'price' => '<div class="paketfiyat xrc keskin">%price</div>',
                'active-button' => '<a href="%link" data-pk_pri="%pk_pri" id="pk_refresh" data-pk_title="%pk_title Satın Al" class="btn paketsatinal xrb keskin">'._e("SATIN AL",true).'</a>',
                'pasive-button' => '<button type="button" disabled="" class="btn paketsatinal xrb keskin">'._e("SATIŞA KAPALI",true).'</button>'
                ),ns_filter('paketler','for'));?>
				<div class="col-md-12" style="margin-top: 50px;">
					<?= ns_filter('content');?>
				</div>
			</div>
			
		</div>
    </section>
    <?php ns_Content(array(
        "htmlHead"=>'<section id="makaleyazi" class="pb-5"><div class="container"><div class="row"><div class="col-md-12">',
        "htmlFoot"=>'</div></div></div></section>',
        "type"=>ns_filter('kategori','hz_makale')));?>  
</main>
<style type="text/css">@media(max-width: 700px) {.mozellik {overflow: unset;height: auto !important;}}</style>
  