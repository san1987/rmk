<?

if ($del_id)
	$r=mq("DELETE FROM banners WHERE id=".intval($del_id));

if ($edit){

        if($save){
        	mq("UPDATE banners SET
        		`title`='".mres($title)."',
        		`chpu`='".mres($chpu)."',
        		`link`='".mres($link)."',
        		`meta_title`='".mres($meta_title)."',
        		`meta_descr`='".mres($meta_descr)."',
        		`order`='".mres($order)."'
        		WHERE id=".intval($edit));

			if($_FILES['pic']['tmp_name'])
	            imgresize($_FILES['pic']['tmp_name'], "../files/banner/".$edit.".jpg", 310, 602);

        }


		$r=mq("SELECT * FROM banners WHERE id=".intval($edit));
		$row=fetch($r);


        ?>

     	<form enctype="multipart/form-data" method=post  style='margin: 10px; border: solid 1px black; padding: 10px'>
				<h3>Редактировать  `<?=$row["title"]?>`</h3>
				<?echo "[<a href='.?p=$p&m=$m&del_id=".$row["id"]."'>удалить</a>]";?>
				id: #<?=$row["id"]?><br>
				Название<br><input type=text name='title' value='<?=$row["title"]?>'  size=80><br>
				Ссылка откуда<br>http://<?=$_SERVER["SERVER_NAME"]?><input type=text name='link' value='<?=$row["link"]?>'  size=80> (пример <i>/sale/</i>)<br>
		 		Ссылка куда<br><input type=text name='chpu' value='<?=$row["chpu"]?>'  size=80><br>
		 		meta_title<br><textarea cols=80 rows=10 name='meta_title'><?=$row["meta_title"]?></textarea><br>
		 		meta_descr<br><textarea cols=80 rows=10 name='meta_descr'><?=$row["meta_descr"]?></textarea><br>
				<br>
		 		Порядок вывода: <br><input type=text name='order' value='<?=$row["order"]?>'><br>
		        Пиктограмма  : <br>
		        <input type=file name='pic' value='<?=$p?>'>
		        <br>    <br>
		        <?="<img src='../files/banner/".$row["id"].".jpg'>"?>
		        <br>
		 		<input type=hidden name='p' value='<?=$p?>'>
		 		<input type=hidden name='save' value='1'>
		 		<input type=hidden name='m' value='<?=$m?>'>
		 		<input type=hidden name='edit' value='<?=$_REQUEST["edit"]?>'>

				<br><br>
		 		<input type=submit >
			</form>
   <?
}

if ($add_new){
	$r=mq("INSERT INTO  banners (`title`) VALUES ('Новый баннер')");
	$edit=mysql_insert_id();
}

$r=mq("SELECT * FROM banners ORDER BY `order`, id");
while($row=fetch($r)){
	 $manuf[]=$row;
}

echo "<a href='.?p=$p&add_new=1' class=green>+ Добавить</a><br><br>";
echo "<table border=1>";
foreach ($manuf as $row){
	echo "<tr><td><img src='../files/banner/".$row["id"].".jpg' style=' vertical-align: middle;'></td><td><a href='.?p=$p&edit=".$row["id"]."'>".$row["title"]."</a></td></tr>";
}
