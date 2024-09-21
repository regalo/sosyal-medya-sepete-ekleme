// Bilgi Kutusu Accordion //
$(".card.bilgi-box .card-header").click(function(){
  if(!$(this).parent().hasClass("active")){
    !$(this).parent().addClass("active");
    $(this).addClass("border-bottom-0");
     $(this).parent().find(".card-body").slideUp(100);
  } else {
      $(".card.bilgi-box .card-header").addClass("border-bottom-0");
      $(".card.bilgi-box .card-header").parent().addClass("active");
      $(".card.bilgi-box .card-header").parent().find(".card-body").slideUp(100);
    $(this).removeClass("border-bottom-0");
    $(this).parent().removeClass("active");
    $(this).parent().find(".card-body").slideDown(100);
  }
});

// Bilgi Kutusu Accordion //
function boxAcKapa(item){
  $(item).toggleClass("border-bottom-0");
  $(item).parent().toggleClass("active");
  $(item).parent().find(".card-body").slideToggle(100);
};
function headClone(item){
  var headClone = $(item).val();
  $(item).parent().parent().parent().parent().find("span").html(headClone);
}
function boxQuesDelete(item){
  $(item).parent().parent().remove();
}

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
$('button[data-editorAfter="editor"]').click(function(){
  editor_data = CKEDITOR.instances.editor.getData();
  $('#editorAfter').val(editor_data);
  return;
});
  $('.loftForm').submit(function(){
    data = $(this).serialize();
    $(this).find('button').addClass('gecistir');
    $.ajax({
      type: 'POST',
      url: window.location.href,
      data: data,
      dataType: 'JSON',
      success: function(response) {
        loftAjaxAction(response);
        $('button').removeClass('gecistir');
      }
    });
    return false;
  });
  function homeListing(item) {
      if($(item).data("key")!="none"){
        $('.HomeListing').addClass('gecistir');
        data = {"olay":"loftAction","page":"theme","loftAction":"homeListing","type":$(item).data("type"),"key":$(item).data("key")};
        $.ajax({
          type: 'POST',
          url: window.location.href,
          data: data,
          dataType: 'JSON',
          success: function(response) {
            loftAjaxAction(response);
            $('.HomeListing').removeClass('gecistir');
          }
        });
        return false;
      }
  };
  function homeListOff(item) {
      $('.HomeListing').addClass('gecistir');
      if($(item).data("type")=="statu")
          data = {"olay":"loftAction","page":"theme","loftAction":"homeListOff","key":$(item).data("key")};
      if($(item).data("type")=="options")
          data = {"olay":"loftAction","page":"theme","loftAction":"homeListOptions","key":$(item).data("key"),"value":$(item).val()};
      $.ajax({
        type: 'POST',
        url: window.location.href,
        data: data,
        dataType: 'JSON',
        success: function(response) {
          loftAjaxAction(response);
          $('.HomeListing').removeClass('gecistir');
        }
      });
      return false;
  };
  function loftAjaxAction(data){
    if(data.loftAction=="homeListing"){
      if(data.jsonStatu)
        $('.HomeListing').html(data.html);
    } else if(data.loftAction=="alert"){
      $('#ajaxout').html(data.html);
    } else if(data.loftAction=="whyOurNew"){
      $('#whyOurList').html(data.html);
    } else if(data.loftAction=="commentActionType"){
      $('#commentList').html(data.html);
    } else if(data.loftAction=="commentMore"){
      if(data.jsonStatu){
        $('.vsCommentList').html(data.html);
        $('input[name="commentMore"]').val(data.commentMore);
      } else {
        $('.showMore').html(data.html);
      }
    }
  }

$(".whyOurNew").click(function(){
  $('input[name="loftActionType"]').val("whyOurNew");
  $('#'+$(this).data("form")).submit();
});
$(".loftCommentNew").click(function(){
  $('input[name="commentActionType"]').val("commentActionType");
  $('#'+$(this).data("form")).submit();
});
$( "body" ).on( "click",".ortambutLoft", function() {
    ortamend = $(this).data('ortam');
    if($(this).data('url')){
      imageselect(this);
    }
    $(".ortam-bg").fadeIn(100);
    $(".ortam-box").fadeIn(100);
});
$('body').on('click','.commentListDelete',function(){
     var boxList = document.querySelectorAll('.com-list');
     if(boxList.length>3){
       $('div[data-commentList="'+$(this).data("key")+'"]').remove();
     }
});
$('.whyOurDeleted').click(function(){
     var boxList = document.querySelectorAll('#whyOurList .item');
     if(boxList.length>3){
       $('div[data-whyBox="'+$(this).data("key")+'"]').remove();
       $('#whyOur').submit();
     }
     var boxList = document.querySelectorAll('#whyOurList .item');
     if(boxList.length<4){
      $('.whyOurDeleted').attr("class","butto butto-xs butto-danger whyOurDeleted ml-2 nodelete");
     }
     
});

$( "body" ).on( "click", function() {
  $(".icon-modal").click(function(){
    $(".icon-add").attr("data-icon",$(this).data("icon"));
    $(".icon-add").attr("data-id",$(this).data("add"));
  });
  $(".icon-add").click(function(){
     $('#iconView_'+$(this).attr("data-id")).attr("class",$(this).attr("data-icon"));
     $('#iconInput_'+$(this).attr("data-id")).val($(this).attr("data-icon"));
    $('#iconButton_'+$(this).attr("data-id")).attr("data-icon", $(this).attr("data-icon"));
  });
});
$('button[data-loftAction="loftOptions"]').click(function(){
  $('input[name="olay"]').val($(this).data("type"));
});
$('select[data-showHide="true"]').change(function(){
  if($(this).val()=="aktif")
    $($(this).attr("data-class")).show();
  else
    $($(this).attr("data-class")).hide();
});
function commentDetail(key){
  data = dataComment[key];
  $('input[name="commentSave"]').val(data.ayar_1);
  $('input[name="commentSave"]').val(data.ayar_1);
  $('input[name="commentSave"]').val(data.ayar_1);
  $('input[name="data[item2]"]').val(data.item2);
  $('input[name="data[item4]"]').val(data.item4);
  $('select[name="data[statu]"]').val(data.statu);
  $('input[name="data[item3][name]"]').val(data.name);
  $('input[name="data[item3][mail]"]').val(data.mail);
  $('input[name="data[item3][date]"]').val(data.date);
  $('textarea[name="data[item3][comment]"]').val(data.comment);
  $('.modal-title').html('('+data.type+') | '+data.contentTitle);
  if(data.reply.length>3)
    $('textarea[name="data[item3][reply]"]').val(data.reply);
}
styleParcala = [];
  styleGetir = [];
  styleNet = [];
  $('button').click(function(){
    var checkboxes = document.querySelectorAll('.renksecici');
    for (var i = 0, len = checkboxes.length; i < len; i++) {
        var id = $(checkboxes[i]).data("renk");
        styleGetir[id] = $("#"+id).attr("style");
        if(styleGetir[id].indexOf("#")=="-1"){
          styleParcala[id] = styleGetir[id].split("rgb(");
          styleGetir[id] = styleParcala[id][1];
          styleNet[id] = styleGetir[id].split(");");
          var renk = styleNet[id][0];
          $('input[data-renkRgb="'+id+'"]').val(renk);
      }
    }
  });