// Bilgi Kutusu Accordion //
$(".card.bilgi-box .card-header").click(function(){
  $(this).toggleClass("border-bottom-0");
  $(this).parent().toggleClass("active");
  $(this).parent().find(".card-body").slideToggle(100);
});

// Intro Modeli Filtreleme //
function introx(){
  var intmodel = $('select#intromodel option').filter(':selected').val();
  $(".intromodel").removeClass("show");
  $("#"+intmodel).addClass("show");
  if(intmodel == 'introSearch'){
    $(".intro-butonlar").addClass("d-none");
  } else {
    $(".intro-butonlar").removeClass("d-none");
  }
  if(intmodel == 'introShow'){
    $(".intro-gorseli").removeClass("d-none");
  } else {
    $(".intro-gorseli").addClass("d-none");
  }
}
introx();
$( "select#intromodel" ).change(function() {
  introx();
});
$('.specialpage_delete').click(function(){
  veriler = {'page':'theme','olay':'deletepageSpace','yontem':'delete','head_alert':'Özel Sayfayı Sil'};
  spaceData(veriler);
  return false;
});
$('.specialPacket_delete').click(function(){
  veriler = {'page':'theme','olay':'deletepageSpace','yontem':'delete','head_alert':'Özel Paket Listesini Sil'};
  spaceData(veriler);
  return false;
});

// Hizmetler Listesi Filtreleme //
function sercatx(){
  var servicecat = $('select#sercat option').filter(':selected').data('service');
  if(servicecat == 'category'){
    $("#servicecat").removeClass("d-none");
  } else {
    $("#servicecat").addClass("d-none");
  }
}
sercatx()
 $( "select#sercat" ).change(function() {
    sercatx();
});

// liste ekle çıkar
var listsay = $(".liste-list select option").length;
$("#listeekle").click(function(){
  if($(".list-element").length < listsay) {
  $(".list-element:nth-child(1)").clone().appendTo(".liste-list");
  }
});
$("#listecikar").click(function(){
  if($(".list-element").length > 1) {
  $(".list-element:nth-last-child(1)").remove();
  }
});

// Neden biz ekle çıkar
$("#whyekle").click(function(){
  if($(".why-element").length < 5) {
  $(".why-element:nth-child(1)").clone().appendTo(".why-list");
  }
});
$("#whycikar").click(function(){
  if($(".why-element").length > 1) {
  $(".why-element:nth-last-child(1)").remove();
  }
});


// Yorum biz ekle çıkar
$("#comekle").click(function(){
  if($(".com-element").length < 10) {
  $(".com-list").append('<div class="com-element"><div class="form-row"><div class="col com-img-area"><div class="onecik-onizle ortambut" onclick="ortGetir(this);" data-ortam="commentAvatar'+comLastkey+'" data-url="../images/admin.png" data-input=""><img class="ortam-sec" src="../images/ortam-sec.png""><div class="tumb-oniztext"><img id="commentAvatar'+comLastkey+'-onizleme" src="../images/admin.png"><input type="hidden" id="commentAvatar'+comLastkey+'-input" name="data[item3]['+comLastkey+'][avatar]" required="" value="avatar"></div></div></div><div class="col"><div class="form-row"><div class="col-md-4"><div class="form-group"><input type="text" class="form-control" name="data[item3]['+comLastkey+'][name]" placeholder="Müşteri Adı" required="" value=""></div></div><div class="col-md-8"><div class="form-group"><input type="text" class="form-control" name="data[item3]['+comLastkey+'][job]" placeholder="Mesleği" required="" value=""></div></div><div class="col-md-12"><div class="form-group"><textarea class="form-control" placeholder="Yorum alanı" name="data[item3]['+comLastkey+'][comment]" required=""></textarea></div></div></div></div></div></div>');
    comLastkey++;
  }
});
$("#comcikar").click(function(){
  if($(".com-element").length > 1) {
  $(".com-element:nth-last-child(1)").remove();
  if(comLastkey>0)
    comLastkey--;
  }
});
function ortGetir(item){
  ortamend = $(item).data('ortam');
    if($(item).data('url')){
      imageselect(item);
    }
    $(".ortam-bg").fadeIn(100);
    $(".ortam-box").fadeIn(100);
}
// Soru ekle çıkar
$("body").on("click", ".faqekle", function(){
    var parent = $(this).parent().find(".faq-list");
    $(parent).append('<div class="card bilgi-box mb-2"><div class="card-header">Yeni Soru<i class="fas fa-chevron-right" aria-hidden="true"></i></div><div class="card-body"><div class="faq-element mb-4"><div class="form-group mb-2"><input type="text" required="" class="form-control" name="data[item3]['+cSssKey+'][question]" placeholder="Soru" value=""></div><div class="form-group"><textarea class="form-control" required="" name="data[item3]['+cSssKey+'][reply]" placeholder="Cevap"></textarea></div></div><button type="button" class="butto butto-danger butbor ml-2 mb-3 faqcikar"><i class="fas fa-trash" aria-hidden="true"></i> Sil</button></div></div>');
    cSssKey++;
});

$("body").on("click", ".faqcikar", function(){
    if(cSssKey>1) {
        var parent = $(this).parent().parent().remove();
        cSssKey--;
    }
});


// Sayfa Seçimi

$(".cb-item").click(function(){
  id = $(this).data("input");
  if($(this).hasClass("selected")) {
    $('input[name="data[item2][places]['+id+']"]').attr('checked',false);
  } else {
    $('input[name="data[item2][places]['+id+']"]').attr('checked',true);
  }
  $(this).toggleClass("selected");
});

// Servis Listesi
function choose(){
  var choosedata = $('.datachoose option').filter(':selected').data("choose");
 if(choosedata == "category") {
  $(".choose-show").show();
 } else {
  $(".choose-show").hide();
 }
}
choose();
$(".datachoose").change(function() {
  choose();
});

  $('.action_form_submit').submit(function(){
    spaceData($(this).serialize());
    return false;
  });
  function spaceData(data){
    $('.content').addClass('gecistir');
    $.ajax({
      type: 'POST',
      url: window.location.href,
      data: data,
      success: function(response) {
        $('#ajaxout').html(response);
        $('.content').removeClass('gecistir');
      }
    });
  }