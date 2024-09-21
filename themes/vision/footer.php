<?php 
if($footer["areaStatu"]=="aktif")
	include_once "part/include/home/supportArea.php";
?>
</main>


<style>
        
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');
    @media screen and (max-width: 575px){
        #popup_window {
            display: none;
            bottom: 55px;
        }
    }
    @media (max-width: 992px){
        #popup_window {
            display: none;
            position: fixed;
            width: 100%;
            height: 70vh;
            bottom: 56px;
            background: #fff;
            border-radius: 30px 30px 0 0;
            z-index: 2;
        }
    }
    #popup_window{
        display: none;
    }
    .popup_content{
        overflow-x: hidden;
        overflow-y: auto;
        padding: 15px 5px 80px 5px;
        height: 70vh;
    }
    .popup_title{
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #e9e7ee;
        padding: 7px 20px;
    }
    .popup_title_text{
        margin: 0;
        color: #3e6acd;
        font-weight: 600;
        font-size: 16px;
        padding: 0 10px;
    }
    #popup_window a{
        cursor: pointer;
        font-size: 12px;
        font-weight: bold;
    }
    .popup_packages_url{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    #popup_packages .fab{
        color:blue;
        margin-right:15px;
        font-size: 13pt;
        padding-top: 0px;
    }
    #popup_window .row{
        margin: 0px;
        padding: 0px;
    }
    .popup_icons{
        color: #3e6acd;
        margin-right: 15px;
    }
    .popup_price{
        float:right;
        color: #fff;
        padding: 5px 10px;
        border-radius: 4px;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        -ms-border-radius: 4px;
        -o-border-radius: 4px;
        background-color: #1aa7b3;
        display: inline-block;
    }
    .popup_list{
        margin-top:10px;
        padding:0.5rem 0.7rem;
    }
    .popup_list li{
        padding:0.5rem 0.7rem;
        --font-family-sans-serif: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans","Liberation Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
        --font-family-monospace: SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;
        --swiper-theme-color: #007aff;
        --swiper-navigation-size: 44px;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        font-family: Gilroy,sans-serif;
        font-size: 13px;
        box-sizing: border-box;
        margin: 0;
        position: relative;
        padding: .75rem 1.25rem;
        background-color: #fff;
        border: 1px solid rgba(0,0,0,.125);
        border-top-left-radius: inherit;
        border-top-right-radius: inherit;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .popup_list li strong{
        display:flex;
        justify-content: space-between;
        line-height: 1.5;
        color: #212529;
        font-family: Gilroy,sans-serif;
        font-size: 13px;
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-weight: bolder;
    }
    .popup_list li strong i{
        padding-top: 4px;
    }
    .popup_list .fa-long-arrow-right{
        font-style: normal;
        font-family: 'Font Awesome 6 Free';
        color: #1aa7b3;
    }
    #popup_back_button{
        font-weight: bold;
        font-family: 'Font Awesome 6 Free';
        font-style: normal;
        font-size: 20px;
    }
    #popup_close_button{
        font-size: 23px;
        color: #3a2424;
        font-family: 'FontAwesome';
        -webkit-font-smoothing: antialiased;
        font-style: normal;
        font-weight: lighter;
    }
    #popup_platforms{
        --font-family-sans-serif: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans","Liberation Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
        --font-family-monospace: SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;
        --swiper-theme-color: #007aff;
        --swiper-navigation-size: 44px;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        text-align: left;
        font-family: Gilroy,sans-serif;
        font-size: 13px;
        box-sizing: border-box;
        padding: 0;
        display: flex;
        flex-wrap: wrap;
        margin: 0;
    }
    #popup_platforms .col-3{
        flex: 0 0 25%;
        max-width: 25%;
    }
    #popup_platforms .col-3.item{
        --font-family-sans-serif: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans","Liberation Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
        --font-family-monospace: SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;
        --swiper-theme-color: #007aff;
        --swiper-navigation-size: 44px;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        font-family: Gilroy,sans-serif;
        font-size: 13px;
        box-sizing: border-box;
        position: relative;
        width: 100%;
        flex: 0 0 25%;
        max-width: 25%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        margin: 0;
        padding: 3px;
    }
    #popup_platforms .popup_card {
        display:block;
        font-weight: 400;
        line-height: 1.5;
        font-family: Gilroy,sans-serif;
        font-size: 13px;
        text-align: center;
        box-sizing: border-box;
        margin: 0;
        text-decoration: none;
        width: 100%;
        padding: 10px 5px;
        color: #fff;
        border-radius: 10px;
    }
    #popup_platforms .popup_card .card-avatar{
        --font-family-sans-serif: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans","Liberation Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
        --font-family-monospace: SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;
        --swiper-theme-color: #007aff;
        --swiper-navigation-size: 44px;
        font-weight: 400;
        line-height: 1.5;
        font-family: Gilroy,sans-serif;
        font-size: 13px;
        text-align: center;
        color: #fff;
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }
    #popup_platforms .popup_card .h6{
        font-size: .718rem;
        margin-bottom: 0px;
        margin-top: 4px;
    }
    #popup_platforms .popup_card p{
        margin:0px !important;
        padding:0px !important;
        font-size: .7rem;
    }
    .popup_content .Tiktok{
    	background: black;
    }
    .popup_content .Instagram{
    	background:linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
    }
    .popup_content .Facebook{
    	background: #3b5998;
    }
    .popup_content .Twitter{
    	background: #1DA1F2;
    }
    .popup_content .Kwai{
    	background:linear-gradient(45deg, #ff8800 0%, #ff8605 25%, #ff9c33 50%, #ff9c33 75%, #ff9c33 100%);
    }
    .Trovo{
        background:linear-gradient(45deg, #19d66b 0%, #19d66b 25%, #000000 50%, #000000 75%, #19d66b 100%)
    }
    .popup_content .Youtube{
    	background: #FF0000;
    }
    .popup_content .Twitch{
    	background: #6441a5;
    }
    .popup_content .Spotify{
    	background: #1DB954;
    }
    .popup_content .Clubhouse{
    	background: #ccbd00;
    }
    .popup_content .Telegram{
    	background: #007bff;
    }
    .popup_content .SoundCloud{
    	background: #ff8800;
    }
    .popup_content .Whatsapp{
    	background: #1DB954;
    }
    .popup_content .Discord{
    	background: #5865F2;
    }
    .popup_content .Tumblr{
    	background: #35465C;
    }
    .popup_content .Periscope{
    	background: #3FA4C4;
    }
    .popup_content .Vimeo{
    	background: #3da9e5;
    }
    .popup_content .Linkedin{
    	background: #0A66C2;
    }
    .popup_content .Tiktak{
    	background: black;
    }
    .popup_content .fa-tiktok{
        color: white;
    }
    .popup_content .fa-facebook{
        color: white;
    }
    .popup_content .fa-video-camera{
        color: white;
    }
    .popup_content .fa-instagram{
        color: white;
    }
    .popup_content .fa-twitter{
        color: white;
    }
    .popup_content .fa-youtube{
        color: white;
    }
    .popup_content .fa-twitch{
        color: white;
    }
    .popup_content .fa-spotify{
        color: white;
    }
    .popup_content .fa-telegram{
        color: white;
    }
    .popup_content .fa-square-whatsapp{
        color: white;
    }
    .popup_content .fa-discord{
        color: white;
    }
    .popup_content .fa-tumblr{
        color: white;
    }
    .popup_content .fa-music{
        color: white;
    }
    .popup_content .fa-globe{
        color: white;
    }
</style>
<div id="popup_window"> 
        
    <div class="col-12 popup_title"> 
        <div><i id="popup_back_button" class="fa-thin fa-arrow-left"></i></div>
        <div class="heading"><div class="h5 text-center popup_title_text">Select Platform</div></div>
        <div><i id="popup_close_button" class="fa-thin fa-xmark" aria-hidden="true"></i></div>
    </div>
    <div class="popup_content">
        <div id="popup_platforms"><div class="sc-heading style-2"><div id="popup_platforms_row" class="row"></div></div></div>
        <div id="popup_services"></div> 
        <div id="popup_packages"></div>
    </div>
</div>

<footer>
	<div class="footer">
		<div class="container">
			<div class="foot-flex">
				<div class="start logo">
					<img class="light lazy" src="<?php echo $loaderPng;?>" data-src="<?php echo $logo;?>" alt="<?php echo $sitename;?>" title="<?php echo $sitename;?>" width="150" height="50">
					<img class="dark lazy" src="<?php echo $loaderPng;?>" data-src="<?php echo $costimize["modLogo"];?>" alt="<?php echo $sitename;?>" title="<?php echo $sitename;?>" width="150" height="50">
					<p><?php echo $footer["copyright"];?></p>
					<div class="social-action">
						<?php if(isset($footer["instagram"]) AND !empty($footer["instagram"])) { ?>
							<a href="<?php echo $footer["instagram"];?>" target="_blank">
								<i class="fab fa-instagram"></i>
							</a>
						<?php } ?>
						<?php if(isset($footer["youtube"]) AND !empty($footer["youtube"])) { ?>
							<a href="<?php echo $footer["youtube"];?>" target="_blank">
								<i class="fab fa-youtube"></i>
							</a>
						<?php } ?>
						<?php if(isset($footer["twitter"]) AND !empty($footer["twitter"])) { ?>
							<a href="<?php echo $footer["twitter"];?>" target="_blank">
								<i class="fab fa-twitter"></i>
							</a>
						<?php } ?>
						<?php if(isset($footer["facebook"]) AND !empty($footer["facebook"])) { ?>
							<a href="<?php echo $footer["facebook"];?>" target="_blank">
								<i class="fab fa-facebook"></i>
							</a>
						<?php } ?>
					</div>
				</div>
				<div class="fdef">
					<div class="title">
						<?php _e("hizli-menu");?>
					</div>
					<ul>
						<?php foreach ($footerMenu["elements"] as $value) { ?>
							<li>
								<a href="<?php echo $value["href"];?>"><?php echo $value["title"];?></a>
							</li>
						<?php } ?>
					</ul>
				</div>
				<div class="fdef">
					<div class="title">
						<?php _e("iletisim-bilgileri");?>
					</div>
					<ul>
						<li>
							<i class="fas fa-envelope"></i> <?php echo $contactInfo["mail"];?>
						</li>
						<li>
							<i class="fas fa-phone"></i> <?php echo $contactInfo["phone"];?>
						</li>
						<li>
							<i class="fas fa-map"></i> <?php echo $contactInfo["adres"];?>
						</li>
					</ul>
				</div>
			</div>
			<?php if($footer["footImgStatu"]=="aktif"){ ?>
				<div class="footImg">
					<img src="<?php echo $footer["footImg"];?>" alt="<?php _e("odeme-yontemleri");?>" title="<?php _e("odeme-yontemleri");?>" width="50" height="200">
				</div>
			<?php } ?>
		</div>
	</div>
</footer>
<div class="alert alert-success alert-dismissible alert-message d-none" style="z-index:9999;" role="alert">
	<button type="button" class="btn-close" onclick='$(".alert-message").fadeOut("slow");'></button>
	<strong id="alertHead"></strong>
	<p class="mb-0" id="alertText"></p>
</div>
<?php if($costimize["buttons"]["statu"]!="pasif") { ?>
	<div class="fixActions show"><script type="text/javascript">if(cookieOku("buttonRight")=="kapali") $(".fixActions").attr("class","fixActions");	else $(".fixActions").attr("class","fixActions show");</script>
		<div class="items">
			<?php if($costimize["favoriStatu"]=="aktif") { ?>
				<div class="hrefGo item fav" data-href="<?php echo $favoriGo;?>">
					<div class="icon">
						<i class="<?php echo $costimize["favoriIcon"];?>"></i>
					</div>
					<span><?php echo $costimize["favoriTitle"];?></span>
				</div>
			<?php } ?>
			<?php if($costimize["buttons"]["orderSearch"]["statu"]=="aktif") { ?>
				<div class="item order orsebtns">
					<div class="icon">
						<i class="fas fa-search"></i>
					</div>
					<span><?php _e("siparis-sorgula");?></span>
				</div>
			<?php } ?>
			<?php if($costimize["buttons"]["whatsapp"]["statu"]=="aktif") { ?>
				<div class="hrefGo item wp" data-href="<?php echo $whatsappGo;?>" data-blank="true">
					<div class="icon">
						<i class="fab fa-whatsapp"></i>
					</div>
					<span><?php _e("Whatsapp");?></span>
				</div>
			<?php } ?>
			<?php if($costimize["buttons"]["phone"]["statu"]=="aktif") { ?>
				<div class="hrefGo item tel" data-href="<?php echo $phoneGo;?>" data-blank="true">
					<div class="icon">
						<i class="fas fa-phone"></i>
					</div>
					<span><?php echo $costimize["buttons"]["phone"]["number"];?></span>
				</div>
			<?php } ?>
		</div>
		<div class="close">
			<i class="fas fa-bars cshow"></i>
			<i class="fas fa-times chide"></i>
		</div>
	</div>
<?php } ?>
<?php include_once "part/include/search.loft.php";?>
<script src="<?php $loft->path("assets/js/popup.js?ver=1.1.0");?>"></script>
<script src="<?php $loft->path("assets/js/variable.js");?>"></script>
<script src="<?php $loft->path("assets/js/main.js");?>"></script>
<script type="text/javascript">
	var packJson = <?php echo json_encode($loft->packJson);?>;
</script>
<script src="<?php $loft->path("assets/bootstrap/js/bootstrap.bundle.js")?>" crossorigin="anonymous"></script>
<script src="<?php $loft->path("assets/bootstrap/js/bootstrap.min.js");?>" crossorigin="anonymous"></script>
<script src="<?php $loft->path("assets/js/splide.min.js");?>" crossorigin="anonymous"></script>
<script src="<?php $loft->path("assets/js/wow.js");?>" crossorigin="anonymous"></script>
   <script type="text/javascript">
 $( document ).ready(function() { if($(window).width() <= 575){ Tawk_API.onLoad = function(){ Tawk_API.hideWidget(); }; Tawk_API.hideWidget(); } }); 
    </script>
<?php echo $footer["code"];?>   
<script>
	new WOW().init();
</script>

<div id="demo"></div>
</body>
</html>