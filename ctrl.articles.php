<?

include "ctrl.left_menu_page.php";

		$bread[1]=array("href"=>url("about", false), "title"=>"О компании");
		$bread[2]=array("href"=>url("articles", false), "title"=>"Статьи");


if($id){
		$id=intval($id);
		$sql="SELECT * FROM  articles  WHERE id=$id";
		$r=mq($sql);
		$main=fetch($r);
		$template="article_main";

		$bread[3]=array("href"=>url("articles", $main), "title"=>$main["title"]);



}else{

		$sql="SELECT * FROM  articles  ORDER BY cr,id  DESC LIMIT 2";
		$r=mq($sql);
		while ($row=fetch($r)) {


			$row["img"]	=$fn="files/articles/".$row["id"].".jpg";
			if (!file_exists($fn)) $row["img"]="";


			$row["href"]	=url("articles", $row);

			$articles[]=$row;
		}


 		$template="articles";
}