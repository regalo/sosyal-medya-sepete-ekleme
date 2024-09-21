/* COOKIE İŞLEMLERİ */
favoriJson = [];
cookieOrders = [];
$('button[data-type="packetFavori"]').click(function(){
	packetID = $(this).data("favpacket");
	if(cookieOku("favorilerim["+packetID+"]")){
		cookieGuncelle("favorilerim["+packetID+"]",false,-1);
		$('button[data-favpacket="'+packetID+'"]').attr("class","favPack");
		if(getFavoritePacket)
			$(this).parent().parent().remove();
	} else {
		cookieGuncelle("favorilerim["+packetID+"]",true,"9999999999");
		$('button[data-favpacket="'+packetID+'"]').attr("class","favPack active");
	}
});
setTimeout(function(){
	packJson.forEach(favoriCheck);
	cookieOrdersChech();
	if(getFavoritePacket){
		data = {"loftAction":"favoriCheck","favoriler":favoriJson};
		$.ajax({
			type: 'POST',
			url: window.location.href,
			data: data,
			dataType: 'JSON',
			success: function(response) {
				loftAjaxAction(response);
			}
		});
	}
},100);
$('button[data-contract="true"]').click(function(){
	$('input[name="contract"]').prop("checked",true);
});
function cookieOrdersChech(){
	for (var i = 5; i >= 1; i--) {
		if(cookieOku("cookieOrders["+i+"]")!=""){
			cookieOrders[i] = cookieOku("cookieOrders["+i+"]");
		}
	}
}
function cookieOrdersNew(token){
	exitingToken = false;
	for (var i = 5; i >= 1; i--) {
		if(cookieOku("cookieOrders["+i+"]")==token)
			exitingToken = true;
	}
	if(!exitingToken){
		for (var i = 5; i >= 1; i--) {
			var exiID = cookieOrders[i];
			var newID = (i - 1);
			if(newID>0){
				cookieGuncelle("cookieOrders["+newID+"]",exiID,"9999999999");
			}
		}
		cookieGuncelle("cookieOrders[5]",token,"9999999999");
	}

}

function favoriCheck(item, index) {
	if(cookieOku("favorilerim["+item+"]")){
		favoriJson.push(item);
		$('button[data-favpacket="'+item+'"]').addClass("active");
	}
}
/* COOKIE İŞLEMLERİ SONU */
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
}(this);

/* MobileMenu */
$(".navTogbtn").click(function(){
	$(this).toggleClass("active");
	$("body").toggleClass("showmenu");
});
$(".nav-drop a").click(function(){
	if(screen.width<991){
		if($(this).next().hasClass("activeDrop")){
			  $(this).next().fadeOut(10);
			  $(this).next().removeClass("activeDrop");
			  $(this).removeClass("show");
		} else {
			$('.nav-drop ul').fadeOut(10);
			$('.nav-drop ul').attr("class","drop-menu");
			$('.nav-drop a').attr("class","nav-link");
			$(this).next().addClass("activeDrop");
			$(this).addClass("show");
			$(this).next().fadeIn(500);
		}
	}
});
/* bestsellers splide */
packListCount.forEach(packListSel);
function packListSel(item, index){
	document.addEventListener( 'DOMContentLoaded', function () {
		new Splide('.packlisti'+item, {
			type: "slide",
			perPage: 4,
			perMove: 1,
			arrows: false,
			pagination: true,
			breakpoints: {
				1200: {
					perPage: 3,
				},
				992: {
					perPage: 2,
				},
				640: {
					perPage: 1,
					arrows: false,
					padding: {
						left: 25,
						right: 25,
					}
				},
			}
		} ).mount();
	} );
};
/* Testimonial */
if(document.querySelectorAll('.testimonial').length>0){
document.addEventListener( 'DOMContentLoaded', function () {
	new Splide( '.splide.testimonial', {
		type   : 'loop',
		perPage: 3,
		focus  : 'center',
		autoplay: true,
		arrows: false,
		interval: 7000,
		breakpoints: {
			1200: {
				perPage: 3,
			},
			992: {
				perPage: 2,
			},
			640: {
				perPage: 1,
				arrows: false,
				padding: {
					left: 20,
					right: 20,
				}
			},
		}
	} ).mount();
} );
}
/* Why More */
$(".whymore").click(function(){
	$(this).find("span").toggle();
	$(this).parent().parent().find(".item.more").slideToggle(100);
});
/* Pack More */
$(".packDetailMore").click(function(){
	$(this).hide();
	$(this).parent().addClass("more");
	$(this).parent().find(".moresi").slideDown(300);
});
/* Gece Modu */
/* Faq */
$(".faqwell .item").click(function(){
	if($(this).hasClass("show")){
		$(".faqwell .item").removeClass("show");
		$(".faqwell .item").find(".fs-content").slideUp(100);
		return true;
	}
	$(".faqwell .item").removeClass("show");
	$(".faqwell .item").find(".fs-content").slideUp(100);
	$(this).addClass("show");
	$(this).find(".fs-content").slideDown(100);
});
/* Fav Pack */


