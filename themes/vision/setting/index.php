<?php if(isset($post["olay"])) {
	include_once "action.php";
	exit;
}
?>

<link rel="stylesheet" type="text/css" href="<?php $loft->path("setting/assets/style.css");?>">
<div class="tab-alani to-tabz">
	<ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
		<li class="nav-item active">
			<a href="<?php echo $ayar->getpage('theme');?>" class="nav-link gri <?php echo !isset($get["include"]) ? 'active show':'';?>">
				<i class="fas fa-flag"></i> Başlarken
			</a>
		</li>
		<li class="nav-item">
			<a href="<?php echo $ayar->getpage('theme').'?include=genel';?>" class="nav-link gri
				<?php echo (isset($get["include"]) AND $get["include"]=="genel") ? 'active show':'';?>">
				<i class="fas fa-bolt"></i> Genel
			</a>
		</li>
		<li class="nav-item">
			<a href="<?php echo $ayar->getpage('theme').'?include=home';?>" class="nav-link gri
				<?php echo (isset($get["include"]) AND $get["include"]=="home") ? 'active show':'';?>">
				<i class="fas fa-home"></i> Anasayfa
			</a>
		</li>
		<li class="nav-item">
			<a href="<?php echo $ayar->getpage('theme').'?include=specialpage';?>" class="nav-link gri
				<?php echo (isset($get["include"]) AND $get["include"]=="specialpage") ? 'active show':'';?>">
				<i class="fas fa-magic"></i> Özel Sayfalar
			</a>
		</li>
		<li class="nav-item">
			<a href="<?php echo $ayar->getpage('theme').'?include=spacialpackets';?>" class="nav-link gri
				<?php echo (isset($get["include"]) AND $get["include"]=="spacialpackets") ? 'active show':'';?>">
				<i class="fab fa-sketch"></i> Özel Paketler
			</a>
		</li>
		<li class="nav-item">
			<a href="<?php echo $ayar->getpage('theme').'?include=sidebar';?>" class="nav-link gri
				<?php echo (isset($get["include"]) AND $get["include"]=="sidebar") ? 'active show':'';?>">
				<i class="far fa-list-alt"></i> Sidebar
			</a>
		</li>
		<li class="nav-item">
			<a href="<?php echo $ayar->getpage('theme').'?include=comment';?>" class="nav-link gri
				<?php echo (isset($get["include"]) AND $get["include"]=="comment") ? 'active show':'';?>">
				<i class="fas fa-comment"></i> Yorumlar
			</a>
		</li>
		<li class="nav-item">
			<a href="<?php echo $ayar->getpage('theme').'?include=config';?>" class="nav-link gri
				<?php echo (isset($get["include"]) AND $get["include"]=="config") ? 'active show':'';?>">
				<i class="fas fa-pencil-ruler"></i> Özelleştir
			</a>
		</li>
		<li class="nav-item">
			<a href="<?php echo $ayar->getpage('theme').'?include=ekkod';?>" class="nav-link gri
				<?php echo (isset($get["include"]) AND $get["include"]=="ekkod") ? 'active show':'';?>">
				<i class="fas fa-code"></i> Ek Kod
			</a>
		</li>
	</ul>
</div>
<?php
if(isset($get["include"])) {
	extract($loft->setting($get["include"]));
include_once __DIR__."/".$get["include"].".php";
} else {
include_once __DIR__."/dashboard.php";
}
if(file_exists("panel/assets/icons.php"))
	include_once "panel/assets/icons.php";
else
	include_once __DIR__."/assets/icons.php";
?>
<script src="<?php $loft->path("setting/assets/over.js");?>"></script>
