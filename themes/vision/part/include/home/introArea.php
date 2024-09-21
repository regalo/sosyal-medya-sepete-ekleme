<style>
    /* popüler arkaplan resimleri */
    .Tiktok{
        background: black;
    }
    .Instagram{
        background:linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
    }
    .Facebook{
        background: #3b5998;
    }
    .Twitter{
        background: #1DA1F2;
    }
    .Whatsapp{
        background: #4dc247	;
    }
    .Gardrops{
        background:linear-gradient(45deg, #FA383E 0%, #FA383E 25%, #F35369 50%, #F35369 75%, #ff9c33 100%);
    }
    .Trovo{
        background:linear-gradient(45deg, #19d66b 0%, #19d66b 25%, #000000	 50%, #000000	 75%, #19d66b	 100%);    
    }
    .Kwai{
        background:linear-gradient(45deg, #ff8800 0%, #ff8605 25%, #ff9c33 50%, #ff9c33 75%, #ff9c33 100%);
    }
    .Likee{
        background:linear-gradient(45deg,#bf39fa 0%, #fe1d73 25%, #fe7849 50%, #febd09 75%, #febd09 100%);
    }
    .Kick{
        background:linear-gradient(45deg,#33FF33 0%, #00CC33 25%, #009933 50%,  #006633	75%, #003333 100%);
    }
    .Youtube{
        background: #FF0000;
    }
    .Threads{
        background: #000000;    
    }
    .Twitch{
        background: #6441a5;
    }
    .Spotify{
        background: #1DB954;
    }
    .Clubhouse{
        background: #ccbd00;
    }
    .Telegram{
        background: #007bff;
    }
    .SoundCloud{
        background: #ff8800;
    }
    .Discord{
        background: #5865F2;
    }
    .Tumblr{
        background: #35465C;
    }
    .Periscope{
        background: #3FA4C4;
    }
    .Vimeo{
        background: #3da9e5;
    }
    .Linkedin{
        background: #0A66C2;
    }
    .Tiktak{
       background:linear-gradient(45deg, #fff  0%, #fff 5%, #000000	 50%, #000000	 75%, #fff	 100%);
    }
    .Dolap{
        background: #20c997	;
    }
    
    .Pinterest{
        background: #a82400	;
    }
    /* populer iconlar */
    .fa-tiktok{
        color: white;
    }
    .fa-box-open{
        color: white;
    }
    .fa-tumblr-square{
        color: #19d66b;  
    }
    .fa-kickstarter-k{
        color: white; 
    }
    .fa-facebook{
        color: white;
    }
    .fa-video-camera{
        color: white;
    }
    .fa-instagram{
        color: white;
    }
    .fa-twitter{
        color: white;
    }
    .fa-youtube{
        color: white;
    }
    .fa-twitch{
        color: white;
    }
    .fa-square-whatsapp{
        color: white;
    }
    .fa-spotify{
        color: white;
    }
    .fa-telegram{
        color: white;
    }
    .fa-discord{
        color: white;
    }
    .fa-gratipay{
        color: white;
    }
    .fa-tumblr{
        color: white;
    }
    .fa-music{
        color: white;
    }
    .fa-globe{
        color: white;
    }
    .fa-android{
        color: white;
    }
    .fa-soundcloud{
        color: white;
    }
    .fa-at{
        color: white;    
    }
    .fa-periscope{
        color: white;
    }
    .fa-vimeo{
        color: white;
    }
    .fa-linkedin{
        color: white;
    }
    .fa-house-user{
        color: white;
    }
    .fa-pinterest{
        color: white;
    }
    div#desktop-area {
        width: 20%;
    }
    .sc-author {
        display:flex;
        gap: 10px;
        padding: 20px;
        padding-left: 0px;
        align-items: center;
        justify-content: space-between;
        position: relative;
        border: 2px solid rgba(99,69,237,.1);
        border-radius: 12px;
        text-align: center;
        overflow: hidden;
        -webkit-transition: all .3s ease;
        -moz-transition: all .3s ease;
        -ms-transition: all .3s ease;
        -o-transition: all .3s ease;
        transition: all .3s ease;
    }
    #mobile-area .sc-author {
        gap: 0px;
        padding: 20px 5px;
    }
    .infor{
        text-align: left;
    }
    strong.brand_label {
        display: inline-block;
        margin-bottom: 5px;
        font-size: 16px;
    }
    .sc-author .card-avatar{
        margin-bottom:5px;
    }
    .nosc-author {
        color: #000 !important;
        background-color: transparent !important;
        pointer-events: none;
    }
    #mobile-area{
        display:none;
    }
    @media only screen and (max-width:578px){
        #desktop-area{
            display:none;
        }
        #mobile-area{
            display:block;
        }
        .best-seller-inner{
            padding: 10px 15px;
        }
        a.popup_card.Dolap {
            background: #00e09e;
        }
    }
</style>
			
<section id="introHome">
	<div class="container">
	    <a name="siparisver"></a>
		<div class="homestep <?php echo $slide["class"];?>">
			<div class="area2">
				<div class="introHome">
					<img class="introBG lazy" src="<?php echo $introBack; ?>" data-src="<?php echo $introBack;?>" alt="<?php echo $slide["head"].' '.$slide["headLine"];?>" width="100%" height="100%">
					<div class="content">
						<h1><?php echo $slide["head"];?><span style="color: <?php echo $slide["introColor"];?>;"><?php echo $slide["headLine"];?></span></h1>
						<p><?php echo $slide["description"];?></p>
					</div>
				</div>
				<?php include_once "fastOrder.loft.php";?>
			</div>
		</div>
	</div>
    <section style="z-index: 2" id="populer" class="tf-best-seller">
        <div class="best-seller-inner">
            <div class="row">
                <div style="margin:0px auto;" class="col-md-11">
                    <div class="col-md-12">
                    <div class="sc-heading style-2 has-icon">
                        <div align="center">
                            <div class="inner">
                                <div class="group">
                                    <div class="icon d-none d-sm-block"><i class="ripple"></i></div>
                                    <h3><strong>Our Popular Services</strong></h3>
                                </div>
                                <p class="desc">We Listed Our Most Popular Services For You</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sc-heading style-2">
                    <div class="row">
                        <?php foreach ($slideList as $value) { ?>
                            <div id="desktop-area" style="padding-bottom: 10px"  class="col-lg-3 col-md-4 col-4">
                                <a href="<?php echo $value["url"];?>"> 
                                    <div class="sc-author <?php echo $value["name"]; ?>">
                                        <div class="infor">
                                            <h6>
                                                <font size='3'> <a href="<?php echo $value["url"];?>" style="font-size: 15px;color:white;"><strong class="brand_label"><?php echo $value["name"];?></strong><br>Services</a></font> 
                                            </h6>
                                        </div><br>
                                        <div class="card-avatar">
                                            <?php echo isset($value["ptIcon"]) ? '<span class="opacityIcon"><i class="'.$value["ptIcon"].'"></i></span>':'';?>
                                            <i  style="font-size: 30px;"  class="<?php echo $value["icon"];?>"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div id="mobile-area" style="padding:5px 13px 5px 15px;"  class="col-lg-6 col-md-6 col-6" >
                                <a href="<?php echo $value["url"];?>"> 
                                    <div class="sc-author <?php echo $value["name"]; ?>">
                                        <div class="infor">
                                            <h6>
                                                <font size='3'> <a href="<?php echo $value["url"];?>" style="font-size: 15px;color:white;"><strong class="brand_label"><?php echo $value["name"];?></strong><br>Services</a></font> 
                                            </h6>
                                        </div><br>
                                        <div class="card-avatar">
                                            <?php echo isset($value["ptIcon"]) ? '<span class="opacityIcon"><i class="'.$value["ptIcon"].'"></i></span>':'';?>
                                            <i  style="font-size: 25px;"  class="<?php echo $value["icon"];?>"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>

<script>
    $(".sc-author").slice(0, 33).show();
    $("#loadMore").on("click", function(e){
        e.preventDefault();
        $(".sc-author:hidden").slice(0, 33).slideDown();
        if($(".sc-author:hidden").length == 0) {
        $("#loadMore").text("Hepsi Bu Kadar").addClass("nosc-author");
        }
    });
</script>