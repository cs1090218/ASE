<?php 
session_start();

?>

<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Home | ASE, IIT Delhi </title>
<link rel="stylesheet" href="css/style1.css">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta http-equiv="edit-Type" edit="text/html; charset=utf-8">
<script type='text/javascript' src='js/my.js'></script>
<script type='text/javascript' src='js/formbox.js'></script>

<script src="js/jquery.min.js" type="text/javascript"></script>



<link href="css/searchMeme.css" rel="stylesheet" type="text/css" />

<style>


</style>	

<script type="text/javascript">
  // Some simple jQuery to remove the default search value when the user clicks the box
  $(document).ready(function() {
        $search_box1 = $("#search_box1");
		$search_box2 = $("#search_box2");
		$search_box3 = $("#search_box3");
		$search_box4 = $("#search_box4");
		$bodyid = $("#body");

        $search_box1
			.focus(function() {
            if( $search_box1.attr("value") == "title of paper" ) {
 
                // Set it to an empty string
                $search_box1.attr("value", "");
            }
        })
			.blur(function() {
			if( $search_box1.attr("value") == "" ) {
                $search_box1.attr("value", "title of paper");
            }
		});
		
        $search_box2
			.focus(function() {
            if( $search_box2.attr("value") == "tag" ) {
 
                // Set it to an empty string
                $search_box2.attr("value", "");
            }
        })
			.blur(function() {
			if( $search_box2.attr("value") == "" ) {
                $search_box2.attr("value", "tag");
            }
		});
		
        $search_box3
			.focus(function() {
            if( $search_box3.attr("value") == "author" ) {
 
                // Set it to an empty string
                $search_box3.attr("value", "");
            }
        })
			.blur(function() {
			if( $search_box3.attr("value") == "" ) {
                $search_box3.attr("value", "author");
            }
		});
		
        $search_box4
			.focus(function() {
            if( $search_box4.attr("value") == "year" ) {
 
                // Set it to an empty string
                $search_box4.attr("value", "");
            }
        })
			.blur(function() {
			if( $search_box4.attr("value") == "" ) {
                $search_box4.attr("value", "year");
            }
		});
		
  });
  

</script>	
<style>
.inputc {
    float:right;
    width:200px;
    border:2px solid #dadada;
    border-radius:7px;
    font-size:20px;
    padding:5px;
    margin-top:-10px;    
}

.inputc:focus { 
    outline:none;
    border-color:#9ecaed;
    box-shadow:0 0 10px #9ecaed;
}
</style>

</head>

<body id="body">



<div id="edgesline" class="edges"></div>
<div id="tabs">

    <ul id="tabMenu">
  
        <li class="regular"><a href="../index.php">Home</a></li>
	<?php if(!isset($_SESSION['myusername'])){ ?>
        <li class="dropdown"><a href="#tab1">Login</a></li>
        <li class="dropdown"><a href="#tab2">Sign-Up</a></li>
    <?php } ?>
	<?php if(isset($_SESSION['myusername'])) { ?>
		<li class="dropdown"> <a href="#tab3"><span > upload </a></span></li>
	<?php if($_SESSION['priv'] == '0')	{  ?>
		
		<li class="regular"> <a href="../control/admin.php"><span > Admin Option</a></span></li> <?php } ?>
		<li class="regular"><a href="../control/logout.php"><span style="color:green"> Logout </a></span></li>
		<?php 	}?>
    </ul>


</div>

<div id="tabContainer">
<?php if(!isset($_SESSION['myusername'])){ ?>
	<ul id="tabPanes">
		<li id="tab1">
			
			<p>
				<form method="post" action="control/login.php">
				<div class="formcontainer">
					
					<div class="text">
						<label for="username">Username</label>
						<input type="text" name="myusername" id="username" alt="The username you chose when signing-up for the site.">
					</div>
					
					<div class="text">
						<label for="password">Password</label>
						<input type="password" name="mypassword" id="password" alt="The password you chose when signing-up for the site.">
					</div>
					
					<div class="text">
						<br>

						<input type="checkbox" name="rememberme" id="rememberme"> Remember Me
						
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
				<form method="post" action="../control/register.php">
				<div class="formcontainer">
					<div class="text">
						<label for="username">Desired Username</label>
						<input type="text" name="desusername" id="desusername" alt="Min. 5 characters Long. <br>All Lowercase letters.<br>Easy to remember">
					</div>

					
					<div class="text">
						<label for="email">Email id</label>
						<input type="email" name="email" id="email" alt="is complusory">
					</div>

					<div class="text">
						<label for="despassword">Desired Password</label>
						<input type="password" name="despassword" id="despassword" alt="Min. 5 characters Long.<br>Must include 1 Number<br>& One Uppercase Letter.">
					</div>

					<div class="text">
						<label for="password">Confirm Password</label>
						<input type="password" name="confpassword" id="confpassword" alt="Please ensure this matches the password above">
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
					<form method="post" action="../control/upload.php" method="post" enctype="multipart/form-data">
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
		}
		if(isset($_GET['success']))
		{
			if($_GET['success']==0)
				echo "Username or password is incorrent";
		}
	?>
</div>
<div class="head_name">
<H1> AcadSeer </h1>
</div>


<?php
function print_unapproved($row)
{
?>
<div>
<?php
if(mysqli_num_rows($row)==0) { ?>
	<p style="color:Green; text-align:center">	Nothing to Approve </p>
<?php }	
	else
	
{	
?>
		<table width="100%">
		
	<?php	while($temp=mysqli_fetch_array($row))
		{
			$loc="../control/admin/".$temp['name'] ?>
		
				<tr>
				<form id="admin_form" action="../control/admin_approvalprocess.php" method="post">
					<td>
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <a href= <?php echo $loc ?>  > <img src="images/preview.png" height="70" width="70"></img></a>
					</td>
					<td>
						<input id="search_box1" class="inputc" type="text" name="name" value="title of paper"/>
					</td>
					<td>

						<input id="search_box2" class="inputc" type="text" name="tag" value="tag"/>
					</td>
					<td>

						<input id="search_box3" class="inputc" type="text" name="authors" value="authors"/>
					</td>
										<td>

						<input id="search_box4" class="inputc" type="text" name="year" value="year" value="Year of publication"/>
					</td>

					<td>
						<input type="submit" name="approve" value="approve">
					</td>
					<td>
						<input type="submit" name="decline" value="decline">
					</td>
					<td>
						<input type="hidden" name="prev" value=<?php echo $temp['name'] ?> />
					</td>					
				</form>
				</tr>
		<?php } ?></table><?php
	}	
	?>
	
	</div>
	
	<br><br><br><br><br>
	<div id = "Footer">
		<hr style="margin-left:3cm;margin-right:3cm">
		<p style="color:#5FC9F9; text-align:center;" ><strong style="font-size:20 ">&#169 </strong>&nbsp TeamQuark, IIT Delhi</p>
	</div>
	
	<?php
}
?>