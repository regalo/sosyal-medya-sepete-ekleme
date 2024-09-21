<section id="intro" class="clearfix xrb <?php echo ns_filter('default-desen'); ?> ns-ortala">
        <div class="container alan1 fadeInUp">
            <div class="row">
                <div class="col-md-6 text-center text-white align-self-center mob-inth">
                    <h1><span class="font-wight-bold d-block"><?php echo ns_filter('default-slogan'); ?></span><?php echo ns_filter('default-slogan','item4');?></h1>
                    <div class="mogiz">
                        <p><?php echo ns_filter('default-slogan','item3');?></p>
                        <?php if(ns_filter('default-slogan','statu')) {?>
                        <div class="form-row">
                            <?php $slg = explode("=?=", ns_filter('default-slogan','item5'));
                            foreach ($slg as $slge) {
                            $slge = explode("?=?", $slge); ?>
                            <div class="col-md-4">
                                <div class="alan1madde xrc keskin" style="animation-delay: .<?php echo rand(1,5);?>s;">
                                    <i class="<?php echo $slge[1];?>"></i> <?php echo $slge[0];?>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-6 ortala">
                    <div class="head-servis row">
                        <?php default_headlist(array(
                        'platform'=>'<a href="%url" class="hser xrc keskin"><i class="%icon"></i><span><b>%name</b><br>'._e("Servisleri",true).'</span></a>',
                        'kategori'=>'<a href="%url" class="hser xrc keskin"><i class="%icon"></i><span><b>%name</b><br>'._e("Paketleri",true).'</span></a>')); ?>
                    </div>
                </div>
            </div>
        </div>
    <div class="container alan2 fadeInUp">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="text-white font-weight-bold"><? _e("Hızlı Sipariş");?></h2>
                <p class="text-white"><? _e("Hızlı sipariş sistemi ile ihtiyacınız olan pakete hızlıca erişin");?>.</p>
                <div class="hizlisip keskin">
                    <div class="form-row" id="hizli-al">
                        <? include_once 'include/hizlial.php';?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="<?php echo ns_filter('default-class');?>-head"></div>
</section>
<div class="hizser-<?php echo ns_filter('default-class');?>">
      <button id="fastopen" class="Ns_none alandugme xrc keskin" data-open="fastclose"><i class="fas fa-bolt"></i> <? _e("Hızlı Sipariş Formu");?></button>
      <button id="fastclose" class="Ns_none alandugme xrc keskin d-none" data-open="fastopen"><i class="fas fa-power-off"></i> <? _e("Hızlı Siparişi Kapat");?></button>
</div>

<main id="main">
    <section id="coksatan" class="mb50 mobmb20">
        <div class="container">
            <header class="section-header" style="margin-bottom: -10px; ">
                <h2 class="xrc"><?= ns_filter('default-coksatan','item3');?></h2>
                <p><?= ns_filter('default-coksatan','item4');?></p>
            </header>
            <div class="row">
                <div class="owl-carousel owl-theme mustu">
                    <?php default_product_list(array(
                    'foreach'=>'<div class="item"><div class="paket wow fadeInUp keskin" data-wow-delay="0.1s">%foreach</div></div>',
                    'icon'=>'<div class="paket-icon xrc"><i class="%icon"></i></div>',
                    'title'=>'<div class="paket-baslik"><b class="xrc">%title</b><br><span>%pk_adi</span></div>',
                    'features' => '<div class="paketozellik"><ul>%feature-li</ul></div>',
                    'feature-li' => '<li><i class="fas fa-chevron-right xrc"></i> %features</li>',
                    'price' => '<div class="paketfiyat xrc keskin">%price</div>',
                    'active-button' => '<a href="%link" class="btn paketsatinal xrb keskin">'._e("SATIN AL",true).'</a>',
                    'pasive-button' => '<button type="button" disabled="" class="btn paketsatinal xrb keskin">'._e("SATIŞA KAPALI",true).'</button>'
                    ),explode(",",ns_filter('default-coksatan')));?>
                </div>
            </div>
        </div>
    </section>
    <section id="services" class="xrb <?php echo ns_filter('default-desen');?>">
        <div class="<?php echo ns_filter('default-class');?>-ust"></div>
        <div class="ptb">
            <div class="container">
                <header class="section-header">
                    <h2 style="color: #fff;"><?php echo ns_filter('default-tercih');?></h2>
                    <p style="color: #fff;"><?php echo ns_filter('default-tercih','item3');?></p>
                </header>
                <div class="row">
                    <?php default_boxs(array(
                    'box_html'=>'<div class="col-md-6 wow bounceInUp" data-wow-duration="1.4s"><div class="box keskin">%content</div></div>',
                    'icon'=>'<div class="icon"><i class="%icon xrc"></i></div>',
                    'title'=>'<div class="sbox-right"><span class="title">%title</span>',
                    'description' =>'<p class="description">%description</p></div>',
                    'description-long' =>150)); ?>
                </div>
                <section id="testimonials" class="keskin">
                    <div class="container">
                        <div class="row justify-content-center" style="text-align: center;">
                            <div class="col-lg-8">
                                <div class="owl-carousel yorumalan wow fadeInUp">
                                    <?php default_comment_list(array(
                                    'box_html'=>'<div class="testimonial-item">%content</div>',
                                    'name'=>'<span class="tname">%name</span>',
                                    'job'=>'<span class="tjob">%job</span>',
                                    'message' =>'<p>"%message"</p>')); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    <div class="<?php echo ns_filter('default-class');?>-alt"></div>
    </section>
    <section id="blogyazi">
        <div class="container">
            <header class="section-header">
                <h2 class="xrc"><?= ns_filter('default-blog','item3');?></h2>
                <p style="padding-bottom: 10px"><?= ns_filter('default-blog','item4');?></p>
            </header>
            <div class="anablogyazi row">
            <? if (ns_filter('default-blog')<2) { ?>
                <div class="owl-carousel owl-theme mustu">
                <?php default_blog_main(array(
                'blog_html'=>'<div class="item"><div class="tek blog keskin">%image<div class="clear"></div><div class="blco">%content</div></div></div>',
                'image'=>'<a href="%url"><img class="lazy" style="height:150px; width:115% !important" src="" data-src="%img" alt="%title"></a>',
                 'title'=>'<a class="blcotitle xrc" href="%url" title="%title">%title</a>',
                'description' =>'<p>%description</p>',
                'button' => '<a href="%url" class="btn animebut xrb"><i class="fas fa-chevron-up"></i></a>',
                'from_record_num' => 0,
                'records_per_page' => 4,
                'description-long' => 100,
                'title-long' => 35));?>
                </div>
           <? } ?>
            </div>
        </div>
    </section>
    <?php ns_Content(array(
        "htmlHead"=>'<section id="makaleyazi" class="pb-5"><div class="container"><div class="row"><div class="col-md-12">',
        "htmlFoot"=>'</div></div></div></section>',
        "type"=>"default-blog"));?>       
</main>
