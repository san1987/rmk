<form action=. method=post><?

$sql="SELECT * FROM params WHERE is_noneditable=0";

$r=mq($sql);

while($row=mysql_fetch_assoc($r)){
	$name=$row["name"];
	if (isset($_REQUEST[$name])) {		mq("UPDATE params SET `value`='".mysql_real_escape_string($_REQUEST[$name])."' WHERE `name`='".mysql_real_escape_string($name)."'");
		$row["value"] = $_REQUEST[$name];
	}
	echo $row["desc"].

	($row["is_checkbox"]?"<br><input type=radio name=$name value=1 ".($row["value"]?"checked":"")."> Да

	<input type=radio name=$name value=0 ".(!$row["value"]?"checked":"")."> Нет
	 ":

					(strlen($row["value"])>200?
					"<br><textarea rows=10 cols=90 name=".$name." >".htmlspecialchars($row["value"])."</textarea>":

					": <br><input type=text size=80 name=".$name." value='".htmlspecialchars($row["value"])."'>")

	)



	."<br>";
}


?> <br>
<input type=hidden name=p value=<?=$p?>>
<input type=submit>
</form>