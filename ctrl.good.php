<?

include "ctrl.left_menu_catalog.php";
include "ctrl.recom.php";

$template="good";



		$id=intval($id);
		$_SESSION["last"][]=$id;
		if (count($_SESSION["last"])>3) array_shift($_SESSION["last"]);

		$r=mq("UPDATE goods SET view=view+1 WHERE id=$id");

        $r=mq("SELECT * FROM goods WHERE id=$id");
        $main=fetch($r);

        $photos=               get_photo($main, false, true);
        $page_img=$photos[0];


        $r=mq("SELECT * FROM manufs WHERE id=".$main["manuf_id"]);
	    $once_manuf=fetch($r);
        $bread[2]=array("href"=>url("manuf", $once_manuf), "title"=>$once_manuf["title"]);


        $r=mq("SELECT cat_id FROM good2cat WHERE good_id=".$id);
        $row=fetch($r);

	 	while(1)       {
	 		if (!$row["cat_id"]) break;
	        $r=mq("SELECT * FROM cats WHERE id=".$row["cat_id"]);
			$row=fetch($r);
			$bread[1]=array("href"=>url("catalog", $row), "title"=>$row["title"]);
			$row["cat_id"]=$row["parent_id"];
		}



		$bread[3]=array("href"=>url("good", $main), "title"=>$main["title"]);