<?

$r=mq("SELECT * FROM manufs ORDER BY `order`, id");
while($row=fetch($r)){	 $row["img"]	="files/manufacturers/".$row["id"].".jpg";
	 $row["href"]	=url("manuf", $row);

	 $manuf[]=$row;


}
