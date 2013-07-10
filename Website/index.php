<?php 
session_start();

?>

<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Home | ASE, IIT Delhi </title>
<link rel="stylesheet" href="css/main.css">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta http-equiv="edit-Type" edit="text/html; charset=utf-8">
<script type='text/javascript' src='js/my.js'></script>
<script type='text/javascript' src='js/formbox.js'></script>

<script src="js/jquery.min.js" type="text/javascript"></script>



<link href="css/searchMeme.css" rel="stylesheet" type="text/css" />

<style>


</style>	

<script type="text/javascript">
/*
$(document).ready(function() {
        $search_box = $("#search_box");
 
        // If the user clicks the input box and the text is "search here!",
        //    set it to blank
        $search_box.click(function() {
            if( $search_box.attr("value") == "Search...." ) {
 
                // Set it to an empty string
                $search_box.attr("value", "");
            }
        });
  });*/
  $search_param="1";
  $(document).ready(function(){
		$("#param").attr("value", $search_param);
	  $("#search_box")
	  .focus(function() {
			if($("#search_box").attr("value") == "Search....")
				$("#search_box").attr("value", "")
	  })
	  .blur(function() {
			if($("#search_box").attr("value") == "")
				$("#search_box").attr("value", "Search....")
	  });
});

		
		
		function titl()
		{
			alert("title");
			$search_param=1;
		};
		function author()
		{
//			button.style.backgroundColor:#ff0000;
			alert("author");
			$search_param=0;
		}
		function send_query()
		{
			$name = document.search_form.search_query.value;
			alert("sending query" + $name);
			//console.log($name);
			$url= "control/search.php?"+"name="+$name+"&"+"param="+$search_param;
			window.location=$url;			
		}
		function popular_a()
		{
			window.location="control/popular.php?author";			
		}
		function popular_t()
		{
			window.location="control/popular.php?title";			
		}
		function popular_c()
		{
			window.location="control/popular.php?citation";			
		}
		function applyClass(classes){
		var e=document.getElementById(classes);
		
		var e2 = document.getElementById(classes=="1"?"2":"1");
		if(e.className == 'button')
		{
			e.className = 'buttons';
			e2.className = "button";
		}
		/*	
		else
		{
			e.className = 'button'
			e2.className = "buttons";
		}*/
		if(classes == '1')
			$search_param=0;
		else
			$search_param=1;
		$("#param").attr("value", $search_param);
		}
	

</script>
	

</head>

<body>



<div id="edgesline" class="edges"></div>
<div id="tabs">

    <ul id="tabMenu">
  
        <li class="regular"><a href="index.php">Home</a></li>
	<?php if(!isset($_SESSION['myusername'])){ ?>
        <li class="dropdown"><a href="#tab1">Login</a></li>
        <li class="dropdown"><a href="#tab2">Sign-Up</a></li>
    <?php } ?>
	<?php if(isset($_SESSION['myusername'])) { ?>
		<li class="dropdown"> <a href="#tab3"><span > upload </a></span></li>
		<?php if($_SESSION['priv'] == 0)	{  ?>
		
		<li class="regular"> <a href="control/admin.php"><span > Admin Option</a></span></li> <?php } ?>
		<li class="regular"><a href="control/logout.php"><span style="color:green"> Logout </a></span></li>
		<?php 	}?>
    </ul>


</div>

