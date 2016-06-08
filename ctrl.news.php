<?

include "ctrl.left_menu_page.php";

	    $bread[1]=array("href"=>url("about", false), "title"=>"О компании");
		$bread[2]=array("href"=>url("news", false), "title"=>"Новости");

if($id){
		$id=intval($id);
		$sql="SELECT * FROM  news  WHERE id=$id";
		$r=mq($sql);
		$main=fetch($r);
		$template="article_main";


		$bread[3]=array("href"=>url("news", $main), "title"=>$main["title"]);



}else{

		$sql="SELECT small_text, title, id, DATE_FORMAT(g.cr, '%d %M %Y') AS cr FROM  news g ORDER BY g.cr DESC,id  ";
		$r=mq($sql);
		while ($row=fetch($r)) {

			$row["img"]	=$fn="files/news/".$row["id"].".jpg";
			if (!file_exists($fn)) $row["img"]="";
			$row["href"]	=url("news", $row);

			$news[]=$row;
		}



 		$template="news";
}