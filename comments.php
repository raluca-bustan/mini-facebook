<?php

function comment($id) //id poza
{	
	$db = new mysqli('localhost','root','','user');

	if($db->connect_error)
	   die("Connection failed: " . $db->connect_error);		

	//afisare comentarii
	$comms=$db->query("select coments.text, users.username from coments join users on coments.ID_user=users.id where coments.ID_img='$id'order by Date");
	
	while($row=mysqli_fetch_array($comms))
	{
		echo '<font size="4" style="color: black;">'.$row["username"].':	</font>';	
		echo $row["text"];
		echo '<br>';
	}
}
?>
