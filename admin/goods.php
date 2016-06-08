`<?
  $cat_id=intval($cat_id);
  $r=mq("SELECT * FROM cats WHERE id=$cat_id ");
  $cat=fetch($r);

?>
<h2>ТОВАРЫ <?=$cat["title"]?></h2>

<?



if ($from_excel_goods){
		if($save_goods){
			require_once "PHPExcel.php";
			include_once 'PHPExcel/IOFactory.php';


			$objReader = new PHPExcel_Reader_Excel2007($_FILES['file']['tmp_name']);
			$xls = $objReader->load($file);
			$xls->setActiveSheetIndex();
			$sheet = $xls->getActiveSheet();
			$row_counter=0;
			do{
				 $data = array();
				 $row_counter++;
			     for($i=0; $i<10; $i++)
				     $data[$i]= $sheet->getCellByColumnAndRow($i, $row_counter+1)->getValue();;

				 if (!$data[1]) break;

				 $manuf=$data[3];
				 $r=mq("INSERT INTO manufs (`title`, `chpu`) VALUES ('".mres($manuf)."', '".mres(do_translit($manuf))."') ");
				 $r=mq("SELECT * FROM manufs WHERE title='".mres($manuf)."' ");
				 $manuf=fetch($r);

				 $cats= $data[1];
				 $cats= explode("/", $cats );

				 $cat_id=0;

				 while (1){

					 $cat_title=array_shift($cats);
					 if (!$cat_title) break;
					 //$r=mq("INSERT INTO cats (`left_title`, `parent_id`, `chpu`) VALUES ('".mres($cat_title)."', $cat_id, '".mres(do_translit($cat_title))."') ");
					 $r=mq("SELECT * FROM cats WHERE left_title='".mres($cat_title)."' AND parent_id= $cat_id");
					 $cat=fetch($r);
					 $cat_id=$cat["id"];
					 if (!$cat_id ) echo "Ошибка заливки товара - не найдена категория `$cat_title`<br>";
				 }







                 if ($cat_id )
			     mq($sql="INSERT INTO  `goods`(

														  `art`,
														  `chpu` ,
											              `manuf_id`,
											              `title`,
											              `price`,
											              `photos`   ,
											              `description`,
											              `desc1`  ,
											              `desc2`,
											              `desc3`,
											              `meta_title`  ,
												          `meta_descr`,
											              `is_spec`,
											              `is_visible`


													)
													VALUES (
														'". (mres($data[0]))."',
														'". (mres($data[2]))."',
														'". (mres($manuf["id"]))."',
														'". (mres($data[4]))."',
														'". (mres($data[5]))."',
														'". (mres($data[6]))."',
														'". (mres($data[7]))."',
														'". (mres($data[8]))."',
														'". (mres($data[9]))."',
														'". (mres($data[10]))."',
														'". (mres($data[11]))."',
														'". (mres($data[12]))."',
														'". (mres($data[13]))."',
														'". (mres($data[14]))."'

														)

												ON DUPLICATE KEY UPDATE


														  `art`='". (mres($data[0]))."',
														  `chpu`='". (mres($data[0]))."' ,
											              `manuf_id`='". (mres($manuf["id"]))."',
											              `title`='". (mres($data[4]))."',
											              `price`='". (mres($data[5]))."',
											              `photos`  ='". (mres($data[6]))."' ,
											              `description`='". (mres($data[7]))."',
											              `desc1` ='". (mres($data[8]))."' ,
											              `desc2`='". (mres($data[9]))."',
											              `desc3`='". (mres($data[10]))."',
											              `meta_title` ='". (mres($data[11]))."' ,
												          `meta_descr`='". (mres($data[12]))."',
											              `is_spec`='". (mres($data[13]))."',
											              `is_visible`='". (mres($data[14]))."'


														;");
							$good_id=mysql_insert_id();

							if (!$good_id &&  false)
								echo "ошибка! ".mysql_error()." $sql<br>";
                            else{
								$r=mq("DELETE FROM good2cat WHERE `good_id`=$good_id ");
								$r=mq("INSERT INTO good2cat (`cat_id`, `good_id`) VALUES ($cat_id, $good_id) ");

								/* if ($good_id) */ $added++;
							}


			}while(true);


			  echo "<h3>добавлено $added записей</h3>";

		}

        if ($export) {

        	require_once "PHPExcel.php";
			include_once 'PHPExcel/Writer/Excel2007.php';

        	// Create new PHPExcel object
				$objPHPExcel = new PHPExcel();
				$objPHPExcel->setActiveSheetIndex(0);
				$row_counter=1;

				$array=array(


				               							  "art",
				               							  "cats",
														  "chpu" ,
											              "mtitle",
											              "title",
											              "price",
											              "photos"   ,
											              "description",
											              "desc1"  ,
											              "desc2",
											              "desc3",
											              "meta_title"  ,
												          "meta_descr",
											              "is_spec",
											              "is_visible"  );



				 foreach ($array as $t) {

                		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col_num++, $row_counter, $t);

                	}


        	$s="";
        	$r=mq("SELECT c.*, m.title AS mtitle  FROM goods  c
                    LEFT JOIN manufs m ON m.id= c.manuf_id
        			ORDER by c.manuf_id, c.`order` ");
			while ($row=fetch($r)){
				$ss=array();
                $row_counter++;


				 $row["cats"]=array();
				 $rr=mq("SELECT c1.title AS c1title,
								 c2.title AS c2title,
								 c3.title AS c3title

				 			 FROM good2cat g2c


				 			LEFT  JOIN cats c1 ON   g2c.cat_id=c1.id
				 			LEFT  JOIN cats c2 ON   c1.parent_id=c2.id
				 			LEFT  JOIN cats c3 ON   c2.parent_id=c3.id
                                                  WHERE
                            g2c.good_id=".$row["id"]." 			");
					if ($rrow=fetch($rr)){
						$row["cats"] =($rrow["c3title"]?$rrow["c3title"]."/":"").
									($rrow["c2title"]?$rrow["c2title"]."/":"").$rrow["c1title"];
					}



                $col_num=0;
				foreach ($array as $t) {
                	$ss[]="\"".mb_replace('"', "\\\"",
                				mb_replace(";","\\;",
                				mb_replace("\n","<br>",
                				mb_replace("\r","",

                				$row[$t]))))."\"";
                		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col_num++, $row_counter, $row[$t]);

                	}


                $s.=implode(";", $ss);
				$s.="\n";

			}
            $fn="../files/goods.csv";
        	file_put_contents($fn, iconv("UTF-8","WINDOWS-1251",$s));
        	$fn2="../files/goods.xlsx";

        	// Save Excel 2007 file
			$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
			$objWriter->save($fn2);
        	?>
        	<br><br><a href='<?=$fn?>?t=<?=time()?>'>скачать CSV</a>
        	    <br>
        	    <br><a href='<?=$fn2?>?t=<?=time()?>'>скачать XLSX</a>
        	    <br>
        	<?
        } else{
		?>
		Формат файла CSV, описание колонок:<br>
		Артикул<br>	Путь категори<br>	URL	Производитель	<br>Название товара<br>	Цена	<br>Картинки<br>	Преимущества
		<br>	Описание товара	<br>Характеристики	<br>Аксессуары<br>	Title	<br>Description<br>	Спецпредложение<br>	Опубликовано    <br>


		<br>
		<a href='.?p=<?=$p?>&export=1&from_excel_goods=1'>
		Экспорт всех товаров</a>   <br><br>
		Импорт товарова (картинки 		заливайте в files/goods/min и files/goods/medium):
		<form enctype="multipart/form-data" method=post  style='margin: 10px; border: solid 1px black; padding: 10px'>
		<input type=file name='file' value='<?=$p?>'>
	    <input type=hidden name='p' value='<?=$p?>'>
	    <input type=hidden name='save_goods' value='1'>


 		<input type=submit >


	</form>
		<br><?
		}

}else{

           ?><a href='.?p=<?=$p?>&from_excel_goods=1'>импорт и экспорт</a><br><?


		$root_id=0;

		if (isset($_REQUEST["del_id"])){
            del_good(intval($_REQUEST["del_id"]));
		}

		if (isset($_REQUEST["add_id"])){

			$add_id=intval($_REQUEST["add_id"]);

			if (trim($_REQUEST["title"])){
				mq($dsql="INSERT INTO goods (title, chpu) VALUES(
					'".mres($_REQUEST["title"])."',  '".mres(do_translit($_REQUEST["title"]))."'


						)");
				$_REQUEST["edit_id"]=$id=mysql_insert_id();

				mq("INSERT INTO good2cat (good_id, cat_id) VALUES (".$id.", $add_id)");
				echo "Успешно  <br>";
			}
			?>

			<form method=post style='margin: 10px; border: solid 1px black; padding: 10px'>
				<h3>Добавить новый товар:</h3>
		 		Название товара <br><input type=text name='title' value='' size=80><br>
		 		<input type=hidden name='p' value='<?=$p?>'>
		 		<input type=hidden name='m' value='<?=$m?>'>
		 		<input type=hidden name='add_id' value='<?=$add_id?>'>
		 		<input type=hidden name='cat_id' value='<?=$add_id?>'>

		 		<input type=submit >


			</form>

			<?
		}



		if (isset($_REQUEST["edit_id"])){
				$_REQUEST["edit_id"]=intval($_REQUEST["edit_id"]);
				$edit_id=intval($edit_id);
				/*
				if ($_REQUEST["delpic"]){
					mq($dsql="UPDATE cats SET  pic=0 WHERE id=				".($menu_id=intval($_REQUEST["edit_id"])));
		            unlink("../files/goods/".$menu_id.".jpg");
				}
				*/
		        if ($_REQUEST["title"] && $save){
		            //print_r($good2cat);

		            mq($dsql="DELETE FROM  good2cat WHERE good_id= $edit_id");
		            if ($good2cat)
			            foreach ($good2cat as $cid=>$t)
			            	mq($dsql="INSERT INTO  good2cat (good_id, cat_id) VALUES ( $edit_id, ".intval($cid).")");



					mq($dsql="UPDATE goods SET
						 title='".mres($_REQUEST["title"])."',
						 chpu='".mres($_REQUEST["chpu"])."',
						 art='".mres($_REQUEST["art"])."',
					    `order`='".mres($_REQUEST["order"])."',
					     price='".mres($_REQUEST["price"])."',
					    `description`='".mres($_REQUEST["description"])."',
					    `desc1`='".mres($_REQUEST["desc1"])."',
					    `desc2`='".mres($_REQUEST["desc2"])."',
					    `desc3`='".mres($_REQUEST["desc3"])."',
					    `desc4`='".mres($_REQUEST["desc4"])."',
					    `view`='".mres($_REQUEST["view"])."',
					    `manuf_id`='".mres($_REQUEST["manuf_id"])."',
					    `photos`='".mres($_REQUEST["photos"])."',
					    `meta_title`='".mres($_REQUEST["meta_title"])."',
					    `meta_descr`='".mres($_REQUEST["meta_descr"])."'
		 				 WHERE id=				".($menu_id=intval($_REQUEST["edit_id"])));

		            @mkdir("../files");
		            @mkdir("../files/goods/");
		            @mkdir("../files/goods/min");
		            @mkdir("../files/goods/medium");
		            $fn_new= $menu_id."_".time().".jpg";
		            imgresize($tmpfn=$_FILES['pic']['tmp_name'], "../files/goods/min/".$fn_new , 100, 100);
		            imgresize($tmpfn=$_FILES['pic']['tmp_name'], "../files/goods/medium/".$fn_new , 400, 400);
		            if ($tmpfn){
		                echo "Файл пиктограммы сохранён<br>";
		                $r=mq("SELECT photos FROM goods WHERE  `id`=".$_REQUEST["edit_id"]);
					    $row=fetch($r);
		                $photos=explode("|", $row["photos"]);
		                if (!$photos[0]) unset ($photos[0]);
		                $photos[]=$fn_new;
		                $photos=implode("|", $photos);
		                mq($dsql="UPDATE goods SET  photos='".mres($photos)."' WHERE id=
		                			".($menu_id=intval($_REQUEST["edit_id"])));
		            }



					echo "Успешно   <br>";
			}
			if (isset($del_photo)){
						$r=mq("SELECT * FROM goods WHERE  `id`=".$_REQUEST["edit_id"]);
					    $row=fetch($r);
		                $photos=explode("|", $row["photos"]);
		                $fn_new=$photos[$del_photo];
		                if($fn_new){
			                @unlink("../files/goods/min/".$fn_new);
			                @unlink("../files/goods/medium/".$fn_new);
			            }
		                unset($photos[$del_photo]);
		                $photos=implode("|", $photos);
		                mq($dsql="UPDATE goods SET  photos='".mres($photos)."' WHERE id=
		                			".($menu_id=intval($_REQUEST["edit_id"])));
			}

				$r=mq("SELECT * FROM goods WHERE  `id`=".$_REQUEST["edit_id"]);
				$row=fetch($r);

			?>
			<form enctype="multipart/form-data" method=post action='.' style='margin: 10px; border: solid 1px black; padding: 10px'>
            <table><tr><td>

				<h3>Редактировать  `<?=$row["title"]?>`</h3>
				id: #<?=$row["id"]?> <br>
				артикул<br><input type=text name='art' value='<?=$row["art"]?>'  size=80><br>
		 		Название странице<br><input type=text name='title' value='<?=$row["title"]?>'  size=80><br>
		 		цена<br><input type=text name='price' value='<?=$row["price"]?>'  size=80><br>
		 		ЧПУ<br><input type=text name='chpu' value='<?=$row["chpu"]?>'  size=80><br>

                Преимущества<br><textarea cols=80 rows=10 name='description'><?=$row["description"]?></textarea><br>
		 		Описание 1<br><textarea cols=80 rows=10 name='desc1'><?=$row["desc1"]?></textarea><br>
		 		Описание 2<br><textarea cols=80 rows=10 name='desc2'><?=$row["desc2"]?></textarea><br>
		 		Описание 3<br><textarea cols=80 rows=10 name='desc3'><?=$row["desc3"]?></textarea><br>
		 		Описание 4<br><textarea cols=80 rows=10 name='desc4'><?=$row["desc4"]?></textarea><br>
		 		meta_title<br><textarea cols=80 rows=10 name='meta_title'><?=$row["meta_title"]?></textarea><br>
		 		meta_descr<br><textarea cols=80 rows=10 name='meta_descr'><?=$row["meta_descr"]?></textarea><br>

		 		просмотры<br><input type=text name='view' value='<?=$row["view"]?>'  size=80><br>
			<br>
		 		Порядок вывода: <br><input type=text name='order' value='<?=$row["order"]?>'><br>
		        Добавить фото: <br>
		<input type=file name='pic' value='<?=$p?>'>
                <br>Фото (разделитель | , папки - /files/goods/min/ и /files/goods/medium)<br><input type=text name='photos' value='<?=$row["photos"]?>'  size=80><br>
		        <br>
		        <?											  $photos=               get_photo($row, true, true);
                                                              $photos_huge=               get_photo($row, false, true);

			                                                  foreach($photos as $k=>$photo) {
			                                                  	?>
			                                                  	<img src='../<?=$photo?>'>
			                                                  	<? echo "<a href='.?del_photo=$k&root_id=$root_id&p=$p&cat_id=$cat_id&m=$m&edit_id=$edit_id&parent_title=".urlencode($row["title"])."'>удалить</a>"; ?>
			                                                  	<br>
			                                                  	<?
			                                                  }

		        	?>

		 		<input type=hidden name='p' value='<?=$p?>'>
		 		<input type=hidden name='save' value='1'>
		 		<input type=hidden name='root_id' value='<?=$root_id?>'>
		 		<input type=hidden name='m' value='<?=$m?>'>
		 		<input type=hidden name='edit_id' value='<?=$_REQUEST["edit_id"]?>'>
		 		<input type=hidden name='cat_id' value='<?=$_REQUEST["cat_id"]?>'>
                                     <br><br>
		 		<input type=submit >




			</td>
			<td valign=top>
                        Производитель:
                        <select name=manuf_id>
                        <option></option>
                        <?
                        $rr=mq("SELECT * FROM manufs ORDER BY `order`, title");
						while($rrow=fetch($rr)){
							 ?><option value=<?=$rrow["id"]?> <?=$rrow["id"]==$row["manuf_id"]?"selected":""?>> <?=$rrow["title"]?></option><?
						}
                        ?>

                        </select><br><br>
			<?

							$r=mq("SELECT c.*, g2c.good_id FROM cats c
							    LEFT JOIN good2cat g2c ON g2c.good_id=".$_REQUEST["edit_id"]." AND c.id=g2c.cat_id
							    ORDER by c.`order`
								");
							while ($row=fetch($r)){
								$menu_link[$row["parent_id"]][]=$row["id"];
								$menu[$row["id"]]=$row;
							}
							$menu[0]["title"]="Меню слева";


							function show_admin_menu($id, $root=false){
								global $menu, $menu_link, $p, $m, $root_id;

								echo "<div style='margin-left: 50px'>

									";
								if ($menu_link[$id])
								foreach ($menu_link[$id] as $row_id){
									echo "<input name=good2cat[$row_id] type=checkbox ".($menu[$row_id]["good_id"]?"checked":"")."> ";
									echo "¤ ".$menu[$row_id]["title"]." (#$row_id)<br>";
									show_admin_menu($row_id);

								}
								echo "</div>";

							}


							    if ($root_id==0){
                                    echo "Отображение товара в категориях:";
									show_admin_menu(0);
								}

			?>
			</td>
			</tr>
			</table>
			</form>

			<?

		}



		$r=mq("SELECT g.* FROM goods g INNER JOIN good2cat g2c ON g2c.good_id=g.id AND g2c.cat_id=$cat_id ORDER by g.`order` ");
		while ($row=fetch($r)){
			$goods[]=$row;
		}

             ?>
             <br><br><a href='.?p=<?=$p?>&add_id=<?=$cat_id?>&cat_id=<?=$cat_id?>' class=green>+ добавить товар</a>
             <br><br>
             <br><br>
             <table  border=1 cellspacing=0 cellpadding=4>
             <?

            if($goods)
			foreach ($goods as $row){
				$row_id=$row["id"];
				$photos=               get_photo($row, true, true);
				echo "<tr><td>".(true?"<img src='../".$photos[0]."' width=40>":"
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;")."
				</td>
				 <td>
				(#$row_id)  </td><td>
				 <a href='.?root_id=$root_id&p=$p&cat_id=$cat_id&m=$m&edit_id=$row_id&parent_title=".urlencode($row["title"])."' style='font-weight: bold'>
				 ¤ ".$row["title"]."</a></td>

				 <td>		<a href='.?root_id=$root_id&p=$p&cat_id=$cat_id&m=$m&del_id=$row_id'><img src='img/delete.png'></a></td>


					 </tr>";


			}

			?>

			</table>
			<?





	}
