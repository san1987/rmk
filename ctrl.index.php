<?

include "ctrl.left_menu_catalog.php";

include "ctrl.slider.php";
include "ctrl.recom.php";
include "ctrl.new_pos.php";
include "ctrl.manufs.php";
include "ctrl.recently.php";

$r=mq("SELECT * FROM banners LIMIT 1");
$banner=fetch($r);
if ($banner)
	$banner["img"]="files/banner/".$banner["id"].".jpg";


if (gp("main_text")){
	$r=mq("SELECT * FROM pages WHERE name='main_text'");
	$row=fetch($r);
	$main_text=$row;
}


if (gp("main_news")){


		$sql="SELECT small_text, title, id, DATE_FORMAT(cr, '%d %M %Y') AS cr FROM  news  ORDER BY cr DESC ,id  DESC LIMIT 3";
		$r=mq($sql);
		while ($row=fetch($r)) {
			$row["img"]	="files/news/".$row["id"].".jpg";
			$row["href"]	=url("news", $row);
			$news[]=$row;
		}


		$sql="SELECT * FROM  articles  ORDER BY cr DESC,id  DESC LIMIT 2";
		$r=mq($sql);
		while ($row=fetch($r)) {

			$row["img"]	="files/articles/".$row["id"].".jpg";
			$row["href"]	=url("articles", $row);

			$articles[]=$row;
		}
}