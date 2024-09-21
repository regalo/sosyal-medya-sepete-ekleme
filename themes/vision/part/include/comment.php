<?php if($comment!=false){ ?>
<div class="CommentArea">
	<?php if(count($commentList)>0){ ?>
	<div class="title-heading icon">
		<h2><?php _e("yorumlar");?></h2>
		<div class="icon">
			<i class="fas fa-comment"></i>
		</div>
	</div>
	<div class="commentList">
		<?php foreach ($commentList as $value) { ?>
			<div class="comment">
				<div class="comHead">
					<div class="costumer"><?php echo $value["name"];?></div>
					<span><?php echo $value["publishDate"];?></span>
				</div>
				<div class="comContent">
					<p><?php echo $value["comment"];?></p>
				</div>
			</div>
		<?php } ?>
	</div>
	<?php if($comment["viewCount"]<=count($commentList)){ ?>
		<div class="MoreComment">
			<div class="smcommentBTN" data-startCount="<?php echo ($commentStart+$comment["viewCount"]);?>">
				<span><?php _e("daha-fazla-goster");?></span> <i class="fas fa-arrow-down"></i>
			</div>
		</div>
	<?php }?>
    <?php } ?>
	<div class="title-heading icon mt-5">
		<h2><?php _e("yorum-yap");?></h2>
		<div class="icon">
			<i class="fas fa-comment-medical"></i>
		</div>
	</div>
	<div class="addComment">
		<form class="loftForm" id="commentForm">
			<input type="hidden" name="loftAction" value="commentCreate">
			<div class="row g-3">
				<div class="col-md-6">
					<input type="text" minlength="4" class="ns-control mb-1" required="" name="data[xasSAa4zkxmm]" placeholder="<?php _e("adiniz-soyadiniz");?>">
				</div>
				<div class="col-md-6">
					<input type="email" class="ns-control mb-1" name="data[xasSAa4zkxmmADSX]" placeholder="<?php _e("e-posta-istege-bagli");?>">
				</div>
				<div class="col-md-12">
					<textarea class="ns-control" minlength="20" required="" name="data[xasSAa4FGzkxmmADSX]" placeholder="<?php _e("yorumunuzu-yazinir");?>"></textarea>
				</div>
				<?php if(isset($commentRecaptcha) AND $commentRecaptcha!=false) { ?>
					<div class="recaptcha">
						<div class="g-recaptcha" data-sitekey="<?php echo $commentRecaptcha;?>"></div>
					</div>
					<div id="captcha"></div>
					<script src="https://www.google.com/recaptcha/api.js" async defer></script>
				<?php } ?>
				<div class="col-md-12">
					<button type="submit" class="btn comSend anibut"><?php _e("gonder");?> <span><i class="fas fa-paper-plane"></i></span></button>
				</div>
			</div>
		</form>
	</div>
</div>
<?php } ?>