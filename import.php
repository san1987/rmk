<pre><?

$f=file("files/goods.csv");

$s="";

foreach($f as $line){
	if (substr($line,-2,1)!='"') continue;
	echo "$s\n";
	print_r($matches[1]);
	$s="";

?>