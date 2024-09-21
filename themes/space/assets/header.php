<!DOCTYPE html>
<html lang="<?php echo $space->lang;?>">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $space->title;?></title>
		<meta content="<?php echo $space->title;?>" name="title">
		<meta content="<?php echo $space->description;?>" name="description">
		<meta property="og:title" content="<?php echo $space->title;?>">
		<meta property="og:description" content="<?php echo $space->description;?>">
		<meta property="og:image" content="<?php echo $space->image;?>">
		<link href="<?php echo $space->favicon;?>" rel="icon">
		<link href="<?php echo $space->favicon;?>" rel="apple-touch-icon">
		<meta content="<?php echo $space->keyword;?>" name="keywords">
		<meta property="og:url" content="<?php echo $space->urlRequest;?>">
		<meta name="robots" content="<?php echo $space->robots;?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo $space->path();?>assets/bootstrap/css/bootstrap.min.css" async="async">
		<style type="text/css">.preloader{position:fixed;display:flex;flex-direction:column;justify-content:center;align-items:center;left:0;right:0;top:0;bottom:0;background:#fff;z-index:9999;width:100%;height:100%}.pre-flex{display:flex;justify-content:center;align-items:center}.pre-item1{width:130px;height:130px;border:15px solid var(--color1);animation:2s infinite preturnright}.pre-item2{color:var(--color2);position:absolute;font-size:50px;font-weight:600;animation:2s infinite scaleboom}.preloader span{margin-top:35px;font-size:22px;color:var(--color1);letter-spacing:5px}</style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
		<?php echo ns_filter("header");?>
	</head>
	<body>
		<div class="preloader">
			<div class="pre-flex">
				<div class="pre-item1"></div>
				<div class="pre-item2">
					<i class="<?php
					if(empty(ns_filter('icon'))) {
						echo 'fas fa-dot-circle';
					} else {
						echo ns_filter('icon');
					}
					?>"></i>
				</div>
			</div>
			<style type="text/css"></style>
			<span><?php _e("Yükleniyor");?>.</span>
		</div>
		<header>
			<div class="header-area">
				<div class="container">
					<nav class="navbar head-nav navbar-expand-lg">
						<div class="logo">
							<a href="<?php echo $space->baseUrl;?>">
								<img src="<?php echo $space->logo;?>" alt="<?php echo $space->sitename;?>">
							</a>
						</div>
						<div class="menu-toggler">
							<div class="line-1"></div>
							<div class="line-2"></div>
							<div class="line-3"></div>
						</div>
						<div class="droplapse navbar-collapse" id="navbarsupport">
							<ul class="navbar-nav ml-auto">
								<?php foreach ($space->menuBuilder("header",$header["headerMenu"]) as $value) { extract($value); ?>
								<?php if(count($drop)) { ?>
								<li class="drop-down">
									<a class="dropdown-element" href="javascript:void(0)"><?php echo $head;?> <i class="fas fa-angle-down"></i></a>
									<div class="dropdown-sub">
										<div class="dropdown-items">
											<?php foreach ($drop as $val) { extract($val) ?>
											<a class="dropsub-item" href="<?php echo $href;?>"><?php echo $head;?></a>
											<?php } ?>
										</div>
									</div>
								</li>
								<?php } else { ?>
								<li><a href="<?php echo $href;?>"><?php echo $head;?></a></li>
								<?php } ?>
							</li>
							<?php } ?>
							<div class="nav-buts-flex">
								<?php if($contact = $space->buttons("menuContact")) { ?>
								<li class="nav-contact">
									<a href="<?php echo $contact["href"];?>"><i class="fas fa-envelope"></i> <?php echo $contact["text"];?></a>
								</li>
								<?php } ?>
								<?php if($menuSearch = $space->buttons("menuSearch")) { ?>
								<li class="order-search-btn">
									<a href="#"><i class="fas fa-search"></i> <?php echo $menuSearch["text"];?></a>
								</li>
								<?php } ?>
							</div>
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</header>
	<main class="main-area">