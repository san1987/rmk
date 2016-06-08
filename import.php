<pre><?

$f=file("files/goods.csv");

$s="";

foreach($f as $line){	$s.=$line;
	if (substr($line,-2,1)!='"') continue;
	echo "$s\n";	preg_match_all("@\"([^\"]*)\"(;|\n)@", $s, $matches);
	print_r($matches[1]);
	$s="";}

?>