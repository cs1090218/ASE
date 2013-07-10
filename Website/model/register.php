<?php

header("location: ../index.php");

function get_username($userName) {
    require_once '../conf.php';

    $dbc=mysqli_connect(dbConf::$dbHostname, dbConf::$dbUser, dbConf::$dbPasswd,dbConf::$dbName);
    //check in  db
    $q="select Email_id from users where username='$userName'";
    $r=mysqli_query($dbc,$q);
    $rows= mysqli_num_rows($r);
    
	return $rows;
 }

function get_email($email) {
    require_once '../conf.php';

    $dbc=mysqli_connect(dbConf::$dbHostname, dbConf::$dbUser, dbConf::$dbPasswd,dbConf::$dbName);
    //check in  db
    $q="select Email_id from users where Email_id='$email'";
    $r=mysqli_query($dbc,$q);
    $rows= mysqli_num_rows($r);
    
    return $rows;
 }


function register($userName,$pass,$email) {
    require_once '../conf.php';
	$priv=1;
    $dbc=mysqli_connect(dbConf::$dbHostname, dbConf::$dbUser, dbConf::$dbPasswd,dbConf::$dbName);
    //check in  db
    $q="insert into users values (NULL, '$email','$userName','$pass','$priv')";
    $r=mysqli_query($dbc,$q);
	
    if ($r ==false) {
        echo "<br> ".mysqli_error($dbc)."<br>"."Query: ".$q;
    }
    //echo 'rows='.mysqli_num_rows($r);
    
/*    if (mysqli_num_rows($r)==1) {
        $row=mysqli_fetch_array($r);
        $res['name']=$row['username'];
	$res['Priv']=$row['priv'];
 */ return $r;
    
 }

 
 ?>