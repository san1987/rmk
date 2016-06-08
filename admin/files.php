Эти файлы располагаются в папке files на сервере. Если в параметрах вы ссылаетесь на файл картинки, то он должен быть загружен здесь.

<?



if (!$dir) $dir="../files/";
if (substr($dir, -1, 1)!=="/") $dir.="/";
if ($delfile) echo unlink($dir.$delfile)?"Файл успешно удалён<br><br>":"Ошибка удаления файла $delfile<br><br>";

?>

<br>
<br>
<span class=green>Загрузить новый файл(ы):</span>
<form enctype="multipart/form-data" method="post">
<?
for ($i=1 ; $i<=10; $i++){
	?>
	<input type=file name=newfile[]> <br>
	<?
}
?>
<input type=submit  value='Отправить'>
<input type=hidden  value='<?=$dir?>' name=dir>

</form>
<?


foreach ($_FILES['newfile']['tmp_name'] as $d=> $ff){	$translit_name=      translit_url(   $_FILES['newfile']['name'][$d],false, true);	if (move_uploaded_file($ff  , $dir.$translit_name ))
		echo "Файл успешно загружен на сервер. Можете ссылаться на него , как ".$translit_name.
			" если нужно указать адрес картинки в параметрах, или как ".( $dir.$translit_name)." если вы хотите задать ссылку<br><br><br>";
}
if ($handle = opendir($dir)) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
           $files[]=$file;
        }
    }
    closedir($handle);
}
 ?><h3>Все файлы <?=$dir?></h3><?
sort($files);

echo "<table border=1 cellspacing=0 cellpadding=4><tr><td>Название файла</td><td>Удалить</td><td>Ссылка на файл</td></tr>";

foreach ($files as $file)
	if (is_dir($dir.$file))
		$dirs[]=$file;
	else
		$filess[]=$file;

$extr=explode("/", $dir);
if (array_pop($extr)=="")
	array_pop($extr);

$up_dir=implode("/",$extr);



echo "<tr><td><a href='$PHP_SELF?p=$p&dir=$up_dir'>..</a> </td><td><img src='http://cdn-nus-5.pinme.ru/pin-upload-static/photos/1bc4466bb8c8a307c1da4f92e617d792_m.jpg' width=30></td><td>  </td></tr>";

foreach ($dirs as $file)
		echo "<tr><td><a href='$PHP_SELF?p=$p&dir=$dir"."$file'>$file</a> </td><td><img src='http://cdn-nus-5.pinme.ru/pin-upload-static/photos/1bc4466bb8c8a307c1da4f92e617d792_m.jpg' width=30></td><td>  </td></tr>";
foreach ($filess as $file)
		echo "<tr><td><a href='$dir"."$file'>$file</a> </td><td> <a href='$PHP_SELF?p=$p&p=$p&delfile=$file&dir=$dir'>удалить</a> </td><td> /$dir"."$file </td></tr>";
//  echo "<a href='$dir"."$file'>$file</a> [<a href='$PHP_SELF?m=$m&p=$p&delfile=$file'>удалить</a>]<br>";
echo "</table>";


?>