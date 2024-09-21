<!DOCTYPE html>
<html lang="<?php echo $lang;?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $title;?></title>
	<meta content="<?php echo $title;?>" name="title">
	<meta property="og:title" content="<?php echo $title;?>">
	<meta property="og:description" content="<?php echo $description;?>">
	<meta content="<?php echo $description;?>" name="description">
	<link href="<?php echo $favicon;?>" rel="icon">
	<link href="<?php echo $favicon;?>" rel="apple-touch-icon">
	<meta content="<?php echo $keyword;?>" name="keywords">
	<?php echo ns_filter("noindex") ? '<meta name="robots" content="noindex" />':'';?>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
	<!--<link href="<?php $loft->path("assets/css/popup.css?ver=2.3.99");?>" rel="stylesheet">-->
	<link href="<?php $loft->path("assets/css/variable.css");?>" rel="stylesheet">
	<link href="<?php $loft->path("assets/css/style.min.css");?>" rel="stylesheet">
	<link href="<?php $loft->path("assets/css/anisplide.min.css");?>" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/d3897fd5a7.js" crossorigin="anonymous"></script>
	<script type="text/javascript">var defaultMode = '<?php echo $costimize["modDefault"];?>';</script>
	<?php echo $header["code"];?>
	<style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');
        @media screen and (max-width: 767px) {
            .nav__menu {
                position: fixed;
                bottom: 0;
                left: 0;
                background-color: white;
                box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
                width: 100%;
                height: 3.5rem;
                display: grid;
                align-content: center;
                z-index:9999;
                transition: .4s;
            }
        }

        .nav__list, 
        .nav__link {
        display: flex;
        }

        .nav__link {
        flex-direction: column;
        align-items: center;
        row-gap: 4px;
        color: var(--title-color);
        font-weight: 600;
        }
        li{
        list-style:none;
        }
        .nav__list {
        justify-content: space-around;
        padding:10px 0px 10px 0px;
        }

        .nav__name {
        /* display: none;*/ /* Minimalist design, hidden labels */
        font-size:9px;
        text-transform:uppercase;
        font-family:'Roboto',sans-serif;
        }

        .nav__icon {
        font-size: 1.4rem;
        }

        /*Active link*/
        .active-link {
        position: relative;
        color: var(--first-color);
        transition: .3s;
        }

        /* Minimalist design, active link */
        /* .active-link::before{
        content: '';
        position: absolute;
        bottom: -.5rem;
        width: 4px;
        height: 4px;
        background-color: var(--first-color);
        border-radius: 50%;
        } */

        /* Change background header */
        .scroll-header {
        box-shadow: 0 1px 12px hsla(var(--hue), var(--sat), 15%, 0.15);
        }
	</style>
	

</head>
   <style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap');

  .blink {
    animation: blinker 4.0s linear infinite;
    color: #1c87c9;
    font-size: 10px;
    font-weight: bold;
    font-family: 'Poppins', sans-serif;
  }

  @keyframes blinker {
    50% { opacity: 0; }
  }
</style>
    </head>
  <body>
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-12GYYP96YP"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-12GYYP96YP');
</script>
  </head>
  <body>
