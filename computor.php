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

echo "Startingpoint";

print_r($newleft);
print_r($newright);

$degrees = array();

foreach ($newleft as $key => $value)
{

	$pos = 0;
	if (($pos = strpos($newleft[$key], 'X^')) !== false)
	{
		$degree = substr($newleft[$key],$pos + 2);
		$number = explode('*',$newleft[$key]);	
		$number = $number[0];
		if (!isset($degrees[$degree]))
		{
			$toadd = array($degree => 0);
			$degrees = $degrees + $toadd;
		}
		$degrees[$degree] += (float)$number;

	}
}

foreach ($newright as $key => $value)
{


	$pos = 0;
	if (($pos = strpos($newright[$key], 'X^')) !== false)
	{
		$degree = substr($newright[$key],$pos + 2);
		$number = explode('*',$newright[$key]);	
		$number = $number[0];
		if (!isset($degrees[$degree]))
		{
			$toadd = array($degree => 0);
			$degrees = $degrees + $toadd;
		}
		$degrees[$degree] -= (float)$number;

	}
}

print_r($degrees);

//print in reduced form
echo "Reduced form : ";
foreach ($degrees as $key => $value)
{
	if ($key != 0)
	{
		if ($value >= 0)
		{
			echo " + ";
		}
		else
		{
			echo " ";
		}
	}
	echo "$value * X^";
	echo $key;
}
echo " = 0\n";


foreach ($degrees as $key => $value)
{
	if ($value == 0)
	{
	unset($degrees[$key]);
	}
}

$maxdeg = 0;
if (count($degrees) != 0)
{
$maxdeg = max(array_keys($degrees));
}

echo "Polynomial degree : ". ($maxdeg)."\n";


if (count($degrees) == 0)
{
	die("It seems any real number is a solution to this equation");
}



if ($maxdeg > 2)
{
	echo "The polynomial degree is stricly greater than 2, I can't solve.\n";
	die();
}

//TODO
//0's degree
//
//
	
if ($maxdeg == 0)
{
	echo "No solution\n";
	die();

}
	
if ($maxdeg == 1)
{
	echo "One solution, x = ";
	echo ((-1) * $degrees[0]) / ($degrees[1])."\n";

	die();
}

$discriminant = ($degrees[1])*($degrees[1]) - (4 * ($degrees[2] * $degrees[0]));
echo "Discriminant : ".$discriminant."\n";

if ($discriminant == 0)
{
	echo "One solution x = ";
	echo ((-1) * $degrees[1])/(2 * $degrees[2])."\n";
}

if ($discriminant > 0)
{
	echo "Two solutions : \n";
	echo "x1 = ";
	echo (((-1) * $degrees[1]) + sqrt($discriminant)) / (2 * $degrees[2]);
	echo "\n";
	echo "x2 = ";
	echo (((-1) * $degrees[1]) - sqrt($discriminant)) / (2 * $degrees[2]);
	echo "\n";

}

if ($discriminant < 0)
{
	echo "No solutions in R, solutions in C : \n";
	echo "x1 = ";
	echo '('.((-1) * $degrees[1]).' + i * sqrt('.abs($discriminant).')) / '. (2 * $degrees[2]);
	echo "\n";
	echo "x2 = ";
	echo '('.((-1) * $degrees[1]).' - i * sqrt('.abs($discriminant).')) / '. (2 * $degrees[2]);
	echo "\n";

}




echo "\n";
?>
