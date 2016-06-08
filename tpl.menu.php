<script>
function search(){}
</script>
<div class='clear main_menu' style='margin-bottom: 0px;margin-top: 10px;'>

<?


foreach($menu as $k=>$row){
	if ($row["search"])
		echo "<div class=search  >


					 <form  style='' action='.?p=search' itemprop='potentialAction' itemscope itemtype='http://schema.org/SearchAction'>

									 <meta itemprop='target' content='"."http://".$_SERVER["SERVER_NAME"]."/?p=catalog&search={search}'/>
									 <input itemprop='query-input' 		 name=search type=text  >

									 <input type=submit value=''     		 	onclick='search();'>
									 <input type=hidden name=p value=search>


					 </form>

		  </div>";
	else{
        echo "<div>";
		echo "<a href='".$row["href"]."' class='main_menu_a menu_link ".($row["sel"]?"sel":"")."'>";
		if ($row["home"])
			echo "<img src='imgs/nav_home.png' style='display: inline'>";
		else			echo "".$row["title"]."";
		echo "</a>";
		echo "</div>";	}

}


?>
</div>

