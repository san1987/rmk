<?



   function add_new_value($value, $param_id, $good_id){
			    if (!trim($value)) return;
   		        $value=mres($value);
	   			$param_id=intval($param_id);
	   			$good_id=intval($good_id);
	   			$r=mq("SELECT * FROM filter_param_values WHERE title='$value' AND param_id=$param_id");
	   			$row=fetch($r);
	   			if ($row){
	   				$value_id=$row["id"];
	   			}else{
	   				mq($sql="INSERT INTO filter_param_values (param_id, title, decimal_value) VALUES (".$param_id.", '".mres($value)."', ".intval(trim($value)).")");
	   				$value_id=mysql_insert_id();
	   			}
	   			if ($value_id){
		   			mq("DELETE FROM filter_good2param WHERE value_id=$value_id AND good_id=$good_id");
		   			mq($sql="INSERT INTO filter_good2param (value_id, good_id) VALUES (".$value_id.", '".$good_id."')");
		   		}
   }

   function update_decimal_values($was_decimal=false){   	echo "<br>====================<br>Уравниваю текстовые и числовые значения:<br>";
	$r=mq("SELECT *, fpv.id AS fpvid FROM filter_params  fp
			INNER JOIN filter_param_values fpv ON fpv.param_id=fp.id
			WHERE fp.is_decimal=1
			");
	while ($row=fetch($r))
		if ($was_decimal===false || array_search($row["param_id"], $was_decimal)!==false){
				$decimal_value=intval(trim($row["title"]));
				if ($decimal_value." "!=trim($row["title"])." ") echo "<font color=blue>";
				echo $row["title"]." &raquo; $decimal_value    </font><br>";
				mq("UPDATE filter_param_values SET decimal_value=$decimal_value WHERE id=".$row["fpvid"]);
			}   }
   echo "====================<br>";


?>