/* OrderPage */
$(".tabOption ul li").click(function(){
	var datasi = $(this).data("cs");
	$(".orderTabs .tab-content").removeClass("show");
	$(".orderTabs .tab-content#"+datasi).addClass("show");
});
$(".tabOption ul li").click(function(){
	$(".tabOption ul li").removeClass("active");
	$(this).addClass("active");
});
$(".PaymentMethod ul .selectPayment").click(function(){
	$(".PaymentMethod ul li").removeClass("selected");
	data = {"loftAction":"paymentChange","action":"response","sp_musteri_kupon":$('input[name="sp_musteri_kupon"]').val(),"sp_odeme":$(this).data("key"),"kuponClick":kuponClick};
	kuponClick = 0;
	$.ajax({
		type: 'POST',
		url: window.location.href,
		data: data,
		dataType: 'JSON',
		success: function(response) {
			loftAjaxAction(response);
		}
	});
	$(this).addClass("selected");
});
kuponClick = 0;
$('.coupbtn').click(function(){
	if($(this).hasClass("chechCoup")){
			$('input[name="sp_musteri_kupon"]').prop("readonly",false);
			$('input[name="sp_musteri_kupon"]').val("");
			alertCreate({"statu":"info","head":lang.islembasarili,"text":lang.kuponkodubasariylakaldirildi});
	} else {
		kuponClick = 1;
	}
	$('.selectPayment[data-key="'+$('input[name="sp_odeme"]').val()+'"]').click();

});

			$(".fixActions .close").click(function(){
		if($(".fixActions").hasClass("show"))
			cookieGuncelle("buttonRight","kapali",9999999999);
		else
			cookieGuncelle("buttonRight","acik",9999999999);
		$(".fixActions").toggleClass("show");
	});
