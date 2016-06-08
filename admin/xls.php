<h2>Загружайте файл формата CSV</h2>

<?

if ($_REQUEST["csv"]){
	$file="";
	$sql="SELECT g.*, c.`count` AS c, p.price AS p  FROM goods g LEFT JOIN `count` c ON c.art=g.art LEFT JOIN price p ON p.art=g.art ORDER BY g.id ";
	$r_main=mq($sql);
	while($row=mysql_fetch_assoc($r_main)) $file.=$row["art"].";".$row["name"].";".$row["c"].";".$row["p"]."\n";
	file_put_contents("file.csv", $file);
	echo "&raquo;&raquo;&raquo;&raquo; <a href=file.csv?rnd=".time().">скачать CSV файл</a>";


}


require_once "tags_func.php";

if ($fn=$_FILES["file_all"]["tmp_name"]){
	$f=file($fn);

	$r=mq("SELECT * FROM  `filter_params` ORDER BY vieworder ");
	while ($row=fetch($r)) $params[$row["id"]]=$row["title"];

	$data=array();
	$counter=0;
	$ok=true;
    $last_str_not_ok=false;
     echo "<h1>$fn</h1>";


	foreach ($f as $nn=> $s){
	     $k=0;

		 $count=0;
		 $ss=str_replace("\\\"", ' ', $s) ;
		 str_replace('"', ' ', $ss, $count) ;
		 $data[$counter].=$s;
		 if ($count%2==1) $ok=!$ok;
		 if ($ok) $counter++;

		 // break;
	}
	echo "<h3>Строк ".count($data)."</h3>";


	//print_r($data);

	foreach($data as $kk=>$s) {
		 $cc=0;
         $s=trim($s);
         $k=0;
	     while ($k<strlen($s)   && $cc++<100){
	     	if ($s{$k}=='"'){
	     		//echo "кавычки найден  в позиции $k<br>";
	     		$k=strpos($s, '"', $k+1);
	     		if ($k===false) {
	     			//echo "Ошибка парсинга строки $n файла! Не найдена закрывающая кавычка для открывающей!<br>$s<br>";
	     			$k=strlen($s);
	     		}
	     		$k+=2;
	     		//echo "предполагаме что точка с заяптйоо тут  $k `".$s{$k}."`<br>";
	     		continue;
	     	}
            //echo "кавычки НЕ найден  в позиции $k `".$s{$k}."`<br>";
	     	$s=substr($s,0,$k).'"'.substr($s,$k);
	     	$k=strpos($s, ';', $k);
	     	if ($k===false) $k=strlen($s);
	     	$s=substr($s,0,$k).'"'.substr($s,$k);
	     	$k+=2;
            //echo "продолжаем с  $k `".$s{$k}."`<br>";
	     }
         //echo "Было ".$data[$kk]."<br> стало $s<hr><br>";
		$data[$kk]=$s;
	}
	echo "<h3>Строк ".count($data)."</h3>";

   // print_r($data);
	foreach($data as $k=>$s) $data[$k]=explode('";"', substr(trim($s),1, -1));

    echo "<h3>Строк ".count($data)."</h3>";

		$all='"артикул";"название";"цена продажи";"цена закупки";"наличие";"описание";"картинка";"страна";';
		foreach($params as $p) $all.='"'.$p.'";';
		$all.='"Сопутствующие товары:";"Категория";"название категории"'."\n";


		$current_format=$all;
		$current_format=explode(';', $current_format);

		foreach($data as $nn=> $s){
			 echo "<h3>обработка строки $nn</h3>";
			 echo "<br>";
			 if (($c1=count($s))==($c2=count($current_format))){

			 	$art=mres($s[0]);

			 	echo "<hr>Артикул: <b>$art</b><br><br>";

			 	$r=mq("SELECT id FROM goods  WHERE `art`='$art' ");
			 	$row=fetch($r);

			 	if (!$row){
			 		 echo "Товара с данным артиклем не существует в базе, создаю его<br>";
			 		 mq("INSERT INTO goods (`art`, `date`) VALUES ('$art', NOW())");
			 		 $r=mq("SELECT id FROM goods  WHERE `art`='$art' ");
			 		 $row=fetch($r);
					 $need_regen_chpu=true;
			 	}

			 	if ($row) echo "ID товара ".$row["id"]."<br>"; else { echo "<h3>ошибка, товар с данным артикулом не был найден в базе данных и не был добавлен из-за ошибки</h3>"; continue;}
                          print_r($s);
                echo "Обновляю <br>";
                $catid= intval($s[8+count($params)+1]);
     			mq("UPDATE  `goods` SET name='".mres($s[1])."', `desc`='".mres($s[5])."',
     				cat=".$catid.",
     				country='".mres($s[7])."' WHERE id=".$row["id"]." ");
				//Обработка картинки
				$img_url=$s[6]=trim($s[6]);
				if($img_url){
					$f=file_get_contents($img_url);
					echo "скачана картинка $img_url размером ".strlen($f)."<br>";
					file_put_contents($tmp_pic="../pic/tmp.jpg", $f);
					addpic($tmp_pic, $row["id"], 0);
				}
        		//Сопутствующие
        		echo "===================Категория  $catid <br>==================== Обработка сопуствующих. Для `$art` удаляем все.<br>";
        		$tying=  trim($s[8+count($params)+0]);
        		$tying=  explode(";", $tying);
                mq("DELETE FROM tying WHERE art='$art' ");
                $art_sop_count=0;
                foreach($tying as $art_sop)
                	 if (trim($art_sop)) {
                	 	$art_sop_count++;
                	 	mq("INSERT INTO tying (art, art_sop) VALUES ('$art', '".mres($art_sop)."')");
                	 }
                echo "Добавляем $art_sop_count сопутствующих (последний `$art_sop`)<br>Апдейтим цены и наличие<br>";

                mq("UPDATE price SET   price ='".mres($s[2])."', 	price_zakup='".mres($s[3])."'  WHERE art='$art'");
				mq("UPDATE `count` SET   `count` ='".mres($s[4])."'   WHERE art='$art'");



          		//Номер категории

          		//Значения тегов!
          		$col_num=8;
          		mq("DELETE FROM  `filter_good2param` WHERE good_id=".$row["id"]." ");
                foreach ($params as $param_id=>$title){
                	   $values=$s[$col_num];
                	   $values=explode(";", $values);
                	   $added=false;

                	   foreach ($values as $v)
                	   		if ($v=trim($v)){
                	   			echo "Обработка значения `$v` для тэга `$title`<br>";
                	   			add_new_value($v, $param_id, $row["id"]);
                	   			$added=true;
                	   		}
                	   $col_num++;
                	   mq("DELETE FROM filter_cat2param WHERE cat_id=$catid AND param_id=$param_id");
			   		   mq($sql="INSERT INTO filter_cat2param (cat_id, param_id) VALUES ($catid, $param_id)");
                }

				foreach($current_format as $k=>$v) echo "$v:[$k]=".$s[$k]."<br>";
			 }
			 else   {
			 	echo "Ошибка в CSV файле - в строке $nn колонок $c1  а должно быть $c2<br> ";
			 	print_r($s);
			 	}
            // break;
		}
		update_decimal_values();
}

if ($_FILES["file"]["tmp_name"]){
	$zakup_add=false;
	if ($isCount) $n = "count"; else { $n="price"; $zakup_add=true; }
	echo $n."<br><br>";
	$f=file($fn=$_FILES["file"]["tmp_name"]);

	if ($isCount) mq("TRUNCATE TABLE `$n`"); //Если речь о наличии то удаляем всё. иначе цена - для объединения нескольких прайсов не удаляем.
	$sql="SELECT art FROM goods"; //НАХОДИМ ВСЕ ТОВАРЫ
	$r_main=mq($sql);
	while($row=mysql_fetch_assoc($r_main)){
		$founded4=0;
		$founded1=0;
		$founded2=0;
		$founded3=0;
		$value=0;
		$art=$row["art"];
		if ($art===0 || $art==="0") continue;
		echo "обработка товара с артиклом $art<br>";
		foreach($f as $nn=> $s){
			$s=explode(";", $s);
			$art_str=trim($s[0]);
			//echo "проверяем строку $art_str<br>";

		/*
		if (strpos($art, " ")!==false) $art = trim(substr($art, 0, strpos($art, " ")));
		if ($art{0}=='"') $art=substr($art,1);
		//$value=floatval(str_replace(",",".",$s[1]));*/

			$value=trim($s[1]); // Берем значение из второй колонки неизменным
			$value_zakup_price=trim($s[2]);

		//Пытаемся найти данный АРТ в подстроке!
			if (stripos($art_str, $art)!==false){
				$founded1++;
				$value1=$value;
				$value_zakup_price1=$value_zakup_price;
				$art_str1=$art_str;

				if (0) echo $row["art"]. " найден в строке $art_str , ставлю значение $value<br>";
			}

			if (stripos($art_str, $art." ")!==false && stripos($art_str, $art." ")===0){
				$founded2++;
				$value2=$value;
				$value_zakup_price2=$value_zakup_price;
				$art_str2=$art_str;
				if (0) echo $row["art"]. " найден в строке $art_str , ставлю значение $value<br>";
			}

			if (stripos($art_str, " ".$art." ")!==false || $art_str==$art){
				$founded3++;
				$value3=$value;
				$value_zakup_price3=$value_zakup_price;
				$art_str3=$art_str;
				if (0) echo $row["art"]. " найден в строке $art_str , ставлю значение $value<br>";
			}

			if (stripos($art_str, " ".$art)!==false && stripos($art_str, $art." ")===strlen($art_str)-strlen($art)){
				$founded4++;
				$art_str4=$art_str;
				$value_zakup_price4=$value_zakup_price;
				$value4=$value;
				if (0) echo $row["art"]. " найден в строке $art_str , ставлю значение $value<br>";
			}

		}
		$value=false;
		if ($founded3==1)
			{$value=$value3; $art_str=$art_str3;$value_zakup_price=$value_zakup_price3;}
		else if ($founded2==1)
			{$value=$value2; $art_str=$art_str2;$value_zakup_price=$value_zakup_price2;}
		else if ($founded4==1)
			{$value=$value4; $art_str=$art_str4;$value_zakup_price=$value_zakup_price3;}
		else if ($founded1==1)
			{$value=$value1; $art_str=$art_str1;$value_zakup_price=$value_zakup_price1;}
		if ($value!==false){
			echo $row["art"]. " найден в строке $art_str , ставлю значение $value<br>";
				$r=mq("SELECT COUNT(art) FROM `$n` WHERE `art`='".mysql_real_escape_string($art)."'");
				if ($r) {
								$rr=mysql_fetch_row($r);
								$rr=$rr[0];
								if ($art)
									if ($rr>0)
										mq($sql="UPDATE  `$n` SET `$n` = '".mysql_real_escape_string($value)."' ".($zakup_add?" , `price_zakup` = '".mysql_real_escape_string($value_zakup_price)."' ":"")." WHERE `art`='".mysql_real_escape_string($art)."'");
									else
										mq($sql="INSERT INTO `$n` (`art`, `$n` ".($zakup_add?" , `price_zakup` ":"").") VALUES ('".mysql_real_escape_string($art)."','".mysql_real_escape_string($value)."' ".
													($zakup_add?" , '".mysql_real_escape_string($value_zakup_price)."'  ":"")." ) ");
				}else $value=false;
			}
		if ($value===false) echo "<font color=red>Для $art найдено более 1  строк в файле или не найдено ни одной</font><br>";
	}
}


if ($need_regen_chpu){
	gen_chpu(false);
	echo "<h2>ЧПУ созданы</h2>";
}
?>          <hr>    <a href=.?p=<?=$p?>&csv=1>выгрузить цены и наличие в CSV</a>
<br><br><br>
<form action=. method=post enctype="multipart/form-data">
<b>1я колонка -- АРТ, 2я -- цена/наличие     </b><br>
<input type=file name=file ><br><br>
<input type=radio name=isCount value=0> Цены<br>
<input type=radio name=isCount value=1> Наличие<br>
<input type=hidden name=p value=<?=$p?>>


<input type=submit>
</form>         <br><br><br><br>
            <hr><br><br><br>
<h3>Загрузка описаний и характеристик</h3>

Формат файла можно посмотреть на <a href='.?p=getxls'>странице</a><br>


<form action=. method=post enctype="multipart/form-data">
<input type=file name=file_all ><br><br>
<input type=hidden name=p value=<?=$p?>>
<input type=submit>
</form>

<br><br><br><br>