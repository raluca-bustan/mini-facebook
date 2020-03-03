<?php

	session_start(); 
	$db = new mysqli('localhost','root','','user');

	if($db->connect_error)
	   die("Connection failed: " . $db->connect_error);	

 	$id_img= $_POST['ID_img'];
 	$username=$_SESSION['username'];

 	// get no of likes for each image
 	$likes=$db->query("select count(ID_like) as nr_likes from likes l join users u on l.ID_user=u.id where u.username='$username' and l.ID_img='$id_img'");

 	if($row=mysqli_fetch_array($likes))
 		$count =$row["nr_likes"];

 	if($count==0){ //userul nu a dat like
 		$likes=$db->query("insert into likes(ID_user,ID_img) values ((select id from users where username='$username'),'$id_img')"); 
 	}
 	else{ //unlike	
 		$likes=$db->query("delete from likes where ID_img='$id_img' and ID_user=(select id from users where username='$username')");
 	 	}
       
	if($_SESSION['page']==0)
		 header('location: index.php'); //home page
	else
		header('location: profile.php'); //profile page
?>