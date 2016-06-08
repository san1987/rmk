





		<h1><?=$h1 ?>
		</h1>


		<?
		if ($search) echo "&nbsp;&nbsp;<b>Вы искали &laquo;$search&raquo;</b><br><br>";

		?>


        <? if (!($page>1)  && $main["descr"]) {?>
			<div class=annot>
			<?=$main["descr"]?>
			</div>
		<?}
		?>


		<?
		//print_r($filter_sel);
		if (!$search)
			include "tpl.cats.php";

		if($goods){

																		?>

											                                           <div class=clear></div>
																						<div class='sort_block border'>
																						<div class='nav_left' style='margin-right: 20px'>
																						Сортировать:
																						</div>
                                                                                        <?
																						/*          .?p=<?=$p?>&search=<?=urlencode($search)?>&is_spec=<?=$is_spec?>&filter=<?=$filter?>&id=<?=$id?>&page=<?=$page?>&by_price=1&desc=<?=(1-$desc)?>
                                                                                                    .?p=<?=$p?>&search=<?=urlencode($search)?>&is_spec=<?=$is_spec?>&filter=<?=$filter?>&id=<?=$id?>&page=<?=$page?>&by_price=0&desc=<?=(1-$desc)?>
																						$cat_url


																						*/
																						?>
																						<a href='<?=$cat_url.($page>1?"page-$page/":"").


																							($search || $filter || !$desc ? "?":"")


																							.($search?"search=".urlencode($search):"")."".($filter?"&filter=$filter":"")."".($desc?"":"&desc=1")?>' class='nav <?=!$by_price?"sel":""?>'>по популярности</a>
																						 <a class='nav <?=!$by_price?"":"sel"?> ' href='<?=$cat_url.($page>1?"page-$page/":"")."?".($search?"search=".urlencode($search):"")."".($filter?"&filter=$filter":"")."&by_price=1".($desc?"":"&desc=1") ?>'>по цене</a>

																						 <a class='nav last'></a>
                                                                                         <?
                                                                                         if ($goods_count){?>
		                                                                                         <div style='float: right; line-height: 35px; margin-right: 20px;'>
																								 <b>Найдено товаров <?=$goods_count?></b>
																								 </div>
																						 <? } ?>

																						  <div class=clear></div>

																						</div>




											<? //for ($i=1; $i<=10; $i++)


											foreach ($goods as $row)

											{													$url=$row["href"];//".?p=good&id=".$row["id"]."&chpu=".$row["chpu"];

													//print_r($row);

													?>

													<div class='good border'>
														<a href='<?=$url?>' class='img border' style='overflow: hidden'>
															<img src='<?=get_photo($row, false)?>'>

															<?
															if ($row["is_spec"]){?>
															<div style='position: relative; left: 0px; top: -160px; width: 105px; height: 18px; background: url("imgs/sale.png") no-repeat;'>
															</div>
															<? } ?>



															<?
                                                              /*
															<div style='display: none; position: relative;left: 0px;top: -160px; width: 57px; height: 18px; background: url("imgs/new.png") no-repeat;'>
															</div>
															  */
															?>
														</a>

														<div class=descr>
															<a href='<?=$url?>' class=title><?=$row["title"]?></a>
															<b>Производитель</b> <?=$row["mtitle"]?><br>
															<!--b>Материал</b> Ротанг<br>
															<b>Каркас</b> Алюминий<br>
															<b>Размер столика</b> 124*45*496<br>
															<b>Страна производитель</b> Голландия<br-->

														</div>

														<div class='price border'>
														<b>Цена:</b><br><br>
														от <span class=red><?=ceil($row["price"])?></span> р. <br>
														<a href='javascript: show_req(<?=$row["id"]?>);' class=price_req style='margin-left:16px'>   </a>
														</div>
													</div>

													<?
											}
											?>

											<div style='float:left'>
												<?

												//$page_count=20;
												if ($page_count>1){

															 if ($page>1) {?>
															<a href='<?=$cat_url."page-".($page-1)."/".

																($search || $filter || $by_price || $desc ? "?":"")


																.($search?"search=".urlencode($search):"")."".($filter?"&filter=$filter":"")."".($by_price?"&by_price=$by_price":"")."".($desc?"&desc=".($desc):"") ?>' class='prev nav'>Предыдущая</a>
															<? } ?>
															<?
															$points_showed=false;
															for ($i=1; $i<=$page_count; $i++){


																if (($i>3 && $i<$page-1)||($i>$page+1   && $i<$page_count-1)){																	if (!$points_showed){																		$points_showed=true;																		?>
																		<a class='nav'>...</a>
																		<?
																	}																}else{
																	$points_showed=false;																	?>
																	<a
																	<? if (($page)!=$i) {?>

																	 href='<?=$cat_url.($i>1?"page-".($i)."/":"").


																	($search || $filter || $by_price || $desc ? "?":"")

																	.($search?"search=".urlencode($search):"")."".($filter?"&filter=$filter":"")."".($by_price?"&by_price=$by_price":"")."".($desc?"&desc=".($desc):"")
																	  ?>'

																	  <? } ?>
																	  class='nav <?=(($page)==$i?"sel":"")?>'><?=$i?></a>
																	<?
																}

															}

															?>



															<? if ($page<$page_count) {?>
															<a href='<?=$cat_url."page-".($page+1)."/".
															($search || $filter || $by_price || $desc  ? "?":"")
															.($search?"search=".urlencode($search):"")."".($filter?"&filter=$filter":"")."".($by_price?"&by_price=$by_price":"")."".($desc?"&desc=".($desc):"") ?>' class='nav next'>Следующая</a>
															<? } ?>
															<a class='nav last'></a>
												<? } ?>
											</div>

											<?
											if ($page_count>1  || $showall){
											?>

											<div style='float:right'>
											    <a href='<?=$cat_url.($search || $filter || $by_price || $desc || !$showall? "?":"").($search?"search=".urlencode($search):"")."".($filter?"&filter=$filter":"")."".($by_price?"&by_price=$by_price":"")."".($desc?"&desc=".($desc):"").($showall?"":"&showall=1") ?>' class='nav once'><?=!$showall?"показать всё":"постранично"?></a>
											</div>

											<?

											}

											?>
                                                  	<?

}
		?>

											<div class=clear style='margin-bottom: 20px;'></div>

													<? if (!($page>1) && $main["descr2"]) {?>
														<div class=annot>
														<?=$main["descr2"]?>
														</div>
                                                 <? } ?>

                                                  <?




                                                 ?>
                                                 <link href="<?=$canonical_full?>" rel="canonical" />




