<?php
@$nsVersiyon = '3.8';
@$nsAuthor = 'nivusoft';
@$nsSource = 'https://nivusoft.com/';

if(file_exists('config/requirements.php'))
	include_once 'config/requirements.php'; // Sunucu Gereksinimleri Kontrol
include_once 'config/function.php';