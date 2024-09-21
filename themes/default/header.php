<!DOCTYPE html>
<html lang="<?php echo mb_substr(ns_filter('language'),0,2);?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php DEFAULT_HEADER(array(
    'page_title'=>'<title>%item</title>\n<meta content="%item" name="title"><meta property="og:title" content="%item">',
    'description'=>'<meta property="og:description" content="%item"><meta content="%item" name="description">',
    'thumbimage'=>'<meta property="og:image" content="%item"><meta property="og:image:secure_url" content="%item" />',
    'favicon'=>'<link href="'.ns_filter('siteurl').'%item" rel="icon"><link href="'.ns_filter('siteurl').'%item" rel="apple-touch-icon">',
    'keywords' => '<meta content="%item" name="keywords">',
    'siteurl' => '<meta property="og:url" content="'.$urlRequest.'" /><link rel="canonical" href="'.$urlRequest.'" />',
    'noindex' => '<meta name="robots" content="noindex" />')); ?>
    <meta property="og:locale" content="<?php echo ns_filter('language');?>" />
    <meta property="og:type" content="website" />
    <link href="<? theme_path();?>assets/bootstrap/css/bootstrap.min.css?version=3.1" rel="stylesheet">
    <link href="<? theme_path();?>css/style.min.css?version=1.0" rel="stylesheet" asyc>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <?php echo ns_filter('header'); ?>
    <style type="text/css">
      <?php
      $renk = explode("-",   ns_filter('default-ozellestirme'));
      ?>
      .xrb, .mobile-nav, #progressbar li.active:before, #progressbar li.active:after, 
      #msform .action-button, .btn-order.bo-ileri {background-color: <?php echo $renk[0];?> !important;}
      .xrc, .mobile-nav.d-lg-none .drop-down ul li a {color: <?php echo $renk[1];?> !important;}
      .mobile-nav-toggle i{color: <?php echo $renk[1];?>}
      .xrbs {background-color: <?php echo $renk[4];?> !important;}
      #header {background: <?php echo $renk[2];?>;}
      .main-nav a,.mobile-nav-toggle i {color: <?php echo $renk[3];?>; }
      .main-nav .drop-down > a:after {
        border-color: transparent <?php echo $renk[3];?> <?php echo $renk[3];?> transparent;}
        .menubut {background: <?php echo $renk[3];?>}
        <?php echo ns_filter('default-ozellestirme','item3')=="keskin" ? '.keskin{border-radius: 0 !important}':""; ?>
      </style>
    </head>
    <body>
      <header id="header" class="fixed-top">
        <div class="container">
          <div class="logo float-left">
            <a href="<?php echo ns_filter('siteurl');?>"><img src="<?php default_tlogofavicon('sitelogo');?>" alt="" class="img-fluid"></a>
          </div>
          <nav class="main-nav float-right d-none d-lg-block">
            <ul>
              <?php menucreate(array(
                'primary' => '<li><a href="%item5">%item3</a></li>',
                'drop-down' => '<li class="drop-down"><a href="%item5">%item3</a><ul class="keskin">%dropdown</ul></li>',
                'contact' => '<li class="menubut1 keskin xrb"><a href="%item3"><i class="fas fa-envelope"></i> %item5</a></li>',
                'order-search' =>  '<li class="menubut2 keskin xrbs"><a href="#" data-toggle="modal" rel="noreferrer" data-target="#sorgu"><i class="fas fa-search"></i> '._e('Sipariş Sorgula',true).'</a></li>',
                'menu_select' => ns_filter('default-header-menu') 
              ));?>
            </ul>
          </nav>      
        </div>
      </header>