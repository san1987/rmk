<?





?>

<div  class='clear line_title' style='margin-bottom:20px'>
		<div style='text-transform : none'>		Новые поступления		</div>
</div>

<?
include "tpl.banner.php";

?>
<div>
	<?
	if ($new_pos)
    foreach($new_pos as $row){
    	//$url=".?p=good&id=".$row["id"]."&chpu=".$row["chpu"];
    	$url=$row["href"];	    ?>

		<div class=new>
			 <a href='<?=$url?>'>
			<img src='<?=get_photo($row, false);?>'>
			</a>
			<?=$row["title"]?>
			<div>
				<span class=price>от <?=ceil($row["price"])?> руб.</span>
				<a href='javascript: show_req(<?=$row["id"]?>);' class=price_req>   </a>
			</div>
		</div>

		<?

	}
	?>

</div>

<div  class='clear '>
</div>