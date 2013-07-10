<?php
	require_once '../model/admin.php';
	$name=$_POST['name'];
	$prev=$_POST['prev'];
	$tag=$_POST['tag'];
	$author= $_POST['authors'];
	$year=$_POST['year'];
	if(isset($_POST['decline']))
	{
		unlink("admin/".$prev);
		remove_from_temp($prev);
	}
	else
	{
		$approve=$_POST['approve'];
		
		
		$author_arr=array();
		
		$temp=strtok($author,",");
		
		while($temp!=false)
		{
			$temp=trim($temp);
			array_push($author_arr,$temp);
			$temp=strtok(",");
		}
		echo $prev;
		if(count($author_arr) == 0)
			array_push($author_arr, "");
		insert_paper($name,$prev,$tag,$author_arr,$year);
	}
	
	echo "print ho jaaa";
	header("Location:admin.php");
?>
	