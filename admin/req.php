<table border=1><?

$r=mq("SELECT  * FROM requests ORDER BY id DESC");
$z=0;
while ($row=fetch($r)){
		echo "<tr bgcolor=lightgray><td>";

		echo implode("</td><td>", array_keys($row));

		echo "</td></tr>
			";

	$row["good_id"]="<a href='../?p=good&id=".$row["good_id"]."'>url</a>";


	echo implode("</td><td>", $row);

	echo "</td></tr>
	";

?></table><?