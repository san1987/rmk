<?

include "../func.php";

$num=0;

$info="
370263013 ���������� ��������� CARAMEL 6x40W 230V
405231713 ���������� ��������� Nikos nickel 1x35W
403836013 ���������� ���������� ROSARIO 4x40W 2
431497513 ���������� ���������� BOYCE 1x40W 230V
403846013 ���������� ���������� ROSARIO 9x40W 2
431474813 ���������� ���������� BUCKET 1x40W 230V
370283013 ���������� ��������� CARAMEL 5x40W 230
372271113 ���������� ��������� CAVALLI2x9W 230V
302610613 ���������� ��������� AUDREY1x8W 230V
302611713 ���������� ��������� AUDREY nickel 1x8W
302634313 ���������� ���������� RAMEAU2x60W 230
370253013 ���������� ��������� CARAMEL 3x40W 230V
370293013 ���������� ���������� CARAMEL 3x40W 230V
375668713 ���������� ��������� CASTELLO 5x40W 230V
375678713 ��� CASTELLO wall lamps grey 1x40W 230V
374878613 ��� FOSTER wall lamps rust 1x60W 230V
459383113 ���������� ���������� TEMPLE 1x75W 230V
301991813 ���������� ���������� FAITH White 1x10
370551113 ���������� ���������� GLADYS 5x20W 1
555144813 ���������� ���������� PARABOLIC alum 4
361091113 ���������� ���������� DUBOIS 1x100W 230
421474313 ���������� ��������� VIOLLA Brown 1x60W
302601713 ���������� ��������� AUDREY1x13W 230V
362513013 ���������� ��������� KYRAN 1x60W 230V
372749213 ���������� ���������� RAMEAU1x60W 230V
421803813 ���������� ��������� CASSIE 3x40W 230V
431771713 ���������� ���������� SHALLOW 2x40W 230
370758613 ���������� ��������� STREAM 5x40W 230V
370781713 ���������� ��������� STREAM 2x40W 230
370761713 ���������� ���������� STREAM 6x40W 2
375658713 ���������� ��������� CASTELLO 9x40W 230V
403521713 ���������� ��������� MERCURY 1x150W 230V
302063013 ���������� ���������� ALEXA 1x60W 230
403311713 ���������� ��������� CATALINA 1x55W 230V
670111713 ���������� ���������� SINGER 1x50W 12V
372583113 ���������� ��������� FINN3x23W230V1x35W
405241713 ���������� ��������� NIKOS 3x35W 230V
421593013 ���������� ��������� ALLEGRI1x60W 230V
431593013 ���������� ���������� ALLEGRI1x40W 230V
371053013 ���������� ��������� VIADANA 1x60W 230V
302089313 ���������� ���������� CELESTE antr 2x23
302071113 ���������� ���������� CANDACE 1x40W
374461113 ���������� ��������� FESTA 10x10W 12V
421351113 ���������� ��������� MISTERY 1x300W 2
563844813 ���������� ��������� PERCY 4x42W 230V
421574313 ���������� ��������� KASPAR Brown 3x100
431474313 ���������� ���������� BUCKET 1x40W 230V
403484313 ���������� ��������� CLOVE 3x60W 230
561544813 ���������� �������� VENUS grey 4x50W 230
374833013 ���������� ��������� FLORA 3x40W 230V
555503113 ���������� �������� MINHO 1x50W 230V
332133013 ��� NATHALIE wall lamps black 1x100W 23
361261713 ���������� ��������� GARCIA 4x60W 230V
431464313 ���������� ���������� VIOLLA 1x40W
372553113 ���������� ��������� FINN 3x23W 230V
372555313 ���������� ��������� FINN 3x23W 230V
372585313 ���������� ��������� FINN 3x23W 230V 1x3
422161113 ���������� ��������� MARTI1x23W 230V
362533013 ���������� ��������� KYRAN 1x60W 230V
405281113 ���������� ��������� THOR 10x20W 12V
374843013 ���������� ���������� FLORA 3x40W 230V
404244813 ���������� ��������� MARKKU 1x23W 230
302161713 ���������� ���������� DORA 2x21W 230
404414813 ���������� ��������� KASPAR 3x75W 230V
561564813 ���������� �������� VENUS grey 6x50W 12V
374281113 ���������� ��������� MONTI 4x40W 230V
374261113 ���������� ��������� CALIXA 5x50W 230V
374551813 ���������� ��������� CORELLI White 8x40W
370301713 ���������� ��������� DURABO 8x25W 230V
370311713 ���������� ���������� DURABO 7x25W 2
370611113 ���������� ���������� HUMAN 8x20W 12
372928613 ��� LYRIS wall lamps rust 2x40W 230V
677511713 ���������� ��������� SINGER 1x50W 12V
374188613 ���������� ��������� ARTOIS 1x100W 230V
374311113 ���������� ��������� MARIUS 4x35W 12V
374321113 ��� MARIUS wall lamps chrome 1x35W 12V
361081113 ���������� ��������� DUBOIS 1x100W 23
363353113 ���������� ��������� CLEMENT 3x23W 230V
361271713 ��� GARCIA wall lamps nickel 1x40W 230V
372051713 ���������� ��������� ROSSINI 1x100W 230V
372384813 ���������� ��������� MONTOYA 1x60W 230V
371083013 ��-� ��������� VIADANA 1x60W 230V
405271113 ���������� ��������� THOR 10x20W 12V
431587513 ��-� ���������� ILIO 1x60W 230V
372729213 ���������� ��������� RAMEAU1x60W 230V
405251113 ���������� ��������� ENZO 7x20W 12V
431523013 ���������� ���������� BOVOS1x60W 230V
371063013 ���������� ��������� VIADANA 2x60W 230V
421333113 ���������� ��������� lighting products
555134813 ���������� �������� PARABOLIC alum 3x40W
332151713 ��� DORA wall lamps nickel 1x14W 230V
403471713 ���������� ��������� DIABELLI 1x28W 230V
375484813 ���������� ��������� ARBEAU alum 1x60W
431463113 ���������� ���������� VIOLLA 1x40W 230V
431433013 ���������� ���������� BELLINI 1x60W 230V
455593113 ��� VIOLLA wall lamps white 1x60W 230V
404414313 ���������� ��������� KASPAR 3x75W 23
421574813 ���������� ��������� KASPAR 3x100W 230V";

