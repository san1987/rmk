<?

if ($chpu){	$uri=$_SERVER["REQUEST_URI"];
	$uri=explode("?", $uri);
	$uri= $uri[0];
	$uri=explode("/", $uri);
	if ($uri[0]=="") array_shift($uri);
	if ($uri[0]=="rmk") array_shift($uri);

	if ($uri[count($uri)-1]=="") array_pop($uri);
	//print_r($uri);


	//Ќазвание страницы?

	$r=mq("SELECT * FROM pages WHERE name='".mres($uri[0])."'  ");
    $row=fetch($r);
    if ($row){    	$p="page";
    	$n=$uri[0];
    	if ($row["name"]=="about"){    		if ($uri[1]=="news") {$p="news"; $id=intval($uri[2]);}
    		if ($uri[1]=="articles") {$p="articles"; $id=intval($uri[2]);}    	}    }else{
    	 if ($uri[0]=="sale") {    	 	$is_spec=1;
    	 	$p="catalog";
    	 	array_shift($uri);    	 }
    	 if ($uri[0]=="search") {
    	 	$p="catalog";
    	 	array_shift($uri);
    	 }
         $r=mq("SELECT * FROM  manufs WHERE chpu='".mres($uri[0])."'   ");
		 $row=fetch($r);
		 if ($row){
		 	 $p="catalog";
		 	 $filter=$row["id"];   //сразу производитель после слеша
		 }else{		 	   $r=mq("SELECT  * FROM cats WHERE chpu='".mres($uri[0])."' AND parent_id=0  ");
			   $row=fetch($r);
			   if ($row){
			   	    $p="catalog";
			   	    $id=$row["id"];   //сразу родительска€ категори€ после слеша


			   	    if($uri[1]){

			   	    	$r=mq("SELECT * FROM  manufs WHERE chpu='".mres($uri[1])."'  ");
						$row=fetch($r);
						if ($row){
							 $filter=$row["id"];  //после род категории идЄт бренд


						}else{							$r=mq("SELECT * FROM cats WHERE chpu='".mres($uri[1])."'  AND parent_id=$id");
							$row=fetch($r);
							if ($row)
								 $id=$row["id"];    //после род категории идЄт дочерн€€ категори€
							else if (preg_match("|page-(\\d+)|", $uri[1] , $matches)){
								$page= $matches[1];
							}else
								$e404=true;						}

						if($uri[2]){
								$r=mq("SELECT   * FROM cats WHERE chpu='".mres($uri[2])."'  AND parent_id=$id ");
								$row=fetch($r);
								if ($row)
										 $id=$row["id"];       //после дочерней категории или  бренда идЄт еще подкатегори€
								else  {									$r=mq("SELECT * FROM goods WHERE chpu='".mres($uri[2])."'  AND manuf_id=".intval($filter)." ");
									$row=fetch($r);
									if ($row) {
										$p="good";
										$filter=0;										$id=$row["id"];  //после  бренда идЄт товар									}else if (preg_match("|page-(\\d+)|", $uri[2] , $matches)){
										$page= $matches[1];
									}								}
						}

						if($uri[3]) {							if (preg_match("|page-(\\d+)|", $uri[3] , $matches)){								$page= $matches[1];							}						}
                   }


			   }		 }    }


}


if (!$chpu && false){    switch($p){    	case "page":
    		$r=mq("SELECT * FROM pages WHERE chpu='".mres($n)."'");
    		$row=fetch($r);
    		$e301=url("page", $row, true);
    		break;

    	case "good":
    		$r=mq("SELECT * FROM goods WHERE id=".mres($id));
    		$row=fetch($r);
    		$e301=url("good", $row, true);
    		break;

    	case "catalog":
    		$r=mq("SELECT * FROM cats WHERE id=".mres($id));
    		$row=fetch($r);
    		$e301=url("catalog", $row, true);
    		break;

    }
}