<body class="<?php echo $costimize["modDefault"]=="moon" ? 'dark':'';?>">
    
	<script src="<?php $loft->path("assets/js/cookie.js");?>"></script>
	<header>
		<nav class="navbar nav-head <?php echo $costimize["header"]["background"];?>">
			<div class="<?php echo $costimize["header"]["weight"]=="boxed" ? 'container':'container-fluid';?>">
				<div class="nav-content">
					<a class="logo" href="<?php echo $siteurl;?>">
						<img class="light lazy" src="<?php echo $logo;?>" data-src="<?php echo $logo;?>" alt="<?php echo $sitename;?>" title="<?php echo $sitename;?>" width="150" height="50">
						<img class="dark lazy" src="<?php echo $logo;?>" data-src="<?php echo $costimize["modLogo"];?>" alt="<?php echo $sitename;?>" title="<?php echo $sitename;?>" width="150" height="50">
					</a>
					<div class="NavListArea">
						<ul class="NavList">
							<?php foreach ($headerMenu["elements"] as $value) { ?>
								<li class="navitem <?php echo isset($value["items"]) ? 'nav-drop':'';?>">
									<a class="navlink" href="<?php echo !isset($value["items"]) ? $value["href"]:'#';?>"><?php echo $value["title"];?></a>
									<?php if(isset($value["items"])){ ?>
										<ul class="drop-menu">
											<?php foreach ($value["items"] as $item) {
												echo '<li><a class="drop-navlink" href="'.$item["href"].'">'.$item["title"].'</a></li>';
											}
											?>
										</ul>
									<?php } ?>
								</li>
							<?php } ?>
						</ul>
						<div class="NavActions">
							<?php if($costimize["header"]["contactButton"]=="aktif") { ?>
								<div class="supportbtn">
									<a href="<?php echo $contactGo;?>" class="contact-btn anibut navlink" href="#">
										<i class="fas fa-paper-plane"></i> <?php _e("iletisim-button-text");?>
									</a>
								</div>
						    <?php } ?>
							<div class="otbuts">
								<?php if($costimize["modChange"]=="aktif") { ?>
									<div class="darkmode">
										<div class="darkswitch">
											<div class="darkswitchBG <?php echo $costimize["modDefault"]=="moon" ? 'active':'';?>"></div>
											<div class="sunmoon">
												<div class="item <?php echo $costimize["modDefault"]=="sun" ? 'active':'';?>" data-mode="sun">
													<i class="fas fa-sun"></i>
												</div>
												<div class="item <?php echo $costimize["modDefault"]=="moon" ? 'active':'';?>" data-mode="moon">
													<i class="fas fa-moon"></i>
												</div>
											</div>
										</div>
									</div>
									<script type="text/javascript">$('.darkswitch').click(function(){if($("body").hasClass("dark")) cookieGuncelle("colorMode","sun","9999999999");	else cookieGuncelle("colorMode","moon","9999999999");$(".darkswitchBG").toggleClass("active");$(".sunmoon .item").toggleClass("active");$("body").toggleClass("dark");});if(actionDarkMode){$(".darkswitchBG").toggleClass("active");$(".sunmoon .item").toggleClass("active");}
									</script>
								<?php } ?>
								<?php if($costimize["header"]["orderSearchIcon"]=="aktif") { ?>
									<div class="orderSearchNav orsebtns anibut">
										<i class="fas fa-search"></i>
									</div>
								<?php } ?>
								<?php if($costimize["favoriStatu"]=="aktif") { ?>
								<div class="mobileFavsbut">
									<a class="mobifavBTN anibut" href="<?php echo $favoriGo;?>"><i class="<?php echo $costimize["favoriIcon"];?>"></i></a>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
					<div class="navTogbtn">
						<span class="item1"></span>
						<span class="item2"></span>
						<span class="item3"></span>
						<span class="item4"></span>
					</div>
				</div>
			</div>
		</nav>
		<div id="site-menu">
					<div class="d-block d-sm-none nav__menu" id="nav-menu">
                    <ul class="nav__list">

                        <li class="nav__item">
                            <a style="padding-top: 2px;" href="https://socialmister.com" class="nav__link">
                               <i class="fa-solid fa-house-chimney nav__icon"></i>
                                <span class="nav__name">Homepage</span>
                            </a>
                        </li>
						<?php if($costimize["buttons"]["orderSearch"]["statu"]=="aktif") { ?>
                        <li class="order orsebtns nav__item">
                            <a style="padding-top: 2px;" class="nav__link">
                                <i class='fas fa-search nav__icon'></i>
                                <span class="nav__name">My order</span>
                            </a>
                        </li>
						<?php } ?>
						
                        <li class="umut nav__item">
                            
                            <a style="background-image: linear-gradient(130.35deg, #ff9800 17.35%, #ff9800 78.23%);padding-top: 10px;bottom: 35px;margin-top: 5px;background-color: #fff;color: white;border-radius: 10px;box-shadow:0 1px 10px 0 rgb(28 28 28	);" class="button cd-login nav__link active-link">
                             <i class="fa-solid fa-bars fa-shake"></i>
                                <span style="margin-bottom: 15px; margin-left: 10px; margin-right: 10px;" class="nav__name">Quick Menu</span>
                            </a>
                        </li>
						<?php if($costimize["buttons"]["whatsapp"]["statu"]=="aktif") { ?>
                        <li class="nav__item">
                            <a style="padding-top: 2px;" href="<?php echo $whatsappGo;?>" class="nav__link">
                                <i class='fab fa-whatsapp nav__icon'></i>
                                <span class="nav__name">Whatsapp</span>
                            </a>
                        </li>
						<?php } ?>
                        <li class="nav__item">
                            <a style="padding-top: 2px;" onclick="Tawk_API.toggle();" class="cd-signup nav__link">
                                <i class='fas fa-headset nav__icon'></i>
                                <span class="nav__name">Live Support</span>
                            </a>
                        </li>
                    </ul>
                </div>
							
							
                               
							</div>
	</header>
	<div class="path1">
		<svg xmlns="http://www.w3.org/2000/svg" width="1263.564" height="675.739" viewBox="0 0 1263.564 675.739">
			<path class="allpath" id="path1" d="M656.436,0l217.29,488.637s35.49,74.887,118.3,93.1S1920,675.59,1920,675.59V-.149Z" transform="translate(-656.436 0.149)"/>
		</svg>
	</div>
	<main>
        <script>
            var sacmalik_suresi = 0;
            var sacmalik = setInterval(() => {
                if( sacmalik_suresi++ < 4)
                    jQuery('section').css('visibility','visible');
                else
                    clearInterval(sacmalik);
            }, 1000);
        </script>