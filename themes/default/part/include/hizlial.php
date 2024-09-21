<div class="form-group col-md-4">
  <? 
  $select["platform"] = '<option value="" disabled="" selected="" data-select="pasive">'._e("Platform Seç", true).'</option>';
  $select["kategori"] = '<option value="" disabled="" selected="" data-select="pasive">'._e("Kategori Seç", true).'</option>';
  $select["paket"] = '<option value="" disabled="" selected="" data-select="pasive">'._e("Paket Seç", true).'</option>';
  foreach ($platform->all(0,50) as $value) {
       extract($value);
       $select["platform"] .= '<option value="'.$pt_id.'">'.$pt_name.'</option>';
       $kategori->pt_tax = $pt_id;
       foreach ($kategori->all(0,100) as $cat) {
        extract($cat);
         $select["kategori"] .= '<option data-select="'.$pt_id.'" value="'.$hz_id.'">'.$hz_adi.'</option>';
         $paket->hz_tax = $hz_id;
         foreach ($paket->all(0,1000) as $pk) {
          extract($pk);
          if ($pk_durum) {
            $select["paket"] .= '<option id="'.$pk_id.'" data-fee="'._p($pk_fiyat).'" data-select="'.$hz_id.'" data-url="'.$ayar->menulink('paket',$pk_pri).'" value="'.$pk_id.'">'.$pk_adi.'</option>';
          }
         }
       }
    }
  ?>
  <select class="form-control keskin" id="hizli-platform">
      <?= $select["platform"];?>
  </select>
  <div class="validation"></div>
</div>
<div class="form-group col-md-4">
  <select class="form-control keskin" disabled=""  id="hizli-kategori">
    <?= $select["kategori"];?>
  </select>
  <div class="validation"></div>
</div>
<div class="form-group col-md-4">
  <select class="form-control keskin" disabled="" id="hizli-paket">
    <?= $select["paket"];?>
  </select>
  <div class="validation"></div>
</div>
<div class="col-md-12"><a href="#" id="hizli-satin-al" class="btn hiz-but xrb keskin text-white"><?php _e("SATIN AL");?></a></div>
<script type="text/javascript">
  $('#hizli-kategori option').prop('disabled', true);
  $('#hizli-paket option').prop('disabled', true);
  var part = "hizli-platform";
  var SatinAl = "<?php _e("SATIN AL");?>";
  $(document).ready(function() {
      $("#hizli-platform").on('change', function(){
      $('#hizli-kategori option').prop('disabled', true);
      $('#hizli-paket option').prop('disabled', true);
      var list = document.querySelectorAll("#hizli-kategori option");
      for (var i = list.length - 1; i >= 0; i--) {
        if ($(list[i]).data('select')==$(this).val()) {
          $(list[i]).prop('disabled', false);
        }
        if ($(list[i]).data('select')=="pasive") {
          $(list[i]).prop('selected', true);
        }
      }
      $('#hizli-kategori').prop('disabled',false);
      $('#hizli-paket').prop('disabled',true);
      $('#hizli-satin-al').attr('href','');
      part = "hizli-kategori";
      $('#hizli-satin-al').html(SatinAl);
      var list = document.querySelectorAll("#hizli-paket option");
      for (var i = list.length - 1; i >= 0; i--) {
        if ($(list[i]).data('select')==$(this).val()) {
          $(list[i]).prop('disabled', false);
        }
        if ($(list[i]).data('select')=="pasive") {
          $(list[i]).prop('selected', true);
        }
      }
    });
    $("#hizli-kategori").on('change', function(){
      $('#hizli-paket option').prop('disabled', true);
      var list = document.querySelectorAll("#hizli-paket option");
      for (var i = list.length - 1; i >= 0; i--) {
        if ($(list[i]).data('select')==$(this).val()) {
          $(list[i]).prop('disabled', false);
        }
        if ($(list[i]).data('select')=="pasive") {
          $(list[i]).prop('selected', true);
        }
      }
      $('#hizli-paket').prop('disabled',false);
      $('#hizli-satin-al').attr('href','');
      part = "hizli-paket";
      $('#hizli-satin-al').html(SatinAl);
    });
    $("#hizli-paket").on('change', function(){
      var select_paket = $('#'+$(this).val());
      $('#hizli-satin-al').attr('href',select_paket.data('url'));
      $('#hizli-satin-al').html(SatinAl+' ('+select_paket.data('fee')+')');
    });
     $(document).on('click', '#hizli-satin-al', function(){
        var link = $(this).attr('href');
        if (link=="") {
          $('#'+part).addClass("nonshake");
          setTimeout(function(){
            $('#'+part).removeClass("nonshake");},500);
          return false;
        }
        data = {"action":"response"};
        fastpost(link,data,'content_ajax',stateData);
        return false;
    });
  });
</script>
<style type="text/css">
  select option[disabled] {
    display: none;
}
</style>