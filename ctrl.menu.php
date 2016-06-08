<?


$menu=array(
	array(href=>".","home"=>true),
	array("title"=>"О компании", href=>"about/", "sel"=>($p=="page" && $n=="about")),
	array("title"=>"Спецпредложения", href=>"sale/"
				, "sel"=>($p=="catalog" && $is_spec)),
	array("title"=>"Сервис", href=>"service/"
				, "sel"=>($p=="page" && $n=="service")),
	array("title"=>"Доставка и оплата", href=>"delivery/"
				, "sel"=>($p=="page" && $n=="delivery")),
	array("title"=>"Контакты", href=>"contacts/"
				, "sel"=>($p=="page" && $n=="contacts")),
	array("search"=>true)
);