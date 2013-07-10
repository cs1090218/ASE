<?php
session_start();

if(isset($_SESSION['myusername']))
	header("location:../index.php");
else
{

	ini_set('display_errors', 1); 
	// matching username and password
	$password=($_POST['mypassword']);
	$username=$_POST['myusername'];
	require_once '../model/login-check.php';

	$q=checkLogin ($username,$password);



	$ans=mysqli_fetch_array($q);
	if(($ans))
	{
		$name=$ans['username'];
		$priv=$ans['priv'];
		session_start();

		$_SESSION['myusername'] = $username;
		$_SESSION['priv'] = $priv;
		echo $priv;
	
		header("location:../index.php");
	}
	else
		header("location:../index.php?success=0");
}
?>
