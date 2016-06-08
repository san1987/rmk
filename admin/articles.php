<script type="text/javascript" src="../tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="tinyMCE_init.js"></script>

Редактирование содержимого пользовательских страниц, добавление новой страницы:<br><br><?


$newpage_name="newpage";
if ($newpage) {   mq("INSERT INTO  articles(`name`, `title`, `cr`) VALUES ('$newpage_name', 'Страница ".time()."', NOW()) ");
	}


if ($delpage)	mq("DELETE FROM   articles WHERE id='".intval($delpage)."'");

if (isset($id)){
	$id=intval($id);



	//if (trim($newurl_name)=="") $newurl_name=translit_url($name);
	if ($save){

		if($_FILES['pic']['tmp_name'])
	            imgresize($_FILES['pic']['tmp_name'], "../files/articles/".$id.".jpg", 175, 152);

		$newurl_name= translit_url($newurl_name);
	 mq($sql="UPDATE   articles SET
		text='".mres($newtext)."',
		title='".mres($newtitle)."',
		chpu='".mres($newchpu)."',
		name='".mres($newname)."',
		in_left='".mres($in_left)."',
		`order`='".mres($order)."',
		`cr`='".mres($cr)."',
		`small_text`='".mres($small_text)."',

		meta_title 	 	 ='".mres($newmetatags)."',
		meta_descr='".mres($newmetatext)."'





		 WHERE id='$id'");
		 $fn="articles/$newurl_name".".php";
		 if ($is_php)
		 	file_put_contents($fn, $newtext);
		 else
		 	@unlink($fn);
		}

	$sql="SELECT * FROM  articles WHERE id='$id' ";
	$r=mq($sql);
	if ($row=mysql_fetch_assoc($r)){
		if($row["is_php"]) {
			$fn="articles/".$row["url_name"].".php";
			$row["text"]=file_get_contents($fn);
		}
	echo "
		<a href='$PHP_SELF?p=$p&p=$p&delpage=$id'>удалить страницу</a><br><br>
		<form enctype='multipart/form-data' method=post  action='.?p=$p' method=post>Название:  ".$row["title"]." <br>
                     <br>
	Название  <br>
	<input type=text name=newtitle value='".$row["title"]."' size=80><br><br>


	Идентификатор<br>
	<input type=text name=newname value='".$row["name"]."' size=80><br><br>


	Название латиницей (допустимо использовать тире) (для <a href='http://ru.wikipedia.org/wiki/%D7%CF%D3_(%C8%ED%F2%E5%F0%ED%E5%F2)'>ЧПУ</a> ):<br>
	<input type=text name=newchpu value='".$row["chpu"]."' size=80><br><br>


	Отображать в меню слева?<br>
	<input type=text name=in_left value='".$row["in_left"]."' size=80><br><br>

	Порядок вывода<br>
	<input type=text name=order value='".$row["order"]."' size=80><br><br>

    	Дата статьи<br>
	<input type=text name=cr value='".$row["cr"]."' size=80><br><br>


	<!--Выводить страницу в меню:<br>
	<input type=checkbox value=1 name=menu_visible  ".($row["menu_visible"]?"checked":"")."> Да<br>

	Это страница по умолчанию:<br>
	<input type=checkbox value=1 name=is_default  ".($row["is_default"]?"checked":"")."> Да<br>

            <br>

    Название пункта меню:<br>
	<input type=text name=newmenu_name value='".$row["menu_name"]."' size=40><br><br>
            <br>

	Тип страницы:<br>
	<input type=radio name=is_php value=0 ".(!$row["is_php"]?"checked":"")."> HTML-страница<br>
	<input type=radio name=is_php value=1 ".($row["is_php"]?"checked":"")."> PHP-страница<br>
	<br>
    -->

	<b>Текст страницы:</b><br>
	Если вы хотите вставить сюда текст из ворда, лучше всего делать это через блокнот. Сначала скопируйте текст из ворда в блокнот, а затем из блокнота сюда.
	<br>При этом размеры шрифтов и цвета будут убраны. Если вам необходимо их восстановить, разметьте затем текст тут в админке заново. Если их слишком много, то копируйте сюда напрямую из MSWORD,
	но это нежелательно делать лишний раз, т.к. MSWORD вставляет в текст много лишних тэгов, которые не очень полезны для сайта.<br>
	Ссылки внутри сайта на внутренние файлы и страницы должны начинаться со слеша <b>/</b> например <i>/files/dokument.doc</i>
	<textarea ".(!$row["is_php"]?" class=mceTextarea ":"")." name=newtext cols=200 rows=40>".htmlspecialchars($row["text"])."</textarea>
	<br><br>

	<b>Текст анонс:</b><br>
	Если вы хотите вставить сюда текст из ворда, лучше всего делать это через блокнот. Сначала скопируйте текст из ворда в блокнот, а затем из блокнота сюда.
	<br>При этом размеры шрифтов и цвета будут убраны. Если вам необходимо их восстановить, разметьте затем текст тут в админке заново. Если их слишком много, то копируйте сюда напрямую из MSWORD,
	но это нежелательно делать лишний раз, т.к. MSWORD вставляет в текст много лишних тэгов, которые не очень полезны для сайта.<br>
	Ссылки внутри сайта на внутренние файлы и страницы должны начинаться со слеша <b>/</b> например <i>/files/dokument.doc</i>
	<textarea ".(!$row["is_php"]?" class=mceTextarea ":"")." name=small_text cols=200 rows=40>".htmlspecialchars($row["small_text"])."</textarea>
	<br><br>

	Метатэги:<br>
	<textarea name=newmetatags cols=100 rows=3>".$row["meta_title"]."</textarea>
	<br><br>


	Метатекст:<br>
	<textarea name=newmetatext cols=100 rows=3>".$row["meta_descr"]."</textarea>
	<br><br>

	Порядок вывода:<br>
	<input type=text size=10 name=neworder value='".$row["order"]."'><br><br>
            <br>  " ;
            ?>
             Пиктограмма  : <br>
		        <input type=file name='pic' value='<?=$p?>'>
		        <br>    <br>
		        <?="<img src='../files/articles/".$row["id"].".jpg'>"?>
		        <br>
		        <?

            echo "


	Комментарий (не отображается на сайте, только для админки):<br>
	<input type=text name=newcomment value='".$row["comment"]."'><br><br>



		<input type=hidden name=url_name value=$url_name>
		<input type=hidden name=id value=".$row["id"].">
		<input type=hidden name=save value=1>
		<input type=hidden name=m value=$m><br><input type=submit value='Сохранить'></form><br><br><br>";

     }
}
       ?><a href='<?$PHP_SELF?>?m=<?=$m?>&p=<?=$p?>&newpage=1' class=green>+ Новая страница</a><br><h3>Все страницы</h3><?
$sql="SELECT * FROM  articles  ORDER BY cr,id  DESC";
$r=mq($sql);

echo "<table border=1 cellspacing=0 cellpadding=4><tr><td>Название для ссылки</td><td>Комментарий</td><td>Ссылка на страницу внутри сайта</td></tr>";
while ($row=mysql_fetch_assoc($r)) echo "<tr><td><img src='../files/articles/".$row["id"].".jpg' style=' vertical-align: middle;'></td><td>".($href="<a href='$PHP_SELF?p=$p&id=".$row["id"]."'>").$row["title"]."</a> </td><td>".($row["url_name"]==$newpage_name?
			"<font color=red>это вновь созданная вами страница. $href отредактируйте</a> её параметры</font>":"").$row["comment"]." </td><td>/articles/".$row["chpu"]."</td>
			<td>		<a href='$PHP_SELF?p=$p&p=$p&delpage=".$row["id"]."'><img src='img/delete.png'></a></td>

			</tr>";
echo "</table>";

