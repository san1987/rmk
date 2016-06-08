<style>

#bread{	margin-bottom: 10px;
	margin-top: 10px;	}

#bread a {	font-size: 10pt;
	color: gray;}
</style>

<nav id=bread>
<?
if($bread){
?>
<a href='.'>Главная</a>
<?
	ksort($bread); $k=0;
	foreach($bread as $v){		if ($k==count($bread)-1) unset($v["href"]);
		echo " / <a ".($v["href"]?"href='".$v["href"]."'":"").">".$v["title"]."</a>";
  	    $k++;	}

?>
<!-- / <a href='.?p=3545'>Ультразвуковые сканеры</a> -->
<?
}

?>
</nav>

