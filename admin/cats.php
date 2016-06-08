<h2>КАТЕГОРИИ</h2>

<a href='.?p=<?=$p?>&from_excel=1'>импорт и экспорт</a><br><br>
<?



if ($from_excel){
        if ($save){              $f=file($_FILES['file']['tmp_name']);
              foreach($f as $k=>$s)
              {
              			$s=trim($s_orig=$s);
              			//echo iconv("WINDOWS-1251","UTF-8",$s."<hr>") ;
              			//echo iconv("WINDOWS-1251","UTF-8","<hr>") ;
		                $s=str_replace("\r","<br>",$s);
              			$s=str_replace("\n","<br>",$s);
              			$s=str_replace("\\n","<br>",$s);
              			$s=str_replace("\\;","@@@@@@@@@@@@@@@@@",$s);
				        $data = str_getcsv ($s,  ";", '"', "\\");
				        $num = count($data);
				        //echo "<p> $num полей в строке $row: <br /></p>\n";
				        if ($num!=10  && false)
					        echo "<p>ОШИБКА! $num полей в строке $k  (нумерация с 0 )<br/></p>\n";
						else{
							for ($c=0; $c < $num; $c++) {
					    	   	 $data[$c]=str_replace("@@@@@@@@@@@@@@@@@",";",$data[$c]);
				           // echo "<b>$c</b>".iconv("WINDOWS-1251","UTF-8",$data[$c]) . "<br />\n";
				        	}



				        	$r=mq("SELECT id FROM cats WHERE left_title='".u(mres(trim($data[2] ) ))."' ");
				        	$row=fetch($r);
				        	if (trim($data[2] )=="") $row["id"]=0;
				        	if($row["id"] || trim($data[2])=="") if (trim($data[0])!="") {								mq($sql="INSERT INTO  `cats` (

							  `title`,
							  `left_title` ,
				              `parent_id`,
				              `photo`,
				              `order`,
				              `chpu`   ,
				              `descr`  ,
				              `descr2`,
				              `meta_title`  ,
				              `meta_descr`


														)
														VALUES (
															'".u(mres($data[0]))."',
															'".u(mres($data[1]))."',
															'".u(mres(intval($row["id"])))."',
															'".u(mres($data[3]))."',
															'".u(mres($data[4]))."',
															'".u(mres($data[5]))."',
															'".u(mres($data[6]))."',
															'".u(mres($data[7]))."',
															'".u(mres($data[8]))."',
															'".u(mres($data[9]))."'
														)


									ON DUPLICATE KEY UPDATE


									`title`='".u(mres($data[0]))."',
							  `left_title`='".u(mres($data[1]))."' ,
				              `parent_id`='".u(mres(intval($row["id"])))."',
				              `photo`='".u(mres($data[3]))."',
				              `order`='".u(mres($data[4]))."',
				              `chpu`='".u(mres($data[5]))."'   ,
				              `descr` ='".u(mres($data[6]))."' ,
				              `descr2`='".u(mres($data[7]))."',
				              `meta_title`='".u(mres($data[8]))."'  ,
				              `meta_descr`='".u(mres($data[9]))."'


														 ");
								$ii=mysql_insert_id();
								if ($ii  || true)
									$added++;
								else
									echo "Запись $ii не была добавлена <br>".u($s_orig)."<br>".mysql_error()." ".u($data[0])." $sql<br>";
								}
							else
								echo "<p>ОШИБКА!  в строке $k (нумерация с 0 ) не найдена родительская категория '".u($data[2])  ."'<br/></p>\n";						}
				        $row++;

			  }
			  echo "<h3>добавлено $added записей</h3>";        }
        if ($export) {
        	$fn="../files/cats.csv";
        	$s="";
        	$r=mq("SELECT c.*,c1.left_title AS parent_title FROM cats  c
        			LEFT JOIN  cats c1 ON c1.id=c.parent_id
        			ORDER by c.`order` ");
			while ($row=fetch($r)){
				$ss=array();
				$array=array( "title",
							  "left_title",
				              "parent_title",
				              "photo",
				              "order",
				              "chpu"   ,
				              "descr"  ,
				              "descr2",
				              "meta_title"  ,
				              "meta_descr"

				);
				foreach ($array as $t)                	$ss[]="\"".mb_replace('"', "\\\"",
                				mb_replace(";","\\;",
                				mb_replace("\n","<br>",
                				mb_replace("\r","",

                				$row[$t]))))."\"";


                $s.=implode(";", $ss);
				$s.="\n";
			}

        	file_put_contents($fn, iconv("UTF-8","WINDOWS-1251",$s));        	?>
        	<br><br><a href='<?=$fn?>?t=<?=time()?>'>скачать CSV</a>       <br>
        	<?        } else{
		?>
		Формат файла CSV, описание колонок:<br>
		1) название категории  <br>
		2) название категории в левом меню <br>
		3) название родительской категории (из соответствующей второй колонки) или пусто если это корневая категория<br>
		4) картинка в папке /files/cats/<br>
		5) порядок вывода<br>
		6) ЧПУ<br>
		7) Описание 1<br>
		8) Описание 2<br>
		9) meta_title<br>
		10) meta_descr<br>

		<br>
		<a href='.?p=<?=$p?>&export=1&from_excel=1'>
		Экспорт всех категорий в CSV</a>   <br><br>
		Импорт товаров:
		<form enctype="multipart/form-data" method=post  style='margin: 10px; border: solid 1px black; padding: 10px'>
		<input type=file name='file' value='<?=$p?>'>
	    <input type=hidden name='p' value='<?=$p?>'>
	    <input type=hidden name='save' value='1'>


 		<input type=submit >


	</form>
		<br><?
		}
}else{




		$root_id=0;

		if (isset($_REQUEST["del_id"])){
			del_cat($_REQUEST["del_id"]);




		}

		if (isset($_REQUEST["add_id"])){

			$add_id=$_REQUEST["add_id"];

			if (trim($_REQUEST["title"])){
				mq($dsql="INSERT INTO cats (title,   left_title,   parent_id) VALUES(
					'".mres($_REQUEST["title"])."','".mres($_REQUEST["title"])."',

					'".intval($_REQUEST["add_id"])."'


						)");
				echo "Успешно  <br>";
			}
			?>

			<form method=post style='margin: 10px; border: solid 1px black; padding: 10px'>
				<h3>Добавить новый подпункт меню в `<?=$_REQUEST["parent_title"]?>`</h3>
		 		Название пункта меню <br><input type=text name='title' value='' size=80><br>
		 		<input type=hidden name='p' value='<?=$p?>'>
		 		<input type=hidden name='m' value='<?=$m?>'>
		 		<input type=hidden name='add_id' value='<?=$add_id?>'>

		 		<input type=submit >


			</form>

			<?
		}



		if (isset($_REQUEST["edit_id"])){
				/*
				if ($_REQUEST["delpic"]){
					mq($dsql="UPDATE cats SET  pic=0 WHERE id=				".($menu_id=intval($_REQUEST["edit_id"])));
		            unlink("../files/cats/".$menu_id.".jpg");
				}
				*/
		        if ($_REQUEST["title"]){
					mq($dsql="UPDATE cats SET

						 chpu='".mres($_REQUEST["chpu"])."',
					    `order`='".mres($_REQUEST["order"])."',
					    `show_goods`='".mres($_REQUEST["show_goods"])."',
					     parent_id='".mres($_REQUEST["parent_id"])."',
					    `left_title`='".mres($_REQUEST["left_title"])."',

					    title='".mres($_REQUEST["title"])."',
					    `descr`='".mres($_REQUEST["descr"])."',
					    `descr2`='".mres($_REQUEST["descr2"])."',
					    `meta_title`='".mres($_REQUEST["meta_title"])."',
					    `meta_descr`='".mres($_REQUEST["meta_descr"])."',

					      spec_title='".mres($_REQUEST["spec_title"])."',
					    `spec_descr`='".mres($_REQUEST["spec_descr"])."',
					    `spec_descr2`='".mres($_REQUEST["spec_descr2"])."',
					    `spec_meta_title`='".mres($_REQUEST["spec_meta_title"])."',
					    `spec_meta_descr`='".mres($_REQUEST["spec_meta_descr"])."',



					    `photo`='".mres($_REQUEST["photo"])."'

		 				 WHERE id=				".($menu_id=intval($_REQUEST["edit_id"])));

		            @mkdir("../files");
		            @mkdir("../files/cats/");
		            imgresize($fn=$_FILES['pic']['tmp_name'], $fn_new="../files/cats/".$menu_id.".jpg" , 129, 175);
		            if ($fn){
		                echo "Файл пиктограммы сохранён<br>";
		                mq($dsql="UPDATE cats SET  photo='' WHERE id=				".($menu_id=intval($_REQUEST["edit_id"])));
		            }



					echo "Успешно   <br>";
			}

				$r=mq("SELECT * FROM cats WHERE  `id`=".$_REQUEST["edit_id"]);
				$row=fetch($r);

			?>

			<form enctype="multipart/form-data" method=post  style='margin: 10px; border: solid 1px black; padding: 10px'>
				<h3>Редактировать  `<?=$_REQUEST["parent_title"]?>`   (<a href=.?p=goods&cat_id=<?=$row["id"]?>>Товары в этой категории</a>)</h3>
				<?echo "[<a href='.?root_id=$root_id&p=$p&m=$m&del_id=".$row["id"]."'><img src='img/delete.png'>удалить</a>]";?>
				id: #<?=$row["id"]?> родительская категория: #<?=$row["parent_id"]?><br>

		 		Название в меню слева<br><input type=text name='left_title' value='<?=$row["left_title"]?>'  size=80><br>
		 		ЧПУ<br><input type=text name='chpu' value='<?=$row["chpu"]?>'  size=80><br>
		 		картинка в папке /files/cats/ (если пусто то используется <?=$row["id"]?>.jpg)<br><input type=text name='photo' value='<?=$row["photo"]?>'  size=80><br>
                <table width=100%><tr><td>
				H1<br><input type=text name='title' value='<?=$row["title"]?>'  size=80><br>
		 		Описание 1<br><textarea cols=80 rows=10 name='descr'><?=$row["descr"]?></textarea><br>
		 		Описание 2<br><textarea cols=80 rows=10 name='descr2'><?=$row["descr2"]?></textarea><br>
		 		meta_title<br><textarea cols=80 rows=10 name='meta_title'><?=$row["meta_title"]?></textarea><br>
		 		meta_descr<br><textarea cols=80 rows=10 name='meta_descr'><?=$row["meta_descr"]?></textarea><br>

		 		</td><td>

		 		в спецпредложении: H1<br><input type=text name='spec_title' value='<?=$row["spec_title"]?>'  size=80><br>
		 		в спецпредложении: Описание 1<br><textarea cols=80 rows=10 name='spec_descr'><?=$row["spec_descr"]?></textarea><br>
		 		в спецпредложении: Описание 2<br><textarea cols=80 rows=10 name='spec_descr2'><?=$row["spec_descr2"]?></textarea><br>
		 		в спецпредложении: meta_title<br><textarea cols=80 rows=10 name='spec_meta_title'><?=$row["spec_meta_title"]?></textarea><br>
		 		в спецпредложении: meta_descr<br><textarea cols=80 rows=10 name='spec_meta_descr'><?=$row["spec_meta_descr"]?></textarea><br>

		 		</td></tr></table>

		 		родительская категория<br><input type=text name='parent_id' value='<?=$row["parent_id"]?>'  size=80><br>





			<br>
		 		Порядок вывода: <br><input type=text name='order' value='<?=$row["order"]?>'><br>
		 		Показывать ли товары и фильтр?: <br><input type=text name='show_goods' value='<?=$row["show_goods"]?>'><br>

		        Пиктограмма  : <br>
		<input type=file name='pic' value='<?=$p?>'>

		        <br>
		        <?=!$row["photo"]?"<img width=80 src='../files/cats/".$_REQUEST["edit_id"].".jpg'>":
		        	"<img width=80 src='../files/cats/".$row["photo"].".jpg'>"?>
                                                                       <br>
		 		<input type=hidden name='p' value='<?=$p?>'>
		 		<input type=hidden name='root_id' value='<?=$root_id?>'>
		 		<input type=hidden name='m' value='<?=$m?>'>
		 		<input type=hidden name='edit_id' value='<?=$_REQUEST["edit_id"]?>'>
                                       <br><br>
		 		<input type=submit >


			</form>

			<?

		}



		$r=mq("SELECT * FROM cats ORDER by `order` ");
		while ($row=fetch($r)){
			$menu_link[$row["parent_id"]][]=$row["id"];
			$menu[$row["id"]]=$row;
		}
		$menu[0]["left_title"]="Меню слева";


		function show_admin_menu($id, $root=false){
			global $menu, $menu_link, $p, $m, $root_id;

			echo "<div style='margin-left: 50px; line-height: 2.0'>

				";
			if ($menu_link[$id])
			foreach ($menu_link[$id] as $row_id){
				echo ($menu[$row_id]["photo"]?"<img src='../files/cats/$row_id.jpg' width=40>":"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;")."
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

				[<a href=.?p=goods&cat_id=".$row_id.">товары</a>]
				 <a href='.?root_id=$root_id&p=$p&m=$m&edit_id=$row_id&parent_title=".urlencode($menu[$row_id]["left_title"])."' style='font-weight: bold'>
				 ¤ ".$menu[$row_id]["left_title"]."</a>(#$row_id) [<a href='.?root_id=$root_id&p=$p&m=$m&add_id=$row_id&parent_title=".urlencode($menu[$id]["left_title"])."'>+ добавить</a>]
				 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br>";
				show_admin_menu($row_id);

			}
			echo "</div>";

		}


		    if ($root_id==0){
				echo "<h2>".$menu[0]["title"]."</h2> [<a href='.?root_id=$root_id&p=$p&m=$m&add_id=0&parent_title=".urlencode($menu[0]["left_title"])."' class=green >+ добавить</a>]";
				show_admin_menu(0);
			}



}