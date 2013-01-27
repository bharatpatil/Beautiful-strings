<?php

$fpWrite = fopen('problem3Output.txt','w+');
$fp = fopen('problem3Input.txt','r');

$counter = (int)fgets($fp);
$countCase = 1;
while(!feof($fp) && $counter--)
{
	$line1 = fgets($fp); 
	$n = explode(' ',$line1);
	$k = $n[1];
	$n = $n[0];
	
	$line2 = fgets($fp);
	$e = explode(' ',$line2);
	$a = $e[0];
	$b = $e[1];
	$c = $e[2];
	$r = $e[3];
	

	$m = array();
	array_push($m,$a);
	for($i=1;$i<$k;$i++)
	{
		array_push($m,($b * $m[$i-1] + $c) % $r);
		echo $i .' = '. $m[$i] . "\n";
	}
	
	sort($m);	
	print_r($m);	
	exit;
}

fclose($fp);
fclose($fpWrite);
	

