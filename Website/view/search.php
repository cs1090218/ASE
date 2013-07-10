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
<script src="js/jquery.min.js" type="text/javascript">



</script>

<!-- Add jQuery library -->
<script type="text/javascript" src="../lib/jquery-1.8.2.min.js"></script>

<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="../source/jquery.fancybox.js?v=2.1.3"></script>
<link rel="stylesheet" type="text/css" href="../source/jquery.fancybox.css?v=2.1.2" media="screen" />

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
		$('.fancybox').fancybox();
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
			$url= "../control/search.php?"+"name="+$name+"&"+"param="+$search_param;
			window.location=$url;			
		}
		function popular_a()
		{
			window.location="../control/popular.php?author";			
		}
		function popular_t()
		{
			window.location="../control/popular.php?title";			
		}
		function popular_c()
		{
			window.location="../control/popular.php?citation";			
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
		$iii=1;
		function show(a)
		{
			//alert("a");
			$str="<img src='"+a+"' >";
			var e= document.getElementById("preview");
			e.innerHTML="<p>"+$iii+"</p><img src='"+a+"' width='450px'>";
			$iii++;
			$("#preview").fadeOut();
			$("#preview").fadeIn();
		}
		
		function hide()
		{
			var e= document.getElementById("preview");
			e.innerHTML="";

		}
		function valueToSearchBox($qq, $param)
		{
			$("#search_box").attr("value", $qq);
			applyClass($param+1);
		}
		
		function showSummary($start, $end, $next_result, $color1, $prev_result, $color2)
		{
			document.getElementById("result_bar_top").innerHTML = "<table style=\"background-color:#354D57;color:#2FA7D6\"><tr><td style=\"width:550\"><b>&nbsp&nbsp&nbspResults " + $start + "&nbsp-&nbsp" + $end + "</b></td><td style=\"width:150px;font-size:17px\"><a style=\"color:"+$color2+"; text-decoration:none\" href=" + $prev_result + "><b>Previous</b></a></td><td style=\"width:50px;font-size:17px\"><a style=\"color:"+$color1+"; text-decoration:none\" href=" + $next_result + "><b>Next</b></a></td></tr></table>";
			document.getElementById("result_bar_bottom").innerHTML = "<table style=\"background-color:#354D57;color:#2FA7D6\"><tr><td style=\"width:550\"><b>&nbsp&nbsp&nbspResults " + $start + "&nbsp-&nbsp" + $end + "</b></td><td style=\"width:150px;font-size:17px\"><a style=\"color:"+$color2+"; text-decoration:none\" href=" + $prev_result + "><b>Previous</b></a></td><td style=\"width:50px;font-size:17px\"><a style=\"color:"+$color1+"; text-decoration:none\" href=" + $next_result + "><b>Next</b></a></td></tr></table>";
		}
	

</script>
<style type="text/css">
	.fancybox-custom .fancybox-skin {
		box-shadow: 0 0 50px #222;
	}
</style>
	

</head>

<body>


<div id="edgesline" class="edges"></div>
<div>
	<img src="images/title.gif" height="50px" style="float:left; margin-left:100px" />


	<div id="tabs">

		<ul id="tabMenu">
	  
			<li class="regular"><a href="../index.php">Home</a></li>
		<?php if(!isset($_SESSION['myusername'])){ ?>
			<li class="dropdown"><a href="#tab1">Login</a></li>
			<li class="dropdown"><a href="#tab2">Sign-Up</a></li>
		<?php } ?>
		<?php if(isset($_SESSION['myusername'])) { ?>
			<li class="dropdown"> <a href="#tab3"><span > upload </a></span></li>
			<?php if($_SESSION['priv'] == 0)	{  ?>
			
			<li class="regular"> <a href="../control/admin.php"><span > Admin Option</a></span></li> <?php } ?>
			<li class="regular"><a href="../control/logout.php"><span style="color:green"> Logout </a></span></li>
			<?php 	}?>
		</ul>


	</div>
</div>
<div id="tabContainer">
<?php if(!isset($_SESSION['myusername'])){ ?>
	<ul id="tabPanes">
		<li id="tab1">
			
			<p>
				<form method="post" action="../control/login.php">
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
				<form method="post" action="../control/register.php">
				<div class="formcontainer">
					<div class="text">
						<label for="username">Desired Username</label>
						<input type="text" class="custom" name="desusername" id="desusername" alt="Min. 5 characters Long. <br>All Lowercase letters.<br>Easy to remember">
					</div>

					
					<div class="text">
						<label for="email">Email id</label>
						<input type="email" class="custom" name="email" id="email" alt="is complusory">
					</div>

					<div class="text">
						<label for="despassword">Desired Password</label>
						<input type="password" class="custom" name="despassword" id="despassword" alt="Min. 5 characters Long.<br>Must include 1 Number<br>& One Uppercase Letter.">
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


	<div class="wrapper">
		<form name="search_form" action="../control/search.php" method="get" >
			<br><br>
			<!--<span id="2" class="buttons" onclick="applyClass('2');">Title</span>
			<span id="1" class="button" style="margin-right:1150" onclick="applyClass('1');">Author</span>	-->
			<table width="100%">

			<tr>
			<td></td>
			<td style="width:500;margin-left:30;"><input type="text" class = "inputc" style="width:500px;" name="name" id="search_box" value="Search...."></input></td>
			<td style="padding:0;"><input type="hidden" class = "inputc" style="width:0px;" name="param" id="param" value="1" ></input></td>
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
<hr style="text-align:left;margin-left:113;padding: 0px;margin-bottom: 2" width=750 size=1>
<div id="result_bar_top" style="height:20px;width:750px; margin-left:113px;background-color:#354D57;color:#2FA7D6"></div>	
	<br>	
<?php 
//#DF9F7B
		function printSearchDetailsAndQueryBox($q, $max, $param)
		{
			echo '<script type="text/javascript">
                valueToSearchBox( "'.$q.'",'.$param.');
                </script>';
			
			
		
		}
		?>
		
			<?php
			function printsearch($title_of_page, $author_of_page, $ip,$paper_id, $cont,$pos)
			{ 
			
				$img_address="http://".$ip."/SE/DatabasePapers/".$paper_id.".jpg"; 
				?>
				
				
					<div  class="search_div" style="margin-left:113; width:750" >
						<?php //$link =$ip."DBP/".$paper_id.".pdf" ?>
						<?php $link ="http://".$ip."/SE/DatabasePapers/".$paper_id.".pdf" ?>

						<a href=<?php echo $link ?> style="text-decoration:none"><span class="title_link"><?php echo "[PDF] "; ?><strong><?php echo $title_of_page?></strong></span></a>
						<a class="fancybox" href="<?php echo $img_address ?>" data-fancybox-group="gallery" title="<?php echo $title_of_page ?>"><img src="images/preview.png" style="float:right" height="50" width="50" /></a><br>
						<i class="author_link"> <?php echo "by ".$author_of_page ?></i><br>
						<p> <font color="#5FC9F9" ><?php echo $cont ?></font>

						</p>
						<br>
						<br>
						
					</div>
				
				
				
		<hr color=whitesmoke size=1 width=750 style="text-align:left; margin-left:113">
				<?php
	
			}?>


		
		<?php
		function bottomPane($q, $max, $param, $num)
		{
			if($num == 0){
				?>
				
		
					<div id ="resultspane" class="search_div" style="margin-left:115;width:750">
						<p style="color:#DF9F7B;font-size:30">We could not find any search result corresponding to your query. Please try to refine your query.
						</p>
					</div>
				<?php	
				return;
			}
			
			
			
			$start = $max - 9;
			$end = $max;
			?>
			<div id="result_bar_bottom" style="margin-left:113;width:750px; ">
			</div>
			<hr style="text-align:left;padding: 0px;margin-bottom: 2;margin-top:2;margin-left:113;" width=750 size=1>
			<?php
			$pageNo = ($max/10)+1;
			$prevNo = ($max/10)-1;
			$nextPage = "../control/search.php?name=".$q."&param=".$param."&page=".$pageNo;
			$nextPage = str_replace(" ", "+", $nextPage);
			if($num < 10)
				$nextPage = "http://#";
			$prevPage = "../control/search.php?name=".$q."&param=".$param."&page=".$prevNo;
			$prevPage = str_replace(" ", "+", $prevPage);
			if($start == 1)
				$prevPage = "http://#";
			
			$color1 = "#2FA7D6";
			$color2 = "#2FA7D6";
			if($num < 10)
				$color1 = "2A7594";
			if($start == 1)
				$color2 = "2A7594";
			if($num < 10)
				$end = $start + $num - 1;
			if($num == 0)
				$start = 0;
			echo '<script type="text/javascript">
                showSummary( '.$start.', '.$end.',"'.$nextPage.'","'.$color1.'","'.$prevPage.'","'.$color2.'");
                </script>';
				?>
				<br><br><br><br><br>
				<div id = "Footer">
					<hr style="margin-left:3cm;margin-right:3cm">
					<p style="color:#5FC9F9; text-align:center;" ><strong style="font-size:20 ">&#169 </strong>&nbsp TeamQuark, IIT Delhi</p>
				</div>
				<?php
		}

?>



</body>