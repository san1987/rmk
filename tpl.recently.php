<?

if ($rece){
?>



<div class='main recently'>

		<div class='title' >Вы недавно смотрели</div>



		<?
		foreach($rece as $i=>$row)
											{  $url=$row["href"];
												?>



											<a   class=white_border
																	 			href='<?=$url?>'>

																				<img src='<?=$row["img"]?>' style=' '  >
																				</a>


											<?

		}

		?>



</div class=main>

<?
}
?>