

<?
/*
if (!$cats) $cats=array( "
Эндоскопическое оборудование","
Функциональная диагностика","
Гинекология","
Офтальмология");
  */

if ($cats)
	foreach($cats as $tt){	?>
	      <div class='cat_elem'>
									  			<a href='<?=$tt["href"]?>'>    <!-- .?p=<?="$p&filter=$filter&id=".$tt["id"]."&chpu=".$tt["chpu"].""?> -->
									  			<div>
												<img src='<?=$tt["img"]?>'>   <!-- files/cats/<?=$tt["id"]?>.jpg -->
												</div>
												<?=$tt["title"]?>
												</a>

											</div>
	<?}
?>




