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

$('.os-pri-btn').click(function(){
	btn = $(this);
	nextOf(btn.data("tab"));
});
$('.os-next-btn').click(function(){
	btn = $(this);
	var parcala = btn.data("input").split("|");
	for(i = 0; i < parcala.length; i++) {
		if(!inputValite(parcala[i]))
			return false;
	}
	nextOf(btn.data("tab"));
});
function nextOf(idsi){
	$(".obj-tab").removeClass("active");
	$("#now-"+idsi).addClass("active");
	$(".os-tabs").hide();
	$("#"+idsi).show();
};
function inputValite(name){
	if(name=="islem_adres"){
		islem_adres = $('input[name ="'+name+'"]').val();
		if(islem_adres.length>3){
			return true;
		}
		return dangerNoti('input[name ="'+name+'"]');
	}
	if(name=="sp_musteri_adi"){
		sp_musteri_adi = $('input[name ="'+name+'"]').val();
		if(sp_musteri_adi.length>3){
			return true;
		}
		return dangerNoti('input[name ="'+name+'"]');
	}
	if(name=="sp_musteri_telefon"){
		sp_musteri_telefon = $('input[name ="'+name+'"]').val();
		if(sp_musteri_telefon.length>10){
			return true;
		}
		return dangerNoti('input[name ="'+name+'"]');
	}
	if(name=="sp_musteri_mail"){
		sp_musteri_mail = $('input[name ="'+name+'"]').val().trim();
		if(sp_musteri_mail.indexOf('@')!=-1){
			var mailParcala = sp_musteri_mail.split("@");
			if(mailParcala[0].length>0 && mailParcala[1].length>0 && mailParcala[1].indexOf('.')!=-1) {
				return true;
			}
		} 
		return dangerNoti('input[name ="'+name+'"]');
	}
	if(name=="sp_musteri_adres"){
		if($('select[name ="sp_tur"]').val()=="bireysel") {
			return true;
		}
		sp_musteri_adres = $('#'+name).val();
		if(sp_musteri_adres.length>10){
			return true;
		}
		return dangerNoti('#'+name);
	}
	if(name=="sp_musteri_vn" || name=="sp_musteri_vd"){
		if($('select[name ="sp_tur"]').val()=="bireysel") {
			return true;
		}
		data = $('input[name ="'+name+'"]').val();
		if(data.length>4){
			return true;
		}
		return dangerNoti('input[name ="'+name+'"]');
	}
	if(name=="payment"){
		if($('input[name ="sp_odeme"]').val().length>0){
			return true;
		}
		return dangerNoti('#payment_info');
	}
	if(name=="recaptcha"){
		return get_action();
	}
	if(name=="sozlesme"){
		if(document.getElementById("check_contract").checked) {
			return true;
		} 
		return dangerNoti('.usinfor');
	}
}
kuponStatu = false;
setTimeout(function(){
    uygulaButtonText = $(".control-coupon").html();
},2000);

$(".control-coupon").click(function(){
	if(kuponStatu) {
		$('input[name ="sp_musteri_kupon"]').prop("readonly",false);
		$(this).html(uygulaButtonText);
		$(this).attr("style","");
		$('input[name ="sp_musteri_kupon"]').val("");
		kuponStatu = false;
		data = {"action":"response","sp_musteri_kupon":"","sp_odeme":$('input[name ="sp_odeme"]').val()};
		orderPost(data);
		return false;
	}
	coupon = $('input[name ="sp_musteri_kupon"]').val();
	if(coupon.length>1){
		data = {"action":"response","sp_musteri_kupon":coupon,"sp_odeme":$('input[name ="sp_odeme"]').val()};
		orderPost(data);
		return true;
	}
	return dangerNoti('input[name ="sp_musteri_kupon"]');
});
$(".pay-item").click(function(){
	if($(this).data("statu") && $('input[name ="sp_odeme"]').val()!=$(this).data("medhod")) {
		$('input[name ="sp_odeme"]').val($(this).data("medhod"));
		data = {"action":"response","sp_musteri_kupon":$('input[name ="sp_musteri_kupon"]').val(),"sp_odeme":$(this).data("medhod")};
					orderPost(data);
		$(".pay-item").removeClass("selected").find(".pay-checked").fadeOut(300);
		$(this).find(".pay-checked").fadeIn(300);
		$(this).addClass("selected");
	} else {
		if($('input[name ="sp_odeme"]').val()!=$(this).data("medhod"))
		dangerNoti(this);
	} 
});
$('input[name="sp_musteri_telefon"]').on("keyup",function(){
	var texts = this.value.replace(" ","");
	texts = texts.replace(/[^0-9.+]/g,'');
	$(this).val(texts.trim());
});

