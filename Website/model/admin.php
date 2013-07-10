<?php
	function get_unapproved()
	{
			require_once '../conf.php';

			$dbc=mysqli_connect(dbConf::$dbHostname, dbConf::$dbUser, dbConf::$dbPasswd,dbConf::$dbName);
			$q = "select * from admin";
			$ret= mysqli_query($dbc,$q);
			return $ret;
	}
	function remove_from_temp($prev)
	{
	require_once '../conf.php';	
	$db=mysqli_connect(dbConf::$dbHostname, dbConf::$dbUser, dbConf::$dbPasswd,dbConf::$dbName);
	$res=mysqli_query($db, "delete from admin WHERE name='$prev'");
		
	}

	function insert_paper($title, $prev, $tag, $auth, $year){	
	assert(is_array($auth));	
	
			require_once '../conf.php';	
			require_once '../t.php';		
		$db=mysqli_connect(dbConf::$dbHostname, dbConf::$dbUser, dbConf::$dbPasswd,dbConf::$dbName);
		$newdbhost=mysqli_query($db, "SELECT ip FROM ipmatch WHERE tag='$tag'");
		if(mysqli_num_rows($newdbhost)==0){
			unlink("../control/admin/".$prev);
			remove_from_temp($prev);
			return 0;
		}
		$te=mysqli_fetch_array($newdbhost);
		//echo $te['ip'];
		$db=mysqli_connect($te['ip'],"root" ,"","acadse");
		if(!$db)
			die("Could not connect".mysql_error());
		$query=mysqli_query($db, "SELECT Id_ppr FROM papers WHERE name='$title'");
		if(mysqli_num_rows($query)==0){ // Not found
			//echo "Does not already exist. Now inserting...\n";
			$result = mysqli_query($db, "INSERT INTO papers (name,year) VALUES ('$title', '$year')");
			//echo "Should have been inserted by now\n".$result;
			$id_paper=mysqli_query($db, "SELECT Id_ppr FROM papers WHERE name='$title'"); // Id_paper from the table
			$row=mysqli_fetch_array($id_paper);
			$id_paper=$row['Id_ppr'];
			
			remove_from_temp($prev);
			rename("../control/admin/".$prev,"../control/admin/".$id_paper.".pdf");
			$prev=$id_paper.".pdf";
			
			$contents = shell_exec("c:\\wamp\\www\\pdftotext.exe c:\\wamp\\www\\control\\admin\\".$prev." -");
			$len = min(10000, strlen($contents));
			$contents = substr($contents, 0, $len);
			$contents = str_replace("\x27", "", str_replace("\x22", "", $contents));
			//echo $contents;
			mysqli_query($db, "INSERT INTO paper_contents VALUES('NULL', '$id_paper', '$title', '$contents')");
			
			$image = $id_paper.".jpg";
			$s = "gswin32c -dFirstPage=1 -dLastPage=1 -r200 -sDEVICE=jpeg -o c:\\wamp\\www\\control\\admin\\".$image." c:\\wamp\\www\\control\\admin\\".$prev;
			shell_exec($s);
			
			ftp_push($te['ip'], "C:\wamp\www\control\admin\\".$prev, $prev);
			ftp_push($te['ip'], "C:\wamp\www\control\admin\\".$image, $image);
			//$str="xcopy ..\control\admin\\".$prev." ..\DatabasePapers\\ ";
			//echo $str;
//			system($str);
			unlink("admin/" . $prev);
			unlink("admin/" . $image);
			
		}
		else {
			echo "Paper already exist";
			return 0;
			//header() // The paper already exist. Return from here.		
		}		
	foreach($auth as $name){
		$id_author=mysqli_query($db, "SELECT Id_aut FROM authors WHERE name='$name'");
		if(mysqli_num_rows($id_author)==0){ // Author is not there. Insert the author and then insert into paper_author the pair.
			mysqli_query($db, "INSERT INTO authors (name) VALUES ('$name')");			
			$id_author=mysqli_query($db, "SELECT Id_aut FROM authors WHERE name='$name'");
			$row=mysqli_fetch_array($id_author);
			$temp_id_aut=$row['Id_aut'];
			mysqli_query($db, "INSERT INTO paper_author (Id_aut, Id_ppr) VALUES ('$temp_id_aut','$id_paper')");	
		}
		else
			{
			$row=mysqli_fetch_array($id_author); 
			$temp_id_aut=$row['Id_aut']; 
			mysqli_query ($db, "INSERT INTO paper_author (Id_aut, Id_ppr) VALUES ('$temp_id_aut', '$id_paper')"); 
			}
		}
		
		$temp = mysqli_query($db, "SELECT Id_tag FROM tags WHERE name='$tag'");
		$row = mysqli_fetch_array($temp);
		$tagid = $row['Id_tag'];
		$temp = mysqli_query($db, "SELECT * FROM paper_tag WHERE Id_tag='$tagid' AND Id_ppr='$id_paper'");
		if(mysqli_num_rows($temp) == 0)
		{
			mysqli_query($db, "INSERT INTO paper_tag VALUES('$tagid', '$id_paper')");
		}
		
		
		return 1;
	
}

?>