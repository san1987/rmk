<?


function url($ctrl, $row=false, $chpu=true){
	global  $is_spec, $filter;
	switch($ctrl){		case "about":
		     return "about/";
		break;
		case "sale":
		     return "sale/";
		break;		case "page":
			if ($chpu)
				return "".$row["name"]."/";
			else
				return ".?p=page&n=".$row["chpu"];
		break;

		case "manuf":
			if ($chpu)
				return "".$row["chpu"]."/";
			else
				return ".?p=catalog&filter=".$row["id"];
		break;

		case "catalog":
			if ($chpu)
				return "".$row["chpu"]."/";
			else
				return ".?p=catalog&id=".$row["id"]."&is_spec=$is_spec&filter=$filter&";
		break;

		case "news":
            if ($chpu)
				if ($row)
					return "about/news/".$row["id"]."/";
				else
					return "about/news"."/";
			else
				if ($row)
					return ".?p=news&id=".$row["id"];
				else
					return ".?p=news";
		break;

		case "articles":
			if ($chpu)
				if ($row)
					return "about/articles/".$row["id"]."/";
				else
					return "about/articles"."/";
			else
				if ($row)
					return ".?p=articles&id=".$row["id"];
				else
					return ".?p=articles";
		break;

		case "good":
			if ($chpu)
				return ($row["cat3chpu"]?$row["cat3chpu"]:($row["cat2chpu"]?$row["cat2chpu"]:($row["cat1chpu"]?$row["cat1chpu"]:"")))."/".$row["mchpu"]."/".$row["chpu"]."/";
			else
				return ".?p=good&id=".$row["id"]."&chpu=".$row["chpu"];
		break;







	}}

        /*
function imgresize($src, $dest, $w,$h){
	$src = imagecreatefromjpeg($src);
	if ($src){
		$w1 = imagesx ($src);
		$h1 = imagesy ($src);
		$ratio1 = $w1/$w; $ratio2 = $h1/$h;
		//echo "need $w $h ex $w1 $h1 ratio $ratio1 $ratio2 ";
		if ($ratio1<$ratio2) $ratio1=$ratio2;
		if ($ratio1<1)  $ratio1=1;
		//echo "need $w $h ex $w1 $h1 ratio $ratio1 $ratio2 ";
		$w=$w1/$ratio1; $h=$h1/$ratio1;
		//echo "need $w $h ex $w1 $h1 ratio $ratio1 $ratio2 ";
		$big_image = imagecreatetruecolor($w, $h);
		//imagecopyresized ($big_image, $src, 0,0,0, 0, $w, $h, $w1,$h1);
		imagecopyresampled($big_image, $src, 0,0,0, 0, $w, $h, $w1,$h1);
		imagejpeg($big_image, $dest);
		echo "Создан $dest<br>";
		return true;
		}
	return false;
}
          */


function getCellValue($aSheet, $cellOrCol, $row = null){
    //column set by index
    if(is_numeric($cellOrCol)) {
        $cell = $aSheet->getCellByColumnAndRow($cellOrCol, $row);
    } else {
        $lastChar = substr($cellOrCol, -1, 1);
        if(!is_numeric($lastChar)) { //column contains only letter, e.g. "A"
           $cellOrCol .= $row;
        }

        $cell = $aSheet->getCell($cellOrCol);
    }
    $val = $cell->getValue();
    return $val;
}



 function __file_get_url_contents( $remote_url ){}
 function __url_get_contents( $remote_url, $timeout ){}


