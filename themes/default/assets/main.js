/* Lazy Load */
!function(window){
  var $q = function(q, res){
        if (document.querySelectorAll) {
          res = document.querySelectorAll(q);
        } else {
          var d=document,
          a=d.styleSheets[0] || d.createStyleSheet();
          a.addRule(q,'f:b');
          for(var l=d.all,b=0,c=[],f=l.length;b<f;b++)
            l[b].currentStyle.f && c.push(l[b]);

          a.removeRule(0);
          res = c;
        }
        return res;
      },
      addEventListener = function(evt, fn){
        window.addEventListener
          ? this.addEventListener(evt, fn, false)
          : (window.attachEvent)
            ? this.attachEvent('on' + evt, fn)
            : this['on' + evt] = fn;
      },
      _has = function(obj, key) {
        return Object.prototype.hasOwnProperty.call(obj, key);
      };
  function loadImage (el, fn) {
    var img = new Image()
      , src = el.getAttribute('data-src');
    img.onload = function() {
      if (!! el.parent)
        el.parent.replaceChild(img, el)
      else
        el.src = src;

      fn? fn() : null;
    }
    img.src = src;
  }

  function elementInViewport(el) {
    var rect = el.getBoundingClientRect()

    return (
      rect.top >= 0 && 
    rect.bottom >= 0 && 
        rect.right >= 0 && 
        rect.top <= (window.innerHeight || document.documentElement.clientHeight) && 
        rect.left <= (window.innerWidth || document.documentElement.clientWidth)
    )
  }
    var images = new Array(),
    query = $q('img.lazy'),
    processScroll = function(){
          for (var i = 0; i < images.length; i++) {
            if (elementInViewport(images[i])) {
              loadImage(images[i], function () {
                images.splice(i, i);
              });
            }
          };
        };
    // Array.prototype.slice.call is not callable under our lovely IE8 
    for (var i = 0; i < query.length; i++) {
      images.push(query[i]);
    };
    processScroll();
    addEventListener('scroll',processScroll);
}(this);
$(document).ready(function(){ $(window).scroll(function(){ $('.lazy').each(function(){ if( $(this).offset().top < ($(window).scrollTop() + $(window).height() + 100) ) { $(this).attr('src', $(this).attr('data-src')); } }); }) })
window.scrollBy(0,1);

$('.Ns_none').click(function(){
    $(this).addClass('d-none');
    $('#'+$(this).data('open')).removeClass("d-none");
    if($(this).data('open')=="fastclose") {
      $('.alan1').hide();
      $('.alan2').show();
    } else {
      $('.alan1').show();
      $('.alan2').hide();
    }
});
 function get_action(element) {
      var v = grecaptcha.getResponse();
      if(v.length == 0){
        $('.recaptcha').addClass("nonshake");
          setTimeout(function(){
            $('.recaptcha').removeClass("nonshake");},500);
          return false;
      } else {
          return true; 
      }
  }
    $(document).ready(function(){
        $(document).on('click', '#coupon_code', function(){
          if (!$('#coupon_code').data('action')) {
            $('#coupon_code_input').val('');
          }
          orderpaymenupdate();
        });
        $('#order_type').on('change', function(){
          var list = document.querySelectorAll("#order_input_list div");
          for (var i = 0; i <= list.length; i++) {
            if ($(this).val()=="bireysel" && $(list[i]).data('type')=="kurumsal") {
              $(list[i]).addClass('d-none');
             $('.order_inputer').prop('required',false);
            }
            if ($(this).val()=="kurumsal" && $(list[i]).data('type')=="kurumsal") {
              $(list[i]).removeClass('d-none');
               $('.order_inputer').prop('required',true);
            }  
          };
        });
    });
      function orderpaymenupdate(){
        var coupon_code = $('#coupon_code_input').val();
        var payment_medhod = $('#order_payment_medhod').val();
        if (payment_medhod==null) {
          $('#order_payment_medhod').addClass('nonshake');
          setTimeout(function(){
            $('#order_payment_medhod').removeClass("nonshake");},500);
          return;
        }
        if (coupon_code=="" && $('#coupon_code').data('action')) {
          $('#coupon_code_input').addClass('nonshake');
          setTimeout(function(){
            $('#coupon_code_input').removeClass("nonshake");},500);
          return;
        }
        data = {"action":"response","sp_musteri_kupon":coupon_code,"sp_odeme":payment_medhod};
        var link = window.location.href+'?action=code';
        fastpost(link,data,'_order_payment');
      }
      function orderstatu(element){
        var link = window.location.href+'?action=code';
        fastpost(link,$(element).serialize(),'_orderstatu');
      }
     function fastpost(url,data, htm = "",stateData = null) {
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                success: function(response) {
                    if(htm == "content_ajax") {
                        $('#'+htm).html(response);
                        document.title = $('#ajax_title').val();
                        $('meta[name=keywords]').attr('content',$('#ajax_keywords').val());
                        $('meta[name=title]').attr('content',$('#ajax_title').val());
                        $('meta[name=description]').attr('content',$('#ajax_description').val());
                        history.pushState("","", $('#ajax_pathname').val());
                        if (stateData) {
                            $("html, body").animate({ scrollTop: 0 }, "slow");
                        }
                        $('.mobile-nav-active').removeClass('mobile-nav-active');
                        $('.mobile-nav-overly').hide();
                        $('.fa-times').attr("class","fa fa-bars");
                        $('#'+htm).attr('style','');
                        return false;
                    }
                    if (htm == "_order_payment" || htm == "_orderstatu" ) {
                        $('#'+htm).html(response);
                        return false;
                    }
                    return false;

                }
            });
        }
