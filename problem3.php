<?php
function nextVal($arr,$start)
{
    $j = $start;
    $l = count($arr);
    $ret = $start - 1;
    while ($j < $l and $arr[$j])
    {
        $ret = $j;
        $j += 1;
    }
    return $ret;
	
}

$fpWrite = fopen('problem3Output.txt','w+');
$fp = fopen('find_the_mintxt.txt','r');

$counter = (int)fgets($fp);
$countCase = 1;
while(!feof($fp) && $counter--)
{
	$line1 = fgets($fp); 
	$e = explode(' ',$line1);
	$k = (int)$e[1];
	$n = (int)$e[0];
	$line2 = fgets($fp);
	$e = explode(' ',$line2);
	$a = (int)$e[0];
	$b = (int)$e[1];
	$c = (int)$e[2];
	$r = (int)$e[3];
	$m = array_fill(0,4*$k,0);
	$s = array_fill(0,$k+1,0);

	$m[0] = $a;
	if ($m[0] <= $k)
		$s[$m[0]] = 1;
	foreach(range(1,$k) as $i)
	{
		$m[$i] = ($b * $m[$i-1] + $c) % $r;
		if($m[$i] < $k+1)
		    $s[$m[$i]] += 1;
	}        
	
	$p = nextVal($s,0);

	$m[$k] = $p + 1;
	$p = nextVal($s, $p+2);
	
	
	foreach(range($k+1,$n) as $i)
	{
		if($m[$i-$k-1] > $p ||  $s[$m[$i-$k-1]] > 1)
		{
		    $m[$i] = $p + 1;
		    if ($m[$i-$k-1] <= $k)
		        $s[$m[$i-$k-1]] -= 1;
		    $s[$m[$i]] += 1;
		    $p = nextVal($s, $p+2);
		}
		else
		{
		    $m[$i] = $m[$i-$k-1];
		}
		if ($p == $k)
		    break;
	}

	$outputLine = '';
	if ($p != $k)
        	$outputLine = 'Case #'.$countCase++.': '.$m[$n-1]."\n";
	else
		$outputLine = 'Case #'.$countCase++.': '.$m[$i-$k + ($n-$i+$k+$k) % ($k+1)]."\n"; 
	echo $outputLine;	
	fwrite($fpWrite,$outputLine);	
}

fclose($fp);
fclose($fpWrite);
	

