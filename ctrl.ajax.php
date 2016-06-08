<?


$result=array();
switch($a){	case "request":
		$result["result"]="0";
		//if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] === $_POST['captcha'])
		if (true)
		{

			if (  $phone=="" || $email=="" || $name=="" || $juridical_name=="" )
				$result["error"]="Не все обязательные поля формы заполнены. Попробуйте ещё раз";
			else{
				$r=mq("INSERT INTO  `requests` ( `text`, `phone`, `email`, `name`, `juridical_name`,
					`page_url`, `good_id`) VALUES
					('".mres($text)."', '".mres($phone)."', '".mres($email)."', '".mres($name)."', '".
						mres($juridical_name)."', '".
						mres( $_SERVER['HTTP_REFERER'])."', ".intval($good_id).");");
				$result["result"]="1";
				unset($_SESSION['captcha_keystring']);
			}




  		}else{

	  		$result["error"]="Вы неверно ввели код с картинки. Попробуйте ещё раз";
	  	}
		break;}

header('Content-type: application/json');
echo json_encode($result);