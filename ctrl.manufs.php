<?

$r=mq("SELECT * FROM manufs ORDER BY `order`, id");
while($row=fetch($r)){
	 $row["href"]	=url("manuf", $row);

	 $manuf[]=$row;


}