<?php

	session_start(); 
	$db = new mysqli('localhost','root','','user');

	if($db->connect_error)
	   die("Connection failed: " . $db->connect_error);	

	 $username=$_SESSION['username'];
	
	 $id_img= $_POST['ID_img'];
	
	 $text= $_POST['text'];

	//inserare comentariu
	$comms=$db->query("insert into coments(ID_user,ID_img,text) values ((select id from users where username='$username'),'$id_img','$text')");
            
	if($_SESSION['page']==0)
	 header('location: index.php'); //home page
	else
		header('location: profile.php'); //profile

?>