$all = explode("\n", $info);
$goods=array();
foreach($all as $s) {	$art = intval($s);	$s = str_replace($art." ", "", $s);
	$full=$s;
	$s = str_ireplace(array("����������","����������","����������", "����������", "���������", "���������", "���", "���������", "��-�"), "", $s);
	$goods[$art] ="<input type=text size=100 value='".trim($s)."'>".$full;
}


$dir="../pic/tmp/";
$dir1="../pic/tmp2/";
$f=0;
$nofind=0;

if ($handle = opendir($dir)) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
            //echo "$dir $file<br>\n";
            $art = intval($file);
            $art_num=$art;

            $art = substr($art, 0,5)."/".substr($art, 5, 2)."/".substr($art, 7 ,2);
            //echo $art;
            $sql="SELECT * FROM goods WHERE art='$art'";
            $r = mysql_query($sql);
            //echo "ok001 ";
            $num++;
            echo "$num)   <a target=_blank href='http://www.lightinside.ru/search.php?q=$art'>url</a> <input size=10 value='�������������: Eseo'><input size=10 value='$art'>".$goods[$art_num]."<br>";

            if ($row = mysql_fetch_array($r)) if (!file_exists("../pic/medium/1183_0.jpg")){
            	$i=0;
            	//if ($file!=$art.".jpg") $i=1;
            	$fn=$row["id"]."_".$i.".jpg";
            	//echo "$file -> $fn<br>";
            	copy($dir.$file, $dir1.$fn);
            	//echo "ok002 ";

				$res = addpic($dir1.$fn, $row["id"], 0);
            	echo ($res?"OK ":" ������ ��� ���� �������� ").$row["id"]."<br>";
            	//echo "ok004 ";
            	$f++;            }else echo "$art ���������� ../pic/medium/".$row["id"]."_0.jpg<br>";
            else{
	            echo "�� ������ ��� '$art'  <br>";
	            $nofind++;
	            }
        }
    }
    closedir($handle);
}


    echo "<br>�����: ".$f;
    echo "<br>�� ��������� $nofind ";


    //////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////

    $r=mq($sql="SELECT  SQL_CALC_FOUND_ROWS g.*, p.price, c.count FROM goods g
		LEFT OUTER JOIN price p ON p.art=g.art
		LEFT OUTER JOIN count c ON c.art=g.art
		WHERE DAYOFYEAR(`date`)=DAYOFYEAR(NOW())");

$r1=mq("SELECT FOUND_ROWS() ");
$all_count = mysql_fetch_array($r1);
$all_count = $all_count [0];

echo "<b><span style='font-size: 15px'>".($name0==""?$name1:$name0)."</span></b> ";

echo "(����� �������: $all_count)<br><br>";




//////////////////*
$u=".?m=$m&p=$p&c1=$c1&c2=$c2&cat=".intval($cat);
$nav = "<table width=100%><tr><td aling=left valign=top>";

$page_count = ceil($all_count/$perpage);

if ($page_count>1){
	 $nav .=  "����� ��������: ";
	for ($i=0; $i<$page_count ; $i++) $nav .=  ($pn==$i?$i:"<a href=$u&perpage=$perpage&pn=$i>$i</a>")." ";
}

$nav .= "</td><td align=right valign=top>������� �� ��������: ";

for ($i=0; $i<count($per_pages); $i++){
	$x=$per_pages[$i];
    $nav .= (($x!=$perpage)?"<a href=$u&perpage=$x&pn=".floor($perpage*$pn/$x).">".$x."</a>":$x)." ";
}
$nav .= "</td></tr></table>";
///////////




?>