<?php
header("location: ../index.php");



function checkLogin ($userName,$pass) {
    require_once '../conf.php';
    $dbc=mysqli_connect(dbConf::$dbHostname, dbConf::$dbUser, dbConf::$dbPasswd,dbConf::$dbName);
    //check in  db
    $q="SELECT * FROM users WHERE username='$userName' and userpass='$pass'";
    
    $r=mysqli_query($dbc,$q);
    if ($r ==false) {
        echo "<br> ".mysqli_error($dbc)."<br>"."Query: ".$q;
    }
    //echo 'rows='.mysqli_num_rows($r);
    
/*    if (mysqli_num_rows($r)==1) {
        $row=mysqli_fetch_array($r);
        $res['name']=$row['username'];
	$res['Priv']=$row['priv'];
 */       return $r;
    
 }

 
 ?>