function get_photo($row, $min=true, $array=false){	if (!$row["photos"])
		if ($array)
			return array(
				"photos/good/".($min?"min":"medium")."/".$row["id"]."_"."0".".jpg",
				"photos/good/".($min?"min":"medium")."/".$row["id"]."_"."1".".jpg",
				"photos/good/".($min?"min":"medium")."/".$row["id"]."_"."2".".jpg",
				"photos/good/".($min?"min":"medium")."/".$row["id"]."_"."3".".jpg",
				"photos/good/".($min?"min":"medium")."/".$row["id"]."_"."4".".jpg",
				"photos/good/".($min?"min":"medium")."/".$row["id"]."_"."5".".jpg",
				"photos/good/".($min?"min":"medium")."/".$row["id"]."_"."6".".jpg");
		else
			return "photos/good/".($min?"min":"medium")."/".$row["id"]."_"."0".".jpg";
	else{		$p=explode("|", $row["photos"]);
		$res="files/goods/".($min?"min":"medium")."/".$p[0];
		if ($array) {			$res=array();
			foreach ($p as $t)
				$res[]="files/goods/".($min?"min":"medium")."/".$t;		}
		return $res;
	}}

function mb_replace($search, $replace, $subject, &$count=0) {
    if (!is_array($search) && is_array($replace)) {
        return false;
    }
    if (is_array($subject)) {
        // call mb_replace for each single string in $subject
        foreach ($subject as &$string) {
            $string = &mb_replace($search, $replace, $string, $c);
            $count += $c;
        }
    } elseif (is_array($search)) {
        if (!is_array($replace)) {
            foreach ($search as &$string) {
                $subject = mb_replace($string, $replace, $subject, $c);
                $count += $c;
            }
        } else {
            $n = max(count($search), count($replace));
            while ($n--) {
                $subject = mb_replace(current($search), current($replace), $subject, $c);
                $count += $c;
                next($search);
                next($replace);
            }
        }
    } else {
        $parts = mb_split(preg_quote($search), $subject);
        $count = count($parts)-1;
        $subject = implode($replace, $parts);
    }
    return $subject;
}

function drob($d) {
	return  str_replace(".", ",", sprintf("%01.2f", $d));
}

function i($s) {
	return 	mb_convert_encoding ($s ,"UTF-8" , "Windows-1251" );
	return $s;// iconv("WINDOWS-1251", "UTF-8", $s);
}


function ucfirst_rus($s){
	$s=trim($s);
	$s1="ЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮ";
	$s2="йцукенгшщзхъфывапролджэячсмитьбю";
	$i=strpos($s2, $s{0});
	if ($i!==false) $s{0}=$s1{$i};
	return $s;
}

function num2str($num) {
    $nul='ноль';
    $ten=array(
        array('','один','два','три','четыре','пять','шесть','семь', 'восемь','девять'),
        array('','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять'),
    );
    $a20=array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать');
    $tens=array(2=>'двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят' ,'восемьдесят','девяносто');
    $hundred=array('','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот','восемьсот','девятьсот');
    $unit=array( // Units
        array('копейка' ,'копейки' ,'копеек',	 1),
        array('рубль'   ,'рубля'   ,'рублей'    ,0),
        array('тысяча'  ,'тысячи'  ,'тысяч'     ,1),
        array('миллион' ,'миллиона','миллионов' ,0),
        array('миллиард','милиарда','миллиардов',0),
    );
    //
    list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($num)));
    $out = array();
    if (intval($rub)>0) {
        foreach(str_split($rub,3) as $uk=>$v) { // by 3 symbols
            if (!intval($v)) continue;
            $uk = sizeof($unit)-$uk-1; // unit key
            $gender = $unit[$uk][3];
            list($i1,$i2,$i3) = array_map('intval',str_split($v,1));
            // mega-logic
            $out[] = $hundred[$i1]; # 1xx-9xx
            if ($i2>1) $out[]= $tens[$i2].' '.$ten[$gender][$i3]; # 20-99
            else $out[]= $i2>0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
            // units without rub & kop
            if ($uk>1) $out[]= morph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
        } //foreach
    }
    else $out[] = $nul;
    $out[] = morph(intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]); // rub
    $out[] = $kop.' '.morph($kop,$unit[0][0],$unit[0][1],$unit[0][2]); // kop
    return trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));
}

/**
 * Склоняем словоформу
 * @ author runcore
 */
function morph($n, $f1, $f2, $f5) {
    $n = abs(intval($n)) % 100;
    if ($n>10 && $n<20) return $f5;
    $n = $n % 10;
    if ($n>1 && $n<5) return $f2;
    if ($n==1) return $f1;
    return $f5;
}

