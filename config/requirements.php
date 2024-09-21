<?
$requc = "config/cache/requirements.html";
if(!file_exists($requc)) {
$short_open_tag = 1;
?>
<?php
if(phpversion()<="7.1") 
{
	$setup_error = "Bu yazılım yanlızca Php 7.1+ sürümlerinde çalışmaktadır. Php sürümünüzü yükseltin.";
}
else if (!EXTENSION_LOADED("IonCube Loader"))
{ 
    $setup_error = "Bu yazılım lisans ve güvenlik sebebiyle IonCube son sürüm şifreli dosyalar barındırır. Öncelikle IonCube son sürümü sunucunuza yükleyip aktifleştirin. Konu hakkında hosting firmanızdan destek alabilirsiniz.";
}
else if(empty(phpversion('zip')))
{
	$setup_error = "Bu yazılım kurulum ve güncelleme işlemleri için zip Archive kütüphanesini kullanır. Güncellemelerden sorunsuz şekilde yararlanmak için lütfen zip Archive kütüphanesini aktif ediniz.";
}
else if(!isset($short_open_tag))
{
    $setup_error = "Bu yazılım short_open_tag functionunu kullanır. Bozuk dosya ve görüntüyü engellemek için lütfen short_open_tag functionunu aktif ediniz.";
}
else if(empty(phpversion('mbstring')))
{
	$setup_error = "Bu yazılım mb_ functionunu kullanır. Tüm işlevlerin sorunsuz çalışabilmesi için lütfen mbstring functionunu aktif ediniz.";
}
if(isset($setup_error))
	{ ?>
	<!DOCTYPE html>
	<html>
		<head>
			<title>Gereksinimleri Karşılayın</title>
			<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
			<link rel="stylesheet" href="https://nivusoft.com/path_file/assets/style.css?v=3.5">
		</head>
		<body>
			<div class="ns-setup-alert">
				<h2>Bir Sorun Tespit Edildi!</h2>
				<p><?php echo $setup_error;?></p>
				<button type="button" onclick="location.reload();">Sayfayı Yenile</button>
			</div>
		</body>
	</html>
	<?php exit(); 
	}
	touch($requc);
	$ch = fopen($requc, 'w');
	fwrite($ch, ob_get_contents());
	fclose($ch);
}