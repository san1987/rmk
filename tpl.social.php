

<div class=clear></div>

<div class='social ' style=''>

<?
$social=array(
	"https://vk.com",
	"https://facebook.com",
	"https://twitter.com",
	"https://ok.ru",
	"https://google.com",
	"https://telegram.org"
);
foreach($social as $k=>$s){	echo "
	<a href='$s'  style='background-position: -".($k*21+0)."px center'></a>
	";}

?>
<div class=clear></div>

</div>