function sum_text($d){
	return num2str($d);
}

function imgresize($src_file, $dest, $w,$h, $field=true){
	$src = @imagecreatefromjpeg($src_file);
	if (!$src) $src = @imagecreatefrompng($src_file);
	if (!$src) $src = @imagecreatefromwbmp($src_file);
	$w_need=$w;
	$h_need=$h;

	if ($src){
		$w1 = imagesx ($src);
		$h1 = imagesy ($src);
		$ratio1 = $w1/$w; $ratio2 = $h1/$h;
		//echo "need $w $h ex $w1 $h1 ratio $ratio1 $ratio2 ";
		if ($ratio1<$ratio2) $ratio1=$ratio2;
		if ($ratio1<1)  $ratio1=1;
		//echo "need $w $h ex $w1 $h1 ratio $ratio1 $ratio2 ";
		$w=$w1/$ratio1; $h=$h1/$ratio1;
		//echo "need $w $h ex $w1 $h1 ratio $ratio1 $ratio2 ";
		$big_image = imagecreatetruecolor($field?$w_need:$w, $field?$h_need:$h);
		if($field){
			$white = imagecolorallocate($big_image, 255, 255, 255);
			imagefilledrectangle ($big_image, 0, 0, $w_need, $h_need, $white);
		}


		imagecopyresampled($big_image, $src, 0+$field?($w_need-$w)/2:0,0+$field?($h_need-$h)/2:0,0, 0, $w, $h, $w1,$h1);
		imagejpeg($big_image, $dest);
		echo "Создан $dest<br>";
		return true;
	}else
		echo "Не удалось открыть файл $src_file<br>";
	return false;
}

$list_size=160;




$sql="SELECT * FROM params";
$r = mq($sql);
$bd_values = array();
while ($row = mysql_fetch_assoc($r)) $bd_values[$row["name"]]=$row["value"];

function bd_value($name){
	global $bd_values;
	return $bd_values[$name];
}

function gp($name){
	return bd_value($name);
}


function br($br){
	return nl2br($br);
//	return str_replace("\n", "<br>", $br);
	}



