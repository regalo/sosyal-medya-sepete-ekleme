<section id="intall" class="wow fadeInDown">	
	<div class="container">
		<div class="intall">
			<img class="introBG lazy" src="<?php echo $loaderPng;?>" data-src="<?php echo $introBack;?>" alt="">
			<div class="conts">
				<div class="icobox">
					<i class="<?php echo $icon;?>"></i>
				</div>
				<div class="detabox">
					<h1><?php echo $head;?></h1>
					<p><?php echo $description;?></p>
					<span class="countservices">
						<i class="fas fa-layer-group me-1"></i> <?php echo sprintf(_e("adet-hizmet-mevcut",true),$count);?>
					</span>
				</div>
			</div>
		</div>
	</div>
</section>
<style>
#mobile-areaa{
		display:none;
		text-align:center;
	}
	#desktop-areaa{
		display:block;
	}
@media only screen and (max-width:578px){

#desktop-areaa{
		display:none;
	}
	#mobile-areaa{
		display:block;
	}
}
</style>
</section>
                <div class="container">
                    <div class="row">
                    <?php  foreach ($list as $value) { ?>

                          <div id="desktop-areaa" class="col-6 item-container p-3">
        <div id="d"class="item" style="border-radius:11px;background-color:#fff; box-shadow:0 20px 30px 0 rgb(187 194 205 / 16%); padding:20px;">
          <div class="row">
            <div class="col-lg-2 icons d-flex align-items-center">
                <i class="iconum fa <?php echo $value["icon"];?>"
                style="font-size:3em;"><!-- populer iconlar-->
	<style>
	.fa-tiktok{
		color: black;
	}
	.fa-thumbs-up{
		color: red;
	}
	.fa-instagram{
		color: white;
	}
	.fa-gratipay{
		color: #b34eff;
	}
	.fa-paper-plane{
		color: blue;
	}
	.fa-users{
		color: #3e6acd;
	}
	.fa-play-circle{
		color: #552fa3;
	}
	.fa-heart{
		color: red;
	}
	.fa-chart-area{
		color: #0cd800;
	}
	.fa-recycle{
		color: #34d100;
	}
	.fa-share-square{
		color: #a6bf00;
	}
	.fa-video-camera{
		color: #00ebe1;
	}
	.fa-commenting{
		color: #f09e00;
	}
	.fa-share{
		color: #ff78cb;
	}
	.fa-bookmark{
		color: #008a68;
	}
	.fa-recycle{
		color: #34d100;
	}
	.fa-share-square{
		color: #a6bf00;
	}
	.fa-video-camera{
		color: #00ebe1;
	}
	.fa-commenting{
		color: #f09e00;
	}
	.fa-play-circle-o{
		color: #ff5a03;
	}
	.fa-eye{
		color: #656dff;
	}
	.fa-play{
		color: black;
	}
	.fa-thumbs-up{
		color: #2962ff;
	}
	.fa-retweet{
		color: #c6c700;
	}
	.fa-spotify{
		color: #81b71a;
	}
	.fa-icons{
		color: #ffac61;
	}
	.fa-user{
		color: #4c76ff;
	}
	.fa-chart-bar{
		color: #ffd630;
	}
	.fa-meteor{
		color: #ca0005;
	}
	.fa-flag{
		color: #ff1f2e;
	}
	.fa-heartbeat{
		color: #ff1f2e;
	}
	.fa-tv{
		color: #0c39df;
	}
	.fa-star-half-o{
		color: #b1a600;
	}
	.fa-star{
		color: #b1a600;
	}
	.fa-eye{
		color: #ffaf8c;
	}
	</style></i></div>
            <div class="col-lg-6 texts d-flex align-items-center">
              <h2  class="hizmet-name"
              style="font-size:20px !important;
              line-height:1.2;
              font-weight:500;
              "
              ><strong><?php echo $value["name"];?></strong></h2>
            </div>
            <div class="col-lg-4 prices d-flex align-items-center">
               	<a href="<?php echo $value["url"];?>"class="sc-button btn btn-sm btn-bordered-white style letter p-3"class="p-wall"class="service-box" style="background: url(images/bg.png), linear-gradient(to bottom, #ff9800 0%, #ff9800 100%);background-size: 200%;border-radius: 10px;">
<span style="color:white" size:"15px">View packages</span></a>
              </div>
          </div>
        </div>
      </div>
	  <div id="mobile-areaa" class="col-6 item-container p-3">
        <div id="d"class="item" style="border-radius:11px;background-color:#fff; box-shadow:0 20px 30px 0 rgb(187 194 205 / 16%); padding:20px;min-height:180px;">
          <div class="row">
            <div style="justify-content:center;padding-bottom:10px;" class="col-lg-2 icons d-flex align-items-center">
                <i class="iconum fa <?php echo $value["icon"];?>"
                style="font-size:2em;"><!-- populer iconlar-->
	<style>
	.fa-tiktok{
		color: black;
	}
	.fa-thumbs-up{
		color: red;
	}
	.fa-instagram{
		color: white;
	}
	.fa-gratipay{
		color: #b34eff;
	}
	.fa-paper-plane{
		color: white;
	}
	.fa-users{
		color: #3e6acd;
	}
	.fa-play-circle{
		color: #552fa3;
	}
	.fa-heart{
		color: red;
	}
	.fa-chart-area{
		color: #0cd800;
	}
	.fa-recycle{
		color: #34d100;
	}
	.fa-share-square{
		color: #a6bf00;
	}
	.fa-video-camera{
		color: #00ebe1;
	}
	.fa-commenting{
		color: #f09e00;
	}
	.fa-share{
		color: #ff78cb;
	}
	.fa-bookmark{
		color: #008a68;
	}
	.fa-recycle{
		color: #34d100;
	}
	.fa-share-square{
		color: #a6bf00;
	}
	.fa-video-camera{
		color: #00ebe1;
	}
	.fa-commenting{
		color: #f09e00;
	}
	.fa-play-circle-o{
		color: #ff5a03;
	}
	.fa-eye{
		color: #656dff;
	}
	.fa-play{
		color: black;
	}
	.fa-thumbs-up{
		color: #2962ff;
	}
	.fa-retweet{
		color: #c6c700;
	}
	.fa-spotify{
		color: #81b71a;
	}
	.fa-icons{
		color: #ffac61;
	}
	.fa-user{
		color: #4c76ff;
	}
	.fa-female{
		color: #0fff91;
	}
	.fa-tv{
		color: #0c39dff;
	}
	.fa-eye{
		color: #ffaf8c;
	}
	.fa-bolt{
		color: #f9df00;
	}
	.fa-telegram{
		color: blue;
	}
	</style></i></div>
            <div style="justify-content:center;padding-bottom:10px;" class="col-lg-6 texts d-flex align-items-center">
              <h2  class="hizmet-name"
             style="font-size:15px !important;
              line-height:1.2;
              font-weight:500;
              "
              ><strong><?php echo $value["name"];?></strong></h2>
            </div>
            <div style="justify-content:center;" class="col-lg-4 prices d-flex align-items-center">
               	<a href="<?php echo $value["url"];?>" class="sc-button btn btn-sm btn-bordered-white style letter p-2"class="p-wall"class="service-box" style="background: url(images/bg.png), linear-gradient(to bottom, #ff9800 0%, #ff9800 100%);background-size: 200%;border-radius: 10px;">
<span style="color:white" size:"15px">View packages</span></a>
              </div>
          </div>
        </div>
      </div>
       <?php } ?>
					<?php /* foreach ($list as $value) { ?>
					
                        <div class="col-lg-4 col-md-6 col-6">
                            <article class="sc-card-article">
                                
                                <div class="content text-center">
                                    <div style="margin-bottom: 30px" class="card-media">
                                    <center><a href="<?php echo $value["url"];?>"><i class="<?php echo $value["icon"];?> fa-8x"></i></a></center>
                                </div>
                                    <div class="text-article">
                                        <h5><a href="<?php echo $value["url"];?>"><?php echo $value["name"];?></a></h5>
                                    </div>
									<div class="meta-info d-none d-sm-block ">
                                       <?php echo $value["description"];?>
                                    </div>
							
									<a href="<?php echo $value["url"];?>" class="sc-button btn btn-sm pt-3 pb-3 btn-bordered-white style letter mt-5"><span>Paketleri 力ncele</span></a>
                                </div>
                            </article>
                        </div>
						 <?php } */?>
						 
						 
                    </div>
					
                </div>
            </div>
			