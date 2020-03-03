<?php

session_start();
$db = new mysqli('localhost','root','','user');

 if($db->connect_error){
    die("Connection failed: " . $db->connect_error);
}	
	$us= $_SESSION['username'];
	$id_img= $_POST['ID'];

	//buton de delete apasat
 	$delete=$db->query("DELETE  FROM images where ID_img='$id_img' and ID_user=(SELECT id from users where username='$us')");
 	
	header('location: profile.php');

?>