$('select[name ="sp_tur"]').on("change",function(){
	if($(this).val()=="kurumsal" && $('#sp_tur').hasClass("d-none")){
		$('#sp_tur').removeClass("d-none");
		return true;
	}
	if($(this).val()=="bireysel" && !$('#sp_tur').hasClass("d-none")){
		$('#sp_tur').addClass("d-none");
		return true;
	}

});
$('input[name="sp_musteri_mail"]').on("keyup",function(){
	var text = this.value.replace(" ","").toLowerCase();
	var text = text.replace(/[^a-z0-9.@_-]/g,'');
	this.value= text.trim();
});
function orderPost(data){
	$('.order-area').addClass('gecistir');
	$.ajax({
		type: 'POST',
		url: window.location.href,
		data: data,
		dataType: 'JSON',
		success: function(response) {
			$('.order-area').removeClass('gecistir');
			jsonController(response);
		}
	});
}
function jsonController(data){
	if(data.sales_contract){
		$('#contract_head').html(data.contract_head);
		$('#contract_content').html(data.contract_content);
		$('#sozlesme').modal();
		return true;
	}
	if(data.service_amount){
		$('#service_amount').html(data.service_amount);
	}
	if(data.total_amount){
		$('#total_amount').html(data.total_amount);
	}
	if(data.coupon_discount){
		$('#coupon_discount').html(data.coupon_discount);
	}
	if(data.price){
		$('#price').html(data.price);
	}
	if(data.payment_info){
		$('#payment_info').html(data.payment_info);
	}
	if(data.coupon_discount_control){
		$('input[name ="sp_musteri_kupon"]').prop("readonly",true);
		kuponStatu = true;
		$('.control-coupon').html(kaldirButtonText);
		$('.control-coupon').attr("style","background: #777777;color: #fff;");
	} else {
		kuponStatu = false;
		$('input[name ="sp_musteri_kupon"]').prop("readonly",false);
		$('.control-coupon').html(uygulaButtonText);
		$('.control-coupon').attr("style","");
		if($('input[name ="sp_musteri_kupon"]').val().length>0){
			$('input[name ="sp_musteri_kupon"]').val("");
			dangerNoti('input[name ="sp_musteri_kupon"]');
		}
	}
	return true;
}
$('form[name="OrderForm"]').on('keydown',function(){
	return event.key != 'Enter';
});
$(".order-search-btn").click(function(){
	$(".search-area").addClass("show");
	if(screen.width < 900){
		$("#navbarsupport").removeClass("show").slideUp(200);
		$(".menu-toggler").toggleClass("active");
	}
});
$(".wb-osearch").click(function(){
	$(".search-area").toggleClass("show");
});
$(".search-close").click(function(){
	$(".search-area").removeClass("show");
});
$(".wb-close").click(function(){
	$(".wb-itemz").slideToggle(100).toggleClass("closed");
	$(this).parent().toggleClass("close");
	if($(this).parent().hasClass("close")){
		$(this).find(".ico-chance").html('<i class="fas fa-angle-double-up"></i>');
	} else {
		$(this).find(".ico-chance").html('<i class="fas fa-times"></i>');
	}
	checkCookie("cache");
});
function setCookie(cname,cvalue,exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires=" + d.toGMTString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function checkCookie(type = "") {
  var kapali = getCookie("wbclose");
  if(type=="cache"){
  	if(kapali != "")
  	setCookie("wbclose", "", 30);
    else
    	setCookie("wbclose", true, 30);
  	return;
  }
  if (kapali != "") {
  	$(".wb-itemz").slideToggle(100).toggleClass("closed");
	$(".wb-close").parent().toggleClass("close");
	if($(".wb-close").parent().hasClass("close")){
		$(".wb-close").find(".ico-chance").html('<i class="fas fa-angle-double-up"></i>');
	} else {
		$(".wb-close").find(".ico-chance").html('<i class="fas fa-times"></i>');
	}
  } 
}
setTimeout(function(){
checkCookie();
},500);
function wb_closeFunc(){
$(".wb-itemz").slideToggle(100).toggleClass("closed");
	$(".wb-close").parent().toggleClass("close");
	if($(".wb-close").parent().hasClass("close")){
		$(".wb-close").find(".ico-chance").html('<i class="fas fa-angle-double-up"></i>');
	} else {
		$(".wb-close").find(".ico-chance").html('<i class="fas fa-times"></i>');
	}
}
$('#order_search').submit(function(){
	$('.search-input-btn').addClass('gecistir');
	searchRequest = $('.search-input-btn').data("href");
	$.ajax({
		type: 'POST',
		url: searchRequest,
		data: $(this).serialize(),
		dataType: 'JSON',
		success: function(response) {
			if(response.statu){
				window.location.href = response.href;
			} else {
				dangerNoti('input[name ="islem_kodu"]');
			}
			$('.search-input-btn').removeClass('gecistir');
		}
	});
	return false;
});
function dangerNoti(element){
	$(element).addClass("nonshake").attr('style','background:#f2cbcb');
	setTimeout(function(){
		$(element).focus();
		$(element).removeClass("nonshake").attr('style','');},500);
	return false;
}
$(".nsa-header").click(function () {
	var kisalt = $(this).parent().find(".nsa-body");
	if (kisalt.hasClass("show")) {
		kisalt.removeClass("show").slideUp(100);
	} else {
		$(".nsa-body").removeClass("show").slideUp(100);
		kisalt.addClass("show").slideDown(100);
	}
});
$(".menu-toggler").click(function(){
	$(this).toggleClass("active");
	$("#navbarsupport").slideToggle(200).toggleClass("show");
});
$("body").on("click", ".droplapse.show ul li.drop-down", function(){
	$(this).find(".dropdown-sub").slideToggle(0);
});
$(document).ready(function(){
	$(".preloader").delay(500).fadeOut(500);
});
function get_action() {
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
  $('.recaptchaControl').submit(function(){
  	return get_action(this);
  });