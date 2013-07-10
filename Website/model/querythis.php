<?php

	function query_sphinx($q,$mode,$host,$port,$max)
	{
		require_once "test.php";
		if($mode == "")
			$arr = array($q, "-h", $host, "-p", $port);
		else
			$arr = array($q, "-".$mode, "-h", $host, "-p", $port, "-l2", $max);
		return queryme($arr);
	}


?>