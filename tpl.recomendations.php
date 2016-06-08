<?





?>


<div  class='clear line_title' style='margin-bottom:20px'>
		<div style='text-transform : none'>		Рекомендуемые товары		</div>
</div>


<div style='height: 300px' id='recom_slider'>

				<div    class='buttons prev_button'
				 onclick='prev("recom_slider", 0)'
				  >
				</div>

				<div style='float:left; width:1040px; height:100%;  overflow: hidden'>

										<div   class='slider_content'>

                                                   <?
                                            if($recom)
											foreach($recom as $i=>$row)
											{
												$url=".?p=good&id=".$row["id"]."&chpu=".$row["chpu"];
												$url=$row["href"];

												 ?>    <div class='new slider<?=$i+1?>'>
												<a href='<?=$url?>'>
												<img src='<?=$row["img"]?>'>
												</a>
												<?=$row["title"]?>
												<div style='text-align: left'>
													<span class=price>от <?=ceil($row["price"])?> руб.</span>
													<a href='javascript: show_req(<?=$row["id"]?>);' class=price_req>   </a>
												</div>
											</div>

												 <?    }
											?>








							</div>

				</div>


				<div      class='buttons next_button'
					onclick='prev("recom_slider", 1)'
					 >
				</div>
</div>

<div class=clear></div>

<script>
	init("recom_slider", 5);
</script>