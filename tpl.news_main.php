<?
if ( ($articles) ||  ($news)){
?>

<div  class='clear line_title' style='margin-bottom:20px'>
		<div style='text-transform : none'>	Новости и статьи		</div>
</div>





<article style='width:50%; float:left'>

<?
                foreach($articles as $v){
                	?>

	<div class='article_main clear'>
		<a href='<?=$v["href"]?>'><img src='<?=$v["img"]?>'></a>
		<div>
			<a href='<?=$v["href"]?>'><b><?=$v["title"]?></b></a><br>
			<?=$v["small_text"]?>
		</div>
	</div>

                	<?

                	}
                	?>



</article>

<div style='width:50%; float:left'>



                <?
                foreach($news as $v){                	?>
                	 <div style='display: inline; float:left'>
						<a href='<?=$v["href"]?>'><b><?=$v["title"]?></b></a>
					</div>
					<div style='text-align: right; color: lightgray; '>            	<i><?=$v["cr"]?></i></div>
					<div class=clear></div>

					<?=$v["small_text"]?>
					<div class=clear></div>

					<a href='<?=$v["href"]?>' class=black style='margin-bottom: 20px; font-style:   italic; display: block; text-align: right '>Подробнее</a>


                	<?                }

                ?>



</div>

<?

}

?>