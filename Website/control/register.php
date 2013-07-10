<?php
session_start();

if(isset($_SESSION['myusername']))
	header("location:../index.php");
else
{

	ini_set('display_errors', 1); 

	$password=($_POST['despassword']);
	$conf_password=($_POST['confpassword']);
	$username=$_POST['desusername'];
	$email= $_POST['email'];


	require_once '../model/register.php';

	if($username == '' || $password == '' || $email == '' || $conf_password == '')
	{
		header("location:../index.php?error=4");
	}

	else if($password != $conf_password)
	{
		header("location:../index.php?error=1");
	}
	else
	{

	if(get_username($username) > 0)
		header("location:../index.php?error=2");
	else if(get_email($email) > 0)
		header("location:../index.php?error=3");


	else
	{
		$q=register($username,$password,$email);

		session_start();

		$_SESSION['myusername'] = $username;

		$_SESSION['priv'] = "1" ;

		header("location:../index.php");
	}
	}
}
?>