function good_url($id){
	$r=mq("SELECT g.chpu_name AS gc, c1.chpu_name AS c1c, c2.chpu_name AS c2c, c3.chpu_name AS c3c, c4.chpu_name AS c4c, c5.chpu_name AS c5c,
		c6.chpu_name AS c6c  FROM goods g


			LEFT JOIN cats c1 ON c1.id=g.cat
			LEFT JOIN cats c2 ON c2.id=c1.parent
			LEFT JOIN cats c3 ON c3.id=c2.parent
			LEFT JOIN cats c4 ON c4.id=c3.parent
			LEFT JOIN cats c5 ON c5.id=c4.parent
			LEFT JOIN cats c6 ON c6.id=c5.parent

						WHERE g.id=".$id);
		$row1=fetch($r);


		$u="/catalog/"./* ($row1["c6c"]?$row1["c6c"]."/":"").($row1["c5c"]?$row1["c5c"]."/":"").($row1["c4c"]?$row1["c4c"]."/":"").($row1["c3c"]?$row1["c3c"]."/":"").
			($row1["c2c"]?$row1["c2c"]."/":"").($row1["c1c"]?$row1["c1c"]."/":"").*/ $row1["gc"]."/";
		return $u;
}


function cat_url($id){


		$r=mq("SELECT  c1.chpu_name AS c1c  FROM  cats c1


						WHERE c1.id=".$id);



		$row1=fetch($r);


		$u="/catalog/"./* ($row1["c6c"]?$row1["c6c"]."/":"").($row1["c5c"]?$row1["c5c"]."/":"").($row1["c4c"]?$row1["c4c"]."/":"").($row1["c3c"]?$row1["c3c"]."/":"").
			($row1["c2c"]?$row1["c2c"]."/":"").*/($row1["c1c"]?$row1["c1c"]."/":"") ;
		return $u;
}


function menu_url($id){

		$r=mq("SELECT * FROM menu WHERE id=".intval($id));
		$row = fetch($r);  // print_r($row);
		return "/menu/".$row["chpu_name"]."/";
}








function mime_header_encode($str, $data_charset, $send_charset) {
  if($data_charset != $send_charset) {
    $str = iconv($data_charset, $send_charset, $str);
  }
  return '=?' . $send_charset . '?B?' . base64_encode($str) . '?=';
}



function send_mime_mail(
                        $email_to, // email получателя
                        $subject, // тема письма
                        $body // текст письма
                        ,$email_from=false
                        ) {

                        global $admin_email;
                        if ($email_from===false) $email_from=  $admin_email;
  $data_charset = 'CP1251';
  //$send_charset = 'KOI8-R';
  $send_charset = 'UTF-8';


  // echo "Отправлено письмо на $email_to<br>";
  $to =$email_to;


  $subject = mime_header_encode($subject, $data_charset, $send_charset);
  $from =   $email_from ;
  if($data_charset != $send_charset) {
    $body = iconv($data_charset, $send_charset, $body);
  }
  $headers = "From: $from\r\n";
  $headers .= "Content-type: text/html; charset=$send_charset\r\n";
  return 	mail($to, $subject, $body, $headers);
}


function cut_digit_url($url){
	$url="@".$url;
	$changed=true;
	while ($changed){
		$changed=false;
		for ($i=0; $i<=9; $i++)  {
			$url=mb_replace("@".$i, "@", $url, $count);
			$changed=   $changed ||    $count>0;
		}
	}       //http://forumlocal.ru/showthreaded.php?Cat=&Board=automoto&Number=12184760&fullview=&src=&o=&vc=1
   	$url=mb_replace("@-", "", $url);
	$url=mb_replace("@", "", $url);
	return $url;
}

function do_translit($st) {
     $replacement = array(
         "й"=>"i","ц"=>"ts","у"=>"u","к"=>"k","е"=>"e","н"=>"n",
         "г"=>"g","ш"=>"sh","щ"=>"sch","з"=>"z","х"=>"h","ъ"=>"",
         "ф"=>"f","ы"=>"i","в"=>"v","а"=>"a","п"=>"p","р"=>"r",
         "о"=>"o","л"=>"l","д"=>"d","ж"=>"zh","э"=>"ie","ё"=>"io",
         "я"=>"ia","ч"=>"ch","с"=>"s","м"=>"m","и"=>"i","т"=>"t",
         "ь"=>"","б"=>"b","ю"=>"iu",
         "Й"=>"i","Ц"=>"ts","У"=>"u","К"=>"k","Е"=>"e","Н"=>"n",
         "Г"=>"g","Ш"=>"sh","Щ"=>"sch","З"=>"z","Х"=>"h","Ъ"=>"",
         "Ф"=>"f","Ы"=>"i","В"=>"v","А"=>"a","П"=>"p","Р"=>"r",
         "О"=>"o","Л"=>"l","Д"=>"d","Ж"=>"zh","Э"=>"ie","Ё"=>"io",
         "Я"=>"ia","Ч"=>"ch","С"=>"s","М"=>"m","И"=>"i","Т"=>"t",
         "Ь"=>"","Б"=>"b","Ю"=>"iu", " "=>"-" ,

                 "_" => "-",   "`" => "",       "^" => "",

	"," => "", ":" => "", "\"" => "", "'" => "", "<" => "", ">" => "", "«" => "", "»" => ""  ,


     );

     foreach($replacement as $i=>$u) {
         $st = mb_eregi_replace($i,$u,$st);
     }
     return $st;
 }


function translit_url($text, $id=false, $nocut=false) {
    echo $text;
    $text=strip_tags($text);
	$simplePairs = array( "а" => "a" , "л" => "l" , "у" => "u" , "б" => "b" ,
	 "м" => "m" , "т" => "t" , "в" => "v" , "н" => "n" , "ы" => "y" ,
	 "г" => "g" , "о" => "o" , "ф" => "f" , "д" => "d" , "п" => "p" , "и" => "i" , "р" => "r" , "А" => "A" ,
	  "Л" => "L" , "У" => "U" , "Б" => "B" , "М" => "M" , "Т" => "T" , "В" => "V" , "Н" => "N" , "Ы" => "Y" ,
	   "Г" => "G" , "О" => "O" , "Ф" => "F" , "Д" => "D" , "П" => "P" , "И" => "I" , "Р" => "R" ,
	    "з" => "z" , "ц" => "c" , "к" => "k" , "ж" => "zh" , "ч" => "ch" ,
	    "х" => "kh" , "е" => "e" , "с" => "s" , "ё" => "jo" , "э" => "eh" , "ш" => "sh" , "й" => "jj" ,
	     "щ" => "shh" , "ю" => "ju" , "я" => "ja" , "З" => "Z" , "Ц" => "C" , "К" => "K" ,
	      "Ж" => "ZH" , "Ч" => "CH" , "Х" => "KH" , "Е" => "E" , "С" => "S" , "Ё" => "JO" ,
	      "Э" => "EH" , "Ш" => "SH" , "Й" => "JJ" , "Щ" => "SHH" , "Ю" => "JU" , "Я" => "JA" ,
	       "Ь" => "" , "Ъ" => "" , "ъ" => "" , "ь" => "" ,   "_" => "-", "`" => "", "^" => "",
	        " " => "-", "." => ".",
	"," => "", ":" => "", "\"" => "", "'" => "", "<" => "", ">" => "", "«" => "", "»" => ""  );

	$res="";
	for($i=0; $i<mb_strlen($text);$i++){
		$c=mb_substr($text,$i,1);  echo "$c .";
		if (isset($simplePairs[$c]))
			$res.= $simplePairs[$c];
		else if (mb_strpos("qwertyuiopasdfghjklzxcvbnm1234567890", mb_strtolower($c))!==false)
			$res.= $c;


	}





	$count=1;
	$res=mb_replace("-", " ", $res);
	//$res=trim($res);
	$res=mb_replace(" ", "-", $res);



	while ($count)
		$res=mb_replace("--", "-", $res, $count);



	if (!$nocut) $res=cut_digit_url($res);


	return mb_strtolower($res.($id!==false?"-$id":""));
}



function gen_chpu($for_all=false, $list=0){

	    if (!$list   ||   (  $list & 0x1  ) )	{
			   $r=mq("SELECT * FROM cats".(!$for_all?" WHERE chpu=''":""));
		        while ($row=fetch($r)){
		        	$name=do_translit($row["title"]);//
		        	//$name=translit_url($row["title"]);
		        	//echo $row["title"]."--->".$name."<br><br>";
		        	mq("UPDATE cats SET chpu='$name' WHERE id=".$row["id"]);
		        }

        }

        	    if (!$list   ||   (  $list & 0x2  ) )	{

	         $r=mq("SELECT * FROM goods".(!$for_all?" WHERE chpu=''":""));
	        while ($row=fetch($r)){
	        	$name= do_translit($row["title"]);
	        	//$name= translit_url($row["title"]);
	        	mq("UPDATE goods SET chpu='$name' WHERE id=".$row["id"]);
	        }
	    }

	       if (!$list   ||   (  $list & 0x2  ) )	{

	         $r=mq("SELECT * FROM    manufs".(!$for_all?" WHERE chpu=''":""));
	        while ($row=fetch($r)){
	        	$name= do_translit($row["title"]);
	        	//$name= translit_url($row["title"]);
	        	mq("UPDATE  manufs SET chpu='$name' WHERE id=".$row["id"]);
	        }
	    }

	   	if (!$list   ||   (  $list & 0x4  ) )	{

					        $r=mq("SELECT * FROM pages ".(!$for_all?" WHERE chpu=''":""));
					        while ($row=fetch($r)){
					        	$name=do_translit($row["title"]);
					        	//$name= translit_url($row["title"]);
					        	mq("UPDATE pages SET chpu='$name' WHERE id=".$row["id"]);
					        }
        }
        echo "ok";
}














