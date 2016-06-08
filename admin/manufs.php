<?

if ($del_id)
	$r=mq("DELETE FROM manufs WHERE id=".intval($del_id));

if ($edit){

        if($save)
          if ($tags)
              	mq("INSERT INTO  tags
              	(h1,meta_title, meta_descr, descr1, descr2, manuf_id, cat_id)
              	VALUES (
              	'".mres($title)."',
              	'".mres($meta_title)."',
              	'".mres($meta_descr)."',
              	'".mres($descr1)."',
              	'".mres($descr2)."',
              	".intval($edit).",
              	".intval($tags)."

              	)

              	ON DUPLICATE KEY UPDATE


        		`h1`='".mres($title)."',
        		`descr1`='".mres($descr1)."',
        		`descr2`='".mres($descr2)."',

        		`meta_title`='".mres($meta_title)."',
        		`meta_descr`='".mres($meta_descr)."'

        		");

          else
        	{        	mq("UPDATE manufs SET
        		`title`='".mres($title)."',
        		`chpu`='".mres($chpu)."',
        		`meta_title`='".mres($meta_title)."',
        		`meta_descr`='".mres($meta_descr)."',
        		`descr1`='".mres($descr1)."',
        		`descr2`='".mres($descr2)."',
        		`order`='".mres($order)."'
        		WHERE id=".intval($edit));

			if($_FILES['pic']['tmp_name'])
	            imgresize($_FILES['pic']['tmp_name'], "../files/manufacturers/".$edit.".jpg", 195, 145);
        }


		$r=mq("SELECT * FROM manufs WHERE id=".intval($edit));
		$orig_row=$row=fetch($r);

		if ($tags)  {

			$r=mq("SELECT * FROM tags WHERE  cat_id=".intval($tags)." AND manuf_id =".intval($edit));
			$row=fetch($r);
			$r=mq("SELECT * FROM cats WHERE  `id`=".intval($tags));
			$cat=fetch($r);
		}

        ?>



     	<form enctype="multipart/form-data" method=post  style='margin: 10px; border: solid 1px black; padding: 10px'>
				<h3>Редактировать  `<?=$orig_row["title"]?>`</h3>
				<?echo "[<a href='.?p=$p&m=$m&del_id=".$row["id"]."'>удалить</a>]";?>
				id: #<?=$row["id"]?><br>

				<table><tr><td>

				<?
				if ($tags){  ?>
							<h3>Метатэги для категории <?=$cat["left_title"]?></h3>
				        	Название<br><input type=text name='title' value='<?=$row["h1"]?>'  size=80><br>
					 		meta_title<br><textarea cols=80 rows=10 name='meta_title'><?=$row["meta_title"]?></textarea><br>
					 		meta_descr<br><textarea cols=80 rows=10 name='meta_descr'><?=$row["meta_descr"]?></textarea><br>
					 		Описание 1<br><textarea cols=80 rows=10 name='descr1'><?=$row["descr1"]?></textarea><br>
					 		Описание 2<br><textarea cols=80 rows=10 name='descr2'><?=$row["descr2"]?></textarea><br>
					 		<input type=hidden name='tags' value='<?=$tags?>'>
				<?					}else{
							?>
							Название<br><input type=text name='title' value='<?=$row["title"]?>'  size=80><br>
					 		ЧПУ<br><input type=text name='chpu' value='<?=$row["chpu"]?>'  size=80><br>
					 		Описание 1<br><textarea cols=80 rows=10 name='descr1'><?=$row["descr1"]?></textarea><br>
					 		Описание 2<br><textarea cols=80 rows=10 name='descr2'><?=$row["descr2"]?></textarea><br>
					 		meta_title<br><textarea cols=80 rows=10 name='meta_title'><?=$row["meta_title"]?></textarea><br>
					 		meta_descr<br><textarea cols=80 rows=10 name='meta_descr'><?=$row["meta_descr"]?></textarea><br>
							<br>
					 		Порядок вывода: <br><input type=text name='order' value='<?=$row["order"]?>'><br>
					        Пиктограмма  : <br>
					        <input type=file name='pic' value='<?=$p?>'>
					        <br>    <br>
					        <?="<img src='../files/manufacturers/".$row["id"].".jpg'>"?>
					        <br>
					        <?
		        }
		        ?>
		 		<input type=hidden name='p' value='<?=$p?>'>
		 		<input type=hidden name='save' value='1'>
		 		<input type=hidden name='m' value='<?=$m?>'>
		 		<input type=hidden name='edit' value='<?=$_REQUEST["edit"]?>'>

		 		</td>
			<td valign=top width=10></td valign=top><td valign=top>

			Метатэги в категориях:<br>
			<?

							$r=mq("SELECT DISTINCT c.id, c.left_title , c2.id AS c2id, c2.left_title AS c2title FROM cats c
							    INNER JOIN good2cat g2c ON  c.id=g2c.cat_id
							    INNER JOIN goods g ON g.id=g2c.good_id AND g.manuf_id=".$edit."

							    LEFT  JOIN cats c2 ON c2.id=c.parent_id

							    ORDER by c2.`order` ASC , c2.id ASC , c.`order` ASC, c.id ASC
								");
							while ($rrow=fetch($r)){
								 echo "<a href='.?p=$p&edit=$edit&tags=".$rrow["id"]."'>".$rrow["left_title"]."</a>  &nbsp;&nbsp; / &nbsp;&nbsp; <a href='.?p=$p&edit=$edit&tags=".$rrow["c2id"]."'>".$rrow["c2title"]."</a>  <br>";
							}


			?>
			</td>
			</tr>
			</table>

				<br><br>
		 		<input type=submit >
			</form>
   <?}

if ($add_new){	$r=mq("INSERT INTO  manufs (`title`) VALUES ('Новый бренд')");}

$r=mq("SELECT * FROM manufs ORDER BY `order`, title");
while($row=fetch($r)){
	 $manuf[]=$row;
}

echo "<a href='.?p=$p&add_new=1' class=green>+ Добавить</a><br><br>";
echo "<table border=1>";
foreach ($manuf as $row){	echo "<tr><td><img src='../files/manufacturers/".$row["id"].".jpg' style=' vertical-align: middle;'></td><td><a href='.?p=$p&edit=".$row["id"]."'>".$row["title"]."</a></td></tr>";}
