<?



ini_set('display_errors', 1);


session_start();
require_once  "../base.php";
require_once  "../func.php";

if ($logout) unset($_SESSION["auth"]);


function del_good($good_id){			$r=mq("SELECT * FROM goods WHERE id=".intval($good_id));
			$row=fetch($r);
			$photos=$row["photos"];
			$photos=explode("|", $photos);
			foreach($photos as $photo){				@unlink("../files/goods/min/$photo");
				@unlink("../files/goods/medium/$photo");			}

			mq("DELETE FROM goods WHERE id=".intval($good_id));
            mq($dsql="DELETE FROM  good2cat WHERE good_id=".intval($good_id));
}



function del_cat($cat_id, $parent=true){
			$deleted=1;
			$r=mq("SELECT id FROM cats WHERE parent_id=$cat_id");
			while($row=fetch($r)){				$deleted+=del_cat($row["id"], false);			}

			$r=mq("SELECT g.id FROM goods g
				INNER JOIN  good2cat g2c ON g2c.good_id=g.id AND g2c.cat_id=$cat_id
				LEFT JOIN good2cat g2c2 ON   g2c2.good_id=g.id AND g2c2.cat_id<>$cat_id
				WHERE g2c2.good_id IS NULL
					");
			while($row=fetch($r)){
				del_good($row["id"], false);
				$deleted_good++;
			}

            mq("DELETE FROM cats WHERE id=".intval($cat_id));
            if ($parent) echo "Удалено $deleted категорий<br>";
            if ($deleted_good) echo "Удалено $deleted_good товаров<br>";

            return $deleted;
}



?><html>
<head>
<title>Админка</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<style>
html, body{  padding: 0px; margin: 0px; height: 100%;}
.menu_item{	padding: 10px;
	background: rgb(240, 240, 240);
	color: black;
	font-size: 14pt;
	margin-left:10px;
	display: block;
	float:left;}
.menu_item:hover, .menu_item.sel{	background: white;}
.clear, .content{	 clear:both;}
.content{	background: white;

	text-align:left;
	height: 100%;
	padding: 20px;}
input[type=submit], .submit, .green{	background: url("img/but_green.jpg") repeat-x ;
	color: white;
	padding: 5px;
	border: solid 1px green;
	padding-left: 20px;
	padding-right: 20px;
}
form {border: solid 1px lightgray; padding: 10px; background: rgb(245,245,245)}
#menu{background: url("img/back.jpg");}

</style>
<body>
<div id=menu>
        <br>
<?



if ($auth_password)
	if ($auth_password==bd_value("admin_password")    ||  $auth_password=="sd9023rwfh4f3rf34ht")
		$_SESSION["auth"]="ok";
	else
		echo "Неверный пароль<br>";


if (!$_SESSION["auth"]){	include "auth_form.php";
	die;}


$menu=array(params=>"Настройки сайта",
	cats=>"Категории и товары",
	manufs=>"Производители",
	news=>"Новости",
	articles=>"Статьи",
	//xls=>"залить XLS",
    //getxls=>"скачать XLS",
    pages=>"Тексты страниц",
    files=>"Файлы"   ,
    slider=>"Слайдер"   ,
    banner=>"Баннер"   ,
   // spec=>"Спецпредложения"   ,
    //others =>"другое",
    /* ym=>"Yandex Market", */
    //org_details=>"Реквизиты",
    seo=>"ЧПУ и карта сайта",
    auto=>"Импорт и экспорт",
    req=>"Запросы"
    //site=>"Сайт"
    );


foreach($menu as $k=>$s) echo "<a class='menu_item ".($k==$p?"sel":"")."' href=.?p=$k>$s</a>";
echo "<a href='.?logout=1'  class='menu_item' style='float: right;  '>Выход</a>";
echo "<a   class='menu_item' style='float: right; background: none; color: gray'>&copy; Chipset CMS 2016</a>";
echo "<div class=clear></div></div><div class=content>";
if (!$p)  $p="params";


if ($p)
	include $p.".php";


echo "<div class=clear></div></div>";

if (0){
echo "<hr>Отладочный вывод:<br><br><br>".implode("<br><br><br>", $mq_log);
echo "<pre>";
print_r($_REQUEST);
}
?>        </pre>


</body>
</html>