/* OrderSearch */
$(".orsebtns").click(function(){
	if(!$('.osareaBG').hasClass("show")){
		data = {"loftAction":"cookieOrders","orders":cookieOrders};
		$.ajax({
			type: 'POST',
			url: window.location.href,
			data: data,
			dataType: 'JSON',
			success: function(response) {
				loftAjaxAction(response);
			}
		});
	}
	$(".osareaBG").toggleClass("show");
	$("body").toggleClass("order");
});
$(".osareaBG .close").click(function(){
	$(".osareaBG").removeClass("show");
	$("body").removeClass("order");
});
$('.loftForm').submit(function(){
	data = $(this).serialize();
	$.ajax({
		type: 'POST',
		url: window.location.href,
		data: data,
		dataType: 'JSON',
		success: function(response) {
			loftAjaxAction(response);
		}
	});
	return false;
});
function loftAjaxAction(data){
	if(data.loftAction=="orderControl"){
		if(data.jsonStatu == "success"){
			setTimeout(function(){
				window.location.href = data.href;
			},500);
		}
	} else if(data.loftAction=="paymentChange"){
		$('#amountProduct').html(data.amount.product);
		$('#amountService').html(data.amount.service);
		$('#amountDiscount').html(data.amount.discount);
		$('#amountTotal').html(data.amount.total);
		$('input[name="sp_odeme"]').val(data.paymentSelect.select);
		$('.paymentDetail p').html(data.paymentSelect.info);
		if(data.amount.coupon){
			$('input[name="sp_musteri_kupon"]').prop("readonly",true);
			$('.coupbtn').attr("class","coupbtn anibut chechCoup");
			$('.coupbtn').html(lang.kaldir);
			if(data.kuponClick=="1"){
				alertCreate({"statu":"success","head":lang.indirimuyglulandi,"text":lang.gecerlibirkuponkodugirdiniz});
			}
		} else {
			$('input[name="sp_musteri_kupon"]').prop("readonly",false);
			$('.coupbtn').attr("class","coupbtn anibut");
			$('.coupbtn').html(lang.uygula);
			$('input[name="sp_musteri_kupon"]').val("");
			if(data.kuponClick=="1"){
				alertCreate({"statu":"danger","head":lang.gecersizkod,"text":lang.kuponkodugecerlidegilveindirimuygulanamadi});
			}
		}
	} else if(data.loftAction=="orderCreate"){
		if(data.jsonStatu=="success"){
			if($('input[name="cookieInfo"]').val()=="on"){
				cookieGuncelle("formCookie",data.token,9999999999);
				cookieGuncelle("country-code",$('input[name="sp_musteri_telefon"]').attr("data-country-code"),9999999999);
			} else {
				cookieGuncelle("formCookie",false,9999999999);
			}
			window.location.href = data.href;
		}
	} else if(data.loftAction=="contactCreate"){
		if(data.jsonStatu){
			document.getElementById("contactForm").reset();
			setTimeout(function(){
				window.location.href = data.href;
			},3000);
		}
	} else if(data.loftAction=="commentCreate"){
		if(data.jsonStatu){
			document.getElementById("commentForm").reset();
			if(data.reload){
				setTimeout(function(){
					location.reload();
				},2000);
			}
		}
	} else if(data.loftAction=="favoriCheck"){
		$('.packList').html(data.html);
		packJson.forEach(favoriCheck);
	} else if(data.loftAction=="cookieOrders"){
		$('.LastOrdersList').html(data.html);
	} else if(data.loftAction=="orderFormCheck"){
		if(data.jsonStatu){
			$('#loftOrderForm').attr("data-statu","true");
			$('#spMusteriTelefon').val(data.data.sp_musteri_telefon);
			$('.orActionBTN').click();
			$('#loftOrderForm').attr("data-statu","false");
		} else {
			$('#loftOrderForm').attr("data-statu","false");
		}
		if(data.focus) {
			  $(data.focus).focus();
		}
	} else if(data.loftAction=="moreComment"){
		if(data.jsonStatu){
			$('.commentList').append(data.html);
			$('.smcommentBTN').attr("data-startCount",data.commentMore);
		} else {
			$('.smcommentBTN').attr("data-startCount","none");
			$('.smcommentBTN span').html(data.text);
		}

	}
	if(data.alert){
		alertCreate(data.alert);
	}
}
function alertCreate(data){
	$('.alert-message').attr("class","alert alert-"+data.statu+" alert-dismissible alert-message");
	$(".alert-message").fadeIn("slow");
  $("#alertText").html(data.text);
  $("#alertHead").html(data.head);
	$(".alert-message").animate({
		right: "20px"
	}, 1000, function(){
		setTimeout(function(){
			$(".alert-message").fadeOut("slow");
		}, 5000);
	});
}
$('.customerType').change(function(){
	if($(this).val()=="kurumsal"){
		$('input[name="sp_musteri_adi"]').attr("placeholder",lang.firmaadiniz);
		$('#customerCorporate').show();
		$('input[name="sp_musteri_vd"]').prop("required",true);
		$('input[name="sp_musteri_vn"]').prop("required",true);
		$('textare[name="sp_musteri_adres"]').prop("required",true);
	} else {
		$('input[name="sp_musteri_adi"]').attr("placeholder",lang.adinizsoyadiniz);
		$('#customerCorporate').hide();
		$('input[name="sp_musteri_vd"]').prop("required",false);
		$('input[name="sp_musteri_vn"]').prop("required",false);
		$('textare[name="sp_musteri_adres"]').prop("required",false);
	}
});
$('.hrefGo').click(function(){
	if($(this).data("blank"))
		window.open($(this).data("href"), "_blank");
	else
		window.location.href = $(this).data("href");
});
if(formCookieControl){
	setTimeout(function(){
		if(cookieOku("formCookie")!=false){
			data = {"loftAction":"cookieForm","token":cookieOku("formCookie")};
			$.ajax({
				type: 'POST',
				url: window.location.href,
				data: data,
				dataType: 'JSON',
				success: function(response) {
					if(response.jsonStatu=="success"){
						$('input[name="cookieInfo"]').prop("checked",true);
						$('select[name="sp_tur"]').val(response.sp_tur);
						$('select[name="sp_tur"]').change();
						$('input[name="sp_musteri_adi"]').val(response.sp_musteri_adi);
						$('input[name="sp_musteri_mail"]').val(response.sp_musteri_mail);
						var phoneNumber = response.sp_musteri_telefon.replace("+"+$('input[name="sp_musteri_telefon"]').attr("data-country"), "");
						$('input[name="sp_musteri_telefon"]').val(phoneNumber.replace("+",""));
						$('input[name="sp_musteri_telefon"]').attr("data-country-code",countryCode);
						$('input[name="sp_musteri_vd"]').val(response.sp_musteri_vd);
						$('input[name="sp_musteri_vn"]').val(response.sp_musteri_vn);
						$('textarea[name="sp_musteri_adres"]').val(response.sp_musteri_adres);
						$('input[name="sp_musteri_kupon"]').val(response.sp_musteri_kupon);
						$('.selectPayment[data-key="'+response.sp_odeme+'"]').click();
					}
				}
			});
		}
	},50);
}
liDrop = false;
$('.fastDrop li').click(function(){
	$(".fastselect").attr("class","fastselect");
	$(".fastDrop").attr("class","fastDrop");
	fastSelectStep = $(this).data("type");
	if(fastSelectStep=="fastConKategori"){
		$('#fastPlatformHead').html($(this).data("name"));
		$('#fastPlatformTitle').html(lang.secimyapildi);
		$('#fastCategoryHead').html(lang.kategorisec);
		$('#fastCategoryTitle').html(lang.kategoriyibelirleunlem);
		$('#fastPacketHead').html(lang.paketsec);
		$('#fastPacketTitle').html(lang.sanauygunpaketisecunlem);
		var list = document.querySelectorAll('ul[data-type="fastKategori"] li');
	    for (var i = list.length - 1; i >= 0; i--) {
	        if ($(list[i]).data('tax')==$(this).data("idsi")) {
	          $(list[i]).attr('class','');
	        }
	        if ($(list[i]).data('tax')!=$(this).data("idsi")) {
	          $(list[i]).attr('class','d-none');
	        }
	    }
	    $('button[data-type="fastButton"]').attr("data-href","#");
		$('button[data-type="fastButton"]').html(lang.satinal);
	} else if(fastSelectStep=="fastConPaket"){
		$('#fastCategoryHead').html($(this).data("name"));
		$('#fastCategoryTitle').html(lang.secimyapildi);
		$('#fastPacketHead').html(lang.paketsec);
		$('#fastPacketTitle').html(lang.sanauygunpaketisecunlem);
		var list = document.querySelectorAll('ul[data-type="fastPaket"] li');
	    for (var i = list.length - 1; i >= 0; i--) {
	        if ($(list[i]).data('tax')==$(this).data("idsi")) {
	          $(list[i]).attr('class','');
	        }
	        if ($(list[i]).data('tax')!=$(this).data("idsi")) {
	          $(list[i]).attr('class','d-none');
	        }
	    }
	    $('button[data-type="fastButton"]').attr("data-href","#");
		$('button[data-type="fastButton"]').html(lang.satinal);
	} else if(fastSelectStep=="fastConNext"){
		$('#fastPacketHead').html($(this).data("name"));
		$('#fastPacketTitle').html(lang.secimyapildi);
		$('button[data-type="fastButton"]').attr("data-href",$(this).data("url"));
		$('button[data-type="fastButton"]').html(lang.satinal+" ("+$(this).data("price")+")");
	}
	liDrop = true;
});
fastSelectStep = "fastConPlatform";
thisFastType = "";
$(".fastselect").click(function(){
	if(liDrop){
		liDrop = false;
		return true;
	}
	thisFastType = $(this).data("type");
	if(thisFastType=="fastConKategori" & fastSelectStep=="fastConPlatform"){
		$('div[data-type="'+fastSelectStep+'"]').addClass("show");
		$('div[data-type="'+fastSelectStep+'"]').find(".fastDrop").addClass("show");
	} else if(thisFastType=="fastConPaket" & (fastSelectStep=="fastConKategori" || fastSelectStep=="fastConPlatform")){
		$('div[data-type="'+fastSelectStep+'"]').addClass("show");
		$('div[data-type="'+fastSelectStep+'"]').find(".fastDrop").addClass("show");
	} else {
		if(!$(this).hasClass("show")){
			$(".fastselect").attr("class","fastselect");
			$(".fastDrop").attr("class","fastDrop");
			$(this).addClass("show");
			$(this).find(".fastDrop").addClass("show");
		} else {
			$(this).removeClass("show");
			$(this).find(".fastDrop").removeClass("show");
		}
	}
});
$('button[data-type="fastButton"]').click(function(){
	if($(this).attr("data-href")!="#")
		window.location.href = $(this).attr("data-href");
	else
		return false;
});
$('.orActionBTN').click(function(){
	  if($('#loftOrderForm').attr("data-statu")=="true")
				return true;
		data = {"loftAction":"orderFormCheck","data[sp_musteri_telefon]":$('input[name="sp_musteri_telefon"]').val(),"data[sp_musteri_adi]":$('input[name="sp_musteri_adi"]').val(),"data[islem_adres]":$('input[name="islem_adres"]').val(),"data[sp_musteri_mail]":$('input[name="sp_musteri_mail"]').val(),"data[countryCode]":$('input[name="sp_musteri_telefon"]').attr("data-country")};
		$.ajax({
			type: 'POST',
			url: window.location.href,
			data: data,
			dataType: 'JSON',
			success: function(response) {
				loftAjaxAction(response);
			}
		});
		return false;
});
$('.smcommentBTN').click(function(){
	if($(this).attr("data-startCount")!="none"){
		  data = {"loftAction":"moreComment","commentMore":$(this).attr("data-startCount")};
			$.ajax({
				type: 'POST',
				url: window.location.href,
				data: data,
				dataType: 'JSON',
				success: function(response) {
					loftAjaxAction(response);
				}
			});
			return false;
		}
});