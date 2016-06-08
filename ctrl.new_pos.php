<?


        $r=mq("SELECT g.*,  m.title AS mtitle, m.chpu AS mchpu , c1.chpu AS cat1chpu , c2.chpu AS cat2chpu , c3.chpu AS cat3chpu FROM goods   g
                       INNER JOIN good2cat c2g ON c2g.good_id=g.id
		               LEFT JOIN manufs m ON m.id=g.manuf_id
		               LEFT JOIN cats c1 ON c1.id = c2g.cat_id
		               LEFT JOIN cats c2 ON c2.id = c1.parent_id
		               LEFT JOIN cats c3 ON c3.id = c2.parent_id


        ORDER BY RAND() LIMIT 8 ");
        while ($row=fetch($r)) {        	$row["href"]=url("good", $row);        	$new_pos[]=$row  ;
        }

