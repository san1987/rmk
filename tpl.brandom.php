<?

require_once "base.php";


include "header.tpl.php";

include "menu.tpl.php";

include "bread.tpl.php";



if(0)
{
			$ss=file_get_contents("descr2.txt");

			$r=mq("SELECT * FROM cats WHERE descr2=''");
			while ($row=fetch($r)){
				$s="";
				while (!trim($s))
				mq($sql="UPDATE cats SET descr2='".mres($s)."' WHERE id=".$row["id"]);
				echo $row["id"]."  $sql <br><br><br><br><br>";

}

if(1){
	$dir = "photos/good/medium/";

    if (is_dir($dir)) {
	    if ($dh = opendir($dir)) {
	        while (($file = readdir($dh)) !== false) {
	            	$files[]=$file;
	        }
	        closedir($dh);
	    }
	}
	//print_r($files);


	$r=mq("SELECT * FROM goods");
	while ($row=fetch($r)){
           		if (!file_exists($fn)){
           				echo "$fn1 $fn";
}