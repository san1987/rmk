id;available;url;price;currencyId;category;picture;name;description
<?

include "../base.php";
include "../func.php";


$sql="SELECT * FROM params";
$r = mq($sql);
$bd_values = array();
while ($row = mysql_fetch_assoc($r)) $bd_values[$row["name"]]=$row["value"];

function gp($name){
	global $bd_values;
	return $bd_values[$name];
}


function en($s){
	//$s=html_entity_decode($s);
	$s=strip_tags($s);	$s=str_replace(array("#9658", "\n", "\r", '"', "'", "&", ";"), " ", $s);
	$s=trim($s);
	return $s;}

$ids=array();

$r=mq($sql="SELECT   g.*, p.price, c.count, ca.name AS ca_name , g.id AS gid FROM goods g
		INNER   JOIN price p ON p.art=g.art
		LEFT   JOIN count c ON c.art=g.art
		INNER  JOIN cats ca ON ca.id=g.cat
		WHERE   ca.toYML=1

");

while ($row=mysql_fetch_assoc($r)) if (array_search($id=$row["gid"], $ids)===false) if (trim($row["name"])!=""){
	$ids[]=$id;
	$url="http://".$_SERVER["HTTP_HOST"]."/?p=good&id=$id";
	//echo "<b>".$row["name"]." Model $id</b>, ART: ".$row["art"]." ЦЕНА:".$row["price"].", НАЛИЧИЕ: ".$row["count"]." <a href=''>ссылка</a><br>";
    $cat=en(gp("yml_cat_name"));   //=en($row["ca_name"])

	$s="";
	$s.= $id.";";
	$s.= ($row["count"]?"true":"false").";";
	$s.= $url.";";
	$s.= ($price=$row["price"]).";";
	$s.= "RUR;";
	$s.= ($cat).";";
	$s.= "http://".$_SERVER["HTTP_HOST"]."/pic/huge/".$id."_0.jpg;";
	$s.= en($row["name"]).";";
	$s.= en($row["desc"])."";
	$s.= "\n";

	//$s=iconv("cp1251", "UTF-8", $s);
	if ($price && $cat)
	echo $s;

	//print_r($row);
	//59	true	http://bestbestbest.ru/shop/UID_59.html?from=yml
	//4990	RUR	SHTURMANN	http://bestbestbest.ru/UserFiles/Image/img59_14747s.jpg	SHTURMANN Link 300	"SHTURMANN Link 300Широкоформатный дисплей 4,3”.Информация о&amp;nbsp;пробках.GPRS-интернет. ICQ-клиент. E-mail.Предупреждения о камерах измерения скорости.Карты&amp;nbsp;СитиГид-МТС, SHTURMANN.Просмотр схем перекрестков.&amp;nbsp;Просмотр&amp;nbsp;JPEG, часы, калькулятор.Встроенная память 2Gb."
}
?>