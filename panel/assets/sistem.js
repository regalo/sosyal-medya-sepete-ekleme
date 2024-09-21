 function settingLabel(item){
        if (item == "pasif") {
            $('.fa-cevir').removeClass('fa-cevir');
            $('.duzenleme-alanı').hide();
            $('.duzenleme-alanı').data('statu','pasif');
            return;
        }
        if ($('#'+item["id"]+'uzenle').data('statu')=="pasif") {
            $('.fa-cevir').removeClass('fa-cevir');
            $('.duzenleme-alanı').hide();
            $('.duzenleme-alanı').data('statu','pasif');
            $('#'+item["id"]+'uzenle').show();
            $(item).addClass('fa-cevir');
            $('#'+item["id"]+'uzenle').data('statu','aktif');
            return;
        }
        if ($('#'+item["id"]+'uzenle').data('statu')=="aktif") {
            $('#'+item["id"]+'uzenle').hide();
            $('.fa-cevir').removeClass('fa-cevir');
            $('#'+item["id"]+'uzenle').data('statu','pasif');
            return;
        }
        
    }
    $(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});
    function surukleend(){
        $('#stylealani').html('');
    }
    function surukle(o) {
        o.dataTransfer.setData("text", o.target.id);
        var data = $("#sirali2 li").children().length;
        if (data>0) {
            $('#stylealani').html('<style type="text/css">.ekleme-alani,#ustecek,#sirali2::after{background: #c2c2c2;}#ustecek{opacity:1;margin-top:-10px;visibility:visible;margin-bottom:10px;}.dark .ekleme-alani{background: #00000055;}.ekleme-alani::after {opacity: 1;}</style>');
        } else {
            $('#stylealani').html('<style type="text/css">.ekleme-alani,#sirali2::after{background: #c2c2c2;}</style>');
        }
    }
    function birak(o) {
        var asda = o.target;
        if ($('#'+asda["id"]).data('ekleme')==false) {
            return false;
        }

        o.preventDefault();
        var veri = o.dataTransfer.getData("text");
        var c = $("#"+veri+" li").children().length;
        if ($('#'+asda["id"]).data('ekleme') === undefined)
            return false;
        if (c>0 && $('#'+asda["id"]).data('ekleme')!='kisitli') {
            return false;
        }
        if ($('#'+asda["id"]).data('ekleme')=='kisitli') {
            var tax = $('#sirali2').data('tax');
            $('#tax-'+veri).val(tax);
            $('#'+veri).insertAfter('#'+asda["id"]);
            $('#'+veri).attr('data-ekleme','kisitli');
            var tax = veri.replace('eleman-', "");
            if (document.getElementById(veri).lastElementChild.tagName!="DIV") {
                $('#'+veri).append('<div class="altflex"><ul id="eklemelidir-'+tax+'" data-tax="'+tax+'" type="ul" ondrop="birak(event)" ondragover="return false;" class="list-group ekleme-alani" data-ekleme="true"></ul></div>');
            }
            return false;
        } else {
            o.target.appendChild(document.getElementById(veri));
        }
        if (asda["id"].indexOf('eleman')==0) {
            $('#'+veri).attr('style','');
            $('#'+veri).attr('data-ekleme','false');
            $('#'+veri).removeClass('kisitli');
        }
        if (asda["id"].indexOf('eklemelidir')==0) {
            var tax = $('#'+asda["id"]).data('tax');
            $('#tax-'+veri).val(tax);
            if (document.getElementById(veri).lastElementChild.tagName!="FIELDSET") {
                document.getElementById(veri).lastChild.remove();
            }
        }
        if (asda["id"]=="sirali2") {
            $('#'+veri).attr('data-ekleme','kisitli');
            $('#'+veri).addClass('kisitli');
            tax = $('#'+asda["id"]).data('tax');
            $('#tax-'+veri).val(tax);
            var tax = veri.replace('eleman-', "");
            if (document.getElementById(veri).lastElementChild.tagName!="DIV") {
                $('#'+veri).append('<div class="altflex"><ul id="eklemelidir-'+tax+'" data-tax="'+tax+'" type="ul" ondrop="birak(event)" ondragover="return false;" class="list-group ekleme-alani" data-ekleme="true"></ul></div>');
            }
        }
    }
    function yeniolustur(){
        var id = Math.floor(Math.random() * 1000);
            var item = $('#degistirme').html();
          for (i = 0; i < 20; i++) {
            var item = item.replace('degistir', id);
          }
          var item = item.replace('ozel-alan-link', $('#ozel-alan-link').val());
          var item = item.replace('ozel-alan-link', $('#ozel-alan-link').val());
          var item = item.replace('ozel-alan-link', $('#ozel-alan-link').val());
          var item = item.replace('ozel-alan-baslik', $('#ozel-alan-baslik').val());
          var item = item.replace('ozel-alan-baslik', $('#ozel-alan-baslik').val());
          var item = item.replace('ozel-alan-baslik', $('#ozel-alan-baslik').val());
          var item = item.replace('</fieldset>','</fieldset><div class="altflex"><ul id="eklemelidir-'+id+'" data-tax="'+id+'" type="ul" ondrop="birak(event)" ondragover="return false;" class="list-group ekleme-alani" data-ekleme="true"></ul></div>');
          var item = item.replace('<i onclick="yeniolustur()" class="fas fa-arrow-right','<i class="fas fa-arrows-alt');
          var item = item.replace('ozellik','draggable="true" ondragstart="surukle(event)" ondragend="surukleend()" data-categori="false"');
          $('#sirali2').append(item);
          $("html, body").animate({ scrollTop: $(window).height() }, "slow");
          return true;
    }
    function headtitle(element,id){
        var text = $(element).val();
        if (text.length>3) {
            $('#baslik-'+id).html(text);
            $('#input-'+id).val(text);
        } else {
            $('#baslik-'+id).html("Başlık Alanı");
            $('#input-'+id).val("Başlık Alanı");
        }
        
    }
    function sil(id) {
        settingLabel('pasif');
        if (id=="sirali2") {
            $('#'+id).html('<li id="ustecek" data-categori="false" data-ekleme="kisitli">Üste eklemek için buraya sürükle</li>');
            return false;
        }
        var c = $("#"+id+" li").children().length;
        if (c==0) {
            if(!$('#'+id).data('categori')) {
              $('#'+id).remove();
              return true;
            }
            $("#"+$('#'+id).data('categori')).append($('#'+id));
            $('#'+id).attr('data-ekleme','false');
            if (document.getElementById(id).lastElementChild.tagName!="SPAN") {
                document.getElementById(id).lastChild.remove();
            }
        } else {
            $("#"+id+" li").addClass("nonshake");
            setTimeout(function(){
                $("#"+id+" li").removeClass("nonshake");
            },500);

        }
    }
    function isNumeric(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}
