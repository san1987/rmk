<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="<?=$main["meta_descr"]?>" />
<base href="http://<?=$_SERVER["SERVER_NAME"]."/"?>">
<script src="jquery.js" type="text/javascript"></script>
<script src="js.js?t=<?=time()?>" type="text/javascript"></script>
<title><?=$page_title?></title>


<meta property="og:title" content="<?=$page_title?>" />
<meta property="og:type" content="website" />
<meta property="og:image" content="<?=$page_img?>" />
<meta property="og:url" content="<?="http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]?>" />
<meta property="og:description" content="<?=$main["meta_descr"]?>">
<meta property="og:site_name" content="Русская медицинская компания"/>



<link rel="stylesheet" href="style.css"/>


</head>
<body itemscope itemtype="http://schema.org/WebSite">


<?
include "tpl.req.php";
?>

<div id="wrap">

<div id="content">

	<div id=main>


<header class=head>
	<div class=elem>
		<a href='.'>
		<img src='imgs/logo-only.png'>
		</a>
	</div>

	<div class='elem slogan' >
	Экспертное диагностическое оборудование.<br>
	Для любого бюджета.
	</div>



	<div class='elem phone_logo'>
		<img src='imgs/telephone.png'>
	</div>

	<div class='elem phone_data'>
					<span style=' font-size: 19.757px;
					  line-height: 1.012;'>
						   +7 499 397-00-04
					</span>       <br>
					<span  >
						часы работы: 09<sup>00</sup> — 18<sup>00</sup>
					</span>

	</div>
</header>

	<div class=clear></div>



