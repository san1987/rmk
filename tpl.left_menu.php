<div class='left_menu left_menu_container' data-id="last">

<?

$ul1="<ul>";

foreach($left_menu as $k=> $row){
	$ul1.= "<li class=".($row["sel"]?"sel":"")."


		>
		<a href='".$row["href"]."' ".($row["sel"]  || !$row["items"]?"":" data-id='".$row["id"]."'")."
		class='left_menu_a menu_link '>";
	$ul1.= "".$row["left_title"]."";
	$ul1.= "</a>
		</li>";


	if ($row["sel"]) if ($row["items"]  ){
		$ul1.= "<li class=subli>";
		foreach($row["items"] as $t){
   			$ul1.= "<a href='".$t["href"]."' class='menu_sublink ".($t["sel"]?"sel":"")."'>".$t["left_title"]."</a>";
		}
		$ul1.= "</li>";
	}

	$ul2.=" <ul class='col2_".$row["id"]." col2' data-id='".$row["id"]."' ".($k || true ?"style='display: none'":"").">";
	if ($row["items"])
		foreach($row["items"] as $t){
			$ul2.= "<li class=".($t["sel"]?"sel":"")."><a href='".$t["href"]."' class='menu_link '>".
					$t["left_title"]."</a>";
			/*
            echo "<ul>";
			if ($t["items"])
				foreach($t["items"] as $tt){
					echo "<li class=".($tt["sel"]?"sel":"")."><a
						href='".$tt["href"]."'
					 class='menu_link  '>".$tt["left_title"]."</a>";
					echo "</li>";
				}
			echo "</ul>"; */
			$ul2.=	 "</li>";
		}

	$ul2.=  "</ul>";


}

$ul1.="</ul>";
?>


			<?=$ul1?>



			<?=$ul2?>  <!--ul class='col2 col2fictive' style='background: none'> </ul-->
</div>


<div class='left_menu  back' style=''>

<?=$ul1 ?>

</div>



<script>
var _last;
var hide=false;
function mouseout(){
	if (!hide) {		 $('.col2').css("display", "none");
		// $('.col2fictive').css("display", "none");

         $('.left_menu').css("background-color", "rgba(0,0,0,0)");
	}}
function onmouseon(_over, _id){
     hide=_over;
	//if (!_id) return;

	 if (_id=="last") _id=_last;

	 if (_over){
	 	if(_id!=_last){	 		 $('.col2').css("display", "none");
			 $('.col2_'+_id).css("display", "table-cell");
			 //if (!_id) $('.col2fictive').css("display", "table-cell");
		 }
	 }else
	 	setTimeout(mouseout, 100);








	 _last=_id;


	//alert(_over+" ! "+ _id);
}


$( " .left_menu_a , .left_menu_container " )
	.mouseover(function() {
	 	 onmouseon(true, $( this ).attr("data-id"));

	});
$(".left_menu_container")
	.mouseout(function() {

	  onmouseon(false, "");
	});

</script>
