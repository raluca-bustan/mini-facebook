<?php 
	session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}

	$_SESSION['page']=1;
	if($_SESSION['con']==1)
	header('location: show.php');
	$_SESSION['con']=1;	 

?>

<!DOCTYPE html>
<html>
<head>
	<title>My profile</title>
	<link rel="stylesheet" type="text/css" href="styleindex.css">
</head>
<body>
	<div class="header">
		<h2 style="margin-left:2em">Profile</h2>

		<?php  if (isset($_SESSION['username'])) : ?>

		<p style= " margin-right:2em " align="right" >Welcome <strong><?php echo $_SESSION['username']; ?>	</strong></p>
		<p style= " margin-right:2em " align="right" > <a href="index.php?logout='1'" style="color: red;">logout		</a> </p>

		<?php endif ?>
	</div>	

 	<!-- UPLOAD IMAGE -->
	<div class="content">
		<form action="upload.php" method="post" enctype="multipart/form-data">
      	    <font size="5" color="white"> Select image to upload: </font> <br>
	        <input type="file" name="image"/>
	        <input type="submit" name="submit" value="UPLOAD" style="height:30px; width:80px"/>
        </form>		
	</div>

	<!-- BACK TO HOME PAGE BUTTON -->
	<div class="home-page">
		<form action="index.php" method="post" enctype="multipart/form-data">
			<input type="submit" name="index" value="Home Page" style="height:30px; width:80px"/>
		</form>
	</div>

	
	<?php	
	include 'comments.php';
	include 'likes.php';

	for($i=0;$i<$_SESSION['index'];$i++)
	{
		$row=$_SESSION['array'][$i];
	?>

	<!-- DELETE IMAGE BUTTON -->
	<center><br><br><div class = "delete">
		<form method="post" action="delete.php">
		    <input type="hidden" name="ID" value="<?php echo $row['ID_img'];?>">
		    <input type="submit" name="delete" value='X' style="height:25px; width:25px"/>
		</form>
	</div></center>
   
   	<!-- DISPLAY DATE OF UPLOAD -->
	<center><div class="date">
		<?php
			echo $row["Date"];
		?>
	</div></center>

	<!-- DISPLAY IMAGES -->
	<div class="images">
		<?php		
			echo '<center><img src="data:image/jpeg;base64,' .base64_encode($row['File']).'" class = "img-thumbnail"/ ></center>';
			echo '<br><br>';	
		?>		
	</div>		

	<!--NUMBER OF LIKES AND LIKE BUTTON DISPLAY-->
	<center><div class="likes">
		<form action="enter_like.php" method="post" >
		 	<font size=5 color="blue" >LIKES: </font>	
		 	<?php
			like($row["ID_img"],$_SESSION["username"]);
			?>								
			<input type="hidden" name="ID_img" value="<?php echo $row['ID_img'];?>">
			<input name="form" type="submit" value="Like" style="height:25px; width:60px"/><br><br>
		</form>
	</div></center>

	<!-- COMMENTS UPLOAD AND DISPLAY -->
	<center><div class="comments"> 
		<font size=5 color="blue" >COMMENTS: </font> <br>
		<?php
		comment($row["ID_img"]);
		?>
		<form action="enter_comment.php" method="post" >
			<label><font color="black">New comment:  </font></label>
			<input type="text" name="text">
			<input type="hidden" name="ID_img" value="<?php echo $row['ID_img'];?>">
			<input name="form" type="submit" value="Insert"/><br><br><br><br>
		</form>
	</div></center>

	<?php				
	}?>			

</body>
</html>