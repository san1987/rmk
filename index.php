<?

$start_time=microtime (true);

session_start();

require_once "base.php";
require_once "func.php";





if(0){
echo "<pre>";
print_r($left_menu);
}


include "chpu_redir.php";

  	if ($p)
	  	if ($p=="ajax"){
			include "ctrl.ajax.php";
			die;
		}
	  	else{	  		$fn="ctrl.$p.php";
	  		if (file_exists($fn))
	  			include $fn;
	  		else{	  			$e404=true;
		  	}
		}
	else
		include "ctrl.index.php";



		 										 $url=$_SERVER["REQUEST_URI"];
                                                 $url=explode("?", $url);
                                                 $url=$url[0];
                                                 $canonical=$url;
                                                 $canonical_full="http://".$_SERVER["SERVER_NAME"].$url;


include "ctrl.menu.php";
include "ctrl.banner.php";



if (!$page_title) $page_title=$main["meta_title"];
if (!$page_title) $page_title=$main["title"];
if (!$page_title) $page_title="Русская медицинская компания";

if (!$page_img) $page_img="imgs/logo-only.png";
$page_img="http://".$_SERVER["SERVER_NAME"]."/rmk/".$page_img;

	if (!$template)	$template="index";

	if ($e301){
		 header("HTTP/1.0 301 Moved Permanently");
		 header("Location: $e301");	}elseif ($e404){		header("HTTP/1.0 404 Not Found");
		$n=404;
		include "tpl.404.php";	}else
		include "tpl.".$template.".php";


if(0){
echo "<hr><pre>";
echo implode("\n<hr>\n", $mq_log);

}


	print "<!--\r\n";
	$time_end = microtime(true);
	$exec_time = $time_end-$start_time;

  	if(function_exists('memory_get_peak_usage'))
		print "memory peak usage: ".number_format(memory_get_peak_usage(), 0, '.', ',')." bytes\r\n";
	print "page generation time: ".$exec_time." seconds\r\n";
	print "-->";