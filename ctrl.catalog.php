 <?

	    $filter_sel=explode(",", $filter);
        if(!$filter_sel[0]) array_shift($filter_sel);
        $filter=implode(",", $filter_sel);

        if ($is_spec) $bread[1]=array("href"=>url("sale"), "title"=>"Спецпредложения");


        if (count($filter_sel)==1 && $filter_sel[0]){

		        	$r=mq("SELECT * FROM manufs WHERE id=".$filter_sel[0]);
			        $once_manuf=fetch($r);
			        $manuf_title=$once_manuf["title"];
			        $bread[3]=array("href"=>url("manuf", $once_manuf), "title"=>$manuf_title);
		}


$template="catalog";







        $by_views=!$by_price;
        if ($showall) $perpage=10000; else $perpage=10;
        $page=intval($page);






        if ($page) $page--;
        $offset=$page*$perpage;


        $cats=array();

        $id=intval($id);
        $r=mq("SELECT * FROM cats WHERE id=$id");
        $main=fetch($r);

        if($is_spec){        	if ($main["spec_title"]) $main["title"]=$main["spec_title"];
        	if ($main["spec_descr"]) $main["descr"]=$main["spec_descr"];
        	if ($main["spec_descr2"]) $main["descr2"]=$main["spec_descr2"];
        	if ($main["spec_meta_title"]) $main["meta_title"]=$main["spec_meta_title"];
        	if ($main["spec_meta_descr"]) $main["meta_descr"]=$main["spec_meta_descr"];        }

        if ($once_manuf )
        	if( $id){	        	$r=mq("SELECT * FROM tags WHERE  cat_id=".intval($id)." AND manuf_id =".intval($once_manuf["id"]));
				$tags=fetch($r);
				if ($tags){

					$main["title"]=$tags["h1"];
	        	  	$main["descr"]=$tags["descr1"];
	        	 	$main["descr2"]=$tags["descr2"];
	        	 	$main["meta_title"]=$tags["meta_title"];
	        	 	$main["meta_descr"]=$tags["meta_descr"];				}        }else{
	        	 	$main["meta_title"]=$once_manuf["meta_title"];
	        	 	$main["meta_descr"]=$once_manuf["meta_descr"];
	        	 	$main["descr"]=$once_manuf["descr1"];
	        	 	$main["descr2"]=$once_manuf["descr2"];        }


        if ($main)
           $page_img="files/cats/".$main["id"].".jpg";
        else
        	if($once_manuf)
        		$page_img="files/manufacturers/".$once_manuf["id"].".jpg";

        if ($main["parent_id"]){        	$r=mq("SELECT * FROM cats WHERE id=".$main["parent_id"]);
	        $parent_main=fetch($r);        }

        $cat_url=  ($is_spec?"sale/":"").($parent_main["chpu"]?$parent_main["chpu"]."/":"").($main["chpu"]?$main["chpu"]."/":"");
        if (!$cat_url && $search)  $cat_url="search/";

        $cat_str="";
        $r=mq("SELECT * FROM cats WHERE parent_id=$id");
        while ($row=fetch($r))  {        	if ($id)
	        	$row["href"]=$cat_url.($once_manuf["chpu"]?$once_manuf["chpu"]."/":"").$row["chpu"]."/";
	      	else
		      	$row["href"]=$cat_url.$row["chpu"]."/".($once_manuf["chpu"]?$once_manuf["chpu"]."/":"");

        	$row["img"]="files/cats/".$tt["id"].".jpg";
        	$cats[]=$row;
        	$cat_str.=" OR c2g.cat_id=".$row["id"]." ";     //Строка для WHERE в запросе поиска товаров. Строка содержит в себе текущую категорию и всех её родителей
        }










        $where="";
		if ($is_spec)       $where.= " AND g.is_spec=1 ";
		if ($search)        $where.=" AND g.title LIKE '%".mres($search)."%' " ;

		if ($where)         $where_without_filter="WHERE 1=1 ".$where;

		$where1="";
        foreach ($filter_sel as $v) {
        	$v=intval($v);
        	if ($v)
	        	$where1.=" OR g.manuf_id=".$v;
        }
		if ($where1)         $where.=" AND (1=0 ".$where1.")";


		if ($where)         $where="WHERE 1=1 ".$where;








        if ($main["parent_id"]   || $main["show_goods"]   || !count($cats)   || $search)  {   //товары выводится только не в родительской категории!


				//Поиск тех производителей, товары которых есть в данной категории
                $r=mq("
                SELECT DISTINCT g.manuf_id FROM goods  g
                ".($id?"INNER JOIN good2cat c2g ON c2g.good_id=g.id AND (c2g.cat_id=$id  $cat_str)":"")."
                $where_without_filter
                ");
                $manuf_filter_allowed=array();
                while ($row=fetch($r))   {                	$manuf_filter_allowed[]=$row["manuf_id"];                }           // print_r($manuf_filter_allowed);





		        $r=mq($sql="SELECT SQL_CALC_FOUND_ROWS DISTINCT g.is_spec, g.id, g.title, g.chpu, g.price,g.photos, m.title AS mtitle, m.chpu AS mchpu , c1.chpu AS cat1chpu , c2.chpu AS cat2chpu , c3.chpu AS cat3chpu FROM goods g
		               INNER JOIN good2cat c2g ON c2g.good_id=g.id
		               						".($id?" AND (c2g.cat_id=$id  $cat_str)":"")."
		               LEFT JOIN manufs m ON m.id=g.manuf_id
		               LEFT JOIN cats c1 ON c1.id = c2g.cat_id
		               LEFT JOIN cats c2 ON c2.id = c1.parent_id
		               LEFT JOIN cats c3 ON c3.id = c2.parent_id
		               $where
		               ORDER BY ".($by_views?" view ".($desc?"DESC":"ASC").", id ".($desc?"DESC":"ASC")." ":" price  ".($desc?"DESC":"ASC")."")."

		               LIMIT $offset, $perpage

		        		");
		        while ($row=fetch($r))   {		        	  $row["href"]=url("good", $row);		        	  $goods[]=$row;

		        	  //echo "<pre>";print_r($row);echo " $sql</pre>";
		       	}

		        $count = mq_count();         if ($search) $goods_count=$count;
		        $page_count = ceil($count/$perpage);
		        $page++;







       }





        $h1=trim(/*($is_spec?"Спецпредложения ":"").*/($search?"Поиск ":"").$main["title"]." ".$manuf_title);

        if ( $is_spec){        	if (!$h1) $h1=gp("spec_h1");

        	if (!$main["descr"])
	        	$main["descr"]=gp("spec_descr1");     //$main["descr"]
			if (!$main["descr2"])
	        	$main["descr2"]=gp("spec_descr2");

	        if (!$main["meta_title"])
	        	$main["meta_title"]=gp("spec_meta_title");
	      	if (!$main["meta_descr"])
	        	$main["meta_descr"]=gp("spec_meta_descr");        }

        $page_title =$main["meta_title"];//
        if (!$page_title)$page_title =        $h1;
        $page_title.=($page>1?" — страница ".($page):"");






include "ctrl.left_menu_catalog.php";
include "ctrl.recently.php";

if ($main["parent_id"]   || $main["show_goods"]   || !count($cats)   || $search)        //фильтр выводится только не в родительской категории!
	        include "ctrl.filter.php";