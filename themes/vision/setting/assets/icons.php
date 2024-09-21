<style>
	.icon-modal {
    position: absolute;
    right: 6px;
    top: 6px;
    z-index: 99;
}
#iconSec .modal-footer {
	justify-content: center;
}
#iconSec .form-control {
	border-radius: 0 !important;
}
.icon-list ul {
    display: flex;
    flex-wrap: wrap;
    margin: 10px 0px;
    max-height: 380px;
    overflow: auto;
    padding-right: 5px;
}
.icon-list ul::-webkit-scrollbar-track
{
  -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.1);
  border-radius: 10px;
  background-color: #F5F5F5;
}

.icon-list ul::-webkit-scrollbar
{
  width: 6px;
  background-color: #F5F5F5;
}

.icon-list ul::-webkit-scrollbar-thumb
{
  border-radius: 6px;
  -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.1);
  background-color: #b6b6b6;
}
.icon-list-item {
    width: calc(100%/4 - 4px);
    padding: 20px 2px;
    margin: 2px;
    border: 2px solid #3330;
    text-align: center;
    color: #555;
    background: #fcfbfb;
    cursor: pointer;
    transition: .2s;
    list-style: none;
}
.icon-list-item.selected {
	background: #ececec;
    border: 2px solid #bebebe;
}
.icon-list-item i {
    font-size: 30px;
}
.icon-list-item span {
    display: block;
    font-weight: 300;
    font-size: 13px;
    color: #888;
    position: relative;
    top: 3px;
    letter-spacing: 0.5px;
}
.icon-list-item.more-icon {
    width: 100%;
    padding: 5px;
    margin-top: 5px;
    background: #555;
    border-radius: 0 !important;
    cursor: inherit;
}
.icon-list-item.more-icon i {
    color: #fff;
    font-size: 16px;
}
.icon-list-item.more-icon a {
    color: #fff;
}
</style>
<div class="modal fade" id="iconSec" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="icon-list-area">
					<div class="icon-filter">
						<input type="text" id="iconfilter" class="form-control icon-search" placeholder="İkon Ara">
					</div>
					<div class="icon-list">
						<ul>
							<li class="icon-list-item">
								<i class="fab fa-instagram"></i>
								<span>Instagram</span>
							</li>
							<li class="icon-list-item">
								<i class="fab fa-instagram-square"></i>
								<span>Instagram</span>
							</li>
							<li class="icon-list-item">
								<i class="fab fa-youtube"></i>
								<span>Youtube</span>
							</li>
							<li class="icon-list-item">
								<i class="fab fa-facebook"></i>
								<span>Facebook</span>
							</li>
							<li class="icon-list-item">
								<i class="fab fa-facebook-square"></i>
								<span>Facebook 2</span>
							</li>
							<li class="icon-list-item">
								<i class="fab fa-facebook-f"></i>
								<span>Facebook 3</span>
							</li>
							<li class="icon-list-item">
								<i class="fab fa-twitter"></i>
								<span>Twitter</span>
							</li>
							<li class="icon-list-item">
								<i class="fab fa-twitter-square"></i>
								<span>Twitter 2</span>
							</li>
							<li class="icon-list-item">
								<i class="fab fa-tiktok"></i>
								<span>Tiktok</span>
							</li>
							<li class="icon-list-item">
								<i class="fab fa-twitch"></i>
								<span>Twitch</span>
							</li>
							<li class="icon-list-item">
								<i class="fab fa-tumblr"></i>
								<span>Tumblr</span>
							</li>
							<li class="icon-list-item">
								<i class="fab fa-tumblr-square"></i>
								<span>Tumblr 2</span>
							</li>
							<li class="icon-list-item">
								<i class="fab fa-snapchat"></i>
								<span>Snapchat</span>
							</li>
							<li class="icon-list-item">
								<i class="fab fa-linkedin"></i>
								<span>Linkedin</span>
							</li>
							<li class="icon-list-item">
								<i class="fab fa-spotify"></i>
								<span>Spotify</span>
							</li>
							<li class="icon-list-item">
								<i class="fab fa-telegram"></i>
								<span>Telegram</span>
							</li>
							<li class="icon-list-item">
								<i class="fab fa-facebook-messenger"></i>
								<span>Messenger</span>
							</li>
							<li class="icon-list-item">
								<i class="fab fa-discord"></i>
								<span>Discord</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-user"></i>
								<span>Kullanıcı</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-users"></i>
								<span>Kullanıcılar</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-heart"></i>
								<span>Kalp</span>
							</li>
							<li class="icon-list-item">
								<i class="far fa-heart"></i>
								<span>Kalp 2</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-thumbs-up"></i>
								<span>Beğeni</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-eye"></i>
								<span>Göz</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-comment"></i>
								<span>Yorum</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-comments"></i>
								<span>Yorumlar</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-bell"></i>
								<span>Zil</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-bolt"></i>
								<span>Yıldırım</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-bomb"></i>
								<span>Bomba</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-hashtag"></i>
								<span>Hashtag</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-bookmark"></i>
								<span>Bookmark</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-box-open"></i>
								<span>Kutu</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-bullhorn"></i>
								<span>Megafon</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-envelope"></i>
								<span>Posta</span>
							</li>
							<li class="icon-list-item">
								<i class="far fa-grin-alt"></i>
								<span>Gülücük</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-graduation-cap"></i>
								<span>Kep</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-meteor"></i>
								<span>Meteor</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-mouse-pointer"></i>
								<span>Mouse</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-question-circle"></i>
								<span>Soru İşareti</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-ticket-alt"></i>
								<span>Bilet</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-award"></i>
								<span>Rozet</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-ghost"></i>
								<span>Hayalet</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-globe"></i>
								<span>Dünya</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-headset"></i>
								<span>Destek</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-mouse"></i>
								<span>Mouse</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-paper-plane"></i>
								<span>Kağıt Uçak</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-paperclip"></i>
								<span>Ataş</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-puzzle-piece"></i>
								<span>Puzzle</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-shopping-bag"></i>
								<span>Çanta</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-signature"></i>
								<span>İmza</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-align-center"></i>
								<span>Yazı</span>
							</li>
							<li class="icon-list-item">
								<i class="far fa-calendar-alt"></i>
								<span>Takvim</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-sticky-note"></i>
								<span>Not</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-robot"></i>
								<span>Robot</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-rocket"></i>
								<span>Roket</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-key"></i>
								<span>Anahtar</span>
							</li>
							<li class="icon-list-item">
								<i class="fab fa-algolia"></i>
								<span>Kronometre</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-asterisk"></i>
								<span>Yıldız İşareti</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-at"></i>
								<span>At</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-burn"></i>
								<span>Ateş</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-fire"></i>
								<span>Ateş 2</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-camera"></i>
								<span>Kamera</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-check-circle"></i>
								<span>Onay</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-chart-area"></i>
								<span>Analiz</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-cog"></i>
								<span>Ayar</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-cogs"></i>
								<span>Ayarlar</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-crown"></i>
								<span>Taç</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-exclamation-triangle"></i>
								<span>Uyarı</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-flag"></i>
								<span>Bayrak</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-gem"></i>
								<span>Mücevher</span>
							</li>
							<li class="icon-list-item">
								<i class="fas fa-archive"></i>
								<span>Arşiv</span>
							</li>
							<li class="icon-list-item">
								<i class="fab fa-black-tie"></i>
								<span>Kravat</span>
							</li>
							<div class="icon-list-item more-icon">
								<a target="_blank" href="https://fontawesome.com/icons?d=gallery&m=free">
									<i class="fas fa-external-link-square-alt"></i> Daha Fazla
								</a>
							</div>
						</ul>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="butto butbor butto-danger" data-dismiss="modal">Kapat</button>
				<button type="button" class="butto butbor butto-primary icon-add" data-icon="" data-id="" data-dismiss="modal">Ekle</button>
			</div>
		</div>
	</div>
</div>
<script>
	$('.icon-search').keyup(function(){
		iconSearchItem = $(this).val().toLowerCase();
		$(".icon-list ul li").filter(function() {
	      $(this).toggle($(this).text().toLowerCase().indexOf(iconSearchItem) > -1)
	    });
	});
	$(".icon-list-item").click(function(){
	$(".icon-list-item").removeClass("selected");
	$(this).addClass("selected");
	var degeri = $(this).find("i").attr("class");
  $(".icon-add").attr("data-icon",degeri);
});
$(".icon-modal").click(function(){
  $(".icon-add").attr("data-icon",$(this).data("icon"));
  $(".icon-add").attr("data-id",$(this).data("add"));
  gecerli = this;
});
$(".icon-add").click(function(){
   $('#iconView_'+$(this).attr("data-id")).attr("class",$(this).attr("data-icon"));
   $('#iconInput_'+$(this).attr("data-id")).val($(this).attr("data-icon"));
   $(gecerli).attr("data-icon", $(this).attr("data-icon"));
   $('.icon-search').keyup("");
});
</script>