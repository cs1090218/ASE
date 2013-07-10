<?php


	require_once '../model/upload.php';
	
	$name=str_replace(" ","_",$_FILES["file"]["name"]);
	$allowedExts = array("pdf");
	$extension = end(explode(".", $_FILES["file"]["name"]));
	if (in_array($extension, $allowedExts) && $_FILES['file']['size']<1048576)
	  {
	  if ($_FILES["file"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
		}
	  else
		{

			echo "Upload: " . $name. "<br />";
			echo "Type: " . $_FILES["file"]["type"] . "<br />";
			echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
			echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
			//echo "link: ". $_POST["pdflink"]. "<br>";
			up_file($name,$_FILES["file"]["tmp_name"]);

		}
	  }
	else
	  {
		echo "Invalid file";
	  }
	/*
	else 
	{
		$url = $_GET["pdflink"];
		$namepdf="name.pdf";
		$path = "../mode/admin/".$namepdf;
		file_put_contents($path, file_get_contents($url));
		up_file_url($namepdf);
	}

	*/
			header("Location:../index.php");
?>

