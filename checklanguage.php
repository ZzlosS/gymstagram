<?php
//odredjuje koji jezik je izabran
if(isset($_GET['lang'])){
	$lang = $_GET['lang'];
	//registruje sesiju i postavlja cookie
	$_SESSION['lang'] = $lang;
	setcookie('lang',$lang, time() + (3600 * 24 * 30));
}
elseif (isset($_SESSION['lang'])){
	$lang = $_SESSION['lang'];
}
elseif (isset($_COOKIE['lang'])){
	$lang = $_COOKIE['lang'];
}
else{
	$lang = 'en';
}
switch ($lang){
	case 'en':
		$langfile = 'lang.en.php';
		break;
	case 'sr':
		$langfile = 'lang.sr.php';
		break;
	default:
		$langfile = 'lang.en.php';
}
include_once 'languages/'.$langfile;

?>