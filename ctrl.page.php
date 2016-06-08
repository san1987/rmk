<?

$template="page";



//$n=str_replace("?", "", $n);
$n=mres($n);
$r=mq("SELECT * FROM pages WHERE name='$n'");
$main=fetch($r);


$bread[]=array("href"=>url("page", $main), "title"=>$main["title"]);

include "ctrl.left_menu_page.php";