<main id="main">
  <section id="intros" class="clearfix pageix xrb <?php echo ns_filter('default-ozellestirme','item5');?> ns-ortala">
    <div class="container alans1 fadeInUp">
        <div class="ortala text-white">
            <div class="pagex-title">
              <h1 class="font-weight-bold"><?php echo ns_filter('title');?></h1>
            </div>
        </div>
    </div>
    <div class="<?php echo ns_filter('default-ozellestirme','item4');?>-head"></div>
  </section>
  <?php ns_Content(array(
  "htmlHead"=>'<section id="icerikbolum" class="mb50 mobmb20"><div class="container"><div class="icicerik row"><div class="col-md-12"><div class="iceriks pagex keskin"><div class="icerikalan">',
  "htmlFoot"=>'</div></div></div></div></div></section>',
  "type"=>ns_filter('sayfa','sayfa_icerik')));?>
</main>