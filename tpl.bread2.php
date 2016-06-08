<style>

#bread2{
	margin-bottom: 20px;

	background : rgb(248, 248, 248);
	height: 30px;



	}

 .bread2 {
	font-size: 10pt;
	color: gray;
	line-height: 30px;
    background: url("imgs/bread_splitter.png") right center no-repeat ;
    float:left;
    display: block;
    padding-right: 20px;
    padding-left: 10px;
}

	.bread2.first > div{
				position: absolute;
				display:none;
				z-index: 100;
			  	left: 0px;
			    top: 29px;
			    width:260px;
			    }

 .bread2.first:hover > div{ 	display: block; }

 .bread2.first {
	background-color: rgb(68,140,203);
	background-image: url("imgs/bread_down.png");

	color: white;
	padding-right: 40px;}


 .bread2.last {	background:none;}
</style>
<nav id=bread2>
	<div href='.' class='first bread2' style='position: relative;'>Каталог товаров

		<div>

				<?
				include "tpl.left_menu.php";
				?>
		</div>


	</div>

	<?
if($bread) {	ksort($bread);
	foreach($bread as $k=>$v){
		$counter++;
		echo "   <a  ".($v["href"]  && $counter!=count($bread)?"href='".$v["href"]."'":"")." class='bread2 ".($counter==count($bread)?"last":"")."'>".$v["title"]."</a>";
	}
}
?>

	<!--a href='.?p=3545' class=bread2>Ультразвуковые сканеры</a>
	<a href='.?p=3545' class=bread2>Ультразвуковые сканеры</a>
	<a href='.?p=3545' class='bread2 last'>Ультразвуковые сканеры</a-->
</nav>