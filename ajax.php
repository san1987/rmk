<?


$result=array();
switch($a){	case "request":
		$result["result"]="0";
		if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] === $_POST['captcha']){

			if (  $phone=="" || $email=="" || $name=="" || $juridical_name=="" )
				$result["error"]="Не все обязательные поля формы заполнены. Попробуйте ещё раз";
			else{
				$r=mq("INSERT INTO `zhalex_rmk`.`requests` ( `text`, `phone`, `email`, `name`, `juridical_name`,
					`page_url`, `good_id`) VALUES
					('".mres($text)."', '".mres($phone)."', '".mres($email)."', '".mres($name)."', '".
						mres($juridical_name)."', '".
						mres( $_SERVER['HTTP_REFERER'])."', ".intval($good_id).");");


				unset($_SESSION['captcha_keystring']);

				  $r=mq("SELECT * FROM goods WHERE id=".intval($good_id));
		          $main=fetch($r);


				 $k=send_mime_mail(
                        gp("admin_email"), // email получателя
                        "РМК: Новый запрос ".mysql_insert_id(), // тема письма
                         // текст письма

                         "
                         ".mres($phone)."
                         ".mres($email)."
                         ".mres($name)."
                         ".						mres($juridical_name)."
                         ".$main["title"]."
                         ". $_SERVER['HTTP_REFERER']."
                         ".mres($text)." "
                        ,$email_from=false
                        );


                        send_mime_mail(
                         "zhalex@ya.ru", // email получателя
                        "РМК: Новый запрос ".mysql_insert_id(), // тема письма
                         // текст письма

                         "
                         ".mres($phone)."
                         ".mres($email)."
                         ".mres($name)."
                         ".						mres($juridical_name)."
                         ".$main["title"]."
                         ". $_SERVER['HTTP_REFERER']."
                         ".mres($text)." "
                        ,$email_from=false
                        );
     			$result["result"]=$k;
                 if (!$k)
	     			$result["error"]="На сервере произошла ошибка. Позвоните нам по телефону.";
			}




  		}else{

	  		$result["error"]="Вы неверно ввели код с картинки. Попробуйте ещё раз";
	  	}
		break;}

header('Content-type: application/json');
echo json_encode($result);