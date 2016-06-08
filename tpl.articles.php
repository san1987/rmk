<?

include "tpl.header.php";
include "tpl.menu.php";
include "tpl.bread.php";
echo "<aside style='float:left; width: 310px; margin-right: 20px;'>";

		include "tpl.left_menu.php";
		include "tpl.banner.php";



echo "</aside>";
?>



     <div style='float:left; width: 800px;'>


     <h1><?=gp("articles_h1")?></h1>

	<div class='horiz_line'></div>

<?
                foreach($articles as $v){
                	?>

	<div class='article_main clear'>
		<? if ($v["img"]) { ?>
		<a href='<?=$v["href"]?>'><img src='<?=$v["img"]?>'></a>
		<? } ?>
		<div>
			<a href='<?=$v["href"]?>'><b><?=$v["title"]?></b></a><br>
			<?=$v["small_text"]?>
		</div>
	</div>

                	<?

                	}
                	?>

                </div>

<?
include "tpl.footer.php";

