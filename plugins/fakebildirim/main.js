var element = document.getElementById("bildirim");
element.classList.remove("show");
if (Rondomkey)
   var rands = 0;
else 
   var rands = Math.floor(Math.random()*atOptions.length);
function BildirimStart() {
setTimeout(function(){
if (Rondomkey) {
	rands++;
	if (rands>atOptions.length) {
		rands = 0;
	}
} else {
	rands = Math.floor(Math.random()*atOptions.length);	
}
element.classList.add("show"); }, 100);

var FA_title = atOptions[rands][0];
var FA_text = atOptions[rands][1];
document.getElementById("FA_Title").innerHTML = FA_title;
document.getElementById("FA_text").innerHTML = FA_text;
setTimeout(function(){ element.classList.remove("show"); }, ShowTimer);

}
if (!IntervalTimer) {
	IntervalTimer = ShowTimer;
	setInterval(function(){
		IntervalTimer = Math.floor(Math.random()*(ShowTimer+ShowTimer))+(ShowTimer);	
	},4000);
}
setTimeout(function(){
	BildirimStart();
	setInterval(function(){ BildirimStart();}, IntervalTimer);
},startTimer);

