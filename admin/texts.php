<form action=. method=post  enctype="multipart/form-data"><?

//if ($delete) mq("DELETE FROM  menu WHERE id=".intval($delete));
//print_r($_FILES);

if ($delpic){							unlink ("../img/page".$delpic."_".$num.".jpg");
							$pics=get_pics($delpic);
						    unset($pics[$num]);
						    update_pics($delpic,$pics);}

if ($del_id){	mq($sql="DELETE FROM menu WHERE id=".intval($del_id));


}


//print_r($_REQUEST);


if ($ids){
	foreach($ids as $k=>$_id){
		$_id=intval($_id);
		if (!$_id)
				if ($_REQUEST["name"][$k]){

	 					mq($sql="INSERT INTO menu (text, name) VALUES ('".
	 						mres($_REQUEST["text"][$k]).
		 					"', '".mres($_REQUEST["name"][$k])."')");
						$_id=mysql_insert_id();

	 			}

		if ($_id){

						if ($_FILES["pic"]["tmp_name"][$k]) {
							$picnum=0;
							while(1){
								$pi="../img/page".$_id."_".$picnum.".jpg";
								if (!file_exists($pi)) break;

								$picnum++;
							}
                                 // echo "<h1>FILE $picnum</h1>";
							move_uploaded_file($_FILES["pic"]["tmp_name"][$k], $fn="../img/page".$_id."_".$picnum.".jpg");
							echo "Создал $fn<br> ";
							$pics=get_pics($_id);
						    $pics[$picnum]=	$_REQUEST["href_pic"][$k];
						    update_pics($_id,$pics);
						}

					   // mq("UPDATE news SET `date`='".$_REQUEST["date"][$k]."' WHERE id=$_id");


					    mq("UPDATE menu SET `text`='".mres($_REQUEST["text"][$k])."' WHERE id=$_id");
					    mq("UPDATE menu SET `parent`='".mres($_REQUEST["parent"][$k])."' WHERE id=$_id");


					    mq("UPDATE menu SET `name`='".mres($_REQUEST["name"][$k])."' WHERE id=$_id");
					    mq("UPDATE menu SET `order`='".mres($_REQUEST["order"][$k])."' WHERE id=$_id");
					    mq("UPDATE menu SET `title`='".mres($_REQUEST["title"][$k])."',
					    keywords='".mres($_REQUEST["keywords"][$k])."' , description='".mres($_REQUEST["description"][$k])."' WHERE id=$_id");
	 }
	}
	gen_chpu(true, 4);
}


$sql="SELECT * FROM menu ORDER BY id";

$r=mq($sql);

$counter=0;


function show_row_news($row){
	global $p,$counter;
	$href_pic=explode(";",$row["pic_url"]);
	echo "<table style='width:100%' border=1><tr><td ".($row["id"]==0?"bgcolor=lightgray":"").">


	".($row["id"]==0?"Новая страница":"(ID ".$row["id"].")<b>".$row["name"]."</b> (".$row["href"].")")."
	Название:<input type=text name=name[$counter] value='".htmlspecialchars($row["name"])."' style='width:80%'><br>
	Порядок:<input type=text name=order[$counter] value='".htmlspecialchars($row["order"])."' style='width:80%'><br>";

	if($row["id"]){

				$pics=get_pics($row["id"]);

				$picnum=0;
				while(1){
					$pi="../img/page".$row["id"]."_".$picnum.".jpg";
					if (!file_exists($pi))
						 {if ($picnum>10) break;}
					else
				  		echo
						"<img style='max-height: 200px' src='$pi'><br>".$pics[$picnum]."<br>
						(<a href='?p=$p&delpic=".$row["id"]."&num=$picnum'>удалить</a>)<br>
						";
					$picnum++;
				}
	}
	echo "
	<div style='border: solid 4px gray'>
	<br>ещё картинка:
	<br>
	Файл: <input type=file name=pic[$counter] style='width:80%'><br>
	Ссылка при клике на новую картинку:
		<input type=text name=href_pic[$counter] value='".htmlspecialchars($row["href_pic"])."' style='width:80%'><br>
		</div>
		<br>

	Title:<input type=text name=title[$counter] value='".htmlspecialchars($row["title"])."' style='width:80%'><br>
	Родительская категория:<input type=text name=parent[$counter] value='".htmlspecialchars($row["parent"])."' style='width:80%'><br>
	Keywords:<input type=text name=keywords[$counter] value='".htmlspecialchars($row["keywords"])."' style='width:80%'><br>
	Description:<input type=text name=description[$counter] value='".htmlspecialchars($row["description"])."' style='width:80%'><br>

	<textarea  rows=10 name=text[$counter] style='width:100%'>".htmlspecialchars($row["text"])."</textarea>

	<input type=hidden name=ids[$counter] value=".$row["id"].">
    <a href='.?p=$p&del_id=".$row["id"]."'>удалить</a>

	</td></tr></table>";
	$counter++;
}

$row=array();
/*
$row["id"]="0";
show_row_news($row);*/


while($row=mysql_fetch_assoc($r)){
	show_row_news($row);

}

  show_row_news(array("id"=>0));


?>

<input type=submit>
<input type=hidden name=p value=<?=$p?>>
</form>