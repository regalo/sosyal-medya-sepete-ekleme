<!DOCTYPE html>
<html lang="<?php echo mb_substr($space->lang,0,2);?>">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo $space->title;?></title>
		<meta content="<?php echo $space->title;?>" name="title">
		<meta content="<?php echo $space->description;?>" name="description">
		<meta property="og:title" content="<?php echo $space->title;?>">
		<meta property="og:locale" content="<?php echo $space->lang;?>" />
		<meta property="og:type" content="website" />
		<meta property="og:description" content="<?php echo $space->description;?>">
		<meta property="og:url" content="<?php echo $space->urlRequest;?>" />
		<link rel="canonical" href="<?php echo $space->urlRequest;?>" />
		<meta property="og:image" content="<?php echo empty($space->image) ? $space->logo:$space->image;?>">
		<meta property="og:image:secure_url" content="<?php echo empty($space->image) ? $space->logo:$space->image;?>" />
		<link href="<?php echo $space->favicon;?>" rel="icon">
		<link href="<?php echo $space->favicon;?>" rel="apple-touch-icon">
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo $space->favicon;?>">
		<meta content="<?php echo $space->keyword;?>" name="keywords">
		<meta name="robots" content="<?php echo $space->robots;?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo $space->path();?>assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $space->path();?>assets/style.min.css?v=1.2">
		<link rel="stylesheet" type="text/css" href="<?php echo $space->path();?>assets/spacenivu.css?v=<?php echo ns_filter('spaceHeader',"item4");?>"  async="async">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<?php echo ns_filter("header");?>
	</head>
	<body>
		<?php if(isset($space->set["preloader"]) AND $space->set["preloader"]=="1") { ?>
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
	    <?php } ?>
		<header>
			<div class="header-area">
				<div class="container">
					<nav class="navbar head-nav navbar-expand-lg">
						<div class="logo">
							<a href="<?php echo $space->baseUrl;?>">
								<img src="<?php echo $space->logo;?>" alt="<?php echo $space->sitename;?>" width="120" height="55">
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
								<li class="drop-down pointer">
									<a class="dropdown-element noclick" href="#"><?php echo $head;?> <i class="fas fa-angle-down"></i></a>
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
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</header>
	<main class="main-area">