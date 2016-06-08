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
				while (!trim($s))					$s=mb_substr($ss, rand(1,mb_strlen($ss)-1000), 1000);
				mq($sql="UPDATE cats SET descr2='".mres($s)."' WHERE id=".$row["id"]);
				echo $row["id"]."  $sql <br><br><br><br><br>";				}

}

if(1){
	$dir = "photos/good/medium/";

    if (is_dir($dir)) {
	    if ($dh = opendir($dir)) {
	        while (($file = readdir($dh)) !== false) {	        	if ($file{0}!='.')
	            	$files[]=$file;
	        }
	        closedir($dh);
	    }
	}
	//print_r($files);


	$r=mq("SELECT * FROM goods");
	while ($row=fetch($r)){           echo $row["id"]." ";           for($i=0; $i<6; $i++){           		$fn=$dir."".$row["id"]."_".$i.".jpg";
           		if (!file_exists($fn)){           				copy($fn1=$dir."".$files[rand(0,count($files)-1)], $fn);
           				echo "$fn1 $fn";           			}           }	}
}