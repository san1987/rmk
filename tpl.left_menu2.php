<?

/*
<style>

	#left_menu{
			width: 310px;
			background: rgb(236,236,236);
			padding: 0px;
			float:left;
			clear: both;
			margin-right: 20px;
			margin-bottom: 20px;
	}
    #left_menu > li {    	list-style-type: none;
	    padding-left: 17px;
	    background-image: url("imgs/menu_arrow_unsel.png");
	    background-position: right center;
	    background-repeat: no-repeat;
	    border-top: solid 1px white;
	    border-bottom: solid 1px rgb(186,186,186);



    }

    #left_menu > li.subli {
    	background-image: none;
    	padding-left:0px;    }
    .menu_sublink{    	display: block;    }

    #left_menu > li.subli:hover {
    	background-image: none;
    	background: rgb(236,236,236);

    }



    #left_menu > li.subli > a {
    	line-height: 30px;
    	font-size:  12px;
    	padding-left:40px;

    }

    #left_menu > li.subli > a:hover ,  #left_menu > li.subli > a.sel{

	     background-position: 10px center;
	     background-repeat: no-repeat;
         background-color: rgb(247,247,247);
    }

    #left_menu > li.subli > a.sel{
	    background-image: url("imgs/menu_arrow.png");
	    color: blue;
    }




    #left_menu > li a{
    	 line-height: 45px;
    	 font-size: 11pt;
    	     }


#left_menu > li {	position: relative;}
#left_menu > li a{	display: block;
	 //width: 400px;	}
#left_menu > li ul  {
	//visibility: hidden;
	display:none;

	position: absolute;
	z-index: 100;
  	left: 310px;
    top: 0px;
    width:260px;


    background: rgb(236,236,236);


	padding: 0px;
}
#left_menu > li ul  li {	 border-bottom: solid 1px rgb(186,186,186);
	 border-left: solid 1px rgb(186,186,186);
	 padding-left: 20px;
	 line-height: 45px;	 display: block;
	 font-size: 12pt;
	 position: relative;
	 list-style-type: none;
}
#left_menu > li:hover  {
	   background-image: url("imgs/menu_arrow.png");	   background-color: rgb(247,247,247);}

#left_menu > li.sel  {
	   background-image: url("imgs/menu_arrow_down.png");
	    background-color: rgb(236,236,236);

}

#left_menu > li.sel > a{	color: blue;}

#left_menu > li:hover > ul  {	//visibility: visible;
	display:block;}

#left_menu > li.sel:hover > ul  {
	//visibility: visible;
	display:none;
}


#left_menu > li ul  li ul{	left: 259px;
}

#left_menu > li > ul li:hover{
	 background: rgb(247,247,247);}

#left_menu > li > ul li:hover ul  {
	//visibility: visible;
	display:block;
	list-style-type: none;
}

#left_menu > li > ul li:hover ul  li:hover{
    background: rgb(247,247,247);
}


</style>
<aside>
<ul id=left_menu>
<?

foreach($left_menu as $k=>$row){
	echo "<li class=".($row["sel"]?"sel":"").">
		<a href='".$row["href"]."'
		class='left_menu_a menu_link '>";
	echo "".$row["left_title"]."";
	echo "</a>
		  <ul  >";
	if ($row["items"])
		foreach($row["items"] as $t){
			echo "<li class=".($t["sel"]?"sel":"")."><a href='".$t["href"]."' class='menu_link '>".$t["left_title"]."</a>";
            echo "<ul>";
			if ($t["items"])
				foreach($t["items"] as $tt){
					echo "<li class=".($tt["sel"]?"sel":"")."><a
						href='".$tt["href"]."'
					 class='menu_link  '>".$tt["left_title"]."</a>";
					echo "</li>";
				}
			echo "</ul>";
			echo "</li>";
		}

	echo "</ul>
		</li>";

	if ($row["sel"]) if ($row["items"]){
		echo "<li class=subli>";
		foreach($row["items"] as $t){   			echo "<a href='".$t["href"]."' class='menu_sublink ".($t["sel"]?"sel":"")."'>".$t["left_title"]."</a>";		}
		echo "</li>";	}
}

?>
</ul>
</aside>

*/