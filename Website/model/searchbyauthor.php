<?php
	function getpapersbyauthor($ip1,$authorname){
		
		$id_array = array();	
		$ip_array = array();	
		$exs = array();	
		foreach ($ip1 as $ip){
		$dbc=mysqli_connect($ip, "root", "","acadse");				
		$q="SELECT Id_aut FROM authors WHERE name='$authorname'";			
		$ret=mysqli_query($dbc,$q);
		$temp=mysqli_fetch_array($ret);
		$q="SELECT Id_ppr FROM paper_author WHERE Id_aut=$temp[Id_aut]";
		$ret=mysqli_query($dbc,$q);
		if($ret == false)
		{
			return array(array(), array(), array());
		}
		while($temp=mysqli_fetch_array($ret)){ // $temp contains the Id_ppr of the papers by the author
			$q = "SELECT id FROM paper_contents WHERE paperId=$temp[Id_ppr]";
			$ret1 = mysqli_query($dbc, $q);
			$temp1=mysqli_fetch_array($ret1);
			array_push($id_array,$temp1['id']); // Now this is the array of id from one IP corresponding to one author
			array_push ($ip_array, $ip);
			array_push ($exs, "");
		}		
		}
		$ret = array();
		//print_r($id_array);
		//print_r($ip_array);
		return array($id_array, $ip_array, $exs);
		//array_push ($ret, $id_array, $ip_array);
		//return $ret;
	}	
	//$ip1 = array("192.168.137.28", "192.168.137.2");
	//getpapersbyauthor($ip1,"thorsten joachims");
?>