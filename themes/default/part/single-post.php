<main id="main">
	<section id="intros" class="clearfix pageix xrb <?php echo ns_filter('default-ozellestirme','item5');?> ns-ortala">
		<div class="container alans1 fadeInUp">
			<div class="row">
				<div class="col-md-12 ortala text-white">
					<div class="dikort modikort">
						<div class="pagex-title">
							<h1 class="font-weight-bold"><?php echo ns_filter('title');?></h1>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="<?php echo ns_filter('default-ozellestirme','item4');?>-head"></div>
	</section>
	<?php ns_Content(array(
	"htmlHead"=>'<section id="icerikbolum" class="mb50 mobmb20"><div class="container"><div class="icicerik row"><div class="col-md-10 offset-md-1"><div class="iceriks pagex keskin"><div class="icerikgorsel"><img class="keskin lazy" src="" data-src="%thumbimage" alt="%title"></div><div class="icerikalan">',
"htmlFoot"=>'</div></div></div></div></div>',
"type"=>ns_filter('blog','sayfa_icerik')));?>
</main>