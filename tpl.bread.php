<style>

#bread{
	margin-top: 10px;

#bread a {
	color: gray;
</style>

<nav id=bread>
<?
if($bread){
?>
<a href='.'>Главная</a>
<?

	foreach($bread as $v){
		echo " / <a ".($v["href"]?"href='".$v["href"]."'":"").">".$v["title"]."</a>";
  	    $k++;

?>
<!-- / <a href='.?p=3545'>Ультразвуковые сканеры</a> -->
<?
}

?>
</nav>
