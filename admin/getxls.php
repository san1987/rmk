<?

$all="";
$sql="SELECT SQL_CALC_FOUND_ROWS g.*, p.price, p.price_zakup , c.count , cats.title AS cat_title FROM goods g
		LEFT   JOIN price p ON p.art=g.art
		LEFT   JOIN count c ON c.art=g.art
		LEFT JOIN cats  ON cats.id=g.cat

		ORDER BY g.cat ASC";

		$r=mq("SELECT * FROM  `filter_params` ORDER BY vieworder ");
		while ($row=fetch($r)) $params[$row["id"]]=$row;


		$all='"артикул";"название";"цена продажи";"цена закупки";"наличие";"описание";"картинка";"URL на сайте";';
		foreach($params as $p) $all.='"'.$p["title"].'";';
		$all.='"Сопутствующие товары:";"Категория";"название категории"'."\n";


		$current_format=$all;

		$all='';


		echo "<br><br><br>Текущий формат файла <br><b>$current_format</b><br><br><br><br>";

		$r=mq("SELECT * FROM `filter_param_values` ");
		while ($row=fetch($r)) $param_values[$row["param_id"]][$row["id"]]=$row["title"]; //

        $r=mq("SELECT * FROM  `filter_good2param` ");
		while ($row=fetch($r)) $g2p[$row["good_id"]][]=$row["value_id"];

		$r=mq("SELECT * FROM  `tying` ");
		while ($row=fetch($r)) $tying[$row["art"]][]=$row["art_sop"];



	$r=mq($sql);
	$k=0;



	while ($row=mysql_fetch_assoc($r)) if ($row["art"]){


		$k++;
		//$all.='"'.$row["art"].'";'.'"'.$row["name"].'";'.'"'.$row["price"].'";'.'"'.$row["count"].'";"'.$row["price_zakup"].'";'.";\n";

		$fn="/pic/huge/".$row["id"]."_0.jpg";
		$row["img"]=file_exists("..".$fn)?"http://".$_SERVER["SERVER_NAME"].$fn:"";
		$row["url"]="http://".$_SERVER["SERVER_NAME"]."/catalog/".$row["chpu_name"]."/";



		//артикул-название-цена продажи-цена закупки-наличие-описание-производитель-страна-Тип шины-Тип лампы-Цвет шины-Макс. мощность, Вт-Цоколь-Сопутствующие товары:-Категория-название категории
		$all.='"'.$row["art"].'";'.'"'.$row["name"].'";'.'"'.$row["price"].'";"'.$row["price_zakup"].'";'
				.'"'.$row["count"].'";"'.str_replace("\"", "'", $row["desc"]).'";"'.$row["img"].'";"'.$row["url"].'";';

				foreach($params as $p) {					 $all.='"';
					 $values=array();
					 if($g2p[$row["id"]])						 foreach ($g2p[$row["id"]] as $value_id)
						 	if ($param_values[$p["id"]][$value_id])
						 		$values[]=$param_values[$p["id"]][$value_id];
					 $all.=implode(";", $values).'";';
				}

				$sop=$tying[$row["art"]]?implode(";", $tying[$row["art"]]):"";
                $all.='"'.$sop.'";"'.$row["cat"].'";"'.$row["cat_title"].'"'."\n";

	}


file_put_contents($fn="tmp/goods.csv", $all);
?>     <?=$k?> наименований<br>
<a href='<?=$fn?>'>ссылка на CSV файл со списком продукции</a>