<div id="tabContainer">
<?php if(!isset($_SESSION['myusername'])){ ?>
	<ul id="tabPanes">
		<li id="tab1">
			
			<p>
				<form method="post" action="control/login.php">
				<div class="formcontainer" >
					
					<div>
						<label for="username">Username</label>
						<input type="text" class="custom" name="myusername" id="username" alt="The username you chose when signing-up for the site.">
					</div>
					
					<div>
						<label for="password">Password</label>
						<input type="password" class="custom" name="mypassword" id="password" alt="The password you chose when signing-up for the site.">
					</div>
					
					<div style="visibility:hidden" >
						<label for="username1">Username1</label>
						<input type="text" name="myusername1" id="username1" alt="The user1name you chose when signing-up for the site.">
					</div>
					<div style="visibility:hidden" >
						<label for="username2">Username2</label>
						<input type="text" name="myusername2" id="username2" alt="The usern2ame you chose when signing-up for the site.">
					</div>
				</div>
				
				
				<center>

				
					<div class="block" id="bluebutton">
						<button type="submit" >Login</button>
					</div>
				</center>
				</form>
				
			</p>

		</li>
		
		<li id="tab2">
			
			<p>
				<form method="post" action="control/register.php">
				<div class="formcontainer">
					<div class="text">
						<label for="username">Desired Username</label>
						<input type="text" class="custom" name="desusername" id="desusername" alt="Username should be unique. <br>All Lowercase letters.<br>Easy to remember">
					</div>

					
					<div class="text">
						<label for="email">Email id</label>
						<input type="email" class="custom" name="email" id="email" alt="enter a valid email id">
					</div>

					<div class="text">
						<label for="despassword">Desired Password</label>
						<input type="password" class="custom" name="despassword" id="despassword" alt="">
					</div>

					<div class="text">
						<label for="password">Confirm Password</label>
						<input type="password" class="custom" name="confpassword" id="confpassword" alt="Please ensure this matches the password above">
					</div>

				</div>
				
				<center>
					<div class="block" id="bluebutton">
						<button type="submit">Sign-Up</button>
					</div>
				</center>
				</form>
				
			</p>
		</li>
		
	</ul>


	<?php } else {?>
	
		<ul id="tabPanes">
			<li id="tab3">
				
				<p>
					<form method="post" action="control/upload.php" method="post" enctype="multipart/form-data">
						<div class="formcontainer">
							<div class="text">
							<p> <b>The paper uploaded would be reviewed by the admin </b></p>
							</div>

							<div class="text">
								<label for="username">Upload from file</label>
								<br>
								<input type="file" name="file" id="file" alt="less than 1MB">
							</div>

							<br>
							<!--
							<div class="text">
								<label for="email">Upload from a link</label>
								<input type="text" name="pdflink" id="pdflink" alt="give a valid link">
							</div>


							-->
						</div>
						
						<center>
							<div class="block" id="bluebutton">
								<button type="submit">Upload</button>
							</div>
						</center>
					</form>
					
				</p>
			</li>
		</ul>

<?php } ?>

	
</div>
<div style="text-align: center;
color: red;"> 	
	<?php 
		if(isset($_GET['error']))
		{
			if($_GET['error']=='1') 
				echo "The passwords are mismatching"; 
			else if($_GET['error']=='2') 
				echo "The username is already taken";
			else if($_GET['error']=='3') 
				echo "The email-id is already registered";
			else if($_GET['error']=='4') 
				echo "No field can be left empty";
		}
		if(isset($_GET['success']))
		{
			if($_GET['success']==0)
				echo "Username or password is incorrent";
		}
	?>
</div>
<div class="head_name">
<H1><img src="images/title.gif" height="100px" style="text-align:center" /></H1>
</div>

	<div class="wrapper">
		<form name="search_form" action="control/search.php" method="get" >
			<table align='center'>
			<tr>
			<td><input type="text" class = "inputc" style="width:500px;" name="name" id="search_box" value="Search...."></input></td>
			<td><input type="hidden" class = "inputc" style="width:0px;" name="param" id="param" value="1" ></input></td>
			<td style="width:15px"></td>
			<td><input type="image" src="images/searchButton.png" name="image" width="50px" height="40px" ></td>
			</tr>
			</table>
			
			
			<br>
			<span id="2" class="buttons" onclick="applyClass('2');">Title</span>
			<span id="1" class="button" style="margin-right:430px" onclick="applyClass('1');">Author</span>	
		</form>
			<div class="clear">
			</div>
</div>

<br>
<br>
<br>
	
</div>

<br><br><br><br>
<div id = "Footer">
	
	<hr style="margin-left:3cm;margin-right:3cm">
	<p style="color:#5FC9F9; text-align:center;" ><strong style="font-size:20 ">&#169 </strong>&nbsp TeamQuark, IIT Delhi</p>
</div>


