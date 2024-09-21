
//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function(){
  if (formcontrol() == true) {
  if(animating) return false;
  animating = true;
  current_fs = $(this).parent();
  next_fs = $(this).parent().next();
  
  //activate next step on progressbar using the index of next_fs
  $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
  
  //show the next fieldset
  next_fs.show(); 
  //hide the current fieldset with style
  current_fs.animate({opacity: 0}, {
    step: function(now, mx) {
      //as the opacity of current_fs reduces to 0 - stored in "now"
      //1. scale current_fs down to 80%
      scale = 1 - (1 - now) * 0.2;
      //2. bring next_fs from the right(50%)
      left = (now * 50)+"%";
      //3. increase opacity of next_fs to 1 as it moves in
      opacity = 1 - now;
      current_fs.css({
        'transform': 'scale('+scale+')',
        'position': 'absolute',
        'width': '100%'
      });
      next_fs.css({'left': left, 'opacity': opacity});
    }, 
    duration: 800, 
    complete: function(){
      current_fs.hide();
      animating = false;
    }, 
    //this comes from the custom easing plugin
    easing: 'easeInOutBack'
  });
};
});

$(".previous").click(function(){
  alert();
  if(animating) return false;
  animating = true;
  
  current_fs = $(this).parent();
  previous_fs = $(this).parent().prev();
  
  //de-activate current step on progressbar
  $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
  
  //show the previous fieldset
  previous_fs.show(); 
  //hide the current fieldset with style
  current_fs.animate({opacity: 0}, {
    step: function(now, mx) {
      //as the opacity of current_fs reduces to 0 - stored in "now"
      //1. scale previous_fs from 80% to 100%
      scale = 0.8 + (1 - now) * 0.2;
      //2. take current_fs to the right(50%) - from 0%
      left = ((1-now) * 50)+"%";
      //3. increase opacity of previous_fs to 1 as it moves in
      opacity = 1 - now;
      current_fs.css({'left': left});
      previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
    }, 
    duration: 800, 
    complete: function(){
      current_fs.hide();
      animating = false;
    }, 
    //this comes from the custom easing plugin
    easing: 'easeInOutBack'
  });
});

$(".submit").click(function(){
  return false;
})
function formcontrol(){
  var bolum = $('#bolum').val();
  if (bolum == "islem-adresi") {
    var iss = $('#islem-adresi').val();
    if (iss.length == "") {
    AlertInfo('Lütfen gerekli alanları doldurun.','islem-adresi');
    $('#islem-adresi').attr('style','border-color:red;');
    return false;
    }
    $('#islem-adresi').attr('style','');
    AlertInfo('kapat','islem-adresi');
    return true;
  }
  if (bolum == "iletisim-bilgileri") {
    var iss = $('#adsoyad').val();
    if (iss.length == "") {
      $('#adsoyad').attr('style','border-color:red;');
      AlertInfo('Lütfen gerekli alanları doldurun','iletisim-bilgileri');
      return false;
    }
    $('#adsoyad').attr('style','');
    AlertInfo('kapat','iletisim-bilgileri');
    var iss = $('#telefon').val();
    if (iss.length != 11) {
      $('#telefon').attr('style','border-color:red;');
      AlertInfo('Lütfen telefon numaranızı başında 0 ile birlikte 11 haneli olarak giriniz.','iletisim-bilgileri');
      return false;
    }
    $('#telefon').attr('style','');
    AlertInfo('kapat','iletisim-bilgileri');
    var iss = $('#mail').val();
    if (!regKontrol(iss)) {
      $('#mail').attr('style','border-color:red;');
      AlertInfo('Lütfen mail adresinizi ornek@ornekmail.com şeklinde giriniz.','iletisim-bilgileri');
      return false;
    }
    $('#mail').attr('style','');
    AlertInfo('kapat','iletisim-bilgileri');
    return true
    
  }
}
function regKontrol(value) {
   pattern  = "^"+"([abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0-9_\.\-]+)"+"@"+"([abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0-9_\.\-]+)"+"[\.]"+"([abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0-9_\.\-]+)"+"$"; 
   r = new RegExp(pattern, "g"); 
   return r.test(value); 
}
function abCepTelefon(tel) {
    var parcalanmisTel = tel.split("");
    if (!/[^+].[^0-9]/.test(tel)) {
        if (parcalanmisTel[0] == "+" & tel.length == 13){
            return true;
          }
      if (parcalanmisTel[0] != "+" & (tel.length == 10 || tel.length == 11)){
            return true;
      }
    }
  return false;
}
function Kontrol(bolum){
  $('#bolum').val(bolum);
}
function AlertInfo(text,item) {
  if (text=="kapat") {
     $('#alert-'+item).hide().html('');
     return true;
  }
  $('#alert-'+item).show().html(text);
}
function KuponKodu(paket) {
  var kod = $('#kupon_kodu').val();
  if(kod.length != "") {
    $.ajax({
            type: "POST",
            url: "../themes/default/include/kupon.php",
            data: {"kod":kod,"paket":paket},
            success: function (msg) {
              if (msg=="hata") {
                AlertInfo('Geçersiz bir kod girdiniz.','kupon-kodu');
                return false;
              }
              $('.kupon-load').show();
              $('#siparis-ucret').hide();
              $('#siparis-ucret').html(msg);
              setTimeout(function(){ $('.kupon-load').hide();$('#siparis-ucret').show(); }, 2000);
              return true;
            }
        });
  }
}
$('#kurumsal').hide();
function FaturaTuru(){var secim = $('#faturaturu').val();if(secim=="kurumsal"){$('#kurumsal').show();return true;}$('#kurumsal').hide();}