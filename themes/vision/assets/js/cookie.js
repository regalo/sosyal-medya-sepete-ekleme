function cookieOku(c_name) {
	var name = c_name + "=";
	var ca = document.cookie.split(';');
	for(var i = 0; i <ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length,c.length);
		}
	}
	return "";
}
function cookieGuncelle(c_name,value,exdays){ //cookie oluşturma 
	var exdate=new Date();
	exdate.setTime(exdate.getTime() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; path=/; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + c_value;
}
if(cookieOku("colorMode")==""){
	cookieGuncelle("colorMode",defaultMode,"9999999999");
	$('div[data-mode="'+defaultMode+'"]').remove();
}
actionDarkMode = false;
if(cookieOku("colorMode")=="sun" & $("body").hasClass("dark")){
	$("body").toggleClass("dark");
	actionDarkMode = true;
} else if(cookieOku("colorMode")=="moon" & !$("body").hasClass("dark")) {
	$("body").toggleClass("dark");
	actionDarkMode = true;
}


packListCount = [];
formCookieControl = false;
getFavoritePacket = false;