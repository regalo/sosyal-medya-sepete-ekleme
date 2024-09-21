if (!localStorage.getItem("LastOpen")) {
    localStorage.setItem("LastOpen", Math.floor(Date.now() / 1000));
    Poview = true;
} else {
	var NewOpen = Number(localStorage.getItem("LastOpen")) + viewSetTime;
	var Ponow = Math.floor(Date.now() / 1000);
	if (NewOpen < Ponow) {
		Poview = true;
		localStorage.setItem("LastOpen", Math.floor(Date.now() / 1000));
	}
}
if (Poview) {
setTimeout(function(){
	document.getElementById("duyurualert").classList.add("show");
	setTimeout(function(){
		document.getElementById('duyurualert').classList.remove('show');
	},CloseTime);
},OpenTime);
}
function dkapa(){
	document.getElementById('duyurualert').classList.remove('show');
}
$('.packzsatinal').click(function(){
	document.getElementById('duyurualert').classList.remove('show');
});
$('.duyuruclose i').click(function(){
	document.getElementById('duyurualert').classList.remove('show');
});