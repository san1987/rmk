<?


$filter_sel1=explode(",", $filter);
if (!$filter_sel1)$filter_sel1=array();
$reset_href=".?p=$p&is_spec=$is_spec&id=$id&filter_sel=";
$reset_href=$cat_url."?filter=&search=".mres($search)."";
$manuf_filter=array();
$r=mq("SELECT * FROM manufs ORDER BY `order`, title");
while($row=fetch($r)){
	 $row["sel"]=($ind=array_search($row["id"], $filter_sel1))!==false;
	 $data_filter=$filter_sel1;
	 if ($row["sel"]) unset($data_filter[$ind]); else $data_filter[]=$row["id"];
	 //$row["href"]=".?p=$p&search=".mres($search)."&is_spec=$is_spec&id=$id&filter=".implode(",", $data_filter)."";

	 $row["href"]=$cat_url."?filter=".implode(",", $data_filter)."&search=".mres($search)."";


     if (!is_array($manuf_filter_allowed) || array_search($row["id"], $manuf_filter_allowed)!==false)
	 	$manuf_filter[]=$row;
}

