<?




$cats_local=array();  $left_menu=array();
$r=mq("SELECT * FROM cats");
while($row=fetch($r)){
	$cats_local[$row["parent_id"]][]=$row;
	$cats_local_array[$row["id"]]=$row;
}

if($p=="catalog") $cat_id=$id;
if (!$cats_local_array[$cat_id]["parent_id"])
	$cat0_id=$cat_id;
else{
	$cat1_id=$cat_id;
	$cat0_id=$cats_local_array[$cat_id]["parent_id"];
}

//echo "$cat0_id $cat1_id";

foreach($cats_local[0] as $item){
	$item["items"]=$cats_local[$item["id"]];

	$item["href"]=".?p=catalog&search=".mres($search)."&is_spec=$is_spec&filter=$filter&id=".$item["id"]."&chpu=".$item["chpu"]."";

	$base_url=($is_spec?"sale/":"").$item["chpu"]."/".($once_manuf?$once_manuf["chpu"]."/":"");
	$req_url= ($filter  && !$once_manuf?"?filter=$filter&":"");
	$req_url.= ($search?($req_url?"&":"?")."search=".mres($search):"");
	$item["href"]=$base_url.$req_url;




	$sel=$item["sel"]=$item["id"]==$cat0_id;
	if ($sel) $bread[2]=array("href"=>url("catalog", $item), "title"=>$item["left_title"]);

	//".?p=catalog&search=".mres($search)."&is_spec=$is_spec&filter=$filter&id=".$item["id"]."&chpu=".$item["chpu"]."";

    $info="";
	if ($is_spec || count($filter_sel)==1  || $search){  //если распродажа либо производитель конкретный - тогда посчитать сколько товаров в данной категории


		$r=mq("SELECT COUNT(DISTINCT g.id ) AS c FROM goods g
		            LEFT JOIN  good2cat g2c ON g2c.good_id=g.id
		            LEFT JOIN  cats c1 ON c1.id=g2c.cat_id
		            LEFT JOIN  cats c2 ON c2.id=c1.parent_id
		            LEFT JOIN  cats c3 ON c3.id=c2.parent_id

		            WHERE (c1.id=".$item["id"]."  OR c2.id=".$item["id"]." OR c3.id=".$item["id"].") ".($is_spec?"  AND g.is_spec=1":"").(count($filter_sel)==1?" AND g.manuf_id=".$filter_sel[0] :"").($search?" AND g.title LIKE '%".mres($search)."%'":"")."		            			");
		$info=fetch($r);

		$item["left_title"].= " (".$info["c"].")";


	}





	if($item["items"])
		foreach($item["items"] as $k=>$row){
			$item["items"][$k]["items"]=$cats_local[$row["id"]];



			$sel=$item["items"][$k]["sel"]=($item["items"][$k]["id"]==$cat1_id) ;
			if ($sel) $bread[4]=array("href"=>url("catalog", $item["items"][$k]), "title"=>$item["items"][$k]["left_title"]);
			//$item["items"][$k]["href"]=".?p=catalog&is_spec=$is_spec&filter=$filter&id=".$item["items"][$k]["id"]."&search=".urlencode($search)."&chpu=".$item["items"][$k]["chpu"]."";
            $item["items"][$k]["href"]= $base_url.$item["items"][$k]["chpu"]."/".$req_url;

			if ($item["items"][$k]["items"])
				foreach($item["items"][$k]["items"] as $di=>$d){
					$sel=$item["items"][$k]["items"][$di]["sel"]=($d["id"]==$cat2_id);
					if ($sel) $bread[5]=array("href"=>url("catalog", $d), "title"=>$d["left_title"]);
					$item["items"][$k]["items"][$di]["href"]=
						".?p=catalog&is_spec=$is_spec&filter=$filter&id=".$item["items"][$k]["items"][$di]["id"]."&search=".urlencode($search)."&chpu=".$item["items"][$k]["items"][$di]["chpu"]."";

				}
		}

	$left_menu[]=$item;

}