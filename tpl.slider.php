<?
$slider_width=807;
?>
   <!------------------------------------------------------------------------------------------>
   <!------------------------------------------------------------------------------------------>
   <!------------------------------------------------------------------------------------------>
   <!------------------------------------------------------------------------------------------>
   <!------------------------------------------------------------------------------------------>
   <!------------------------------------------------------------------------------------------>
   <!------------------------------------------------------------------------------------------>
   <!------------------------------------------------------------------------------------------>

<!-- Автор Dylan Wagstaff, http://www.alohatechsupport.net -->

   <table width=<?=$slider_width?> >  <tr>
         <td width=500 valign=top>




<script type="text/javascript">

var count_time=0;
function counter(){
	count_time++;

	if (count_time==6){
		count_time=0;
		rotate();
	}

}

function theRotator() {
	// Устанавливаем прозрачность всех картинок в 0
	$('div#rotator ul li').css({opacity: 0.0});

	// Берем первую картинку и показываем ее (по пути включаем полную видимость)
	$('div#rotator ul li:first').css({opacity: 1.0});


	// Вызываем функцию rotate для запуска слайдшоу, 5000 = смена картинок происходит раз в 5 секунд
	setInterval('counter()',1000);
}

var page_id=0;
var allow=true;
var is_rotate=1;


function show_next_prev(is_next, is_btn) {
	if (is_btn){
		allow=false;
		count_time=0;
		setTimeout('allow=true;', 100);
	}
	// Берем первую картинку
	var current = ($('div#rotator ul li.show')?  $('div#rotator ul li.show') : $('div#rotator ul li:first'));

	// Берем следующую картинку, когда дойдем до последней начинаем с начала
	var next = ((current.next().length) ? ((current.next().hasClass('show')) ? $('div#rotator ul li:first') :current.next()) : $('div#rotator ul li:first'));
	if (!is_next){
		next = ((current.prev().length) ? ((current.prev().hasClass('show')) ?
			 $('div#rotator ul li:last') :current.prev()) : $('div#rotator ul li:last'));

	}

	// Расскомментируйте, чтобы показвать картинки в случайном порядке
	// var sibs = current.siblings();
	// var rndNum = Math.floor(Math.random() * sibs.length );
	// var next = $( sibs[ rndNum ] );

	// Подключаем эффект растворения/затухания для показа картинок, css-класс show имеет больший z-index
	next.css({opacity: 0.0})
	.addClass('show')
	.animate({opacity: 1.0}, 1000);

	//alert();
	page_id=next.attr("page_id");

	// Прячем текущую картинку
	current.animate({opacity: 0.0}, 2000)
	.removeClass('show');

	//alert('текущая '+current.attr("page_id")+' прошлая '+next.attr("page_id"));
};



function rotate() {
	if(is_rotate)
		show_next_prev(true, false);
};

$(document).ready(function() {
	// Запускаем слайдшоу
	theRotator();
});

</script>
<script>



	function goheadpic(){
	   if (allow)
	   	   	   go(		   	   page_url[page_id]	   	   );
	}
</script>

<script>
				var page_url = new Array();

<?
foreach ($slider as $k=>$s) echo " 	page_url[$k]='".$s["href"]."'; ";
?>







				is_rotate=1;
				page_id=0;
</script>


				  <div id="rotator" onclick='javascript: goheadpic()' style='cursor: hand; cursor: pointer'>



				  <ul>

				  <?
					foreach ($slider as $k=>$s) echo " 	     <li class=".($k==0?"show":"")."  page_id=$k style='; margin-left: 0px;
										height:412px; overflow: hidden'>
									<img title='".$slider["title"]."' src='".$s["img"]."' width=$slider_width /> </li>
						 				 ";
					?>







				    </ul>


					<div style='width: <?=$slider_width?>px; position: absolute;  '>

							    <div id='aPrevButton' href='javascript: show_next_prev(false, true); return false;' onclick='show_next_prev(false, true); return false;' >
							    </div>

							    <div id='aNextButton' href='javascript: show_next_prev(false, true); return false;'  onclick='show_next_prev(true, true);return false;' >
							    </div>

				    </div>


				</div>
</td>				 </tr></table>