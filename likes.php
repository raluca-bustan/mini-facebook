<?php
function like($id,$username) //id poza
{	
	$db = new mysqli('localhost','root','','user');

	if($db->connect_error)
	   die("Connection failed: " . $db->connect_error);	
	   	
	//nr de like-uri
	$likes=$db->query("select count(ID_like) as nr_likes from likes where ID_img = '$id'");
	
	if($row=mysqli_fetch_array($likes))
		echo $row["nr_likes"]." ";

	//verificare daca userul a dat deja like
	$likes=$db->query("select count(ID_like) as nr_likes from likes l join users u on l.ID_user=u.id where u.username='$username' and l.ID_img='$id'");

 	if($row=mysqli_fetch_array($likes))
 		$count =$row["nr_likes"];
 	
 	if($count==1){
 		echo"(Liked)";
 	}
	

}
?>