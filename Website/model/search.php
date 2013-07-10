<?php


function find_details($id,$ip)
{
		$dbc=mysqli_connect($ip, "root", "","acadse");
		$q="select paperId from paper_contents where id=$id";
		$ret=mysqli_query($dbc,$q);
		$temp=mysqli_fetch_array($ret);
		$paper_id=$temp['paperId'];
		$q="select * from papers where Id_ppr=$paper_id";
		$ret=mysqli_query($dbc,$q);
		$temp=mysqli_fetch_array($ret);
		$title=$temp['name'];
		$year = $temp['year'];
		$q="select Id_aut from paper_author where Id_ppr=$paper_id";		
		$ret=mysqli_query($dbc,$q);
		$ret_arr="";
		//echo "*********".mysqli_num_rows($ret);
		while($temp=mysqli_fetch_array($ret))
		{
			$author_id=$temp['Id_aut'];
			$q="select name from authors where Id_aut=$author_id";		
			$ret1=mysqli_query($dbc,$q);
			$temp1=mysqli_fetch_array($ret1);
			$author=$temp1['name'];
			$ret_arr=$ret_arr.", ".$author;
//			echo $author. " ";
		}
		return array($title,substr($ret_arr,2)."  in ".$year,$paper_id);
}	

function ip_re()
{
	
			require_once '../conf.php';

			$dbc=mysqli_connect(dbConf::$dbHostname, dbConf::$dbUser, dbConf::$dbPasswd,dbConf::$dbName);
			$q = "select distinct ip from ipmatch";
			$ret=mysqli_query($dbc,$q);
			return $ret;	
}

?>