$('#emailAddress').keyup(function() {
    var text = this.value.replace(" ","");
    var text = text.replace(/[^A-z 0-9-@._]/g,'');
    this.value= text.trim();
});
$('#phoneNumber').keyup(function() {
    var text = this.value.replace(" ","");
    var text = text.replace(/[^0-9]/g,'');
    this.value= text.trim();
});
const buton = document.querySelector('.coupon_code_click');
$('.dyontem-item ').click(function(){
  if (!$(this).data("statu"))
    return titresim(this);
  $('#payment_method').val($(this).data("medhod"));
  var payments = document.querySelectorAll(".default-odeme div");
    for (var i = 0; i < payments.length; i++) {
      if ($(payments[i]).data("medhod")==$(this).data("medhod")) {
        $(payments[i]).addClass("selected");
      } else {
        if($(payments[i]).hasClass("selected"))
          $(payments[i]).removeClass("selected");
      }
    }
  var coupon_code = $('#sp_musteri_kupon').val();
    var payment_medhod = $(this).data("medhod");
    order_data = {"action":"response","sp_musteri_kupon":coupon_code,"sp_odeme":payment_medhod};
    orderajax(order_data,"payment");
});
$('.coupon_code_click').click(function(){
  if ($('#sp_musteri_kupon').val()==="")
    return titresim('#sp_musteri_kupon');
  if (buton.dataset.statu == "true") {
    var coupon_code = "";
  } else {
    var coupon_code = $('#sp_musteri_kupon').val();
  }
    var payment_medhod = $('#payment_method').val();
    var order_data = {"action":"response","sp_musteri_kupon":coupon_code,"sp_odeme":payment_medhod};
    orderajax(order_data,"coupon");
    
});
$('.step-go').click(function(){
  step_now = $(this).data("now");
  step_next = $(this).data("step");
  if (step_next==3 && !MailPhone())
      return false;
  step_action = $(this).data("action");
  if (step_action=="back") {
  $(".step-"+step_now).prop("required", false);
  }
});
order_type = "bireysel";
$('#order_type').on('change', function(){
  var list = document.querySelectorAll("#order_input_list div");
  order_type = $(this).val();
  for (var i = 0; i <= list.length; i++) {
    if ($(this).val()=="bireysel" && $(list[i]).data('type')=="kurumsal") {
      $(list[i]).addClass('d-none');
     $('.order_inputer').prop('required',false);
    }
    if ($(this).val()=="kurumsal" && $(list[i]).data('type')=="kurumsal") {
      $(list[i]).removeClass('d-none');
       $('.order_inputer').prop('required',true);
    }  
  };
});
function MailPhone(){
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    var CostumerName = document.forms["OrderForm"]["sp_musteri_adi"].value;
    var emailVal = document.forms["OrderForm"]["sp_musteri_mail"].value;
    var contact = document.forms["OrderForm"]["sp_musteri_telefon"].value;
    if (CostumerName.length < 1)
      {
       titresim('#CostumerName');
       document.getElementById("CostumerName").focus();
      return false;
      }
     if (contact.length < 10)
      {
       titresim('#phoneNumber');
       document.getElementById("phoneNumber").focus();
      return false;
      }
    if (reg.test(emailVal) == false)
       {
         titresim('#emailAddress');
         document.getElementById("emailAddress").focus();
         return false;
      }
  return true;
}
function orderajax(data,type){
  $.ajax({
        type: 'POST',
        url: window.location.href+'?action=code',
        data: data,
        dataType: 'JSON',
        success: function(response) {
          delete buton.dataset.statu;
          buton.dataset.statu = response.coupon;
          if (type == "coupon" & !response.coupon) {
            titresim('#sp_musteri_kupon');
            $('#sp_musteri_kupon').prop("readonly",false);
          }
          if (type == "coupon" & response.coupon) {
            $('#sp_musteri_kupon').prop("readonly",true);
          }
          if (response.payment_info) {
                if($('#payment_info').hasClass('d-none'))
                    $('#payment_info').removeClass('d-none');
                $('#payment_info').html(response.payment_info);
            } else {
                if(!$('#payment_info').hasClass('d-none'))
                    $('#payment_info').addClass('d-none');
            }
          $('#sp_musteri_kupon').val(response.coupon_code);
          $('#nivu_pk_fee').html(response.product_amount);
          $('#nivu_service_fee').html(response.service_amount);
          $('#nivu_discount').html(response.discount_amount);
          $('#nivu_amount').html(response.total_amount);
          $('.coupon_code_click').html(response.coupon_button_text);
          $('.coupon_code_click').attr('class', response.coupon_button_class);
        }
    });
}
function Wizardkontrol(){
    if (step_next==4)
      return true;
  var sections = document.querySelectorAll("#order_section_list fieldset");
    for (var i = 0; i < sections.length; i++) {
      if($(sections[i]).data("section")==step_next){
        $(sections[i]).addClass("d-block");
        $(".step-"+step_next).prop("required", true);
        if (step_next == 2 && order_type=="bireysel") {
          $('.order_inputer').prop('required',false);
        }
      } else {
        if ($(sections[i]).hasClass("d-block"))
          $(sections[i]).removeClass("d-block");
        $(sections[i]).addClass("d-none");
      }
    }
    var tablist = document.querySelectorAll("#progressbar li");
    for (var i = 0; i < tablist.length; i++) {
      if($(tablist[i]).data("wizart") == step_next && step_action=="next"){
        $(tablist[i]).addClass("active");
      }
      if($(tablist[i]).data("wizart") == step_now && step_action=="back"){
        $(tablist[i]).removeClass("active");
      }
    }
  return false;
}
function titresim(element){
  $(element).addClass("nonshake").attr('style','background:#f2f2f2');
          setTimeout(function(){
            $(element).removeClass("nonshake").attr('style','');},500);
          return false;
}
function hizligetir(item){
if (item=="start") {
  $('.alans1, .alan1').attr("style","display:none;");
    $('.alans2, .alan2').attr("style","display:block;");
    $('#ackapa').attr("onclick","hizligetir('turn')");
    $('#ackapa').html('<i class="fas fa-list"></i> Servislere Geç');
}
if (item=="turn") {
  $('.alans1, .alan1').attr("style","display:block;");
    $('.alans2, .alan2').attr("style","display:none;");
    $('#ackapa').attr("onclick","hizligetir('start')");
    $('#ackapa').html('<i class="fas fa-bolt"></i> Hızlı Siparişe Geç');
}
}