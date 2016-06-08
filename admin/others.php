Идёт поиск по артикулу. Ищем дубликаты<br><?

$sql="SELECT g.id, g.art, g.name, g.cat, c1.id AS c1id, c2.id AS c2id, c3.id AS c3id, c4.id AS c4id FROM goods g
	LEFT JOIN cats c1 ON c1.id=g.cat
	LEFT JOIN cats c2 ON c2.id=c1.parent
	LEFT JOIN cats c3 ON c3.id=c2.parent
	LEFT JOIN cats c4 ON c4.id=c3.parent
	ORDER BY g.id ";
		    $r1=mq($sql);
$goods		    =array();
if($r1!==false)
while ($row =  mysql_fetch_assoc($r1)){
	$level=0;
	if ($row["c4id"]==0) $level=4;
	if ($row["c3id"]==0) $level=3;
	if ($row["c2id"]==0) $level=2;
	if ($row["c1id"]==0) $level=1;

	$art=$row["art"];
	$id=$row["id"];

	$goods[$art][$id] = array("level"=>$level, "row"=>$row);
}
?><pre><?

$todel=array();



foreach ($goods as $art=>$t){	$max = -1;
	foreach ($goods[$art] as $id=>$item) if ($max==-1 || $item["level"]>$max) $max = $item["level"];

	echo "$art $max<br>";
    //ПРоводим проверку всех кто уровнем меньще макса
	foreach ($goods[$art] as $id=>$item){
		$level = $item["level"];		if ($level<$max) {			echo "Уровень для проверяемого $id меньше макса.<br>";
			//Находим кому он является дублем, проверяем все остальные
			$parent=0;
			$x1=0;$x2=0;$x3=0;$x4=0;
			foreach ($goods[$art] as $id1=>$item1) if ($id1<>$id) if ( ($x1=$item1["row"]["c1id"]===$item["row"]["cat"]) ||
																				($x2=$item1["row"]["c2id"]===$item["row"]["cat"]) ||
																				($x3=$item1["row"]["c3id"]===$item["row"]["cat"]) ||
																				($x4=$item1["row"]["c4id"]===$item["row"]["cat"])){																					echo "Товар [$x1, $x2, $x3, $x4] ";
																					print_r($item);
																					echo " \n является дубликатом товара \n ";
																					print_r($item1);
																					echo "\n\n<hr>";
																					$p++;

																					$todel[]=$id;

																					if ($makedel) delete_good($id);
																					break;
			}
		}	}
}


echo "\n\n ".count($todel)." к удалению из ".count($goods);


?></pre><a href=.?m=<?=$m?>&p=others&makedel=1>Удалить!</a>