function copyto(element,button) {
  var copyText = document.getElementById(element);
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  $(button).attr("style","background:green");
  document.execCommand("copy");
  setTimeout(function(){
    $(button).attr("style","");
  },500);
  return;
}
 var source = document.querySelectorAll('input.renksecici');
           for (var i = 0, j = source.length; i < j; ++i) {
                (new CP(source[i])).on('change', function(r, g, b, a) {
                   var selam = this.source.value = this.color(r, g, b, a);
                   var idsi = $(this.source).data('renk');
                   $('#'+idsi).attr('style','background:'+selam+';');
                });
            }
            $(document).ready(function() {
            $('.renksecici').keyup(function(e) {
                var selam = $(this).val();
                var idsi = $(this).data('renk');
                $('#'+idsi).attr('style','background:'+selam+';');
            })
        });
        $(".renkhover").click(function(){
            $(this).find("input").prev().css("width", "35px");
        });
        $(".renkhover").focusout(function(){
            $(this).find("input").prev().css({
                "width" : "calc(100% - 10px)",
                "text-shadow" : "none"
            });
        });
        if (screen.width < 1350 & screen.width > 768) {
            $("body").addClass("open");
        }           
        var text = "";
        function ordersearch(element){
            if ($(element).val()!=text) {
                var text = $(element).val();
                if (text.length<2) {
                    $('#realy').show();
                    $('#realy-head').show();
                    $('.nexto').show();
                    $('#search').hide();
                    $('#search-head').hide();
                } else {
                    $('#realy').hide();
                    $('#realy-head').hide();
                    $('.nexto').hide();
                    fastpost('siparis-search','search');
                    $('#search').show();
                    $('#search-head').show();
                }
            }
            return;
        }
        function oo_(id, page = "") {
            $('#olay').val(id);
            if (page!="") {
                if (page=="makale") {
                    editor_data = CKEDITOR.instances.editor.getData();
                    $('#makale').val(editor_data);
                    return;
                }
                $('#page').val(page);
            }
        }$(document).ready(function(){
            $('#_smmbayi').click(function(){
                var servisdata = {'type':$(this).data('page'),'smm_id':$(this).data('panel'),'service_id':$('#_serviceid').val(),'page':'api','olay':'service','adet':$('#islemadet').val()};
                bayisec(servisdata);
                return;
            });
        });
        $('#alert-noti-delete').click(function(){
            if($('#alert-count').html()=="0")
                return $('.okunmadiclass').removeClass('okunmadiclass');
            action('bildirim');
            $('#alert-count').html('0');
            var alertinfo = true;
        });
        function smmbayi_(element){
            var servisdata = {'type':$(element).data('page'),'smm_id':$(element).data('panel'),'service_id':$('#_serviceid').val(),'page':'api','olay':'service','adet':$('#islemadet').val()};
            bayisec(servisdata);
            return;
        }
        $('.left-panel ul li .gecis').click(function(){
            $('.content').addClass('gecistir');
        });
        function bayisec(data) {
            $('.content').addClass('gecistir');
            $.ajax({
                type: 'POST',
                url: window.location.href,
                data: data,
                success: function(response) {
                    $('.content').removeClass('gecistir');
                    $('#bayisecimi').html(response);
                }
            });
        }
        function fastpost(form, htm = "") {
            $('.content').addClass('gecistir');
            if(htm != "") {
                $('#'+htm).attr('style','display:none;');
            }
            $.ajax({
                type: 'POST',
                url: window.location.href,
                data: $('#'+form).serialize(),
                success: function(response) {
                    $('.content').removeClass('gecistir');
                    if(htm != "") {
                        $('#'+htm).html(response);
                        $('#'+htm).attr('style','');
                    }
                    
                }
            });
        }
        function action(item){
            $('#a-name').attr('name',item);
            fastpost('action','ajaxout');
        }
        function nsoft(data){
            $('.content').addClass('gecistir');
            $('#ajaxout').attr('style','display:none;');
            $.ajax({
                type: 'POST',
                url: window.location.href,
                data: data,
                success: function(response) {
                    $('.content').removeClass('gecistir');
                        $('#ajaxout').html(response);
                        $('#ajaxout').attr('style','');
                }
            });
        };
        function upload(form,page) {
            $('.'+form).hide();
            $('.'+form+'-load').show();
            var file_data = $('#'+form).prop('files')[0];   
            var form_data = new FormData();                  
            form_data.append('file', file_data);
            form_data.append('olay', form);
            form_data.append('page', page);                           
            $.ajax({
                url: window.location.href, 
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(response){
                    if (form=="editor-add") {
                        editor_data = CKEDITOR.instances.editor.getData();
                        CKEDITOR.instances['editor'].setData(editor_data+''+response);
                    } if(page=="ortam") {
                        $('#path_img_list').html(response);
                    } else {
                        $('.'+form).html(response);
                    }
                    $('.'+form).show();
                    $('.'+form+'-load').hide();
                    $('#'+form).val("");
                }
            });
        };
    $(document).ready(function(){
        $("#settingClose").click(function(){
            alert(this.html())
        });
    });
    function iconsec(icon){
        $("#icon2").val(icon);
        $("#icon").attr("class", icon);
    };

    $(".g-filt").click(function(){
        $(".gain-filter ul").slideToggle(100);
    });