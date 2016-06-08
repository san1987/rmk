<?
//$manuf=array("Aloka", "Hitachi","Siemens","Mindray","Medison","Toshiba","Philips" );




?>

<div  class='clear line_title'>
		<div>		Производители		</div>
</div>

<div style='height: 145px' id='manuf_slider'>

						<div  class='buttons prev_button'
						 onclick='prev("manuf_slider", 0)'    				  >
						</div>

						<div style='float:left; width:1000px; text-align:center;height:100%'>

											<div style='display: inline; height:100%' class='slider_content'>

											<?
											foreach ($manuf  as $i=>$row)
												echo "
												<div class='manuf slider$i'  >

															<a

															class=white_border
															href='".$row["href"]."'>

																	<img src='".$row["img"]."'  >

															</a>
												</div>";
											?>


											</div>

						</div>


						<div   class='buttons next_button'
							onclick='prev("manuf_slider", 1)'>
						</div>
</div>
<div class=clear></div>


<script>
init("manuf_slider", 5);
</script>
