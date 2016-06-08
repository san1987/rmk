<a href='.?p=<?=$p?>&m=<?=$m?>&site_map=1'>Перегенерировать карту сайта в формате XML</a><br>
<a href='.?p=<?=$p?>&m=<?=$m?>&chpu=1'>Перегенерировать ЧПУ для товаров, категорий и инфостраниц</a><br>
<hr>

<?


$site_host=$_SERVER["SERVER_NAME"];

if ($site_map){
	$fn="../sitemap.xml";
	echo "<a href='$fn'>$fn</a><br>";
	file_put_contents($fn, '<?xml version="1.0" encoding="UTF-8"?>    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9\n">                            ');

	$r=mq("SELECT * FROM cats");
        while ($row=fetch($r)){
					$u=url("catalog", $row);
		        	file_put_contents($fn, '        <url>         <loc>http://'.$site_host."/".$u.'</loc>  </url>                        '."\n", FILE_APPEND);
        }

         $r=mq("SELECT * FROM goods");
        while ($row=fetch($r)){
        	$u=url("good", $row);
        	file_put_contents($fn, '        <url>         <loc>http://'.$site_host."/".$u.'</loc>  </url>                        '."\n", FILE_APPEND);
        }

         $r=mq("SELECT * FROM pages");
        while ($row=fetch($r)){
        	$u=url("page", $row);
        	file_put_contents($fn, '        <url>         <loc>http://'.$site_host."/".$u.'</loc>  </url>                        '."\n", FILE_APPEND);
        }

        $r=mq("SELECT * FROM news");
        while ($row=fetch($r)){
        	$u=url("news", $row);
        	file_put_contents($fn, '        <url>         <loc>http://'.$site_host."/".$u.'</loc>  </url>                        '."\n", FILE_APPEND);
        }


        $r=mq("SELECT * FROM articles");
        while ($row=fetch($r)){
        	$u=url("articles", $row);
        	file_put_contents($fn, '        <url>         <loc>http://'.$site_host."/".$u.'</loc>  </url>                        '."\n", FILE_APPEND);
        }



	file_put_contents($fn, '</urlset>', FILE_APPEND);
}


if($chpu){
	//echo "<iframe width=100% height=400 src='/?make_chpu=1'></iframe>";

	gen_chpu(true);
}

?>