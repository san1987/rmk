<?



$left_menu=array();

$r=mq("SELECT * FROM pages WHERE in_left=1 ORDER BY `order`");
while($row=fetch($r)) {
	$row["left_title"]=$row["title"];
	$row["href"]=url("page", $row);
	$row["sel"]=($n==$row["name"]  && $p=="page") ;

	if ($row["name"]=="about"){		    $rrow=array();
			$rrow["left_title"]="Новости";
			$rrow["href"]=url("news");
			$rrow["sel"]=$p=="news";
			$row["items"][]=$rrow;

			$rrow=array();
			$rrow["left_title"]="Статьи";
			$rrow["href"]=url("articles");
			$rrow["sel"]=$p=="articles";
			$row["items"][]=$rrow;

			$row["sel"]=$row["sel"]   ||  ( $p=="news" || $p=="articles");	}

	$left_menu[]=$row;
}


