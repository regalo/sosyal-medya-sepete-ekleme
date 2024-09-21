<section id="intall">	
	<div class="container">
		<div class="intall reserve">
			<img class="introBG" src="<?php echo $introBack;?>" alt="">
			<div class="conts">
				<div class="icobox">
					<i class="<?php echo $icon;?>"></i>
				</div>
				<div class="detabox">
					<h1><?php echo $title_page;?></h1>
					<p><?php echo $description;?></p>
					<span class="countservices">
						<i class="<?php echo $icon;?> me-1"></i> <?php echo sprintf(_e("blog-yazisi-mevcut",true),$count);?>
					</span>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="blogList">
	<div class="container">
		<div class="blogList">
			<?php foreach ($list as $value) { ?>
			<div class="blog-item">
				<div class="thumb">
					<a href="<?php echo $value["url"];?>">
						<img src="<?php echo $value["thumb"];?>" alt="<?php echo $value["sayfa_baslik"];?>">
					</a>
					<div class="post-date">
						<?php echo $value["publishDate"];?>
					</div>
				</div>
				<div class="detail">
					<a href="<?php echo $value["url"];?>">
						<h3><?php echo $value["sayfa_baslik"];?></h3>
					</a>
					<p><?php echo $value["sayfa_aciklama"];?></p>
				</div>
			</div>
		    <?php } ?>
		</div>
		<div class="pagins">
			<ul class="pagination">
				<?php foreach ($pagenavi as $value) { ?>
					<li class="page-item <?php echo $value["active"] ? 'active':'';?>">
						<a class="page-link" title="<?php echo $value["title"];?>" href="<?php echo $value["href"];?>"><?php echo $value["key"];?></a>
					</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</section>