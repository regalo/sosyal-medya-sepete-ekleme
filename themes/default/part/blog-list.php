<section id="intros" class="clearfix xrb <?php echo ns_filter('default-desen'); ?> ns-ortala">
  <div class="container alans1 fadeInUp">
    <div class="text-center text-white">
      <div class="paketbaslik">
        <i class="<?php echo ns_filter('icon');?>"></i>
        <h1 class="font-weight-bold"><?php echo ns_filter('title');?></h1>
        <p><?php echo ns_filter('description');?> </p>
      </div>
    </div>
  </div>
<div class="<?php echo ns_filter('default-class');?>-head"></div>
</section>
<main id="main">
  <section id="bloglist" class="mb50 mobmb20" style="padding-top: 50px;">
    <div class="container">
      <div class="blogliste row" id="blogcek">
      	<?php
      	    $per_page = 12;
      	    $record_num = $page*$per_page-$per_page;
      	    default_blog_main(array(
            'blog_html'=>'<div class="col-md-3"><div class="tek blog keskin">%image<div class="clear"></div><div class="blco">%content</div></div></div>',
            'image'=>'<a href="%url"><img class="lazy" style="height:150px; width:115% !important" src="" data-src="%img" alt="%title"></a>',
            'title'=>'<a class="blcotitle xrc" href="%url" title="%title">%title</a>',
            'description' =>'<p>%description</p>',
            'button' => '<a href="%url" id="pk_refresh" class="btn animebut xrb"><i class="fas fa-chevron-up"></i></a>',
            'from_record_num' => $record_num,
            'records_per_page' => $per_page,
            'description-long' => 100,
            'title-long' => 35));
			$total_rows = $icerik->count("blog");
			$pageurl = $ayar->siteurl.'blog/';
      	    include_once "pagenavi.php";
            ?>
      </div>
    </div>
  </section>
   <?php ns_Content(array("type"=>""));?>  
</main>