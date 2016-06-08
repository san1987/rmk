<?

        ?>
<article  itemscope itemtype="http://schema.org/Product">

<h1 itemprop="name"><?=$main["title"]?></h1>

<div  class='horiz_line'  ></div>


<div style='float: left'>

	<?
	/*
	$min_dir="photos/good/min/";
	$medium_dir="photos/good/medium/";

	$photos=trim($main["photos"]);
	if ($photos){		$photos=explode("|", $photos);	}else{
		$fn=$min_dir.$id."_";//_0.jpg";
		for($i=0; $i<10; $i++  ){
			if (file_exists($img=$fn.$i.".jpg")){
				$photos[]=$id."_".$i.".jpg";
				//echo "<a href='$img'>$img</a><br>";
			}		}	}

      */


	$url=get_photo($main, false);//$medium_dir.$photos[0];

	$photos=               get_photo($main, true, true);
    $photos_huge=               get_photo($main, false, true);


     foreach($photos_huge as $k=>$photo) {

	?>
			<div style='overflow: hidden;<?=$k?"display:none":""?> ' class='border mainphoto' id=mainphoto<?=$k?>>
			<a href='<?=$photo?>' id=good_pic_href<?=$k?> class='white_border' style='line-height: 300px;
				   '>
				<img src='<?=$photo?>'  style='    vertical-align: middle;' id=good_pic<?=$k?>>
			</a>
			</div>

	<?

	}

	?>




			<div style='height: 100px; margin-top: 20px' id='good_photos'>

							<div
							 onclick='prev("good_photos", 0)'
							 class='buttons prev_button'>
							</div>

							<div style='float:left; width:380px; height:100px; overflow: hidden;  '>






													<div style='text-align:center; padding-left: 22px;
																 height:100px; '
																							class='slider_content'>


			                                                   <?




			                                                  foreach($photos as $k=>$photo) {
																	 ?>



																	 			<div class='border  slider<?=($k+1)?>'																	 			  >

																	 			<a style='  line-height: 95px;' class=white_border
																	 			href='javascript: show_pic(<?=$k?>)'>

																				<img src='<?=$photo?>'   >
																				</a>

		                                                                        </div>

																	 <?

															  }

														?>








												</div>   <script>function show_pic(url){													//$('#good_pic').attr("src", url);
													//$('#good_pic_href').attr("href", url);
													$('.mainphoto').hide();
													$('#mainphoto'+url).show();

												}</script>


							</div>


							<div  class='buttons next_button'
								onclick='prev("good_photos", 1)'
								style='

								'>

							</div>
			</div>



			<script>
				init("good_photos", 3);
			</script>

</div>



<div style='float:left; width: 690px ; margin-left:20px;'>

		<span style='font-size: 14pt'>Преимущества</span>
		<div class=clear style='margin: 5px;'></div>

		<div  class='good_descr'>


  			<?=$main["description"]?>


		</div>


		<div class='good_price ' style='padding: 0'>

		<div class='good_price border' itemprop="offers" itemscope itemtype="http://schema.org/Offer">
			<b>Цена:</b><br><br>
			от <span class=red itemprop="price"><?=ceil($main["price"])?></span> р.

    		  <meta itemprop="priceCurrency" content="RUB">

			 <br>
			<a href='javascript: show_req(<?=$main["id"]?>);' class=price_req style='margin-left:16px'>   </a>
			</div>

			<?
			include "tpl.social.php";
			?>
		</div>




</div>

<div class=clear></div>


<div class=good_full_descr>

<div class=head>
	<a href='javascript: sel_har("desc1")' id='link_desc1' class=' title sel'>Описание</a>
	<a href='javascript: sel_har("desc2")' id='link_desc2'  class='  title '>Характеристики</a>
	<a href='javascript: sel_har("desc4")' id='link_desc4'  class='  title '><nobr>Доставка и гарантии</nobr></a>
	<a href='javascript: sel_har("desc3")' id='link_desc3'  class='  title'>Аксессуары</a>
	<div class='  title last'>    </div>
</div>

<script>
function sel_har(_id){	$(".good_full_descr  .text").css("display", "none");
	$("#"+_id).css("display", "block");
	$(".head .title").removeClass("sel");
	$("#link_"+_id).addClass("sel");}
</script>



 <div class=clear></div>

	<div class='text sel' id=desc1  itemprop="description">
	 <?=$main["desc1"]?>
	</div>

	<div class=text  id=desc2  >
	 <?=$main["desc2"]?>
	</div>

	<div class=text  id=desc4>
	 <?=$main["desc4"]?>
	</div>

	<div class=text  id=desc3>
	 <?=$main["desc3"]?>
	</div>

	<div class=clear></div>
</div>




<div class=clear></div>

</article>

<?


include "tpl.recomendations.php";