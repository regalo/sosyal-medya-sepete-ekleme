<footer id="footer" class="xrb <?php echo ns_filter('default-desen');?>">
  <div class="<?php echo ns_filter('default-class');?>-ust"></div>
  <div class="footer-top">
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-2 text-center">
          <h3 class="font-weight-bold mb-1"><?php echo ns_filter('default-footbutton');?></h3>
          <p><?php echo ns_filter('default-footbutton','item3');?></p>
          <a href="<?php echo ns_filter('default-footbutton','item5');?>" class="btn footerilet xrc keskin"><i class="fas fa-envelope"></i> <?php echo ns_filter('default-footbutton','item4');?></a>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-6 fsoya">
          <?php echo ns_filter('default-footer-menu','item3');?>
        </div>
        <div class="col-md-6 fsaya">
          <?php menucreate(array(
            'primary' => '<a href="%item5">%item3</a>',
            'menu_select' => ns_filter('default-footer-menu')));?>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="sorgu" style="background: rgba(0, 0, 0, 0.80);max-width:100%" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" style="max-width:100%" role="document">
        <div class="container">
          <div class="modal-content" id="_orderstatu" style="background: none">
            <?php include "part/include/sorgula.php";?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="sol-bars">
    <?php if (ns_filter('default-iletisim','statu')) {
      echo '<div class="telico keskin">';
      echo '<a href="tel:'.ns_filter('default-iletisim').'" title="'._e("Telefon",true).'" class="telbut">'.ns_filter('default-iletisim').' <i class="fas fa-phone"></i></a>';
      echo '</div>';
    }
    defaultwp(array('link' => '<div class="whatsappico keskin"><a title="'._e("Whatsapp İletişim",true).'" class="wpbut" href="%link" target="_blank">Whatsapp <i class="fab fa-whatsapp"></i></a></div>'));
    if (ns_filter('default-sorgu','statu')) {
      echo '<div class="sorgu xrbs keskin">';
      echo '<a href="#" title="'._e("Sipariş Sorgula",true).'" class="sorbut" data-toggle="modal" data-target="#sorgu">'._e("Sipariş Sorgula",true).' <i class="fas fa-search"></i></a>';
      echo '</div>';
    }  ?>
  </div>
</footer>
<?php echo ns_filter('default-footcode');?>  
<link href="<? theme_path();?>assets/owlcarousel/assets/owl.carousel.min.css?version=3.0" rel="stylesheet" async>
<link href="<? theme_path();?>assets/animate/animate.min.css?version=3.0" rel="stylesheet" async>
<script src="<? theme_path();?>assets/jquery/jquery-migrate.min.js" async></script>
<script src="<? theme_path();?>assets/bootstrap/js/bootstrap.bundle.min.js" async></script>
<script src="<? theme_path();?>assets/mobile-nav/mobile-nav.js" async></script>
<script src="<? theme_path();?>assets/wow/wow.min.js" async></script>
<script src="<? theme_path();?>assets/owlcarousel/owl.carousel.min.js"></script>
<script src="https://kit.fontawesome.com/d3897fd5a7.js" crossorigin="anonymous"></script>
<script src="<? theme_path();?>assets/main.js?version=3.1"></script>
<?= ns_filter('footer'); ?>
</body>
</html>