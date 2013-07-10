<?php

function findit($b, $host)
{
	$value = "";
	$docs = array();
	$dbc=mysqli_connect($host, "root", "", "acadse");
	$q="SELECT * FROM paper_contents WHERE id='$b'";
	$r=mysqli_query($dbc,$q);
	while($arr = mysqli_fetch_array($r))
	{
		$value = $arr['contents'];
	}
	
	return $value;
}
?>