<section id="intros" class="clearfix xrb keskin <?php echo ns_filter('default-desen'); ?> ns-ortala pt-4">
  <div class="container alans1 fadeInUp">
    <div class="text-center text-white">
      <div class="hizmetbaslik">
        <i class="<?php echo ns_filter('icon');?>"></i>
        <h1 class="font-weight-bold"><?php echo sprintf(_e("%s Servisleri",true),ns_filter('title'));?></h1>
        <p><?php echo ns_filter('description');?></p>
      </div>
      <div class="float">
        <i class="fas fa-chevron-down" style="font-size: 30px;animation: float 1s ease infinite"></i>
      </div>
    </div>
  </div>
  <div class="<?php echo ns_filter('default-ozellestirme','item4');?>-head"></div>
</section>
<main id="main">
  <section id="hizlist" class="mb50 mobmb20" >
    <div class="container">
      <div class="hizmetliste row">
        <?php 
          default_category_list(array(
          'foreach'=>'<div class="col-md-4"><div class="hizmet paket wow fadeInUp keskin">%foreach</div></div>',
          'icon'=>'<div class="hizmet-icon xrc"><i class="%icon"></i></div>',
          'title'=>'<div class="hizmet-baslik"><b class="xrc">'.sprintf(_e("%s Paketleri",true),'%title').'</b></div>',
          'description' => '<p>%description</p>',
          'description-long' =>90,
          'button' => '<a href="%link" id="pk_refresh" class="btn hizmetsatinal xrb keskin">'._e("İncele",true).'</a>'
          ),ns_filter('kategoriler','for'));?>
      </div>
    </div>
  </section>
  <?php ns_Content(array("type"=>""));?>   
</main>
<style type="text/css">.hizmet.paket.wow.fadeInUp.keskin {width: -webkit-fill-available !important;}
</style>