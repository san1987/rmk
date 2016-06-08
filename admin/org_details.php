<?

if ($addnew){	mq("INSERT INTO org_details (title) VALUES ('Новая организация')");}

if ($save){
	foreach ($ids as $_id=>$v){		mq("
		UPDATE `org_details` SET
				`title` = '".mres($title[$_id])."',
				`INN` = '".mres($INN[$_id])."',
				`KPP` = '".mres($KPP[$_id])."',
				`Bank` = '".mres($Bank[$_id])."',
				`BIK` = '".mres($BIK[$_id])."',
				`kor_schet` = '".mres($kor_schet[$_id])."',
				`ras_schet` = '".mres($ras_schet[$_id])."',
				`Addr` = '".mres($Addr[$_id])."',
				`Phone` = '".mres($Phone[$_id])."',
				gen_dir = '".mres($gen_dir[$_id])."',
				glav_buh= '".mres($glav_buh[$_id])."',
				`active` = ".intval($active[$_id])." WHERE  `id` =".intval($_id).";
		");	}}

?>
<a href='.?p=<?=$p?>&m=<?=$m?>&addnew=1'>Добавить новую</a><br><br>
<form method=post>
<?
$r=mq("SELECT * FROM org_details ORDER BY id DESC");
while ($row=fetch($r)){	echo "ID: ".$row["id"]." <b>".$row["title"]."</b><br><br>";
	echo "<table border=1 cellspacing=0 cellpadding=5 style='width:100%; max-width:1000px'>";

	echo "<tr><td width=40%><b>Название:</b></td><td><input type=text name=".($param_name="title")."[".$row["id"]."] value='".$row[$param_name]."' style='width:100%'></td></tr>";
	echo "<tr><td width=40%><b>ИНН:</b></td><td><input type=text name=".($param_name="INN")."[".$row["id"]."] value='".$row[$param_name]."' style='width:100%'></td></tr>";
	echo "<tr><td width=40%><b>КПП:</b></td><td><input type=text name=".($param_name="KPP")."[".$row["id"]."] value='".$row[$param_name]."' style='width:100%'></td></tr>";
	echo "<tr><td width=40%><b>Банк:</b></td><td><input type=text name=".($param_name="Bank")."[".$row["id"]."] value='".$row[$param_name]."' style='width:100%'></td></tr>";
	echo "<tr><td width=40%><b>БИК:</b></td><td><input type=text name=".($param_name="BIK")."[".$row["id"]."] value='".$row[$param_name]."' style='width:100%'></td></tr>";
	echo "<tr><td width=40%><b>р/с:</b></td><td><input type=text name=".($param_name="kor_schet")."[".$row["id"]."] value='".$row[$param_name]."' style='width:100%'></td></tr>";
	echo "<tr><td width=40%><b>к/c:</b></td><td><input type=text name=".($param_name="ras_schet")."[".$row["id"]."] value='".$row[$param_name]."' style='width:100%'></td></tr>";
	echo "<tr><td width=40%><b>Адрес:</b></td><td><input type=text name=".($param_name="Addr")."[".$row["id"]."] value='".$row[$param_name]."' style='width:100%'></td></tr>";
	echo "<tr><td width=40%><b>Телефон:</b></td><td><input type=text name=".($param_name="Phone")."[".$row["id"]."] value='".$row[$param_name]."' style='width:100%'></td></tr>";

	echo "<tr><td width=40%><b>ген дир:</b></td><td><input type=text name=".($param_name="gen_dir")."[".$row["id"]."] value='".$row[$param_name]."' style='width:100%'></td></tr>";
	echo "<tr><td width=40%><b>глав бух.:</b></td><td><input type=text name=".($param_name="glav_buh")."[".$row["id"]."] value='".$row[$param_name]."' style='width:100%'></td></tr>";
	echo "<tr><td width=40%><b>Эти реквизиты активны (выводятся клиенту):</b></td><td><input type=checkbox name=".($param_name="active")."[".$row["id"]."] value=1  ".($row[$param_name]?" checked ":"")."></td></tr>";
	echo "</table><input type=hidden name=ids[".$row["id"]."] value=".$row["id"]."><br><br><br><br>";
/*

ген дир и глав бух.

	`title` TEXT NOT NULL ,
`` TEXT NOT NULL ,
`` TEXT NOT NULL ,
`` TEXT NOT NULL ,
`` TEXT NOT NULL ,
`` TEXT NOT NULL ,
`` TEXT NOT NULL ,
`` TEXT NOT NULL ,
`` TEXT NOT NULL ,
`` INT NOT NULL ,*/}

?>

<input type=hidden name=p value=<?=$p?>>
<input type=hidden name=save value=1>
<input type=submit>
</form>