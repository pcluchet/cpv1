<?php

if ($argc != 2)
	die("un seul argument");
//echo $argv[1];
//$eq = str_split($argv[1]);
$eq = $argv[1];

$eq = str_replace(' ','',$eq);

$a = 0;
$b = 0;
$c = 0;

$twoparts = explode("=", $eq);
print_r($twoparts);


//TODO
//if not two parts die
//

$left = explode('+', $twoparts[0]);
$right = explode('+', $twoparts[1]);

echo "simple split with +\n";

//print_r($left);
//print_r($right);

foreach ($left as $key => $value)
{
	if ($left[$key][0] !== '-')
	{
		$left[$key] = '+'.$left[$key];
	}
}

foreach ($right as $key => $value)
{

	if ($right[$key][0] !== '-')
	{
		$right[$key] = '+'.$right[$key];
	}
}



print_r($left);
print_r($right);

$newleft = array();
foreach ($left as $key => $value)
{
	if (strpos ($left[$key],'-') !== false)
	{
		echo "ici";
		$result = explode('-',$left[$key]);
		print_r($result);
		//array_splice($left,$key,1);
		foreach ($result as $k => $v)
		{
			if ($k != 0)
			{
				$result[$k] = '-'.$result[$k];
			}

		}
		//cas ou ca commence par un "-"
		if ($result[0] == "" )
		{
		array_splice($result,0,1);
		}

		$newleft = array_merge($newleft,$result);
	}
	else
	{
	$newleft[] = $left[$key];
	}

}

$newright = array();
foreach ($right as $key => $value)
{
	if (strpos ($right[$key],'-') !== false)
	{
		echo "ici";
		$result = explode('-',$right[$key]);
		//print_r($result);
		//array_splice($left,$key,1);
		foreach ($result as $k => $v)
		{
			if ($k != 0)
			{
				$result[$k] = '-'.$result[$k];
			}

		}

		//cas ou ca commence par un "-"
		if ($result[0] == "" )
		{
		array_splice($result,0,1);
		}
		$newright = array_merge($newright,$result);
	}
	else
	{
	$newright[] = $right[$key];
	}

}


print_r($newleft);
print_r($newright);









echo "\n";
?>
