    var popup_back_screen = null;
    var popup_current_screen = null;
    var popup_platforms = null;
    var popup_services = null;
    var popup = null;
    var theButton = null;
    var popup_packages = null;
    var platforms = null;
    var services = null;
    var packages = null;
    var popup_platforms_row = null;

    function setPopup(){
        
        popup = document.querySelector("#popup_window");
        theButton = document.querySelector(".umut.nav__item");
        popup_platforms = $("#popup_platforms")[0];
        popup_platforms_row = $("#popup_platforms_row")[0];
        popup_services = $("#popup_services")[0];
        popup_packages = document.querySelector("#popup_packages");

        theButton.onclick = openPopup;
        
        getPlatforms();
        
        const popup_close_button = document.querySelector("#popup_close_button");
        popup_close_button.onclick = ()=>{
            $('body').css("overflow", "scroll");
            $(popup).slideUp(50);
        };
        
        const popup_back_button = document.querySelector("#popup_back_button");
        popup_back_button.onclick = ()=>{
            
            if(popup_current_screen == popup_packages){
                showPopupView(popup_services);
            }
            else if(popup_current_screen == popup_services){
                showPopupView(popup_platforms);
            }
        };
    }

    function openPopup(){
        if(popup_current_screen  ==  null || popup_current_screen  ==  popup_platforms)
            $(popup_back_button).hide();
        if(popup.style.display  ==  "none" || popup.style.display  ==  ""){
            $('body').css("overflow", "hidden");
            $(popup).slideDown(50);
        }else{
            $('body').css("overflow", "unset");
            $(popup).slideUp(50);
        }
    }

    function getPlatforms() {
        getDataWithAJAX((response)=>{
            platforms = JSON.parse(response.responseText);
            if(platforms){
                let platform_html = '';;
                for (let platform of platforms) {

                    let pt_id = platform.pt_id.trim();
                    let pt_name = platform.pt_name.trim();
                    let pt_icon = platform.pt_icon.trim();
                    platform_html += '<div onclick="goToServices(' + pt_id + ',\''+ pt_icon +'\')" id="popup_platformlar" class="col-3 item"><a class="popup_card ' + pt_name +'" onclick="return false;" href="#" title="#"><div class="card-avatar"><i style="font-size: 35px;" class="' + pt_icon +'" aria-hidden="true"></i></div><div class="h6">' + pt_name +'</div><p>Hizmetleri</p></a></div>';
                   
                }
                
                popup_platforms_row.innerHTML = platform_html;
            }
            else{
                console.log("There is an problem:" + platforms)
            }
        },"/popup_api.php?what=platforms","GET",false);    
    }

    function goToServices(platform_id,pt_icon) {
        getDataWithAJAX((response)=>{
            services = JSON.parse(response.responseText);
            if(services){
                let service_html = '<div class="row"><div class="subtitle">Lütfen almak istediğiniz hizmeti seçin.</div><ul class="list-group popup_list">';
                for (let index = 0; index < services.length; index++) {
                    let service = services[index];
                    etiket_ikonu_html = service.hz_etiket_ikonu != null && service.hz_etiket_ikonu != undefined ? '<i class="ms-1 p-0 '+ service.hz_etiket_ikonu +'"></i>': '';
                    hizmet_etiket_bilgisi = service.etiket_ismi != null || service.etiket_ismi!=undefined ? 
                                            ('<label style="white-space: nowrap;background-color:#'+ service.hz_etiket_rengi + ';" class="ms-2 hizmet_etiketi">'+
                                                service.etiket_ismi +
                                                etiket_ikonu_html+
                                            '</label>') : '';
                    service_html += 
                        '<li onclick="goToPackages(' + service.hz_id + ',\''+pt_icon+'\')" class="list-group-item">'+
                            '<strong>'+
                                '<i style="line-height: 30.5px;padding-top: 0px !important;" class="me-1 ' + service.hz_icon + '"></i>'+
                                '<a onclick="return false;" style="line-height: 30.5px;">' + service.hz_adi + '</a>'+
                                hizmet_etiket_bilgisi+ 
                            '</strong>'+
                            '<a onclick="return false;">'+
                                '<i class="fa-long-arrow-right"></i>'+
                            '</a>'+
                        '</li>';
                }
                service_html += '</ul></div>';
                popup_services.innerHTML = service_html;
                showPopupView(popup_services);
            }
            else{
                console.log("There is an problem:" + services)
            }
        },"/popup_api.php?what=services&id=" + platform_id,"GET",false);    

    }

    function goToPackages(service_id,pt_icon) {
        getDataWithAJAX((response)=>{
            packages = JSON.parse(response.responseText);
            if(packages){
                let package_html = '<div class="row"><div class="subtitle">Lütfen almak istediğiniz paketi seçin.</div><ul class="list-group popup_list">';
                for (let index = 0; index < packages.length; index++) {
                    let the_package = packages[index];
                    let fake_price_html = null;
                    let price_html = '';
                    if(parseInt(the_package.pk_durum) == 1){
                        if((the_package.pk_fake_indirim_orani != null) && the_package.pk_fake_indirim_orani != undefined) {
                            if(the_package.pk_fake_indirim_orani.trim().length > 0) {
                                price = parseFloat(the_package.pk_fiyat);
                                if(price>0){
                                    pk_fake_indirim_orani = parseFloat(the_package.pk_fake_indirim_orani.trim());
                                    if(pk_fake_indirim_orani>0){
                                        fake_price =  (price * 100) / (100 - pk_fake_indirim_orani);
                                        fake_price = fake_price.toFixed(2); 
                                        fake_price_html = '<del class="me-1" style="font-size: .6rem;line-height: 1.5;vertical-align: middle;">'+ fake_price + '₺</del>';
                                    }
                                }
                            }
                        }
                        price_html = '<a class="popup_packages_url" href="/siparis-olustur/' + the_package.pk_pri  + '/">' + the_package.pk_adi + '</a>'+
                        '</strong>'+'<label class="popup_price">' +
                        (fake_price_html!=null?fake_price_html:"") + the_package.pk_fiyat +'₺'+
                    '</label>'+
                    '<a  href="/siparis-olustur/' + the_package.pk_pri  + '/">'+
                        '<i class="fa-long-arrow-right"></i>'+
                    '</a>';
                    }
                    else{
                        price_html = '<a class="popup_packages_url" href="#" onclick="return false;">' + the_package.pk_adi + '</a>'+
                        '</strong>'+'<label class="popup_price" style="background-color:#707070 !important;">Satışa Kapalı</label>';
                    }
                    package_html += 
                                    '<li class="list-group-item">'+
                                        '<strong>'+
                                            '<i class="' + pt_icon + '" aria-hidden="true"></i>'+
                                        price_html+
                                    '</li>';
                }
                package_html += '</ul></div>';
                popup_packages.innerHTML = package_html;
                showPopupView(popup_packages);
            }
            else{
                console.log("There is an problem:" + packages)
            }
        },"/popup_api.php?what=details&id=" + service_id,"GET",false);    
    }
    function showPopupView(show_view) {
        let popup_title = popup.querySelector(".h5.text-center");
        if(show_view == popup_services){
            popup_title.innerText = "Hizmet Seçiniz";
            $(popup_packages).hide();
            $(popup_platforms).hide();
        }
        else if(show_view == popup_packages){
            popup_title.innerText = "Paket Seçiniz";
            $(popup_services).hide();
            $(popup_platforms).hide();
        }
        else{
            popup_title.innerText = "Platform Seçiniz";
            $(popup_services).hide();
            $(popup_packages).hide();
        }
        $(show_view).show(50);
        popup_current_screen = show_view;

        if(show_view  ==  popup_platforms)
            $(popup_back_button).hide();
        else
            $(popup_back_button).show();
    }

    function getDataWithAJAX(callbackFunc,posturl,method,isasync) {
            
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange= function () {
            if(xhr.readyState == 4 && xhr.status == 200){
                if(xhr.responseText="" || xhr.responseText==null || xhr.responseText==false){
                    console.log(xhr.responseText);
                    return false;
                }
                else{
                    callbackFunc(this);
                }
            }
        };
        xhr.open(method,posturl,true);
        xhr.send();
    }
    setPopup();
