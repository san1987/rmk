<?

$r=mq("SELECT * FROM banners WHERE link='".mres($canonical)."'");
$banner=fetch($r);
if ($banner)
	$banner["img"]="files/banner/".$banner["id"].".jpg";
