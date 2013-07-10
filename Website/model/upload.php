<?php

	function up_file($a,$b)
	{
	
	//	echo "inserting".$a." ".$b;
		require_once '../conf.php';

		$dbc=mysqli_connect(dbConf::$dbHostname, dbConf::$dbUser, dbConf::$dbPasswd,dbConf::$dbName);

		if (!file_exists("admin/".$a))
		{
			move_uploaded_file($b,"admin/" . $a);
			$q="insert into admin values('$a')";
			$r=mysqli_query($dbc,$q);
		}
	}
	
/*	function up_file_link($a)
	{
		require_once '../conf.php';

		$dbc=mysqli_connect(dbConf::$dbHostname, dbConf::$dbUser, dbConf::$dbPasswd,dbConf::$dbName);
		$q="insert into admin values('$a')";
		$r=mysqli_query($dbc,$q);
	}
*/

?>