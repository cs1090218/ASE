<?php

//$str = "xcopy exam.pdf control\ ";
//echo $str;
//system($str);

function ftp_push($ftp_server, $local_file, $server_file)
{
	//$ftp_server = "192.168.137.28";
	$ftp_user = "himanshu";
	$ftp_pass = "him";
	//$local_file = "C:\wamp\www\abhi.pdf";
	//$server_file= "control\a.pdf";


	echo "\n\n\n'$local_file' ---- '$server_file' ----- '$ftp_server'\n\n";
	$conn_id = ftp_connect($ftp_server) or die ("couldn't connect to $ftp_server");
	$login_result = ftp_login($conn_id,$ftp_user,$ftp_pass);

	//if(ftp_get($conn_id,$local_file,$server_file, FTP_BINARY)){
	if(ftp_put($conn_id,$server_file,$local_file, FTP_BINARY)){
		echo "Gt the file Connected";
		}
		else {
		echo "There was a problem Could not connect";
		}
		
	ftp_close($conn_id);	
}	

?>