<?

$slider=array();

$r=mq("SELECT * FROM slider ORDER BY `order`, id");
while($row=fetch($r)){
	 $row["img"]	="files/slider/".$row["id"].".jpg";
	 $row["href"]	=$row["chpu"];
	 $slider[]=$row;


}
