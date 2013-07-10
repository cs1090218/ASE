<?php
ini_set('display_errors', 1); 

$squery=$_GET['name'];
$param=$_GET['param'];
$max=10;
$ips = array();
$ids = array();
$exs = array();
$tot = 0;
if(isset($_GET['page']))
{
	$max=$_GET['page']*10;
}
if($param == 1)
{
	
		
	require_once '../model/search.php';
	require_once '../model/querythis.php';

	if(strpos($squery,'&') !=false || strpos($squery,'|')!=false)
		$mode="e2";
	else
		$mode="n2";
		
	$arr2d=array(array());
	$sizes = array();
	$ret=ip_re();
	$ar=array();
	$total_result=0;
	

	$weights = array();
	
	$number=0;
	while($ip=mysqli_fetch_array($ret))
	{
		$qtemp = query_sphinx($squery,$mode,$ip['ip'],9312,$max);

		if ( $qtemp["total"] != 0 &&is_array($qtemp["matches"]) )
		{
			$q = $qtemp["matches"];
			$ex = $qtemp["excerpts"];
		}
		else {
			$q = array();
			$ex = array();
		}
		
		$total_result = 0;
		foreach ( $q as $docinfo )
		{
			$tot++;
			$id= $docinfo['id'];
			$weight= $docinfo['weight'];
			array_push($weights,$weight);
			array_push($ips,$ip['ip']);
			array_push($exs, $ex[$total_result]);
			array_push($ids,$id);
			$total_result++;
			//$entry=array($ip['ip'], $id,$weight);
			//array_push($arr2d,$entry);
		}
		array_push($sizes, $total_result);
	//	break;
	}
	unset($arr2d[0]);

	array_multisort($weights, SORT_DESC, $ids, $ips);

	//echo $max." ".$tot;
	/*
	for($i=0;$i<20;$i++)
	{

		echo $i." " .$weights[$i]. "      ".$ids[$i]. "      ".$ips[$i]."<br>";
	}


	for($i=0;$i<($max-10);$i++)
	{
		unset($weights[$i]);
		unset($ids[$i]);
		unset($ips[$i]);
		//echo $i." " .$weights[$i]. "      ".$ids[$i]. "      ".$ips[$i]."<br>";
	}

	*/

}
else {
	require_once '../model/searchbyauthor.php';
	require_once '../model/search.php';
	$ret=ip_re();
	$iparr = array();
	while($ip = mysqli_fetch_array($ret)) {
		array_push($iparr,$ip['ip']);
		
	}
	$retpapers = getpapersbyauthor($iparr,$squery);
	$ids = $retpapers[0];
	$ips = $retpapers[1];
	$exs = $retpapers[2];
	$tot = sizeof($ids);
	//$ip1 = array("192.168.137.28", "192.168.137.2");
	
}


		require_once '../view/search.php';
		
		printSearchDetailsAndQueryBox($squery, $max, $param);
		$num = $tot - $max + 10;
		$k=1;
		for($i=($max-10);$i<$max && $i<$tot ;$i++)
		{
			$res=find_details($ids[$i], $ips[$i]);	
			if($num == 1)
			printsearch($res[0],$res[1],$ips[$i],$res[2], $exs[$i],4);
			else if($k==1)
			printsearch($res[0],$res[1],$ips[$i],$res[2], $exs[$i],1);
			else if($k==$num)
			printsearch($res[0],$res[1],$ips[$i],$res[2], $exs[$i],2);
			else
			printsearch($res[0],$res[1],$ips[$i],$res[2], $exs[$i],3);
			
			$k++;
		}
		bottomPane($squery, $max, $param, $num);






?>
