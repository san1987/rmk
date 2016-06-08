<?
if ($manuf_filter) if (count($manuf_filter)){


							?>




							<div class=clear>
							</div>

							<div class='manuf_filter_block' style=''>
							     <span style='font-weight: bold;'>Производитель:</span><br><br>
							<?

							foreach ($manuf_filter as $k=>$row)  {
								echo "<a class='".(!$row["sel"]?"":"sel").
									"' href='".$row["href"]."' onclick='checkbox_click(this)'>".$row["title"]."</a>\n\n";
							}
							?>
							    <div style='text-align:center'>
								<a href='<?=$reset_href?>' style='display: block; margin-top:10px' >

								<img src='imgs/reset_filters.png'>
								</a>
								</a>
								</div>

							</div>

							<script>
							var clicked=false;
							function checkbox_click(v){
								if (clicked) return;
								if ($(v).hasClass("sel"))
									$(v).removeClass("sel");
								else									$(v).addClass("sel");

								clicked=true;							}
							function manuf_filter_reset(){
								$(".manuf_filter").removeClass("sel");							}
							</script>

							<?

}


